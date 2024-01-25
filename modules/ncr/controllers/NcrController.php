<?php

namespace app\modules\ncr\controllers;

use app\modules\ncr\models\Ncr;
use app\modules\ncr\models\NcrAccept;
use app\modules\ncr\models\NcrClosing;
use app\modules\ncr\models\NcrProtection;
use app\modules\ncr\models\NcrReply;
use app\modules\ncr\models\NcrUploads;
use app\modules\ncr\models\search\NcrSearch;
use mdm\autonumber\AutoNumber;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;

class NcrController extends Controller
{

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

    public function actionIndex()
    {
        $searchModel = new NcrSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Ncr();
        $ModelReply = new NcrReply();
        $ModelAccept = new NcrAccept();
        $ModelProtection = new NcrProtection();
        $ModelClosing = new NcrClosing();

        $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(), 10);

        $defaultValue = 1;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $this->UploadImg(false);

                $model->ncr_number = AutoNumber::generate('N-' . (date('y') + 43) . date('m') . '-???'); // Auto Number EX N-6612-0001

                $model->ncr_status_id = $defaultValue;

                if ($model->save()) {
                    $ModelReply->ncr_id = $model->id;
                    $ModelAccept->ncr_id = $model->id;
                    $ModelProtection->ncr_id = $model->id;
                    $ModelClosing->ncr_id = $model->id;

                    // Assuming you have appropriate attributes configured for each related model
                    if (
                        $ModelReply->save() &&
                        $ModelAccept->save() &&
                        $ModelProtection->save() &&
                        $ModelClosing->save()
                    ) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            // 'ModelReply' => $ModelReply,
            // 'ModelAccept' => $ModelAccept,
            // 'ModelProtection' => $ModelProtection,
            // 'ModelClosing' => $ModelClosing,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->ref);

        $model->process  = $model->getArray($model->process);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $this->UploadImg(false);

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

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $this->removeUploadImageDir($model->ref);

        NcrUploads::deleteAll(['ref' => $model->ref]);

        $model->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Ncr::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    /*  |*********************************************************************************|
        |================================ Upload Img Ajax ================================|
        |*********************************************************************************|     */

    public function actionUploadImage()
    {
        $this->UploadImg(true);
    }

    private function CreateDir($folderName)
    {
        if ($folderName != NULL) {
            $basePath = Ncr::getUploadImagePath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    private function removeUploadImageDir($dir)
    {
        BaseFileHelper::removeDirectory(Ncr::getUploadImagePath() . $dir);
    }

    private function UploadImg($isAjax = false)
    {
        if (Yii::$app->request->isPost) {
            $images = UploadedFile::getInstancesByName('upload_image'); //actionUploadImage
            if ($images) {

                if ($isAjax === true) {
                    $ref = Yii::$app->request->post('ref');
                } else {
                    $uploader = Yii::$app->request->post('Ncr');
                    $ref = $uploader['ref'];
                }

                $this->CreateDir($ref);

                foreach ($images as $file) {
                    $fileName       = $file->baseName . '.' . $file->extension;
                    $realFileName   = md5($file->baseName . time()) . '.' . $file->extension;
                    $savePath       = Ncr::UPLOAD_FOLDER . '/' . $ref . '/' . $realFileName;
                    if ($file->saveAs($savePath)) {

                        if ($this->isImage(Url::base(true) . '/' . $savePath)) {
                            $this->createThumbnail($ref, $realFileName);
                        }

                        $model                  = new NcrUploads();
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
        $datas = NcrUploads::find()->where(['ref' => $ref])->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $key => $value) {
            array_push($initialPreview, $this->getTemplatePreview($value));
            array_push($initialPreviewConfig, [
                'caption' => $value->file_name,
                'width'  => '120px',
                'url'    => Url::to(['deletefile-img']),
                'key'    => $value->upload_id
            ]);
        }
        return  [$initialPreview, $initialPreviewConfig];
    }

    public function isImage($filePath)
    {
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview(NcrUploads $model)
    {
        $filePath = Ncr::getUploadImageUrl() . $model->ref . '/thumbnail/' . $model->real_filename;
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
        $uploadPath   = Ncr::getUploadImagePath() . '/' . $folderName . '/';
        $file         = $uploadPath . $fileName;
        $image        = Yii::$app->image->load($file);
        $image->resize($width);
        $image->save($uploadPath . 'thumbnail/' . $fileName);
        return;
    }

    public function actionDeletefileImg()
    {

        $model = NcrUploads::findOne(Yii::$app->request->post('key'));
        if ($model !== NULL) {
            $filename  = Ncr::getUploadImagePath() . $model->ref . '/' . $model->real_filename;
            $thumbnail = Ncr::getUploadImagePath() . $model->ref . '/thumbnail/' . $model->real_filename;
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
