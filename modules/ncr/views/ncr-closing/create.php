<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrClosing $model */

$this->title = Yii::t('app', 'Create Ncr Closing');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ncr Closings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-closing-create">

    <p>
        <?= Html::a('<i class="fas fa-circle-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>