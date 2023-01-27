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
use common\models\VideoLike;
use yii\web\NotFoundHttpException;
use function PHPUnit\Framework\throwException;

/**
 * Video controller
 */
class VideoController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            // parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['like', 'dislike'],
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ]
                    ]
                ],
                // 'verbs' => [
                //     'class' => VerbFilter::class,
                //     'actions' => [
                //         'like' => ['post'],
                //         'dislike' => ['post'],
                //     ],
                // ],
                
            ]
        );
    }
    
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

    /**
     * Summary of actionLike
     * @param mixed $video_id
     * @return string
     */
    public function actionLike($video_id)
    {
        $user_id = Yii::$app->user->id;
        $videoLike = VideoLike::find()->isLikedDisliked($video_id, $user_id)->one();
        
        if (!$videoLike){
            $this->saveLikeDislike($video_id, $user_id, VideoLike::TYPE_LIKE);
        } else if ($videoLike->type == VideoLike::TYPE_LIKE){
            $videoLike->delete();
        } else {
            $videoLike->delete();
            $this->saveLikeDislike($video_id, $user_id, VideoLike::TYPE_LIKE);
        }

        return $this->renderAjax('_like_dislike', [
            'model' => Video::findOne($video_id)
        ]);
    }

    /**
     * Summary of actionDislike
     * @param mixed $video_id
     * @return string
     */
    public function actionDislike($video_id)
    {
        $user_id = Yii::$app->user->id;
        $videoLike = VideoLike::find()->isLikedDisliked($video_id, $user_id)->one();

        if (!$videoLike){
            $this->saveLikeDislike($video_id, $user_id, VideoLike::TYPE_DISLIKE);
        } else if ($videoLike->type == VideoLike::TYPE_DISLIKE){
            $videoLike->delete();
        } else {
            $videoLike->delete();
            $this->saveLikeDislike($video_id, $user_id, VideoLike::TYPE_DISLIKE);
        }
        
        return $this->renderAjax('_like_dislike', [
            'model' => Video::findOne($video_id)
        ]);
    }

    public function actionSearch($keyword)
    {
        $query = Video::find()->published()->latest();
        if ($keyword) {
            $query->byKeyword($keyword);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->view->title = Yii::$app->name;
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Summary of saveLikeDislike
     * @param mixed $video_id
     * @param mixed $user_id
     * @param mixed $type
     * @return void
     */
    protected function saveLikeDislike($video_id, $user_id, $type)
    {
        $videoLike = new VideoLike();
        $videoLike->video_id = $video_id;
        $videoLike->user_id = $user_id;
        $videoLike->type = $type;
        $videoLike->created_at = time();
        $videoLike->save();
    }
}
