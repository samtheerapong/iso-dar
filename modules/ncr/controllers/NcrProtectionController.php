<?php

namespace app\modules\ncr\controllers;

use app\modules\ncr\models\Ncr;
use app\modules\ncr\models\NcrProtection;
use app\modules\ncr\models\search\NcrProtectionSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NcrProtectionController implements the CRUD actions for NcrProtection model.
 */
class NcrProtectionController extends Controller
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


    public function actionIndex()
    {
        $searchModel = new NcrProtectionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        // Add a condition to filter only records where ncr_status_id is reply
        $dataProvider->query->andWhere(['ncr_protection.ncr_id' => Ncr::find()->select('id')->where(['ncr_status_id' => 2])]);

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
        $model = new NcrProtection();

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


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->ncr_cause_item  = $model->getArray($model->ncr_cause_item);

        // process จาก NCR
        $modelNcr = $this->findModelNcr($model->ncr_id);
        $modelNcr->process  = $model->getArray($modelNcr->process);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $modelNcr->ncr_status_id = 3;
            if ($model->save()) {
                $modelNcr->save();
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


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = NcrProtection::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
