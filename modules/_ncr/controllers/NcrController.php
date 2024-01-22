<?php

namespace app\modules\ncr\controllers;

use app\modules\ncr\models\Ncr;
use app\modules\ncr\models\NcrSolving;
use app\modules\ncr\models\NcrYear;
use app\modules\ncr\models\search\NcrSearch;
use Exception;
use mdm\autonumber\AutoNumber;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\web\UploadedFile;

//
use kartik\mpdf\Pdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * NcrController implements the CRUD actions for Ncr model.
 */
class NcrController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Ncr models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NcrSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ncr model.
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
     * Creates a new Ncr model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Ncr();
        // $status = 1;
        $ref = substr(Yii::$app->getSecurity()->generateRandomString(), 10);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->ncr_number = AutoNumber::generate('N-' . (date('y') + 43) . date('m') . '-???'); // Auto Number EX 6612/0001

                $model->ref =  $ref;
                $this->CreateDir($model->ref); // create Directory 6701-12

                $model->docs = $this->uploadMultipleFile($model); // เรียกใช้ Function uploadMultipleFile ใน Controller

                if ($model->save()) {
                    // $this->LineNotify($model);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ncr model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tempDocs = $model->docs;

        if ($this->request->isPost && $model->load($this->request->post())) {

            $this->CreateDir($model->ref);
            $model->docs = $this->uploadMultipleFile($model, $tempDocs);

            if ($model->save()) {
                // $this->LineNotify($model);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSolving($id)
    {
        $model = $this->findModel($id);
        $solvingModel = new NcrSolving();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $solvingModel->load(Yii::$app->request->post());

            if ($model->validate() && $solvingModel->validate()) {
                $model->save(false);

                $solvingModel->ncr_id = $model->id;
                if ($solvingModel->save()) {
                    Yii::$app->session->setFlash('success', 'Successfully');
                    return $this->redirect(['/ncr/ncr-solving/view', 'id' => $solvingModel->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error saving solving information.');
                    return $this->redirect(['/ncr/ncr/index']);
                }
            }
        }

        return $this->render('solving', [
            'model' => $model,
            'solvingModel' => $solvingModel,
        ]);
    }

    public function actionSettingMenu()
    {
        $searchModel = new NcrSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('setting-menu', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Ncr model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->removeUploadDir($model->ref);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Ncr model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Ncr the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
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
