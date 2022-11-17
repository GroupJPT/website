<?php

use yii\db\Migration;

class m130524_201442_init extends Migration {

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        /** ==============================
        // CREATE TABLES
        ============================== */

        // Create Table User
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);


        /** ==============================
        // INSERT ITEMS IN TABLES
        ============================== */

        // Insert Default Administrator
        $this->insert('{{%user}}', [
            'username' => 'admin',
            'auth_key' => 'bdpafnYNts_AznTmUbl9QNiZpf0Tg_4D',
            'password_hash' => '$2y$13$FctQ9hmiyRBry8ODgBVfp.f9MjkCQP13FBp5dHFx8wixZb/yj5wiu',
            'email' => 'admin@admin.admin',

            'status' => 10,
            'created_at' => '1668559033',
            'updated_at' => '1668559033',
        ]);
    }

    public function down() {
        $this->dropTable('{{%user}}');
    }
}
