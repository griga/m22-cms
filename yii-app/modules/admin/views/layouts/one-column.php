<?php
/** Created by griga at 05.05.2015 | 12:51.
 * @var $this  \yii\web\View
 *
 */

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;


$this->beginContent('@app/modules/admin/views/layouts/main.php');



?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name . ' <small>admin</small>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Dashboard', 'url' => ['/admin'], 'active'=>Yii::$app->controller->id==='dashboard'],
                ['label'=>'Menu', 'url'=>['/admin/content/top-menu/index'],'active'=>Yii::$app->controller->id === 'top-menu'],
                [
                    'label'=>'Content', 
                    'active'=> (Yii::$app->controller->module->id === 'content' && Yii::$app->controller->id !== 'top-menu'),
                    'items'=>[
                        ['label' => 'Slides', 'url' => ['/admin/content/slide/index'], 'active'=>Yii::$app->controller->id==='slide'],
                        ['label' => 'Pages', 'url' => ['/admin/content/page/index'], 'active'=>Yii::$app->controller->id==='page'],
                        ['label' => 'News', 'url' => ['/admin/content/news/index'], 'active'=>Yii::$app->controller->id==='news'],
                    ]
                ],
                [
                    'label'=>Yii::t('core', 'Translations'), 
                    'url'=>['/admin/translation/module/index'],
                    'active'=>Yii::$app->controller->module->id ==='translation',
                ],
                [
                    'label'=>Yii::t('core', 'Config'), 
                    'active'=>Yii::$app->controller->id==='config' || Yii::$app->controller->id==='template',
                    'items'=>[
                        ['label'=>'Parameters', 'url'=>['/admin/admin/config/index'], 'active'=>Yii::$app->controller->id==='config'],
                        ['label'=>'Templates', 'url'=>['/admin/admin/config/index'], 'active'=>Yii::$app->controller->id==='template'],
                    ]

                ],
                Yii::$app->user->isGuest ?
                    ['label' => 'Login', 'url' => ['/user/security/login']] :
                    ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/user/security/logout'],
                        'linkOptions' => ['data-method' => 'post']],
            ],
        ]);
        NavBar::end();
        ?>

        <div class="container one-column-layout">
            <?= Breadcrumbs::widget([
                'homeLink'=>[
                    'label'=>'Dashboard',
                    'url'=>'/admin'
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>
            <p class="pull-right"><a href="mailto:grigach@gmail.com?Subject=Hello%20again" target="_top">grigach@gmail.com</a></p>
        </div>
    </footer>


<?php


$this->endContent();