<?php

namespace common\models;

use yii\db\ActiveRecord;

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

    public function rules() {
        return [
            [['name', 'description', 'created_at'], 'required'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'description' => 'Descrição',
            'created_at' => 'Criado em',
        ];
    }
}
