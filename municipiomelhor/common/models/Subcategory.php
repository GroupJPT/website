<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "subcategory".
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 *
 * @property Category $category
 * @property Occurrence[] $occurrences
 */

class Subcategory extends ActiveRecord {

    public static function tableName() { return 'subcategory'; }

    public function rules() {
        return [
            [['name', 'category_id'], 'required'],
            [['category_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
        ];
    }

    public function getCategory() {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getOccurrences() {
        return $this->hasMany(Occurrence::class, ['subcategory_id' => 'id']);
    }
}
