<?php 
use \app\components\lang\Lang;


$languages  = \Yii::$app->lang->languages;
$current  = \Yii::$app->lang->currentConfig;

function getUrl($lang){
	return preg_replace('~^/\w\w~', '/'.$lang, \Yii::$app->request->url);
}

 ?>

<ul class="navbar-nav nav navbar-right hidden-sm hidden-xs">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="/img/blank.gif" class="flag flag-<?= $current['key']?>" alt="United States"> <span> <?= $current['language']?> </span> <i class="fa fa-angle-down"></i> </a>
		<ul class="dropdown-menu pull-right">
			<?php foreach ($languages as $key => $data): ?>
			<li>
				<a href="<?= getUrl($key) ?>"><img src="/img/blank.gif" class="flag flag-<?= $key?>" alt="<?= $data?>"> <?= $data?></a>
			</li>
		<?php endforeach ?>
		</ul>
	</li>
</ul>
