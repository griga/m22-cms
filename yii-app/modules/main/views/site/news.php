<?php 
/**
*	@var $model Content
*/

use app\components\html\HtmlHelper;

 ?>
<?php if($model->image): ?>
    <?= HtmlHelper::responsiveImg($model->image->url, 1300, 200, $model->title)  ?>
<?php endif ?>
 <div class="content-container">
<div class="container">
    <hr>
	<div class="row">
		<div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
			<?= $model->content ?>

            <?php foreach($models as $item): ?>
                <div class="row">
                    <?php if($item->image): ?>
                        <div class="col-sm-3">
                            <br>
                            <?= HtmlHelper::responsiveImg($item->image->url, 250, 200, $item->title)?>
                        </div>
                    <?php endif ?>
                    <div class="col-sm-9">
                        <h3><?= $item->link ?></h3>
                        <?= $item->short_content; ?>
                        <div class="row">
                            <div class="pull-left">
                                <?= $item->publish_date ?>
                            </div>
                            <div class="pull-right">
                                <?= $item->getReadMoreLink(['class'=>'btn btn-primary']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
		</div>
	</div>


    <hr>
</div>
</div>