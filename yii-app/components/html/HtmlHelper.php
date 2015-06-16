<?php

namespace app\components\html;

use Yii;
use yii\helpers\Html;

use himiklab\thumbnail\EasyThumbnailImage;

use app\components\lang\Lang;

class HtmlHelper extends yii\base\Component {

	public static function a($content, $to){
		$to = '/' . Yii::$app->lang->get() . '/' . $to;
		return Html::a($content, $to) ;
	}

	public static function responsiveImg($url, $width, $height, $alt = ''){
		return EasyThumbnailImage::thumbnailImg(
		   '@webroot' . $url, 
		   $width, 
		   $height, 
		   EasyThumbnailImage::THUMBNAIL_OUTBOUND,
		   [ 'alt' => $alt, 'class'=>'img-responsive' ]
		);
	}
}
