<?php

namespace app\modules\main\controllers;

use app\modules\shared\models\FbUser;
use Facebook\FacebookRequest;
use Facebook\FacebookSession;
use Yii;
use yii\web\Controller;
use app\modules\main\models\ContactForm;
use yii\web\HttpException;



class ApiController extends Controller
{
    public function beforeAction($action)
    {
        FacebookSession::setDefaultApplication(Yii::$app->params['apiKeys']['facebook']['id'], Yii::$app->params['apiKeys']['facebook']['secret']);
        \Yii::$app->response->format = 'json';
        return parent::beforeAction($action);
    }

    /**
     *
     */
    public function actionCheckUser()
    {
        $req = \Yii::$app->request;

        /** @var FbUser $user */
        $user = FbUser::find()->where(['facebook_id' => $req->post('id')])->one();

        if (!$user) {
            $user = new FbUser();
            $user->facebook_id = $req->post('id');
            $user->name = $req->post('name');
            $user->email = $req->post('email');
            $user->save();
        }
        return $user->apiFields();

    }

    /**
     *
     */
    public function actionCheckLike()
    {
        $req = \Yii::$app->request;

        $fbId = $req->post('fbId');
//        $backingData = $this->fromFb('/me/likes/' . $fbId);

        $fbUrl = $req->post('url');
        $user = FbUser::find()->where(['facebook_id' => $req->post('userId')])->one();
        $user->like($fbId);

        return $user->apiFields();


//        if (isset($backingData['data']) and is_array($backingData['data']) and count($backingData['data']) > 0) {
//        } else {
//            FbUser::unlike($userId, $fbUrl);
//            return ['like' => false];
//        }
    }

    /**
     *
     */
    public function actionCheckUnlike()
    {
        $req = \Yii::$app->request;

        $fbId = $req->post('fbId');
        $user = FbUser::find()->where(['facebook_id' => $req->post('userId')])->one();
        $user->unlike($fbId);
        return $user->apiFields();
    }

    private function fromFb($action, $method = 'GET')
    {
        $accessToken = \Yii::$app->request->post('accessToken');
        $session = new FacebookSession($accessToken);
        $request = new FacebookRequest($session, $method, $action);
        $response = $request->execute();
        return $response->getGraphObject()->asArray();

    }

    /**
     *
     */
    public function actionRequestCoupon()
    {
        $req = \Yii::$app->request;

        $params = \Yii::$app->params;

        $user = FbUser::find()->where(['facebook_id' => $req->post('userId')])->one();

        if(!$user){
            throw new HttpException(404, 'User not found');
        }

        if (!$user->has_coupon){
            if ($user->fbObjectsCount >= $params['likesEnough']) {
                Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom([$params['systemEmail'] => $params['systemName']])
                    ->setSubject('Coupon Request')
                    ->setTextBody('123456')
                    ->send();
                $user->has_coupon = true;
                $user->save();
            }
        }
        return $user->apiFields();
    }
}