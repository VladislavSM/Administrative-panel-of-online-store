<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 30.09.17
 * Time: 21:48
 */

namespace app\modules\admin\models;


use yii\db\ActiveRecord;
use Yii;
class Orders extends ActiveRecord
{

    const ORDER_OPEN = 1;
    const SENT_BY_CUSTOMER = 2;
    const ORDER_ASSEMBLE = 3;
    const ORDER_CLOSED = 4;

public $name;

    public static function tableName()
    {
        return 'orders';
    }

    public function rules()
    {
        return [
            [['userId'], 'integer'],
            [['status'], 'integer'],
//            [['name'], 'string'],

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
        ];
    }


    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'userId']);
    }

//    public static  function setQuery($status){
//       return Yii::$app->db->createCommand( '
//                                            SELECT o.`id`AS `id`,o.`userId`,o.`date_order`,o.`address`,o.`status`,
//                                            u.`name`AS`name`,u.`surename`,u.`email`,u.`phone`,u.`phone2`
//                                            FROM orders o
//                                            JOIN users u ON u.`id` = o.`userId`
//                                             WHERE o.`status` = '.$status.' ')
//
//            ->queryAll();
//    }






    public function findOrders($id){
        return (new \yii\db\Query())
            ->select(['or.id','or.date_order', 'or.address','or.status', 'it.title','ito.quantity','ito.price',
                'ito.sumForItem', ])
            ->from('orders or')
            ->innerJoin('itemToOrder ito','or.id=ito.orderId')
            ->innerJoin('item it','ito.itemId=it.id')
//        ->where('userId=:userId', [':userId' => Yii::$app->user->identity['id']])
            ->where('or.id=:id', [':id' => $id])
//        ->andwhere('or.id=:id',[':id'=>$id])

//        ->andWhere(['status'=>$status])
//            ->orderBy('id DESC')

            ->all();

    }

    public function findUser($id){
        $user = (new \yii\db\Query())
            ->select(['u.name','u.surename', 'u.email', 'u.phone','u.phone2',])
            ->from('orders or')
            ->leftJoin('users u','or.userId=u.id')
            ->where('or.id=:id', [':id' => $id])
            ->one();

        return $user;
    }
}