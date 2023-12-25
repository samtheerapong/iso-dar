<?php

namespace app\controllers;

use app\models\User;
use app\models\UserSearch;
use app\components\Rule;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
            ],
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['profile'],
                            'allow' => true,
                            'roles' => ['@'], // Require authenticated users
                        ],
                        [
                            'actions' => ['index', 'view', 'create', 'update', 'delete', 'profile'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                return in_array(Yii::$app->user->identity->role_id, [2]); // Admin
                            },
                        ],

                        // [
                        //     'actions' => ['profile'],
                        //     'allow' => true,
                        //     'roles' => ['@'],
                        //     'matchCallback' => function ($rule, $action) {
                        //         return Yii::$app->user->id == Yii::$app->request->get('id'); // Require only users
                        //     },
                        // ],
                    ],
                ],
            ]
        );
    }


    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash); // สร้าง Password hash
                $model->auth_key = Yii::$app->Security->generateRandomString(); // สร้าง RandomString
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
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldPass = $model->password_hash;

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($oldPass != $model->password_hash) { //กรณีเปลี่ยนรหัสผ่าน
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
                //$user->auth_key = Yii::$app->Security->generateRandomString();
                $model->save();
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionProfile()
    {
        $model = $this->findModel(Yii::$app->user->id);
        $oldPassword = $model->password_hash;

        if ($this->request->isPost && $model->load($this->request->post())) {
            if (!empty($model->password_hash) && $oldPassword != $model->password_hash) {
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
            } else {
                // No password change
                $model->password_hash = $oldPassword;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }
}
