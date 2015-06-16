<?php
/**
 * @link https://github.com/himiklab/yii2-sitemap-module
 * @copyright Copyright (c) 2014 HimikLab
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace app\modules\sitemap\behaviors;

use yii\base\Behavior;
use yii\base\InvalidConfigException;

/**
 * Behavior for XML Sitemap Yii2 module.
 *
 * For example:
 *
 * ```php
 * public function behaviors()
 * {
 *  return [
 *       'sitemap' => [
 *           'class' => SitemapBehavior::className(),
 *           'scope' => function ($model) {
 *               $model->select(['url', 'lastmod']);
 *               $model->andWhere(['is_deleted' => 0]);
 *           },
 *           'dataClosure' => function ($model) {
 *              return [
 *                  'loc' => Url::to($model->url, true),
 *                  'lastmod' => strtotime($model->lastmod),
 *                  'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
 *                  'priority' => 0.8
 *              ];
 *          }
 *       ],
 *  ];
 * }
 * ```
 *
 * @see http://www.sitemaps.org/protocol.html
 * @author HimikLab
 * @package himiklab\sitemap
 */
class SitemapBehavior extends Behavior
{
    const CHANGEFREQ_ALWAYS = 'always';
    const CHANGEFREQ_HOURLY = 'hourly';
    const CHANGEFREQ_DAILY = 'daily';
    const CHANGEFREQ_WEEKLY = 'weekly';
    const CHANGEFREQ_MONTHLY = 'monthly';
    const CHANGEFREQ_YEARLY = 'yearly';
    const CHANGEFREQ_NEVER = 'never';

    const BATCH_MAX_SIZE = 100;

    /** @var callable */
    public $dataClosure;

    /** @var string|bool */
    public $defaultChangefreq = false;

    /** @var float|bool */
    public $defaultPriority = false;

    /** @var callable */
    public $scope;

    public function init()
    {
        if (!is_callable($this->dataClosure)) {
            throw new InvalidConfigException('SitemapBehavior::$dataClosure isn\'t callable.');
        }
    }

    public function generateSiteMap()
    {
        $result = [];
        $n = 0;

        /** @var \yii\db\ActiveRecord $owner */
        $owner = $this->owner;
        $query = $owner::find();
        if (is_callable($this->scope)) {
            call_user_func($this->scope, $query);
        }

        foreach ($query->each(self::BATCH_MAX_SIZE) as $model) {
            $urlData = call_user_func($this->dataClosure, $model);

            if (empty($urlData)) {
                continue;
            }
            foreach ($urlData as $url) {

                $result[$n]['loc'] = $url['loc'];
                $result[$n]['lastmod'] = $url['lastmod'];

                if (isset($url['changefreq'])) {
                    $result[$n]['changefreq'] = $url['changefreq'];
                } elseif ($this->defaultChangefreq !== false) {
                    $result[$n]['changefreq'] = $this->defaultChangefreq;
                }

                if (isset($url['priority'])) {
                    $result[$n]['priority'] = $url['priority'];
                } elseif ($this->defaultPriority !== false) {
                    $result[$n]['priority'] = $this->defaultPriority;
                }

                if (isset($url['translations'])) {
                    $result[$n]['translations'] = $url['translations'];
                } 

                ++$n;
            }


        }
        return $result;
    }
}
