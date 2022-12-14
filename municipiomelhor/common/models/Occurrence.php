<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "occurrence".
 *
 * @property int $id
 * @property string $description
 * @property int $user_id
 * @property int $categorie_id
 * @property int $subcategorie_id
 * @property int $parish_id
 *
 * @property Categorie $categorie
 * @property OccurrenceFollow[] $occurrenceFollows
 * @property OccurrenceHistory[] $occurrenceHistories
 * @property OccurrencePhoto[] $occurrencePhotos
 * @property Parish $parish
 * @property Subcategorie $subcategorie
 * @property User $user
 */
class Occurrence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'occurrence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'user_id', 'categorie_id', 'subcategorie_id', 'parish_id'], 'required'],
            [['description'], 'string'],
            [['user_id', 'categorie_id', 'subcategorie_id', 'parish_id'], 'integer'],
            [['categorie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorie::class, 'targetAttribute' => ['categorie_id' => 'id']],
            [['parish_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parish::class, 'targetAttribute' => ['parish_id' => 'id']],
            [['subcategorie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategorie::class, 'targetAttribute' => ['subcategorie_id' => 'id']],
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
            'description' => Yii::t('app', 'Descrição'),
            'user_id' => Yii::t('app', 'ID Utilizador'),
            'categorie_id' => Yii::t('app', 'ID categoria'),
            'subcategorie_id' => Yii::t('app', 'ID Subcategoria'),
            'parish_id' => Yii::t('app', 'ID Freguesia'),
        ];
    }

    /**
     * Gets query for [[Categorie]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategorie()
    {
        return $this->hasOne(Categorie::class, ['id' => 'categorie_id']);
    }

    /**
     * Gets query for [[OccurrenceFollows]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOccurrenceFollows()
    {
        return $this->hasMany(OccurrenceFollow::class, ['occurrence_id' => 'id']);
    }

    /**
     * Gets query for [[OccurrenceHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOccurrenceHistories()
    {
        return $this->hasMany(OccurrenceHistory::class, ['occurrence_id' => 'id']);
    }

    /**
     * Gets query for [[OccurrencePhotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOccurrencePhotos()
    {
        return $this->hasMany(OccurrencePhoto::class, ['occurrence_id' => 'id']);
    }

    /**
     * Gets query for [[Parish]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParish()
    {
        return $this->hasOne(Parish::class, ['id' => 'parish_id']);
    }

    /**
     * Gets query for [[Subcategorie]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategorie()
    {
        return $this->hasOne(Subcategorie::class, ['id' => 'subcategorie_id']);
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
