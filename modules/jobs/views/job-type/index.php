<?php

use app\modules\jobs\models\JobType;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\JobTypeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Job Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-type-index">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Jobs'), ['/jobs/jobs/index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create Data'), ['create'], ['class' => 'btn btn-danger']) ?>
        </p>
        <p style="text-align: right;">
        <p>
            <?= Html::a('<i class="fas fa-cog"></i> ' . Yii::t('app', 'Configuration'), ['/jobs/jobs/configs'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>


    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'code',
                        'format' => 'html',
                        // 'contentOptions' => ['class' => 'text-center'],
                        'value' => function ($model) {
                            return Html::a(
                                $model->code,
                                ['view', 'id' => $model->id],
                            );
                        },
                    ],
                    // 'name',
                    [
                        'attribute' => 'name',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a(
                                $model->name,
                                ['view', 'id' => $model->id],
                            );
                        },
                    ],
                    [
                        'attribute' => 'color',
                        'format' => 'html',
                        // 'contentOptions' => ['class' => 'text-center'], // จัดตรงกลาง
                        'value' => function ($model) {
                            return '<span class="badge" style="background-color:' . $model->color . ';"><b>' . $model->color . '</b></span>';
                        },
                    ],
                    [
                        // 'class' => ActionColumn::class,
                        'class' => 'kartik\grid\ActionColumn',
                        'header' => 'จัดการ',
                        'contentOptions' => ['class' => 'text-center'], // จัดตรงกลาง
                        'buttonOptions' => ['class' => 'btn btn-outline-secondary btn-sm'],
                        'template' => '<div class="btn-group btn-group-xs" role="group"> {view} {update} {delete}</div>',
                        'urlCreator' => function ($action,  $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>


        </div>
    </div>
</div>