<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%short_links}}`.
 */
class m211018_094058_create_short_links_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('short_links', [
            'id' => $this->primaryKey(),
            'url' => $this->string(5000)->notNull()->comment("Ссылка"),
            'short_code' => $this->string(6)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-short_links-url', 'short_links', 'url');
        $this->createIndex('idx-short_links-short_code', 'short_links', 'short_code', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('short_links');
    }
}
