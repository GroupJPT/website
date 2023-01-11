<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "suggestion_history".
 *
 * @property int $id
 * @property int $status
 * @property string $created_at
 * @property int $suggestion_id
 *
 * @property Suggestion $suggestion
 */

class SuggestionHistory extends ActiveRecord {

    public static function tableName() { return 'suggestion_history'; }

    public function rules() {
        return [
            [['status', 'created_at', 'suggestion_id'], 'required'],
            [['status', 'suggestion_id'], 'integer'],
            [['created_at'], 'safe'],
            [['suggestion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suggestion::class, 'targetAttribute' => ['suggestion_id' => 'id']],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'status' => 'Estado',
            'created_at' => 'Criado em',
            'suggestion_id' => 'Suggestion ID',
        ];
    }

    public function getSuggestion() { return $this->hasOne(Suggestion::class, ['id' => 'suggestion_id']); }
}
