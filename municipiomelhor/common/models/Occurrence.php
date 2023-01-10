<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "occurrence".
 *
 * @property int $id
 * @property string $description
 * @property string $address
 * @property string $region
 * @property string $postal_code
 * @property string $lat
 * @property string $lng
 * @property int $user_id
 * @property int $category_id
 * @property int $subcategory_id
 *
 * @property Category $category
 * @property OccurrenceFollow[] $occurrenceFollows
 * @property OccurrenceHistory[] $occurrenceHistories
 * @property OccurrencePhoto[] $occurrencePhotos
 * @property Subcategory $subcategory
 * @property User $user
 */

class Occurrence extends ActiveRecord {

    public static function tableName() { return 'occurrence'; }

    public function rules() {
        return [
            [['description', 'address', 'region', 'postal_code', 'lat', 'lng', 'user_id', 'category_id', 'subcategory_id'], 'required'],
            [['description'], 'string'],
            [['user_id', 'category_id', 'subcategory_id'], 'integer'],
            [['address', 'region', 'postal_code', 'lat', 'lng'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['subcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::class, 'targetAttribute' => ['subcategory_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'description' => 'Descrição',
            'address' => 'Rua',
            'region' => 'Localidade',
            'postal_code' => 'Código Postal',
            'category_id' => 'Category ID',
            'subcategory_id' => 'Subcategory ID',
        ];
    }

    public function getCategory() { return $this->hasOne(Category::class, ['id' => 'category_id']); }

    public function getOccurrenceFollows() { return $this->hasMany(OccurrenceFollow::class, ['occurrence_id' => 'id']); }

    public function getOccurrenceHistories() { return $this->hasMany(OccurrenceHistory::class, ['occurrence_id' => 'id']); }

    public function getOccurrencePhotos() { return $this->hasMany(OccurrencePhoto::class, ['occurrence_id' => 'id']); }

    public function getSubcategory() { return $this->hasOne(Subcategory::class, ['id' => 'subcategory_id']); }

    public function getUser() { return $this->hasOne(User::class, ['id' => 'user_id']); }
}
