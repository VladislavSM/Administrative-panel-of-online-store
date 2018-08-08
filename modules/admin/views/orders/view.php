<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 19.09.17
 * Time: 17:32
 */

echo '<p class="data-customer">Заказчик : '. $user['name'].' '.$user['surename'].'<br>';
echo 'E-mail : ' . $user['email']. '<br> Контакные телефоны : '.$user['phone']. ' и '. $user['phone2'].'</p>';
//var_dump($user);
//echo 1;die;
foreach ($orders as $order) {

    $rows[$order['id']]['date'] = $order['date_order'];
    $rows[$order['id']]['address'] = $order['address'];
    $rows[$order['id']]['items'][] = [
        'title' => $order['title'],
        'price' => $order['price'],
        'quantity' => $order['quantity'],
        'sum' => $order['sumForItem'],
    ];
}
foreach ($rows as $key => $value) {
    $sum = 0;

        echo '<h3>Номер заказа : ' . $key . '.  Дата заказа : ' . $value['date'] . '</h3>
                     <h4>Адрес доставки : ' . $value['address'] . '</h4><br><br>
                         <h4>Состав заказа :</h4>
';


    foreach ($value['items'] as $item) {
        $sum += $item['sum'];
        echo '<div>
                    <ul>' . $item['title'] . ' ' . $item['quantity'] . ' шт. Цена : ' . $item['price'] . ' грн.
                         Сумма : ' . $item['sum'] . ' грн.
                    </ul>
             </div>';

    }
    echo '<div><p class="data-customer">Общая сумма заказа : ' . $sum . ' грн</p></div>';
    ;
}
//var_dump($orders);die;
switch ($orders[0]['status']) {
    case \app\modules\admin\models\Orders::SENT_BY_CUSTOMER:
        $mess = '';
        $title = ' Перевести заказ в работу.';
        break;
    case \app\modules\admin\models\Orders::ORDER_ASSEMBLE:
        $mess = 'После получения подтверждения доставки и оплаты заказа :';
        $title = ' Перевести заказ в ДОСТАВЛЕННЫЕ (закрыть заказ).';
        break;
    case \app\modules\admin\models\Orders::ORDER_CLOSED:
        $mess = '';
        $title = ' Вернуться к новым заказам.';
}
echo '<br><p class="data-customer" style="color: #28a4c9;font-weight: bolder">'.$mess.'</p><br>
      <a class="btn btn-info" href="/admin/orders/add-to?id='.$orders[0]['id'].'">'.$title.'</a>';

?>



