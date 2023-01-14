<?php

namespace common\models;

use app\mosquitto\phpMQTT;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "warning".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 */

class Warning extends ActiveRecord {

    public static function tableName() { return 'warning'; }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules() {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'description' => 'Descrição',
        ];
    }


    // MOSQUITTO ----------------------------------------
    public function afterSave($insert, $changedAttributes) {

        parent::afterSave($insert, $changedAttributes);

        $msgCreate = "Um novo aviso foi criada com o nome '".$this->name."'.";
        $msgUpdate = "O aviso com o nome '".$this->name."' foi alterado.";
        if ($insert)
            $this->makePublish("WarningInfo", $msgCreate);
        else
            $this->makePublish("WarningInfo", $msgUpdate);
    }

    public function afterDelete() {

        parent::afterDelete();

        $msgDelete = "O aviso com o nome '".$this->name."' foi eleminado.";
        $this->makePublish("WarningInfo",$msgDelete);
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
