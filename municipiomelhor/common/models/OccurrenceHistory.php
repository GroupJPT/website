<?php

namespace common\models;

use yii\db\ActiveRecord;

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

class OccurrenceHistory extends ActiveRecord {

    public static function tableName() { return 'occurrence_history'; }

    public function rules() {
        return [
            [['status', 'created_at', 'occurrence_id'], 'required'],
            [['status', 'occurrence_id'], 'integer'],
            [['created_at'], 'safe'],
            [['occurrence_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occurrence::class, 'targetAttribute' => ['occurrence_id' => 'id']],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'status' => 'Estado',
            'created_at' => 'Criado em',
            'occurrence_id' => 'Occurrence ID',
        ];
    }

    public function getOccurrence() { return $this->hasOne(Occurrence::class, ['id' => 'occurrence_id']); }
}
