<?php

namespace common\models;

use Yii;

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
class SuggestionHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suggestion_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'suggestion_id'], 'required'],
            [['status', 'suggestion_id'], 'integer'],
            [['created_at'], 'safe'],
            [['suggestion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suggestion::class, 'targetAttribute' => ['suggestion_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'suggestion_id' => Yii::t('app', 'Suggestion ID'),
        ];
    }

    /**
     * Gets query for [[Suggestion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuggestion()
    {
        return $this->hasOne(Suggestion::class, ['id' => 'suggestion_id']);
    }
}
