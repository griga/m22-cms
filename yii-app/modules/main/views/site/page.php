<?php 
/**
*	@var $model Content
*/

use himiklab\thumbnail\EasyThumbnailImage;

 ?>
 <?php if($model->image): ?>
  	<?= EasyThumbnailImage::thumbnailImg(
   '@webroot' . $model->image->url,
    1300, 200,
    EasyThumbnailImage::THUMBNAIL_OUTBOUND, [
     'alt' => $model->title,
     'class'=>'img-responsive', ]); ?> 
<?php endif ?>
 <div class="content-container">
<div class="container">
    <hr>
	<div class="row">
		<div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
			<?= $model->content ?>
		</div>
	</div>

<hr>
</div>
</div>