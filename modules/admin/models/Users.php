<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $surename
 * @property string $email
 * @property string $phone
 * @property integer $status
 * @property string $authKey
 */
class Users extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = 0;
    const STATUS_ADMIN = 3;
    const STATUS_UNREGISTERED_CUSTOMER = 9;
    const STATUS_USER = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['username'], 'string', 'max' => 32],
            [['password', 'name', 'surename', 'email', 'authKey'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 30],
            ['password', 'hashPassword'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Login',
            'password' => 'Password',
            'name' => 'Name',
            'surename' => 'Surename',
            'email' => 'Email',
            'phone' => 'Phone',
            'dateOfRegistr'=>'Pегистрации',
            'status' => 'Status',
            'authKey' => 'Auth Key',
            'action' => 'Action'
        ];
    }

    public function hashPassword() {
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
    }

    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['userId' => 'id']);
    }
}
