<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-chevron-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
       
            <?= Html::a('<i class="fas fa-plus"></i> ' . Yii::t('app', 'Create New User'), ['create'], ['class' => 'btn btn-success']) ?>
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
        <div class="card-body">

            <?= DetailView::widget([
                'model' => $model,
                'template' => '<tr><th style="width: 300px;">{label}</th><td> {value}</td></tr>',
                'attributes' => [
                    // 'id',
                    'username',
                    'thai_name',
                    // 'auth_key',
                    // 'password_hash',
                    // 'password_reset_token',
                    'email:email',
                    // 'status',
                   
                    // 'role_id',
                    [
                        'attribute' => 'role_id',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->role0 ? '<span class="text" style="color:' . $model->role0->color . ';"><b>' . $model->role0->name . '</b></span>' : ' ';
                        },
                    ],
                    // 'rule_id',
                    [
                        'attribute' => 'rule_id',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->rule0 ? '<span class="text" style="color:' . $model->rule0->color . ';"><b>' . $model->rule0->name . '</b></span>' : ' ';
                        },
                    ],
                    // 'department_id',
                    [
                        'attribute' => 'department_id',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->department ? '<span class="text" style="color: ' . $model->department->color . ';"><b>' . $model->department->name . '</b></span>' : ' ';
                        },
                    ],

                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->status === User::STATUS_ACTIVE
                                ? '<span class="text" style="color: #1A5D1A">' . Yii::t('app', 'Active') . '</span>'
                                : '<span class="text" style="color: #FE0000">' . Yii::t('app', 'Inactive') . '</span>';
                        },
                    ],
                    
                    'created_at:date',
                    'updated_at:date',
                    // 'verification_token',
                ],
            ]) ?>


        </div>
    </div>
</div>