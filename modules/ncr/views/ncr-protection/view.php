<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ncr Protections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ncr-protection-view">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fa-solid fa-house-circle-exclamation"></i> ' . Yii::t('app', 'Protection Home'), ['/ncr/ncr-protection/index'], ['class' => 'btn btn-info']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa-solid fa-pen"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'NCR Home'), ['/ncr/ncr/index'], ['class' => 'btn btn-primary']) ?>
        </p>
    </div>
    <div class="row">
        <div class="card border-secondary">
            <div class="card-header text-white bg-secondary">
                <?= Yii::t('app', 'NCR') ?>
            </div>
            <div class="card-body table-responsive">

                <?= DetailView::widget([
                    'model' => $model,
                    'template' => '<tr><th style="width: 190px;">{label}</th><td> {value}</td></tr>',
                    'attributes' => [
                        // 'id',
                        [
                            'attribute' => 'ncr_cause_item',
                            'format' => 'html',
                            'value' => function ($model) {
                                $value = $model->ncr_cause_item ? $model->ncr_cause_item : Yii::t('app', 'N/A');
                                $color = $model->ncr_cause_item ? '#000000' : '#DC5F00';
                                return '<span style="color:' . $color . ';">' . $value . '</span>';
                            },
                        ],
                        [
                            'attribute' => 'issue',
                            'format' => 'html',
                            'value' => function ($model) {
                                $value = $model->issue ? $model->issue : Yii::t('app', 'N/A');
                                $color = $model->issue ? '#000000' : '#DC5F00';
                                return '<span style="color:' . $color . ';">' . $value . '</span>';
                            },
                        ],
                        [
                            'attribute' => 'action',
                            'format' => 'html',
                            'value' => function ($model) {
                                $value = $model->action ? $model->action : Yii::t('app', 'N/A');
                                $color = $model->action ? '#000000' : '#DC5F00';
                                return '<span style="color:' . $color . ';">' . $value . '</span>';
                            },
                        ],
                        [
                            'attribute' => 'schedule_date',
                            'format' => 'html',
                            'value' => function ($model) {
                                $value = $model->schedule_date ? Yii::$app->formatter->asDate($model->schedule_date) : Yii::t('app', 'N/A');
                                $color = $model->schedule_date ? '#000000' : '#DC5F00';
                                return '<span style="color:' . $color . ';">' . $value . '</span>';
                            },
                        ],
                        [
                            'attribute' => 'operator',
                            'format' => 'html',
                            'value' => function ($model) {
                                $value = $model->operator ? $model->operator0->thai_name : Yii::t('app', 'N/A');
                                $color = $model->operator ? '#000000' : '#DC5F00';
                                return '<span style="color:' . $color . ';">' . $value . '</span>';
                            },
                        ],
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>