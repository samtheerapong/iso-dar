<?php

namespace app\modules\jobs\controllers;

use app\modules\jobs\models\Jobs;
use app\modules\jobs\models\JobsSearch;
use app\modules\jobs\models\Operations;
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
use dominus77\sweetalert2\Alert;

/**
 * JobsController implements the CRUD actions for Jobs model.
 */
class JobsController extends Controller
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
     * Lists all Jobs models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new JobsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Jobs model.
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
     * Creates a new Jobs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Jobs();
        $modelOperations = new Operations();

        if ($model->load(Yii::$app->request->post())) {
            $model->number = AutoNumber::generate('RP-' . (date('y') + 43) . date('m') . '-????');
            $this->CreateDir($model->number);
            $model->docs = $this->uploadMultipleFile($model);
            if ($model->save()) {
                $modelOperations->job_id = $model->id;
                $modelOperations->cost = 0;
                if ($modelOperations->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Successfully'));
                }
                // return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['/jobs/operations/index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelOperations' => $modelOperations,
        ]);
    }

    /**
     * Updates an existing Jobs model.
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
            $this->CreateDir($model->number);
            $model->docs = $this->uploadMultipleFile($model, $tempDocs);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
                Alert::widget([
                    'options' => [
                        'Good job!',
                        'You clicked the button!',
                        Alert::TYPE_SUCCESS
                    ]
                ]);
                // Yii::$app->session->setFlash('success', Yii::t('app', 'Updated Successfully'));

            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Jobs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->removeUploadDir($model->number);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Jobs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Jobs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jobs::findOne(['id' => $id])) !== null) {
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
                    $file->saveAs(Jobs::UPLOAD_FOLDER . '/' . $model->number . '/' . $newFileName);
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
            $basePath = Jobs::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    /***************** Remove Upload Dir ******************/
    private function removeUploadDir($dir)
    {
        BaseFileHelper::removeDirectory(Jobs::getUploadPath() . $dir);
    }

    /***************** Download ******************/
    public function actionDownload($id, $file, $fullname)
    {
        $model = $this->findModel($id);
        if (!empty($model->number) && !empty($model->docs)) {
            Yii::$app->response->sendFile($model->getUploadPath() . '/' . $model->number . '/' . $file, $fullname);
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
                if ($this->deleteFile('file', $model->number, $fileName)) {
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
    private function deleteFile($type = 'file', $number, $fileName)
    {
        if (in_array($type, ['file', 'thumbnail'])) {
            if ($type === 'file') {
                $filePath = Jobs::getUploadPath() . $number . '/' . $fileName;
            } else {
                $filePath = Jobs::getUploadPath() . $number . '/thumbnail/' . $fileName;
            }
            @unlink($filePath);
            return true;
        } else {
            return false;
        }
    }
}
