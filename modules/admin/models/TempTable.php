<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 28.09.17
 * Time: 16:51
 */

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;

class TempTable extends ActiveRecord
{

    /**
     * const ORDER_CLOSED = 4(order DELIVERED and PAID FOR);
     */
    const ORDER_OPEN = 1;
    const SENT_BY_CUSTOMER = 2;
    const ORDER_ASSEMBLE = 3;
    const ORDER_CLOSED = 4;


    public static function tableName()
    {
        return 'tempTable';
    }

    public function rules()
    {
        return [
            [['userId'], 'integer'],

            [['status'], 'integer'],
            [['name'], 'string'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер заказа',
            'userId' => 'Статус заказчика',
            'date_order' => 'Дата заказа',
            'address' => 'Адрес доставки',
            'status' => 'Статус заказа',
            'name'=> 'Имя заказчика',
            'surename'=>'Фамилия заказчика',
            'email'=>'E-mail заказчика',
            'phone'=>'Телефон',

            'phone2'=>'Телефон(доп)',

            'phones'=>'Телефоны',
            'fullname'=>'Заказчик',
            'view'=>'Просмотр заказа',
        ];
    }

    public function getFullName() {
        return $this->name . ' ' . $this->surename;
    }


    public static  function setTable($status){
         Yii::$app->db->createCommand( 'CREATE TEMPORARY TABLE tempTable 
                                            SELECT o.`id`,o.`userId`,o.`date_order`,o.`address`,o.`status`, 
                                             CONCAT(u.`name`," ", u.`surename`) AS `fullname`
                                            ,u.`email`,CONCAT(u.`phone`,"\n",u.`phone2`) AS `phones`,u.`status`AS `userStatus` 
                                            FROM orders o 
                                            JOIN users u ON u.`id` = o.`userId`
                                             WHERE o.`status` = '.$status.'
                                             ORDER BY `date_order` DESC')

                     ->execute();
    }

}

//u.`name`, GROUP_CONCAT(u.`surename` SEPARATOR '\n') AS `fullname`