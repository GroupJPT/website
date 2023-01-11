<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 *
 * @property Occurrence[] $occurrences
 * @property Subcategory[] $subcategories
 */

class Category extends ActiveRecord {

    public static function tableName() { return 'category'; }

    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Nome',
        ];
    }

    public function getOccurrences() { return $this->hasMany(Occurrence::class, ['category_id' => 'id']); }

    public function getSubcategories() { return $this->hasMany(Subcategory::class, ['category_id' => 'id']); }
}
