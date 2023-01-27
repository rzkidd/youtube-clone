<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fulltext_index_to_video}}`.
 */
class m230127_062357_create_fulltext_index_to_video_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $alterQuery = "
            ALTER TABLE {{%video}} ADD COLUMN ts tsvector
                GENERATED ALWAYS AS
                (setweight(to_tsvector('english', coalesce(title, '')), 'A') ||
                setweight(to_tsvector('english', coalesce(tags, '')), 'B') ||
                setweight(to_tsvector('english', coalesce(description, '')), 'C')) STORED;
        ";
        $indexQuery = "CREATE INDEX ts_idx ON {{%video}} USING GIN (ts);";
        $this->execute($alterQuery);
        $this->execute($indexQuery);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $query = "ALTER TABLE {{%video}} DROP COLUMN ts;";
        $indexQuery = "DROP INDEX public.ts_idx;";
        $this->execute($indexQuery);
        $this->execute($query);
    }
}
