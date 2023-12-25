<?php

namespace app\modules\engineer\controllers;

use app\modules\engineer\models\Technician;
use app\modules\engineer\models\search\TechnicianSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TechnicianController implements the CRUD actions for Technician model.
 */
class TechnicianController extends Controller
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
     * Lists all Technician models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TechnicianSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Technician model.
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
     * Creates a new Technician model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Technician();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->photo = $model->upload($model, 'photo');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Technician model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // Update actionUpdate method
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldPhoto = $model->photo; // Store the old photo filename

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
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

    // Update unlinkOldPhoto method
    private function unlinkOldPhoto($filename, $id)
    {
        $model = $this->findModel($id);
        $path = $model->getUploadPath() . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
    }

    /**
     * Deletes an existing Technician model.
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
     * Finds the Technician model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Technician the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Technician::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionCard()
    {
        $searchModel = new TechnicianSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('card', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
