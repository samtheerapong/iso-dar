<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\JobStatus $model */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Status'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-status-create">
    <p>
        <?= Html::a('<i class="fa fa-chevron-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>