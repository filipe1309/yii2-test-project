<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tests`.
 */
class m161025_012145_create_tests_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tests', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'content' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tests');
    }
}
