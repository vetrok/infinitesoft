<?php

use yii\db\Migration;

/**
 * Handles adding last_name to table `user`.
 */
class m170221_095004_add_last_name_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'last_name', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'last_name');
    }
}
