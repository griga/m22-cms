<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\modules\content\widgets\NestableSortableWidget;

use app\modules\content\models\TopMenu;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\content\models\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <p>
        <?= Html::a('Create Menu Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



</div>


<?= NestableSortableWidget::widget([
        'models'=>TopMenu::find()->where(['parent_id'=>0])->orWhere(['parent_id'=>null])->sorted()->all(),
        'rearrangeAction'=>'/admin/content/top-menu/rearrange',
    ]) ?>