<?php

namespace app\modules\ncr\controllers;

use app\models\Env;
use app\modules\ncr\models\Ncr;
use app\modules\ncr\models\NcrReply;
use app\modules\ncr\models\search\NcrReplySearch;
use app\modules\ncr\models\search\NcrSearch;
use Exception;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * NcrReplyController implements the CRUD actions for NcrReply model.
 */
class NcrReplyController extends Controller
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
     * Lists all NcrReply models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NcrReplySearch();
        $searchNcr = new NcrSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataNcr = $searchNcr->search($this->request->queryParams);

        $dataProvider->query->andWhere(['ncr_reply.ncr_id' => Ncr::find()->select('id')->where(['ncr_status_id' => 1])]);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchNcr' => $searchNcr,
            // 'dataNcr' => $dataNcr,
        ]);
    }

    /**
     * Displays a single NcrReply model.
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
     * Creates a new NcrReply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new NcrReply();

        $ref = substr(Yii::$app->getSecurity()->generateRandomString(), 10);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->ref =  $ref;
                $this->CreateDir($model->ref); // create Directory 6701-12

                $model->docs = $this->uploadMultipleFile($model); // เรียกใช้ Function uploadMultipleFile ใน Controller

                if ($model->save()) {
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
     * Updates an existing NcrReply model.
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
                $this->LineNotify($model);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findModelNcr($id)
    {
        if (($model = Ncr::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        $modelNcr = $this->findModelNcr($model->ncr_id);
        $modelNcr->process  = $model->getArray($modelNcr->process);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $modelNcr->ncr_status_id = 2;
            if ($modelNcr->save() && $model->save()) {
                $this->LineNotify($model);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('approve', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NcrReply model.
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
     * Finds the NcrReply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return NcrReply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NcrReply::findOne(['id' => $id])) !== null) {
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
                $filePath = NcrReply::getUploadPath() . $ref . '/' . $fileName;
            } else {
                $filePath = NcrReply::getUploadPath() . $ref . '/thumbnail/' . $fileName;
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
                    $file->saveAs(NcrReply::REPLY_FOLDER . '/' . $model->ref . '/' . $newFileName);
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
            $basePath = NcrReply::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    /***************** Remove Upload Dir ******************/
    private function removeUploadDir($dir)
    {
        BaseFileHelper::removeDirectory(NcrReply::getUploadPath() . $dir);
    }

    /***************** Download ******************/
    public function actionDownload($id, $file, $fullname)
    {
        $model = $this->findModel($id);
        if (!empty($model->ref) && !empty($model->docs)) {
            Yii::$app->response->sendFile($model->getUploadPath() . '/' . $model->ref . '/' . $file, $fullname);
        } else {
            $this->redirect(['/ncr/ncr-reply/view', 'id' => $id]);
        }
    }

    //**********  ฟังก์ชันส่ง Line
    private function LineNotify($model)
    {
        // Line Tokens
        $lineapi = Env::LINE_TOKEN;

        //ข้อคว่าม
        $massage =
            "1) " . Yii::t('app', 'สถานะ') .           " : " . $model->ncrs->ncrStatus->name . "\n" .
            "2) " . Yii::t('app', 'NCR Link') .        " : " . Url::to(['/ncr/ncr/view', 'id' => $model->ncrs->id], true) . "\n" .
            "3) " . Yii::t('app', 'ผลิตภัณฑ์') .       " : " . $model->concession0->concession_name . "\n" .
            "4) " . Yii::t('app', 'ประเภทการดำเนินการ') .       " : " . $model->replyType->name . "\n" .
            "5) " . Yii::t('app', 'จำนวน') .       " : " . $model->quantity . " " . $model->unit . "\n" .
            "6) " . Yii::t('app', 'วิธีการ') .       " : " . $model->method . "\n" .
            "7) " . Yii::t('app', 'ผู้ดำเนินการ') .       " : " . $model->operator->thai_name . "\n" .
            "8) " . Yii::t('app', 'วันที่ดำเนินการ') .       " : " . Yii::$app->formatter->asDate($model->operation_date);

        // Conditional content based on the value of ncrStatus->id
        if ($model->ncrs->ncrStatus->id == 1) {
            $massage .= "\n" ."9) " . Yii::t('app', 'Reply') .        " : " . Url::to(['view', 'id' => $model->id], true);
            $massage .= "\n" ."10) " . Yii::t('app', 'Approve') .     " : " . Url::to(['approve', 'id' => $model->id], true);
        } elseif ($model->ncrs->ncrStatus->id == 2) {
            $massage .= "\n" ."10) " . Yii::t('app', 'approve_name') . " : " . $model->approver->thai_name;
            $massage .= "\n" ."11) " . Yii::t('app', 'approve_date') . " : " . Yii::$app->formatter->asDate($model->approve_date);
            $massage .= "\n" ."12) " . Yii::t('app', 'Reply') .        " : " . Url::to(['view', 'id' => $model->id], true);
        }

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
