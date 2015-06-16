<?php
/** Created by griga at 30.01.2015 | 16:12.
 *
 */

namespace app\components\lang;


use Yii;
use yii\base\Component;
use yii\helpers\VarDumper;
use yii\web\Cookie;



class Lang extends Component
{
    /**
     *
     * @return array
     */
    public function getLanguages()
    {
        return array_map(function($lang){
            return $lang['language'];
        }, Yii::$app->params['languagesConfig']);

    }

    public function getLanguageKeys()
    {
        return array_keys($this->getLanguages());
    }

    /**
     * @return string
     */
    public function get()
    {
        $cookies = Yii::$app->response->cookies;

        if (!$cookies->has('language')) {
            $this->_set($this->getDefault());
        }
        if($this->checkLang($cookies->getValue('language'))){
            return $cookies->getValue('language');
        }
        else {
            return $this->getDefault();
        }
    }

    /**
     * @return array
     */
    public function getCurrentConfig()
    {
        
        return Yii::$app->params['languagesConfig'][$this->get()];
    }

    /**
     * @return string
     */
    public function getDefault()
    {
        return Yii::$app->params['defaultLanguage'];
    }

    /**
     *
     * @param $lang
     */
    private function _set($lang)
    {
        $cookie = new Cookie([
            'name' => 'language',
            'value' => $lang,
            'httpOnly' => true,
            'expire' => time() + 60 * 60 * 25 * 30
        ]);

        Yii::$app->response->cookies->add($cookie);
        // Yii::$app->params['defaultLanguage'] = $lang;
    }

    /**
     * @param $lang
     */
    public function update($lang)
    {
        // Language isset it get array, and value in possible array
        if ($this->checkLang($lang)) {
            $this->_set($lang);
        }
        // Anyway, we have to get language and set default value
        Yii::$app->language = $this->get();
    }

    /**
     * @param $lang
     *
     * @return bool
     */
    public function checkLang($lang)
    {
        if (in_array($lang, $this->getLanguageKeys(), true)) {
            return true;
        }
        return false;
    }
}