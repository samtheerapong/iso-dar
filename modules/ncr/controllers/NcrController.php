<?php

namespace app\modules\ncr\controllers;

use app\modules\ncr\models\Ncr;
use app\modules\ncr\models\NcrAccept;
use app\modules\ncr\models\NcrClosing;
use app\modules\ncr\models\NcrProtection;
use app\modules\ncr\models\NcrReply;
use app\modules\ncr\models\NcrUploads;
use app\modules\ncr\models\search\NcrSearch;
use Exception;
use mdm\autonumber\AutoNumber;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\helpers\Json;
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

        $ref = substr(Yii::$app->getSecurity()->generateRandomString(), 10);

        $defaultValue = 1;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->ncr_number = AutoNumber::generate('N-' . (date('y') + 43) . date('m') . '-???'); // Auto Number EX N-6612-0001
                
                $model->ref =  $ref;
                $this->CreateDir($model->ref); // create Directory 6701-12
                
                $model->docs = $this->uploadMultipleFile($model); // เรียกใช้ Function uploadMultipleFile ใน Controller

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

        $tempDocs = $model->docs;

        $model->process  = $model->getArray($model->process);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $this->CreateDir($model->ref);
            $model->docs = $this->uploadMultipleFile($model, $tempDocs);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->removeUploadDir($model->ref);
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

     /***************** action Deletefile ******************/
     public function actionDeletefile($id, $field, $fileName)
     {
         $status = ['success' => false];
         if (in_array($field, ['docs'])) {
             $model = $this->findModel($id);
             $files =  Json::decode($model->{$field});
             if (array_key_exists($fileName, $files)) {
                 if ($this->deleteFile('file', $model->ref, $fileName)) {
                     $status = ['success' => true];
                     unset($files[$fileName]);
                     $model->{$field} = Json::encode($files);
                     $model->save();
                 }
             }
         }
         echo json_encode($status);
     }
        
    /***************** deleteFile ******************/
    private function deleteFile($type = 'file', $ref, $fileName)
    {
        if (in_array($type, ['file', 'thumbnail'])) {
            if ($type === 'file') {
                $filePath = Ncr::getUploadPath() . $ref . '/' . $fileName;
            } else {
                $filePath = Ncr::getUploadPath() . $ref . '/thumbnail/' . $fileName;
            }
            @unlink($filePath);
            return true;
        } else {
            return false;
        }
    }

    /***************** upload MultipleFile ******************/
    private function uploadMultipleFile($model, $tempFile = null)
    {
        $files = [];
        $json = '';
        $tempFile = Json::decode($tempFile);
        $UploadedFiles = UploadedFile::getInstances($model, 'docs');
        if ($UploadedFiles !== null) {
            foreach ($UploadedFiles as $file) {
                try {
                    $oldFileName = $file->basename . '.' . $file->extension;
                    $newFileName = md5($file->basename . time()) . '.' . $file->extension;
                    $file->saveAs(Ncr::UPLOAD_FOLDER . '/' . $model->ref . '/' . $newFileName);
                    $files[$newFileName] = $oldFileName;
                } catch (Exception $e) {
                }
            }
            $json = json::encode(ArrayHelper::merge($tempFile, $files));
        } else {
            $json = $tempFile;
        }
        return $json;
    }

    /***************** Create Dir ******************/
    private function CreateDir($folderName)
    {
        if ($folderName != NULL) {
            $basePath = Ncr::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    /***************** Remove Upload Dir ******************/
    private function removeUploadDir($dir)
    {
        BaseFileHelper::removeDirectory(Ncr::getUploadPath() . $dir);
    }

    /***************** Download ******************/
    public function actionDownload($id, $file, $fullname)
    {
        $model = $this->findModel($id);
        if (!empty($model->ref) && !empty($model->docs)) {
            Yii::$app->response->sendFile($model->getUploadPath() . '/' . $model->ref . '/' . $file, $fullname);
        } else {
            $this->redirect(['/ncr/ncr/view', 'id' => $id]);
        }
    }


    
    //**********  ฟังก์ชันส่ง Line
    public function LineNotify($model)
    {
        // Line Tokens
        $lineapi = "Eon0aRHg9A3Y8j4RH1F1hYvdgGYhhnyiTBfNAKQrDmX";

        //ข้อคว่าม
        $massage =
            Yii::t('app', 'เลขที่ NCR') . " : " . $model->ncr_number . "\n" .
            Yii::t('app', 'วันที่') . " : " .  Yii::$app->formatter->asDate($model->created_date) . "\n" .
            Yii::t('app', 'ถึงแผนก') . " : " . $model->toDepartment->department_code . "\n" .
            Yii::t('app', 'กระบวนการ') . " : " . $model->ncrProcess->process_name . "\n" .
            Yii::t('app', 'ชื่อสินค้า') . " : " . $model->product_name . "\n" .
            Yii::t('app', 'สถานะ') . " : " . $model->ncrStatus->status_name . "\n" .
            Yii::t('app', 'Link') . " : " . Url::to(['view', 'id' => $model->id], true);

        $mms = trim($massage);

        //การทำงานของระบบ
        date_default_timezone_set("Asia/Bangkok");
        $chOne = curl_init();
        curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($chOne, CURLOPT_POST, 1);
        curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=$mms");
        curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
        $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $lineapi . '',);
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($chOne);
        if (curl_error($chOne)) {
            echo 'error:' . curl_error($chOne);
        } else {
            $result_ = json_decode($result, true);
            echo "status : " . $result_['status'];
            echo "message : " . $result_['message'];
        }
        curl_close($chOne);
    }

}
