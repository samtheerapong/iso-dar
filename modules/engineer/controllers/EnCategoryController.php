<?php

namespace app\modules\engineer\controllers;

use app\modules\engineer\models\EnCategory;
use app\modules\engineer\models\search\EnCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnCategoryController implements the CRUD actions for EnCategory model.
 */
class EnCategoryController extends Controller
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
     * Lists all EnCategory models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EnCategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EnCategory model.
     * @param int $category_id Category ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($category_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($category_id),
        ]);
    }

    /**
     * Creates a new EnCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new EnCategory();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'category_id' => $model->category_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EnCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $category_id Category ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($category_id)
    {
        $model = $this->findModel($category_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'category_id' => $model->category_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EnCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $category_id Category ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($category_id)
    {
        $this->findModel($category_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EnCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $category_id Category ID
     * @return EnCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($category_id)
    {
        if (($model = EnCategory::findOne(['category_id' => $category_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
