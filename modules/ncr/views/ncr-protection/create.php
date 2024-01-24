<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrProtection $model */

$this->title = Yii::t('app', 'Create Ncr Protection');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ncr Protections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-protection-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
