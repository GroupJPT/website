<?php

namespace common\models;

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
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules() {
        return [
            [['name', 'description'], 'required'],
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
