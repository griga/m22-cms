<?php
use yii\web\View;


/* @var $this \yii\web\View */
/* @var $content string */

\yii\bootstrap\BootstrapAsset::register($this);


?>



<?php $this->beginContent('@app/modules/admin/views/layouts/bootstrap.php')?>

<?= $content ?>


<?php
$script = <<< JS
    $(window)
        .on('beforeunload', function(){
            window.top.postMessage('iframeBeforeUnload', '*');
        })
        .on('unload', function() {
            window.top.postMessage('iframeUnload', '*');
        });
JS;
$this->registerJs($script, View::POS_READY);

?>

<?php $this->endContent()?>
