<?php

namespace common\models;

use app\mosquitto\phpMQTT;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "occurrence".
 *
 * @property int $id
 * @property string $description
 * @property string $address
 * @property string $region
 * @property string $postal_code
 * @property string $lat
 * @property string $lng
 * @property int $user_id
 * @property int $category_id
 * @property int $subcategory_id
 *
 * @property Category $category
 * @property OccurrenceFollow[] $occurrenceFollows
 * @property OccurrenceHistory[] $occurrenceHistories
 * @property Subcategory $subcategory
 * @property User $user
 */

class Occurrence extends ActiveRecord {

    public static function tableName() { return 'occurrence'; }

    public function rules() {
        return [
            [['description', 'address', 'region', 'postal_code', 'lat', 'lng', 'user_id', 'category_id', 'subcategory_id'], 'required'],
            [['description'], 'string'],
            [['user_id', 'category_id', 'subcategory_id'], 'integer'],
            [['address', 'region', 'postal_code', 'lat', 'lng'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['subcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::class, 'targetAttribute' => ['subcategory_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'description' => 'Descrição',
            'address' => 'Rua',
            'region' => 'Localidade',
            'postal_code' => 'Código-Postal',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'subcategory_id' => 'Subcategory ID',
        ];
    }

    public function getCategory() { return $this->hasOne(Category::class, ['id' => 'category_id']); }

    public function getOccurrenceFollows() { return $this->hasMany(OccurrenceFollow::class, ['occurrence_id' => 'id']); }

    public function getOccurrenceHistories() { return $this->hasMany(OccurrenceHistory::class, ['occurrence_id' => 'id']); }

    public function getSubcategory() { return $this->hasOne(Subcategory::class, ['id' => 'subcategory_id']); }

    public function getUser() { return $this->hasOne(User::class, ['id' => 'user_id']); }




    // MOSQUITTO ----------------------------------------
    public function afterSave($insert, $changedAttributes) {

        parent::afterSave($insert, $changedAttributes);

        $msgCreate = "Uma nova ocorrência foi criada com o ID:".$this->id.".";
        $msgUpdate = "A ocorrência com o ID:".$this->id." foi alterada antes de ser analisada.";
        if ($insert)
            $this->makePublish("OccurrenceInfo", $msgCreate);
        else
            $this->makePublish("OccurrenceInfo", $msgUpdate);
    }

    public function afterDelete() {

        parent::afterDelete();

        $msgDelete = "A ocorrência com o ID:".$this->id." foi eleminado antes de ser analisada.";
        $this->makePublish("OccurrenceInfo",$msgDelete);
    }

    public function makePublish($canal,$msg) {
        $server = "127.0.0.1";
        $port = 1883;
        $username = "";
        $password = "";
        $client_id = "phpMQTT-publisher";
        $mqtt = new phpMQTT($server, $port, $client_id);
        if ($mqtt->connect(true, NULL, $username, $password)) {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        }
        else { file_put_contents("debug.output","Time out!"); }
    }
}
