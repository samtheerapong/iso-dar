<?php

namespace app\modules\itms\controllers;

use app\modules\itms\models\ItTodo;
use app\modules\itms\models\search\ItTodoSearch;
use mdm\autonumber\AutoNumber;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItTodoController implements the CRUD actions for ItTodo model.
 */
class ItTodoController extends Controller
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
     * Lists all ItTodo models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ItTodoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItTodo model.
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
     * Creates a new ItTodo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ItTodo();


        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->code = AutoNumber::generate('TD-' . (date('y') + 43) . date('m') . '-????'); // Auto Number
                $model->status_id = 1; // Status ID 1 => Open
                $model->photo = $model->upload($model, 'photo'); // Upload photo

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
     * Updates an existing ItTodo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldPhoto = $model->photo; // Store the old photo filename

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->photo = $model->upload($model, 'photo');

            // แทนที่รูปใหม่
            if ($oldPhoto && $oldPhoto !== $model->photo) {
                $this->unlinkOldPhoto($oldPhoto, $id);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    private function unlinkOldPhoto($filename, $id)
    {
        $model = $this->findModel($id);
        $path = $model->getUploadPath() . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
    }

    /**
     * Deletes an existing ItTodo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $filename  = $model->getUploadPath() . $model->photo;

        if ($model->delete()) {
            @unlink($filename);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ItTodo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ItTodo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItTodo::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
