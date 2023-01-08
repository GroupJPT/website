<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $created_at
 *
 * @property OccurrenceFollow[] $occurrenceFollows
 * @property Occurrence[] $occurrences
 * @property Suggestion[] $suggestions
 */

class User extends ActiveRecord implements IdentityInterface {

    public static function tableName() { return 'user'; }

    public function rules() {
        return [
            [['name', 'surname', 'email', 'auth_key', 'password_hash', 'created_at'], 'required'],
            [['created_at'], 'safe'],
            [['name', 'surname', 'email', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'created_at' => 'Created At',
        ];
    }

    public function getOccurrenceFollows() {
        return $this->hasMany(OccurrenceFollow::class, ['user_id' => 'id']);
    }

    public function getOccurrences() {
        return $this->hasMany(Occurrence::class, ['user_id' => 'id']);
    }

    public function getSuggestions() {
        return $this->hasMany(Suggestion::class, ['user_id' => 'id']);
    }

    public static function findIdentity($id) {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['auth_key' => $token]);
    }

    public static function findByEmail($email) {
        return static::findOne(['email' => $email]);
    }

    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token))
            return null;

        return static::findOne(['password_reset_token' => $token]);
    }

    public static function isPasswordResetTokenValid($token) {
        if (empty($token))
            return false;

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function getId(){
        return $this->getPrimaryKey();
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken(){
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }
}
