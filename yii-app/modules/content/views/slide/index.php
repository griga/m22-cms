<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\content\models\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Slide';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Slide', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'header'=>'Enabled',
                'content'=>function($model){
                    return $model->enabled ? 'Yes' : 'No';
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'enabled',
                    ['1'=>'Yes', '0'=>'No'],
                    ['class' => 'form-control', 'prompt'=>'']
                )
            ],
			[
				'header'=>'Slide',
				'value'=>function($model){
					return Html::img($model->image->url, [
						'width'=>100,
						'height'=>60,
					]);
				},
				'format'=>'raw'
			],
            [
                'class' => 'app\components\grids\FAActionColumn',
                'hideViewButton' => true,
            ],
        ],
    ]); ?>

</div>
