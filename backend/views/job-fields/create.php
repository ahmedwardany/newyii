<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobField */

$this->title = 'Create Job Field';
$this->params['breadcrumbs'][] = ['label' => 'Job Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-field-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
