<?php

namespace frontend\controllers;

use common\models\VideoView;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Video;

use yii\web\NotFoundHttpException;
use function PHPUnit\Framework\throwException;

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

        if (!$model) {
            throw new NotFoundHttpException('Video not found');
        }

        $videos = Video::find()->andWhere(['!=' ,'video_id', $video_id ])->published()->limit(10)->all();

        // save views
        $view = new VideoView();
        $view->video_id = $video_id;
        $view->user_id = Yii::$app->user->id;
        $view->created_at = time();
        $view->save();

        $this->layout = 'auth';
        $this->view->title = $model->title . ' - ' . Yii::$app->name;
        return $this->render('view', [
            'model' => $model,
            'videos' => $videos
        ]);
    }
}
