<?php

use app\models\User;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\sauce\models\RawSauceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="raw-sauce-index">

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> ' . Yii::t('app', 'Create New User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>

    <div class="row">
        <?php echo $this->render('_search', ['model' => $searchModel]);
        ?>
    </div>
    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Yii::t('app', 'Showing {count} users', ['count' => $dataProvider->totalCount]) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                foreach ($dataProvider->getModels() as $model) : ?>
                    <div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="card mb-2">
                            <div class="card-header" style="background-color: 
                        <?= $model->status === User::STATUS_ACTIVE ? '#1A5D1A' : '#FE0000' ?>
                        ; color: #fff;">
                                <a href="<?= Url::toRoute(['view', 'id' => $model->id]); ?>" class="link-light">
                                    <h5>
                                        <?= Html::encode($model->username) ?> :

                                        <small>
                                            <?= Html::encode($model->thai_name ?? '') ?>
                                        </small>
                                    </h5>
                                </a>
                            </div>

                            <div class="card-body">


                                <p class="card-text"><b><?= Yii::t('app', 'Username') ?></b> : <?= Html::encode($model->username) ?></p>
                                <p class="card-text"><b><?= Yii::t('app', 'Thai Name') ?></b> : <?= Html::encode($model->thai_name) ?></p>
                                <p class="card-text"><b><?= Yii::t('app', 'Email') ?></b> : <?= \yii\helpers\Html::a($model->email, 'mailto:' . $model->email) ?></p>
                                <p class="card-text"><b><?= Yii::t('app', 'Department') ?></b> :
                                    <?= $model->department ? '<span class="text" style="color: ' . $model->department->color . ';">' . $model->department->name . '</span>' : ' '; ?>
                                </p>
                                <p class="card-text"><b><?= Yii::t('app', 'Role') ?></b> :
                                    <?= $model->role0 ? '<span class="text" style="color: ' . $model->role0->color . ';">' . $model->role0->name . '</span>' : ' '; ?>
                                </p>

                                <p class="card-text"><b><?= Yii::t('app', 'Rule') ?></b> :
                                    <?= $model->rule0 ? '<span class="text" style="color: ' . $model->rule0->color . ';">' . $model->rule0->name . '</span>' : ' '; ?>
                                </p>

                                <p class="card-text"><b><?= Yii::t('app', 'Status') ?></b> :
                                    <span class="text" style="color: <?= $model->status === User::STATUS_ACTIVE ? '#1A5D1A' : '#FE0000' ?>;"><?= $model->status === User::STATUS_ACTIVE ? Yii::t('app', 'Active') : Yii::t('app', 'Inactive') ?></span>
                                </p>

                                <p class="card-text"><b><?= Yii::t('app', 'Created At') ?></b> : <?= Html::encode(Yii::$app->formatter->asDate($model->created_at, 'dd MMMM YYYY')) ?></p>

                            </div>

                            <div class="card-footer text-center">
                                <div class="btn-group btn-group-xs" role="group">
                                    <?= Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-dark btn-sm', 'title' => Yii::t('app', 'View'), 'aria-label' => Yii::t('app', 'View')]) ?>
                                    <?= Html::a('<i class="fas fa-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-dark btn-sm', 'title' => Yii::t('app', 'Update'), 'aria-label' => Yii::t('app', 'Update')]) ?>
                                    <?= Html::a('<i class="fas fa-trash-can"></i>', ['delete', 'id' => $model->id], [
                                        'class' => 'btn btn-outline-dark btn-sm', 'title' => Yii::t('app', 'Delete'), 'aria-label' => Yii::t('app', 'Delete'),
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
            <div class="col-md-12">
                <?php
                echo LinkPager::widget([
                    'pagination' => $dataProvider->pagination,
                    'maxButtonCount' => 5,
                    'firstPageLabel' => Yii::t('app', 'First'),
                    'lastPageLabel' => Yii::t('app', 'Last'),
                    'options' => ['class' => 'pagination justify-content-center'],
                    'linkContainerOptions' => ['class' => 'page-item'],
                    'linkOptions' => ['class' => 'page-link'],
                ]);
                ?>

            </div>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>