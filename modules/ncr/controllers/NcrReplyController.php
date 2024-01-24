<?php

namespace app\modules\ncr\controllers;

use app\modules\ncr\models\Ncr;
use app\modules\ncr\models\NcrReply;
use app\modules\ncr\models\search\NcrReplySearch;
use app\modules\ncr\models\search\NcrSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
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
     * Updates an existing NcrReply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // $modelNcr = $this->findModelNcr($model->ncr_id);  // มาจาก protected function findModelNcr($id)

        if ($this->request->isPost && $model->load($this->request->post())) {
            // $modelNcr->ncr_status_id = 2;
            if ($model->save()) {
                // $modelNcr->save();
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
        // $modelNcr = $this->findModelNcr($model->ncr_id);  // มาจาก protected function findModelNcr($id)

        if ($this->request->isPost && $model->load($this->request->post())) {
            // $modelNcr->ncr_status_id = 2;
            if ($model->save()) {
                // $modelNcr->save();
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
        $this->findModel($id)->delete();

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
}
