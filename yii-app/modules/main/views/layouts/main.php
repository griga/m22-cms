<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

use app\components\assets\AppAsset;
use app\components\lang\Lang;
use app\components\lang\widgets\LangDropdown;
use app\modules\content\models\TopMenu;
use app\modules\admin\models\Config;
use app\components\html\HtmlHelper;


/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Yii::$app->seoRenderer->process() ?>
    <?= $this->render('@app/modules/main/views/shared/favicon') ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <div id="wrapper">
        <header>
        <div class="header-top">
            <a class="logo-link" href="/<?= Yii::$app->lang->get() ?>">
                <img class="img-responsive" src="/img/logo/logo.png" alt="logo">
            </a>
            <div class="header-contacts">
                <h3><?= Yii::t('app', 'Contact Us') ?></h3>
                <p><i class="fa fa-fw fa-phone"></i> <?= Config::get('contact_phone')?> </p>
                <p><i class="fa fa-fw fa-envelope"></i> <?= Config::get('contact_email')?> </p>

            </div>
        </div>    
        <?php
        
        NavBar::begin([
            'id'=>'navigation',
            'options' => [
                'class' => 'navbar-default',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => TopMenu::frontEndItems(),
            'activateParents'=>true,
        ]);

        ?> 
        <?= LangDropdown::widget();?>
        <?php
        NavBar::end();
        ?>
        </header>
    
<?= $content ?>
</div>
<div id="footer-wrapper">
<footer>
    <div class="footer-content">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading"><?= \Yii::t('site', "Let's Get In Touch!") ?></h2>
                <hr class="primary">
                <p></p>
            </div>
            <div class="col-lg-4 col-lg-offset-2 text-center">
                <?= HtmlHelper::a('<i class="fa fa-skype fa-3x wow bounceIn"></i>', 'contact') ?>
                
                <p><?= Config::get('contact_skype')?></p>
            </div>
            <div class="col-lg-4 text-center">
                
                <?= HtmlHelper::a('<i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>', 'contact') ?>
                <p><a href="mailto:<?= Config::get('contact_email')?>"><?= Config::get('contact_email')?></a></p>
            </div>
        </div>
    </div>
</footer>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
