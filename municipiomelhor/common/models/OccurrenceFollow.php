<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "occurrence_follow".
 *
 * @property int $id
 * @property string $created_at
 * @property int $user_id
 * @property int $occurrence_id
 *
 * @property Occurrence $occurrence
 * @property User $user
 */
class OccurrenceFollow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'occurrence_follow';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'user_id', 'occurrence_id'], 'required'],
            [['created_at'], 'safe'],
            [['user_id', 'occurrence_id'], 'integer'],
            [['occurrence_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occurrence::class, 'targetAttribute' => ['occurrence_id' => 'id']],
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
            'created_at' => Yii::t('app', 'Created At'),
            'user_id' => Yii::t('app', 'User ID'),
            'occurrence_id' => Yii::t('app', 'occurrence ID'),
        ];
    }

    /**
     * Gets query for [[occurrence]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOccurrence()
    {
        return $this->hasOne(Occurrence::class, ['id' => 'occurrence_id']);
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
