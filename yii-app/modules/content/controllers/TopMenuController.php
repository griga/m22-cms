<?php

namespace app\modules\content\controllers;

use app\modules\admin\controllers\AdminCrudController;
use Yii;

/**
 * PageController implements the CRUD actions for Page model.
 */
class TopMenuController extends AdminCrudController
{
    public $modelClass = 'app\modules\content\models\TopMenu';
    public $modelSearchClass = 'app\modules\content\models\ContentSearch';
    public $useViewAction = false;
    public $useMultilingual = true;


    public function actionRearrange(){
    	$data = Yii::$app->request->post('data');
    	$db = Yii::$app->db;
        $updateData = [];

        $retrieve_data = function($items, $parentId) use (&$updateData, &$retrieve_data){
            foreach($items as $index=>$item){
                $updateData[] = "({$item['id']},$parentId, $index)";
                if (isset($item['children']) && is_array($item['children'])) {
                    $retrieve_data($item['children'], $item['id']);
                }
            }
        };
        $retrieve_data($data, 0);
       
        $sql = 'INSERT INTO {{%content}} (id, parent_id, sort) VALUES '.implode(',',$updateData).' ON DUPLICATE KEY UPDATE parent_id=VALUES(parent_id),sort=VALUES(sort);';
        $db->createCommand($sql)->execute();
    }
}
