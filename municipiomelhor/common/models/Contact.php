<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $region
 * @property string $postal-code
 * @property int $phone
 * @property int|null $fax
 * @property string|null $email
 * @property string|null $website
 * @property int $category_id
 *
 * @property Category $category
 */

class Contact extends ActiveRecord {

    public static function tableName() { return 'contact'; }

    public function rules() {
        return [
            [['name', 'address', 'region', 'postal-code', 'phone'], 'required'],
            [['phone', 'fax'], 'integer'],
            [['name', 'address', 'region', 'postal-code', 'email', 'website'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'region' => 'Region',
            'postal-code' => 'Postal Code',
            'phone' => 'Phone',
            'fax' => 'Fax',
            'email' => 'Email',
            'website' => 'Website',
        ];
    }
}
