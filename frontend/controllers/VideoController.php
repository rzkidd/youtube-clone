<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Video;

/**
 * Video controller
 */
class VideoController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->published()->latest()
        ]);

        $this->view->title = Yii::$app->name;
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Summary of actionView
     * @param mixed $video_id
     * @return string
     */
    public function actionView($video_id)
    {
        $model = Video::findOne(['video_id' => $video_id]);
        $videos = Video::find()->andWhere(['!=' ,'video_id', $video_id ])->published()->limit(10)->all();

        $this->layout = 'auth';
        $this->view->title = $model->title . ' - ' . Yii::$app->name;
        return $this->render('view', [
            'model' => $model,
            'videos' => $videos
        ]);
    }
}
