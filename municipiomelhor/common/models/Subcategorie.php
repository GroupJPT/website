<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subcategorie".
 *
 * @property int $id
 * @property string $name
 * @property int $categorie_id
 *
 * @property Categorie $categorie
 * @property Occurrence[] $occurrences
 */
class Subcategorie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subcategorie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'categorie_id'], 'required'],
            [['categorie_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['categorie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorie::class, 'targetAttribute' => ['categorie_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'categorie_id' => Yii::t('app', 'Categorie ID'),
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
     * Gets query for [[Occurrences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOccurrences()
    {
        return $this->hasMany(Occurrence::class, ['subcategorie_id' => 'id']);
    }
}
