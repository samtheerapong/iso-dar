<?php

namespace app\modules\itms\controllers;

use app\modules\itms\models\ItExUpload;
use app\modules\itms\models\search\ItExUploadSearch;
use app\modules\itms\models\Uploads;
use mdm\autonumber\AutoNumber;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * ItExUploadController implements the CRUD actions for ItExUpload model.
 */
class ItExUploadController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ItExUpload models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ItExUploadSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItExUpload model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ItExUpload model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ItExUpload();

        // $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
        $model->ref = AutoNumber::generate('EX-' . (date('y') + 43) . date('m') . '-????');

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                // $model->ref = AutoNumber::generate('EX-' . (date('y') + 43) . date('m') . '-????');
                $this->Uploads(false);

                $model->save();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {

            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ItExUpload model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->ref);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $this->Uploads(false);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig
        ]);
    }

    /**
     * Deletes an existing ItExUpload model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $this->removeUploadDir($model->ref);

        Uploads::deleteAll(['ref' => $model->ref]);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ItExUpload model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ItExUpload the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItExUpload::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    /*  |*********************************************************************************|
        |================================ Upload Ajax ====================================|
        |*********************************************************************************|     */

    public function actionUploadAjax()
    {
        $this->Uploads(true);
    }

    private function CreateDir($folderName)
    {
        if ($folderName != NULL) {
            $basePath = ItExUpload::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir)
    {
        BaseFileHelper::removeDirectory(ItExUpload::getUploadPath() . $dir);
    }

    private function Uploads($isAjax = false)
    {
        if (Yii::$app->request->isPost) {
            $images = UploadedFile::getInstancesByName('upload_ajax');
            if ($images) {

                if ($isAjax === true) {
                    $ref = Yii::$app->request->post('ref');
                } else {
                    $uploader = Yii::$app->request->post('ItExUpload');
                    $ref = $uploader['ref'];
                }

                $this->CreateDir($ref);

                foreach ($images as $file) {
                    $fileName       = $file->baseName . '.' . $file->extension;
                    $realFileName   = md5($file->baseName . time()) . '.' . $file->extension;
                    $savePath       = ItExUpload::UPLOAD_FOLDER . '/' . $ref . '/' . $realFileName;
                    if ($file->saveAs($savePath)) {

                        if ($this->isImage(Url::base(true) . '/' . $savePath)) {
                            $this->createThumbnail($ref, $realFileName);
                        }

                        $model                  = new Uploads;
                        $model->ref             = $ref;
                        $model->file_name       = $fileName;
                        $model->real_filename   = $realFileName;
                        $model->save();

                        if ($isAjax === true) {
                            echo json_encode(['success' => 'true']);
                        }
                    } else {
                        if ($isAjax === true) {
                            echo json_encode(['success' => 'false', 'eror' => $file->error]);
                        }
                    }
                }
            }
        }
    }

    private function getInitialPreview($ref)
    {
        $datas = Uploads::find()->where(['ref' => $ref])->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $key => $value) {
            array_push($initialPreview, $this->getTemplatePreview($value));
            array_push($initialPreviewConfig, [
                'caption' => $value->file_name,
                'width'  => '120px',
                'url'    => Url::to(['deletefile-ajax']),
                'key'    => $value->upload_id
            ]);
        }
        return  [$initialPreview, $initialPreviewConfig];
    }

    public function isImage($filePath)
    {
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview(Uploads $model)
    {
        $filePath = ItExUpload::getUploadUrl() . $model->ref . '/thumbnail/' . $model->real_filename;
        $isImage  = $this->isImage($filePath);
        if ($isImage) {
            $file = Html::img($filePath, ['class' => 'file-preview-image', 'alt' => $model->file_name, 'title' => $model->file_name]);
        } else {
            $file =  "<div class='file-preview-other'> " .
                "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                "</div>";
        }
        return $file;
    }

    private function createThumbnail($folderName, $fileName, $width = 250)
    {
        $uploadPath   = ItExUpload::getUploadPath() . '/' . $folderName . '/';
        $file         = $uploadPath . $fileName;
        $image        = Yii::$app->image->load($file);
        $image->resize($width);
        $image->save($uploadPath . 'thumbnail/' . $fileName);
        return;
    }

    public function actionDeletefileAjax()
    {

        $model = Uploads::findOne(Yii::$app->request->post('key'));
        if ($model !== NULL) {
            $filename  = ItExUpload::getUploadPath() . $model->ref . '/' . $model->real_filename;
            $thumbnail = ItExUpload::getUploadPath() . $model->ref . '/thumbnail/' . $model->real_filename;
            if ($model->delete()) {
                @unlink($filename);
                @unlink($thumbnail);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false]);
        }
    }
}
