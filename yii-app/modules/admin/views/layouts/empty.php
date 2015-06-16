<?php
/** Created by griga at 21.04.2015 | 14:36.
 *
 */
/* @var $this \yii\web\View */
/* @var $content string */


$this->beginPage();
$this->head();
$this->beginBody();
echo $content;
$this->endBody();
$this->endPage();