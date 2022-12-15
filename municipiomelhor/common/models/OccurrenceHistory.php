<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "occurrence_history".
 *
 * @property int $id
 * @property int $status
 * @property string $created_at
 * @property int $occurrence_id
 *
 * @property Occurrence $occurrence
 */
class OccurrenceHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'occurrence_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'occurrence_id'], 'required'],
            [['status', 'occurrence_id'], 'integer'],
            [['created_at'], 'safe'],
            [['occurrence_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occurrence::class, 'targetAttribute' => ['occurrence_id' => 'id']],
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
}
