<?php

namespace common\models\query;
use common\models\Video;

/**
 * This is the ActiveQuery class for [[\common\models\VideoView]].
 *
 * @see \common\models\VideoView
 */
class VideoViewQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\VideoView[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\VideoView|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Summary of latest
     * @return \yii\db\QueryTrait
     */
    public function latest()
    {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }
}
