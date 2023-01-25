<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\VideoLike]].
 *
 * @see \common\models\VideoLike
 */
class VideoLikeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\VideoLike[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\VideoLike|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Summary of isLikedDisliked
     * @param mixed $video_id
     * @param mixed $user_id
     * @return \yii\db\Query
     */
    public function isLikedDisliked($video_id, $user_id)
    {
        return $this->andWhere([
            'video_id' => $video_id,
            'user_id' => $user_id
        ]);
    }
}
