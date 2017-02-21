<?php

use yii\db\Migration;

/**
 * Handles adding first_name to table `user`.
 */
class m170221_094945_add_first_name_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'first_name', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'first_name');
    }
}
