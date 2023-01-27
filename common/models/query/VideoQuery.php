<?php

namespace common\models\query;

use common\models\Video;
use Yii;

/**
 * This is the ActiveQuery class for [[\common\models\Video]].
 *
 * @see \common\models\Video
 */
class VideoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Video[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Video|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Summary of latest
     * @return Yii\db\QueryTrait
     */
    public function latest()
    {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }

    /**
     * Summary of published
     * @return Yii\db\Query
     */
    public function published()
    {
        return $this->andWhere(['status' => Video::STATUS_PUBLISHED]);
    }

    /**
     * Summary of creator
     * @param mixed $user_id
     * @return Yii\db\Query
     */
    public function creator($user_id)
    {
        return $this->andWhere(['created_by' => $user_id]);
    }
}
