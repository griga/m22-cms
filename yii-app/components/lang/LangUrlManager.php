<?php

namespace app\components\lang;

use Yii;
use yii\web\HttpException;
use yii\web\UrlManager;

class LangUrlManager extends UrlManager
{
    public $languageVar = 'lang';
    public $exclude = [];

    public function createUrl($params = [])
    {
//        if (!isset($params[$this->languageVar]) || !Lang::checkLang($params[$this->languageVar])) {
//            $params[$this->languageVar] = Lang::get();
//        }
        if ($this->_isExcluded($params[0])) {
            unset($params[$this->languageVar]);
        } else {
            $params[0] = '/' .  Yii::$app->lang->get() . (ltrim($params[0], '/') ? '/' . ltrim($params[0], '/') : '');
        }

        return parent::createUrl($params);
    }

    public function parseRequest($request)
    {

        $route = parent::parseRequest($request);


//        $route = lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $route))));
        if ($this->_isExcluded($route[0])) {
            $requestLang =  Yii::$app->lang->getDefault();
        } else if (isset($route[1][$this->languageVar])) {
            $requestLang = $route[1][$this->languageVar];
        } else if(isset($route[0]) && $route[0] === Yii::$app->defaultRoute) {
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: /' .  Yii::$app->lang->get() );
            exit();
        } else {
            throw new HttpException(404, Yii::t('app', 'Page not found'));
        }

        Yii::$app->language =  Yii::$app->lang->get();
        if (! Yii::$app->lang->checkLang($requestLang)) {
            throw new HttpException(404, Yii::t('app', 'Page not found'));
        } else {
            if (Yii::$app->language !== $requestLang) {
                Yii::$app->lang->update($requestLang);
            }
        }

        return $route;
    }

    private function _isExcluded($route)
    {
        $r = explode('/', trim($route, '/'));
        return isset($r[0]) && in_array($r[0], $this->exclude);
    }
}

