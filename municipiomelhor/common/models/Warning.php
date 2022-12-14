<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "warning".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property int $categorie_id
 * @property int $parish_id
 *
 * @property Categorie $categorie
 * @property Parish $parish
 */
class Warning extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warning';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'created_at', 'categorie_id', 'parish_id'], 'required'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['categorie_id', 'parish_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['categorie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorie::class, 'targetAttribute' => ['categorie_id' => 'id']],
            [['parish_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parish::class, 'targetAttribute' => ['parish_id' => 'id']],
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
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'categorie_id' => Yii::t('app', 'Categorie ID'),
            'parish_id' => Yii::t('app', 'Parish ID'),
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
     * Gets query for [[Parish]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParish()
    {
        return $this->hasOne(Parish::class, ['id' => 'parish_id']);
    }
}
