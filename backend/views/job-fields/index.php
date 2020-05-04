<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\JobFieldSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job Fields';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-field-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Job Field', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'parentId',
            'lft',
            'rgt',
            //'depth',
            //'tree',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            //'icon',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
