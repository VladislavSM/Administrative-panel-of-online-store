<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Article;
use app\modules\admin\models\UploadForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    public $layout = './adminlayout';
    public $path = 'image/articles/';
    public $dS = '/';
    public $defaultAction = 'index';
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

//    public function actionUpload()
//    {
//        $modelUpload = new UploadForm();
//        var_dump($_REQUEST['UploadForm']);die;
//        $path= 'image/articles/';
//        if (Yii::$app->request->isPost) {

//            $modelUpload->imageFile = UploadedFile::getInstance($modelUpload, 'imageFile');
//
//            if ($modelUpload->upload($this->path)) {
//
//                return;
//            }
//        }
//
//        return $this->render('upload', ['modelUpload' => $modelUpload]);
//    }


    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $modelUpload = new UploadForm();
        if(empty($id)){
            $model = new Article();
            $message = 'Создать новую статью';
        }else{
            $model = $this->findModel($id);
            $message ='Редактировать статью';
        }

        if ($model->load(Yii::$app->request->post())) {

            $modelUpload->imageFile = UploadedFile::getInstance($modelUpload, 'imageFile');
//            $modelUpload->imageFile = $modelUpload->upload();

//            var_dump($fileName);die;
            if ($modelUpload->upload()) {

                $fileName = $modelUpload->imageFile->name;
                $filePath = $this->dS . $this->path . $fileName;
                $model->image = $filePath;
                $model->save();
            }
            else{
                $model->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }
        else {
            return $this->render('create', [
                'model' => $model,
                'modelUpload' => $modelUpload,
                'path'=> $this->path,
                'message'=> $message,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id)
//    {
//        $modelUpload = new UploadForm();
//        $model = $this->findModel($id);
//        $this->actionUpload();
//
//        if ($model->load(Yii::$app->request->post()) && $this->actionUpload())
//        {  $fileName = $this->actionUpload();
//            $filePath = $this->dS . $this->path . $fileName;
//               ($_POST['Article']['image']). $fileName;
//            $model->image = $filePath;
//            $model->save();
//
//            return $this->redirect(['view', 'id' => $model->id]);
//        }

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//        else {
//            return $this->render('update', [
//                'modelUpload' => $modelUpload,
//                'model' => $model,
//                'path'=> $this->path,
//            ]);
//        }
//    }

    public function beforeAction($action)
    {
        if ($action->id === 'delete') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/admin/article']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
