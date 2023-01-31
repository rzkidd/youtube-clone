<?php

namespace common\models;

use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use Imagine\Image\Box;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property string $video_id
 * @property string $title
 * @property string|null $description
 * @property string|null $tags
 * @property int|null $status
 * @property bool|null $has_thumbnail
 * @property string|null $video_name
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 */
class Video extends \yii\db\ActiveRecord
{
    const STATUS_UNLISTED = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * Summary of Video
     * @var UploadedFile
     */
    public $video;
    /**
     * Summary of Video
     * @var UploadedFile
     */
    public $thumbnail;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id', 'title'], 'required'],
            [['description'], 'string'],
            [['status', 'created_at', 'updated_at', 'created_by'], 'default', 'value' => null],
            [['status', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['has_thumbnail'], 'boolean'],
            [['video_id'], 'string', 'max' => 16],
            [['title', 'tags', 'video_name'], 'string', 'max' => 512],
            [['video_id'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_UNLISTED],
            ['has_thumbnail', 'default', 'value' => false],
            ['thumbnail', 'image', 'minWidth' => 1280],
            ['video', 'file', 'extensions' => ['mp4']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    public function getVideoLink()
    {
        return Yii::$app->params['frontendUrl'] . 'storage/videos/' . $this->video_id . '.mp4';
    }
    
    public function getVideoYoutubeLink()
    {
        return Yii::$app->params['frontendUrl'] . 'video/' . $this->video_id;
    }
    
    public function getThumbnailLink()
    {
        return Yii::$app->params['frontendUrl'] . 'storage/thumbnails/' . $this->video_id . '.jpg';
    }

    public function getStatusLabels()
    {
        return [
            self::STATUS_UNLISTED => 'Unlisted',
            self::STATUS_PUBLISHED => 'Published',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'video_id' => 'Video ID',
            'title' => 'Title',
            'description' => 'Description',
            'tags' => 'Tags',
            'status' => 'Status',
            'has_thumbnail' => 'Has Thumbnail',
            'video_name' => 'Video Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'thumbnail' => 'Thumbnail'
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Summary of getViews
     * @return Yii\db\ActiveQuery
     */
    public function getViews()
    {
        return $this->hasMany(VideoView::class, ['video_id' => 'video_id']);
    }

    /**
     * Summary of getLikes
     * @return Yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(VideoLike::class, ['video_id' => 'video_id']);
    }

    public function liked()
    {
        return VideoLike::find()->isLikedDisliked($this->video_id, Yii::$app->user->id)->andWhere(['type' => VideoLike::TYPE_LIKE])->one();
    }
    
    public function disliked()
    {
        return VideoLike::find()->isLikedDisliked($this->video_id, Yii::$app->user->id)->andWhere(['type' => VideoLike::TYPE_DISLIKE])->one();
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VideoQuery(get_called_class());
    }

    /**
     * Summary of save
     * @param mixed $runValidation
     * @param mixed $attributeNames
     * @return bool
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        $isInsert = $this->isNewRecord; // whether create or update

        if ($isInsert) {
            // specify video_id, title, video_name
            $this->video_id = Yii::$app->security->generateRandomString(16);
            $this->title = $this->video->name;
            $this->video_name = $this->video->name;
        }

        // whether has thumbnail
        if ($this->thumbnail) {
            $this->has_thumbnail = true;
        }
        // save the data
        $saved = parent::save($runValidation, $attributeNames);

        if (!$saved) {
            return false;
        }

        // save file
        if ($isInsert) {
            $videoPath = Yii::getAlias('@frontend/web/storage/videos/' . $this->video_id . '.mp4');
            if (!is_dir(dirname($videoPath))) {
                FileHelper::createDirectory(dirname($videoPath));
            }
            $this->video->saveAs($videoPath);

            $thumbnailPath = Yii::getAlias('@frontend/web/storage/thumbnails/' . $this->video_id . '.jpg');
            $ffmpeg = FFMpeg::create([
                // 'ffmpeg.binaries'  => '/opt/ffmpeg/ffmpeg/ffmpeg',
                // 'ffprobe.binaries' => '/opt/ffmpeg/ffprobe/ffprobe'
            ]);
            $video = $ffmpeg->open($videoPath);
            $video
                ->frame(TimeCode::fromSeconds(10))
                ->save($thumbnailPath);
        }

        if ($this->thumbnail) {
            $thumbnailPath = Yii::getAlias('@frontend/web/storage/thumbnails/' . $this->video_id . '.jpg');
            if (!is_dir(dirname($thumbnailPath))) {
                FileHelper::createDirectory(dirname($thumbnailPath));
            }
            $this->thumbnail->saveAs($thumbnailPath);
            Image::getImagine()
                ->open($thumbnailPath)
                ->thumbnail(new Box(1280, 1280))
                ->save();
        }

        return true;
    }

    /**
     * Summary of afterDelete
     * @return void
     */
    public function afterDelete()
    {
        parent::afterDelete();

        $videoPath = Yii::getAlias('@frontend/web/storage/videos/' . $this->video_id . '.mp4');
        $thumbnailPath = Yii::getAlias('@frontend/web/storage/thumbnails/' . $this->video_id . '.jpg');
        unlink($videoPath);

        if (file_exists($thumbnailPath)){
            unlink($thumbnailPath);
        }
    }
}
