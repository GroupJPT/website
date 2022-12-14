<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property int $phone
 * @property int|null $fax
 * @property string|null $email
 * @property string|null $website
 * @property int $categorie_id
 * @property int $parish_id
 *
 * @property Categorie $categorie
 * @property Parish $parish
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone', 'categorie_id', 'parish_id'], 'required'],
            [['phone', 'fax', 'categorie_id', 'parish_id'], 'integer'],
            [['name', 'address', 'email', 'website'], 'string', 'max' => 255],
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
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'fax' => Yii::t('app', 'Fax'),
            'email' => Yii::t('app', 'Email'),
            'website' => Yii::t('app', 'Website'),
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
