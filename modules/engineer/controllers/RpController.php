<?php

namespace app\modules\engineer\controllers;

use app\models\Model;
use app\modules\engineer\models\Rp;
use app\modules\engineer\models\RpList;
use app\modules\engineer\models\search\RpSearch;
use Exception;
use mdm\autonumber\AutoNumber;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * RpController implements the CRUD actions for Rp model.
 */
class RpController extends Controller
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
     * Lists all Rp models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RpSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rp model.
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
     * Creates a new Rp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Rp();
        $modelsList = [new RpList];

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->repair_code = AutoNumber::generate('RP-' . (date('y') + 43) . date('m') . '-????'); // Auto Number

                // List
                $modelsList = Model::createMultiple(RpList::class);
                Model::loadMultiple($modelsList, Yii::$app->request->post());

                // ajax validation
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($modelsList),
                        ActiveForm::validate($model)
                    );
                }

                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsList) && $valid;

                $model->save();
                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            foreach ($modelsList as $i => $modelList) {
                                $modelList->request_id = $model->id;
                                $modelList->photo = $modelList->upload($modelList, "[{$i}]photo"); // uploaded file
                                // $modelList->photo = UploadedFile::getInstance($modelList, "[{$i}]photo");

                                if (!($flag = $modelList->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                            // return $this->redirect(['index']);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelsList' => (empty($modelsList)) ? [new RpList] : $modelsList
        ]);
    }

    /**
     * Updates an existing Rp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsList = $model->lists;

        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelsList, 'id', 'id');
            $modelsList = Model::createMultiple(RpList::class, $modelsList);
            Model::loadMultiple($modelsList, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsList, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsList),
                    ActiveForm::validate($model)
                );
            }

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsList) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            RpList::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsList as $i => $modelList) {
                            $modelList->request_id = $model->id;

                            $modelList->photo = $modelList->uploadUpdate($modelList, "[{$i}]photo");

                            if (!($flag = $modelList->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsList' => (empty($modelsList)) ? [new RpList] : $modelsList
        ]);
    }


    /**
     * Deletes an existing Rp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /**
     * Deletes an existing Rp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // Delete related RpList photos and records
        $rpListRecords = RpList::findAll(['request_id' => $id]);

        foreach ($rpListRecords as $rpListRecord) {
            // Unlink photo
            $photoPath = $rpListRecord->getUploadPath() . $rpListRecord->photo;
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }

            // Delete RpList record
            $rpListRecord->delete();
        }

        // Delete Rp record
        $model->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Rp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Rp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rp::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
