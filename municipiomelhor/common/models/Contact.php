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
 * @property string $postal_code
 * @property int $phone
 * @property int|null $fax
 * @property string|null $email
 * @property string|null $website
 */
class Contact extends ActiveRecord {

    public static function tableName() { return 'contact'; }

    public function rules() {
        return [
            [['name', 'address', 'region', 'postal_code', 'phone'], 'required'],
            [['phone', 'fax'], 'integer'],
            [['name', 'address', 'region', 'postal_code', 'email', 'website'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'address' => 'Rua',
            'region' => 'Localidade',
            'postal_code' => 'Código-Postal',
            'phone' => 'Telefone',
            'fax' => 'Fax',
            'email' => 'Email',
            'website' => 'Website',
        ];
    }
}
