<?php

namespace app\modules\jobs\controllers;

use app\modules\jobs\models\Jobs;
use app\modules\jobs\models\JobsSearch;
use app\modules\jobs\models\Operations;
use app\modules\jobs\models\OperationsSearch;
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

/**
 * OperationsController implements the CRUD actions for Operations model.
 */
class OperationsController extends Controller
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
     * Lists all Operations models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OperationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Operations model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelJobs = $this->findModelJobs($model->job_id);

        if ($modelJobs === null) {
            throw new NotFoundHttpException('The requested job does not exist.');
        }

        return $this->render('view', [
            'model' => $model,
            'modelJobs' => $modelJobs,
        ]);
    }


    /**
     * Creates a new Operations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Operations();

        $model->cost = 0;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Successfully'));
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('warning', Yii::t('app', 'Unsuccessfully'));
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
     * Updates an existing Operations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tempDocs = $model->docs;
        $modelJobs = $this->findModelJobs($model->job_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $modelJobs->load($this->request->post())) {
            // $modelJobs->job_status = 3;
            $this->CreateDir($model->id);
            $model->docs = $this->uploadMultipleFile($model, $tempDocs);

            $modelJobs->save();
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Successfully'));
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('warning', Yii::t('app', 'Unsuccessfully'));
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'modelJobs' => $modelJobs,
        ]);
    }

    protected function findModelJobs($id)
    {
        if (($model = Jobs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Deletes an existing Operations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->removeUploadDir($model->id);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Operations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Operations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Operations::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
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
                    $file->saveAs(Operations::UPLOAD_FOLDER . '/' . $model->id . '/' . $newFileName);
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
            $basePath = Operations::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    /***************** Remove Upload Dir ******************/
    private function removeUploadDir($dir)
    {
        BaseFileHelper::removeDirectory(Operations::getUploadPath() . $dir);
    }

    /***************** Download ******************/
    public function actionDownload($id, $file, $fullname)
    {
        $model = $this->findModel($id);
        if (!empty($model->id) && !empty($model->docs)) {
            Yii::$app->response->sendFile($model->getUploadPath() . '/' . $model->id . '/' . $file, $fullname);
        } else {
            $this->redirect(['view', 'id' => $id]);
        }
    }

    /***************** action Deletefile ******************/
    public function actionDeletefile($id, $field, $fileName)
    {
        $status = ['success' => false];
        if (in_array($field, ['docs'])) {
            $model = $this->findModel($id);
            $files =  Json::decode($model->{$field});
            if (array_key_exists($fileName, $files)) {
                if ($this->deleteFile('file', $model->id, $fileName)) {
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
    private function deleteFile($type = 'file', $id, $fileName)
    {
        if (in_array($type, ['file', 'thumbnail'])) {
            if ($type === 'file') {
                $filePath = Operations::getUploadPath() . $id . '/' . $fileName;
            } else {
                $filePath = Operations::getUploadPath() . $id . '/thumbnail/' . $fileName;
            }
            @unlink($filePath);
            return true;
        } else {
            return false;
        }
    }
}
