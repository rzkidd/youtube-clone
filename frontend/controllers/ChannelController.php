<?php

namespace frontend\controllers;

use common\models\Subscriber;
use common\models\User;
use common\models\Video;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use function PHPUnit\Framework\throwException;

/**
 * Channel controller
 */
class ChannelController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            // parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['subscribe'],
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ]
                    ]
                ],
            ]
        );
    }
    
    /**
     * Summary of actionView
     * @param mixed $username
     * @return string
     */
    public function actionView($username)
    {
        $channel = User::findByUsername($username);

        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->creator($channel->id)->published()
        ]);

        return $this->render('view', [
            'channel' => $channel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionSubscribe($username)
    {
        $channel = User::findByUsername($username);

        if ($channel->id === Yii::$app->user->id){
            return $this->renderAjax('_subscribe', [
                'channel' => $channel
            ]);
        }
        
        $subscriber = $channel->isSubscribed(Yii::$app->user->id);

        if(!$subscriber) {
            $subscriber = new Subscriber();
            $subscriber->channel_id = $channel->id;
            $subscriber->user_id = Yii::$app->user->id;
            $subscriber->created_at = time();
            $subscriber->save();
            Yii::$app->mailer->compose([
                'html' => 'subscribe-html',
                'text' => 'subscribe-text',
            ], ['channel' => $channel, 'user' => Yii::$app->user->identity])
                ->setFrom(Yii::$app->params['senderEmail'])
                ->setSubject('You have new subscriber!')
                ->setTo($channel->email)
                ->send();
        } else {
            $subscriber->delete();
        }

        return $this->renderAjax('_subscribe', [
            'channel' => $channel
        ]);
    }
}
