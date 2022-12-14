<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "parish".
 *
 * @property int $id
 * @property string $name
 *
 * @property Contact[] $contacts
 * @property Occurrence[] $occurrences
 * @property User[] $users
 * @property Warning[] $warnings
 */
class Parish extends ActiveRecord {

    public static function tableName() {
        return 'parish';
    }

    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Nome'),
        ];
    }






    public function getContacts() {
        return $this->hasMany(Contact::class, ['parish_id' => 'id']);
    }

    public function getOccurrences() {
        return $this->hasMany(Occurrence::class, ['parish_id' => 'id']);
    }

    public function getUsers() {
        return $this->hasMany(User::class, ['parish_id' => 'id']);
    }

    public function getWarnings() {
        return $this->hasMany(Warning::class, ['parish_id' => 'id']);
    }
}
