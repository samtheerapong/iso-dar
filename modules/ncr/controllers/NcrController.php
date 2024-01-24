<?php

namespace app\modules\ncr\controllers;

use app\modules\ncr\models\Ncr;
use app\modules\ncr\models\NcrAccept;
use app\modules\ncr\models\NcrClosing;
use app\modules\ncr\models\NcrProtection;
use app\modules\ncr\models\NcrReply;
use app\modules\ncr\models\search\NcrSearch;
use mdm\autonumber\AutoNumber;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class NcrController extends Controller
{

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
        $searchModel = new NcrSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

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
        $model = new Ncr();
        $ModelReply = new NcrReply();
        $ModelAccept = new NcrAccept();
        $ModelProtection = new NcrProtection();
        $ModelClosing = new NcrClosing();

        $ref = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
        $defaultValue = 1;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->ncr_number = AutoNumber::generate('N-' . (date('y') + 43) . date('m') . '-???'); // Auto Number EX N-6612-0001

                $model->ref = $ref;

                $model->ncr_status_id = $defaultValue;

                if ($model->save()) {
                    $ModelReply->ncr_id = $model->id;
                    $ModelAccept->ncr_id = $model->id;
                    $ModelProtection->ncr_id = $model->id;
                    $ModelClosing->ncr_id = $model->id;

                    // Assuming you have appropriate attributes configured for each related model
                    if (
                        $ModelReply->save() &&
                        $ModelAccept->save() &&
                        $ModelProtection->save() &&
                        $ModelClosing->save()
                    ) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            // 'ModelReply' => $ModelReply,
            // 'ModelAccept' => $ModelAccept,
            // 'ModelProtection' => $ModelProtection,
            // 'ModelClosing' => $ModelClosing,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->process  = $model->getArray($model->process);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Ncr::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
