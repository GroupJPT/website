<?php

namespace common\models;

use yii\db\ActiveRecord;

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

class OccurrenceFollow extends ActiveRecord {

    public static function tableName() { return 'occurrence_follow'; }

    public function rules() {
        return [
            [['created_at', 'user_id', 'occurrence_id'], 'required'],
            [['created_at'], 'safe'],
            [['user_id', 'occurrence_id'], 'integer'],
            [['occurrence_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occurrence::class, 'targetAttribute' => ['occurrence_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
            'occurrence_id' => 'Occurrence ID',
        ];
    }

    public function getOccurrence() {
        return $this->hasOne(Occurrence::class, ['id' => 'occurrence_id']);
    }

    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
