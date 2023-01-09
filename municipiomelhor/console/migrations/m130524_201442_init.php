<?php

use yii\db\Migration;

class m130524_201442_init extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        /** ==============================
        // CREATE TABLES
        ============================== */

        // Table User
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'created_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        // Table Contact
        $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'region' => $this->string()->notNull(),
            'postal_code' => $this->string()->notNull(),
            'phone' => $this->integer(9)->notNull(),
            'fax' => $this->integer(),
            'email' => $this->string(),
            'website' => $this->string(),
        ], $tableOptions);

        // Table Warning
        $this->createTable('warning', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        // Table Category
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        // Table Subcategory
        $this->createTable('subcategory', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'category_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Table Occurrence
        $this->createTable('occurrence', [
            'id' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
            'address' => $this->string()->notNull(),
            'region' => $this->string()->notNull(),
            'postal_code' => $this->string()->notNull(),
            'lat' => $this->string()->notNull(),
            'lgn' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'subcategory_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Table Occurrence Photo
        $this->createTable('occurrence_photo', [
            'id' => $this->primaryKey(),
            'photo_path' => $this->string()->notNull(),
            'occurrence_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Table Occurrence History
        $this->createTable('occurrence_history', [
            'id' => $this->primaryKey(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'occurrence_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Table Occurrence Follow
        $this->createTable('occurrence_follow', [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'occurrence_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Table Suggestion
        $this->createTable('suggestion', [
            'id' => $this->primaryKey(),
            'address' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Table Suggestion History
        $this->createTable('suggestion_history', [
            'id' => $this->primaryKey(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'suggestion_id' => $this->integer()->notNull(),
        ], $tableOptions);


        /** ==============================
        // CREATE FOREIGN KEYS
        ============================== */

        // Table Subcategory
        $this->addForeignKey('fk-subcategory-category_id', 'subcategory', 'category_id', 'category', 'id',);

        // Table occurrence
        $this->addForeignKey('fk-occurrence-user_id', 'occurrence', 'user_id', 'user', 'id',);
        $this->addForeignKey('fk-occurrence-category_id', 'occurrence', 'category_id', 'category', 'id',);
        $this->addForeignKey('fk-occurrence-subcategory_id', 'occurrence', 'subcategory_id', 'subcategory', 'id',);

        // Table occurrence Photo
        $this->addForeignKey('fk-occurrence_photo-occurrence_id', 'occurrence_photo', 'occurrence_id', 'occurrence', 'id',);

        // Table occurrence History
        $this->addForeignKey('fk-occurrence_history-occurrence_id', 'occurrence_history', 'occurrence_id', 'occurrence', 'id',);

        // Table occurrence Follow
        $this->addForeignKey('fk-occurrence_follow-user_id', 'occurrence_follow', 'user_id', 'user', 'id',);
        $this->addForeignKey('fk-occurrence_follow-occurrence_id', 'occurrence_follow', 'occurrence_id', 'occurrence', 'id',);


        // Table Suggestion
        $this->addForeignKey('fk-suggestion-user_id', 'suggestion', 'user_id', 'user', 'id',);

        // Table Suggestion History
        $this->addForeignKey('fk-suggestion_history-suggestion_id', 'suggestion_history', 'suggestion_id', 'suggestion', 'id',);


        /** ==============================
        // INSERT ITEMS IN TABLES
        ============================== */

        // Insert Default Administrator
        $this->insert('user', [
            'name' => 'Pedro',
            'surname' => 'Sousa',
            'auth_key' => 'bdpafnYNts_AznTmUbl9QNiZpf0Tg_1D',
            'password_hash' => '$2y$13$FctQ9hmiyRBry8ODgBVfp.f9MjkCQP13FBp5dHFx8wixZb/yj5wiu',
            'email' => 'admin@mm.pt',
            'created_at' => '2022-07-08 13:45:00',
        ]);

        // Insert Default Appraiser
        $this->insert('user', [
            'name' => 'Tomás',
            'surname' => 'Cândido',
            'auth_key' => 'bdpafnYNts_AznTmUbl9QNiZpf0Tg_2D',
            'password_hash' => '$2y$13$FctQ9hmiyRBry8ODgBVfp.f9MjkCQP13FBp5dHFx8wixZb/yj5wiu',
            'email' => 'appraiser@mm.pt',
            'created_at' => '2022-07-08 13:45:00',
        ]);

        // Insert Default Appraiser
        $this->insert('user', [
            'name' => 'João',
            'surname' => 'Mota',
            'auth_key' => 'bdpafnYNts_AznTmUbl9QNiZpf0Tg_3D',
            'password_hash' => '$2y$13$FctQ9hmiyRBry8ODgBVfp.f9MjkCQP13FBp5dHFx8wixZb/yj5wiu',
            'email' => 'employee@mm.pt',
            'created_at' => '2022-07-08 13:45:00',
        ]);

        // Insert Default User
        $this->insert('user', [
            'name' => 'Mário',
            'surname' => 'Fernandes',
            'auth_key' => 'bdpafnYNts_AznTmUbl9QNiZpf0Tg_4D',
            'password_hash' => '$2y$13$FctQ9hmiyRBry8ODgBVfp.f9MjkCQP13FBp5dHFx8wixZb/yj5wiu',
            'email' => 'user@mm.pt',
            'created_at' => '2022-07-08 13:45:00',
        ]);

        // Insert Default Categories
        $this->insert('category', ['name' => 'Árvores e Espaços Verdes']);
        $this->insert('subcategory', ['name' => 'Árvores - Plantação', 'category_id' => '1']);
        $this->insert('subcategory', ['name' => 'Árvores, arbustos ou relva - Manutenção', 'category_id' => '1']);
        $this->insert('subcategory', ['name' => 'Bebedouros, Chafariz, Fontanário ou Lago - Manutenção', 'category_id' => '1']);
        $this->insert('subcategory', ['name' => 'Cercas, vedações e outras estruturas - Manutenção', 'category_id' => '1']);
        $this->insert('subcategory', ['name' => 'Colocação de novo mobiliário urbano', 'category_id' => '1']);
        $this->insert('subcategory', ['name' => 'Hortas urbanas - Manutenção', 'category_id' => '1']);
        $this->insert('subcategory', ['name' => 'Mesas, bancos ou outros mobiliário urbanos - Manutenção', 'category_id' => '1']);
        $this->insert('subcategory', ['name' => 'Parques Infantis e Juvenis - Manutenção', 'category_id' => '1']);
        $this->insert('subcategory', ['name' => 'Rede de rega - Manutenção', 'category_id' => '1']);

        $this->insert('category', ['name' => 'Equipamentos Municipais - Cultura']);
        $this->insert('subcategory', ['name' => 'Escultura - Manutenção', 'category_id' => '2']);
    }

    public function safeDown() {

        /** ==============================
        // DROP FOREIGN KEYS
        ============================== */

        $this->dropForeignKey('fk-subcategory-category_id', 'subcategory');
        $this->dropForeignKey('fk-occurrence-user_id', 'occurrence');
        $this->dropForeignKey('fk-occurrence-category_id', 'occurrence');
        $this->dropForeignKey('fk-occurrence-subcategory_id', 'occurrence');
        $this->dropForeignKey('fk-occurrence_photo-occurrence_id', 'occurrence_photo');
        $this->dropForeignKey('fk-occurrence_history-occurrence_id', 'occurrence_history');
        $this->dropForeignKey('fk-occurrence_follow-user_id', 'occurrence_follow');
        $this->dropForeignKey('fk-occurrence_follow-occurrence_id', 'occurrence_follow');
        $this->dropForeignKey('fk-suggestion-user_id', 'suggestion');
        $this->dropForeignKey('fk-suggestion_history-suggestion_id', 'suggestion_history');

        /** ==============================
        // DROP TABLES
        ============================== */

        $this->dropTable('user');
        $this->dropTable('contact');
        $this->dropTable('warning');
        $this->dropTable('category');
        $this->dropTable('subcategory');
        $this->dropTable('occurrence');
        $this->dropTable('occurrence_photo');
        $this->dropTable('occurrence_history');
        $this->dropTable('occurrence_follow');
        $this->dropTable('suggestion');
        $this->dropTable('suggestion_history');
    }
}