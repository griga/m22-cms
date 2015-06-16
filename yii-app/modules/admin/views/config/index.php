<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\modules\admin\models\Config;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Configs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Config', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'key',
            'value',

            [
                'class' => 'app\components\grids\FAActionColumn',
                'hideViewButton' => true,
            ],
        ],
    ]); ?>

</div>
