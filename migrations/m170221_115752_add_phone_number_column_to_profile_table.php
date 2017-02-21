<?php

use yii\db\Migration;

/**
 * Handles adding phone_number to table `profile`.
 */
class m170221_115752_add_phone_number_column_to_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('profile', 'phone_number', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('profile', 'phone_number');
    }
}
