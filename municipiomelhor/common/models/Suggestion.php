<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "suggestion".
 *
 * @property int $id
 * @property string $address
 * @property string $description
 * @property int $user_id
 *
 * @property SuggestionHistory[] $suggestionHistories
 * @property User $user
 */

class Suggestion extends ActiveRecord {

    public static function tableName() { return 'suggestion'; }

    public function rules() {
        return [
            [['address', 'description', 'user_id'], 'required'],
            [['description'], 'string'],
            [['user_id'], 'integer'],
            [['address'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'description' => 'Description',
            'user_id' => 'User ID',
        ];
    }

    public function getSuggestionHistories() {
        return $this->hasMany(SuggestionHistory::class, ['suggestion_id' => 'id']);
    }

    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
