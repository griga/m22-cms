<?php 
use app\modules\content\models\Slide;
  
  /**
  * @var $models Slide
  * @var $id string
  * @var $this View
  */
  
?>

<div id="<?= $id ?>" class="carousel fade" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php foreach($models as $i => $model): ?>
      <li data-target="#<?= $id ?>" data-slide-to="<?= $i ?>" class="<?= ($i === 0 ? 'active' : '' )?>"></li>  
    <?php endforeach; ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php foreach($models as $i => $model): ?>
      <div class="item <?= ($i === 0 ? 'active' : '' )?>">
        <img src="<?= $model->image->url ?>" alt="<?= $model->title ?>">
        <div class="carousel-caption"><?= $model->title ?></div>
      </div>  
    <?php endforeach; ?>
    
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#<?= $id ?>" role="button" data-slide="prev">
    <i class="fa fa-angle-left fa-lg"></i>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#<?= $id ?>" role="button" data-slide="next">
    <i class="fa fa-angle-right fa-lg"></i>
    <span class="sr-only">Next</span>
  </a>
</div>