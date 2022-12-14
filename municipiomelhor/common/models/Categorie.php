<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categorie".
 *
 * @property int $id
 * @property string $name
 * @property string $topic
 *
 * @property Contact[] $contacts
 * @property Occurrence[] $occurrences
 * @property Subcategorie[] $subcategories
 * @property Warning[] $warnings
 */
class Categorie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categorie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'topic'], 'required'],
            [['name', 'topic'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'topic' => Yii::t('app', 'Topic'),
        ];
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::class, ['categorie_id' => 'id']);
    }

    /**
     * Gets query for [[Occurrences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOccurrences()
    {
        return $this->hasMany(Occurrence::class, ['categorie_id' => 'id']);
    }

    /**
     * Gets query for [[Subcategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategories()
    {
        return $this->hasMany(Subcategorie::class, ['categorie_id' => 'id']);
    }

    /**
     * Gets query for [[Warnings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWarnings()
    {
        return $this->hasMany(Warning::class, ['categorie_id' => 'id']);
    }
}
