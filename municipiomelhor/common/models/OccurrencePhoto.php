<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "occurrence_photo".
 *
 * @property int $id
 * @property string $photo_path
 * @property int $occurrence_id
 *
 * @property Occurrence $occurrence
 */

class OccurrencePhoto extends ActiveRecord {

    public static function tableName() { return 'occurrence_photo'; }

    public function rules() {
        return [
            [['photo_path', 'occurrence_id'], 'required'],
            [['occurrence_id'], 'integer'],
            [['photo_path'], 'string', 'max' => 255],
            [['occurrence_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occurrence::class, 'targetAttribute' => ['occurrence_id' => 'id']],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'photo_path' => 'Photo Path',
            'occurrence_id' => 'Occurrence ID',
        ];
    }

    public function getOccurrence() {
        return $this->hasOne(Occurrence::class, ['id' => 'occurrence_id']);
    }
}
