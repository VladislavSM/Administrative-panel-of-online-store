<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 21.09.17
 * Time: 10:10
 */

namespace app\modules\admin\controllers;


use app\modules\admin\models\Categories;
use app\modules\admin\models\ItemToCategory;
use Yii;
use app\modules\admin\models\Items;
use app\modules\admin\models\ItemsSearch;
use app\modules\admin\models\UploadForm;
use app\modules\admin\models\MultiUpload;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
//use app\models\Items;

class ItemsController extends Controller
{

    public $layout = './adminlayout';
    public $path = 'image/items/';
    public $DS = DIRECTORY_SEPARATOR;
    public $defaultAction = 'index';
    public $category;
//    public $newPath;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all  models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        $model = new Items();
        $model->findItem($id);
        $model->findPath($this->path);
        $model->viewImage();

        $ololo = $this->findModel($id);
        $ololo->images = $model->images;
//        var_dump($ololo, $model->item);die;
        return $this->render('view', [
            'model' => $ololo,
            'category'=>Items::getCategoryName($id),
            'images'=>$model->images,
        ]);
    }

    /**
     * Creates a new  model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $itemToCategory = new ItemToCategory();

        if (empty($id)) {
            $itemToCategory = new ItemToCategory();
            $model = new Items();
            $message = 'Добавить новый товар';
        } else {
            $model = $this->findModel($id);
            $model->category = $model->getCategoryName($model->id)['title'];

            $this->path = $this->path . $model->id . $this->DS;
            $model->findPath($this->path);
            $model->viewImage();

            $message ='Редактировать товар';
        }

        $modelUpload = new UploadForm();
        $modelMultiUpload = new MultiUpload();

        if ($model->load(Yii::$app->request->post())) {
            $modelUpload->imageFile =  UploadedFile::getInstance($modelUpload, 'imageFile');
            $modelMultiUpload->uploadFiles =  UploadedFile::getInstances($modelMultiUpload, 'uploadFiles');
            $model->imageFile = $modelUpload->upload();
            $model->uploadFiles = $modelMultiUpload->upload();
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);

        } else {

            return $this->render(
                'create',
                [
                    'model' => $model,
                    'itemToCategory' => $itemToCategory,
                    'modelUpload' => $modelUpload,
                    'modelMultiUpload' => $modelMultiUpload,
                    'path'=> $this->path,
                    'images'=>$model->images,
                    'message'=> $message,
                ]
            );
        }
    }

    public function beforeAction($action)
    {
        if ($action->id === 'delete') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
//        var_dump($id);die;
        Yii::$app->db->createCommand()
            ->delete('itemToCategory', 'itemId = '.$id.' ' )
            ->execute();

        $this->findModel($id)->delete();

        return $this->redirect(['/admin/items']);
    }


    protected function findModel($id)
    {
        if (($model = Items::findOne($id)) !== null) {

            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

//            $itcId = ItemToCategory::findCategoryForUpdateId($id);
//            $itemToCategory = $this->findModelItemToCategory($itcId);


//    protected function findModelItemToCategory($id)
//    {
//        if (($itemToCategory = ItemToCategory::findAll($id)) !== null) {
//            return $itemToCategory;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//    }
//
//
