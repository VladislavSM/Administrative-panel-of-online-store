<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 28.09.17
 * Time: 16:48
 */

namespace app\modules\admin\controllers;

use app\modules\admin\models\TempTable;
use Yii;
use yii\web\Controller;
use app\modules\admin\models\OrdersSearch;
use app\modules\admin\models\Orders;
use app\modules\admin\models\Users;
use yii\web\NotFoundHttpException;


class OrdersController extends Controller
{
    public $layout = './adminlayout';
    public $defaultAction = 'index';

    public function getOrders($status) {
        $orders = new TempTable();
        $orders::setTable($status);
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->searchOrders($status);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {

        return $this->getOrders(Orders::SENT_BY_CUSTOMER);
    }

    public function actionAssembleOrders(){

        return $this->getOrders(Orders::ORDER_ASSEMBLE);

    }

    public function actionClosedOrders(){
        return $this->getOrders(Orders::ORDER_CLOSED);
    }

    public function actionView($id){

        $order = new Orders();
        $orders = $order->findOrders($id);
        $user = $order->findUser($id);


        return $this->render('view', [
            'user'=> $user,
            'orders'=>$orders,
        ]);


    }

    public function actionAddTo($id){//            'model' => $this->findModel($id),

        $model = $this->findModel($id);
        if ($model->status == $model::ORDER_CLOSED){//            'model' => $this->findModel($id),

            return $this->redirect('/admin/orders');
        }//            'model' => $this->findModel($id),

        if ($model->status === $model::SENT_BY_CUSTOMER){
            $model->status = $model::ORDER_ASSEMBLE;
            $model->save();
            if ($model->save()){
                \Yii::$app->session->addFlash('success', \Yii::t('app',
                    'Заказ № '.' - '.$model->id.' обработан'));
                return $this->redirect('/admin/orders');
            }else{
                \Yii::$app->session->addFlash('success', \Yii::t('app',
                    'Произошла ошибка - попробуйте повторить обработку заказа'));
                return $this->redirect('/admin/orders');
            }

        }
        if ($model->status == $model::ORDER_ASSEMBLE) {
            $model->status = $model::ORDER_CLOSED;
            $model->save();

            if ($model->save()) {
                \Yii::$app->session->addFlash('success', \Yii::t('app',
                    'Заказ № ' . ' - ' . $model->id . ' обработан'));
                return $this->redirect('/admin/orders');
            } else {
                \Yii::$app->session->addFlash('success', \Yii::t('app',
                    'Произошла ошибка - попробуйте повторить обработку заказа'));
                return $this->redirect('/admin/orders');
            }
        }//            'model' => $this->findModel($id),



    }

    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}