<?php

use yii\db\Migration;

/**
 * Handles adding phone_number to table `user`.
 */
class m170221_094936_add_phone_number_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'phone_number', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'phone_number');
    }
}
