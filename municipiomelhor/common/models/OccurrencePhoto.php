<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "occurrence_photo".
 *
 * @property int $id
 * @property string $photo_path
 * @property int $occurrence_id
 *
 * @property Occurrence $occurrence
 */
class OccurrencePhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'occurrence_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo_path', 'occurrence_id'], 'required'],
            [['occurrence_id'], 'integer'],
            [['photo_path'], 'string', 'max' => 255],
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
            'photo_path' => Yii::t('app', 'Photo Path'),
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
