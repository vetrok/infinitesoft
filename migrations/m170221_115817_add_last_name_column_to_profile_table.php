<?php

use yii\db\Migration;

/**
 * Handles adding last_name to table `profile`.
 */
class m170221_115817_add_last_name_column_to_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('profile', 'last_name', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('profile', 'last_name');
    }
}
