<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\Machine $model */

$this->title = $model->machine_code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Machines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="machine-view">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-chevron-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?php //echo Html::a('<i class="fas fa-calendar"></i> ' . Yii::t('app', 'Moromi Record Card'), ['card'], ['class' => 'btn btn-secondary btn-lg']) 
            ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fas fa-edit"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>

            <?= Html::a('<i class="fas fa-trash"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>

        </p>
    </div>
    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body table-responsive">
            <?= DetailView::widget([
                'model' => $model,
                'template' => '<tr><th style="width: 200px;">{label}</th><td> {value}</td></tr>',
                'attributes' => [
                    // 'id',
                    'machine_code',
                    'machine_name',
                    'last_repair:date',

                ],
            ]) ?>

        </div>
    </div>
</div>