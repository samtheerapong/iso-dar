<?php

namespace app\modules\dar\controllers;

use app\modules\dar\models\Request;
use app\modules\dar\models\RequestUpload;
use app\modules\dar\models\search\Request as RequestSearch;
use mdm\autonumber\AutoNumber;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
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
     * Lists all Request models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
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
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Request();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $documentCode = $model->document_code;

                // Fetch the record based on document_code and highest 'rev'
                $findFromCode = Request::find()
                    ->where(['document_code' => $documentCode])
                    ->orderBy(['rev' => SORT_DESC]) // ต้องใส่  'id' => SORT_DESC, ที่ model search ด้วย
                    ->one();

                if ($findFromCode !== null) {
                    if ($model->request_type_id == 2) {
                        $model->rev = $findFromCode->rev + 1;
                    } else {
                        $model->rev = $findFromCode->rev;
                    }

                    $model->request_category_id = $findFromCode->request_category_id;
                    $model->department_id = $findFromCode->department_id;
                }

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




    public function actionCreateNew()
    {
        $model = new Request();
        // $newUpload = new RequestUpload();

        // Default values
        $model->request_type_id = 1;
        $model->request_status_id = 1;
        $model->rev = 0;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                // Auto Number Generation
                $docCode = $model->requestCategory->code . '-' . $model->department->code;
                $model->document_code = AutoNumber::generate($docCode . '-???');

                // Upload file for model RequestUpload
                // $newUpload->name = $model->upload($model, 'files');
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create-new', [
            'model' => $model,
            // 'newUpload' => $newUpload,
        ]);
    }




    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
