<?php

use yii\db\Migration;

/**
 * Handles the creation of table `login_stories`.
 */
class m170221_123102_create_login_stories_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('login_stories', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'ip' => $this->string(45),
            'browser' => $this->string(),
            'login_time' => $this->integer(11),
        ]);

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-login_stories-user_id',
            'login_stories',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('login_stories');
    }
}
