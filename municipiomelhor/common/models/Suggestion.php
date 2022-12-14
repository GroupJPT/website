<?php

namespace common\models;

use Yii;

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
class Suggestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suggestion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'description', 'user_id'], 'required'],
            [['description'], 'string'],
            [['user_id'], 'integer'],
            [['address'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'address' => Yii::t('app', 'Address'),
            'description' => Yii::t('app', 'Description'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * Gets query for [[SuggestionHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuggestionHistories()
    {
        return $this->hasMany(SuggestionHistory::class, ['suggestion_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
