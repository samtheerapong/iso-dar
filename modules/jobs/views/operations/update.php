<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\Operations $model */

$this->title = Yii::t('app', 'Operations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelJobs->number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="operations-update">
    <p>
        <?= Html::a('<i class="fa fa-chevron-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'modelJobs' => $modelJobs,
    ]) ?>

</div>