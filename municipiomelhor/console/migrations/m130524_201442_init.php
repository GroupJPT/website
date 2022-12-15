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
            'parish_id' => $this->integer(),
        ], $tableOptions);

        // Table Parish
        $this->createTable('parish', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        // Table Contact (FALTA ALTERAÇÕES)
        $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'phone' => $this->integer(9)->notNull(),
            'fax' => $this->integer(),
            'email' => $this->string(),
            'website' => $this->string(),
            'categorie_id' => $this->integer()->notNull(),
            'parish_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Table Warning
        $this->createTable('warning', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'categorie_id' => $this->integer()->notNull(),
            'parish_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Table Categories
        $this->createTable('categorie', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'topic' => $this->string()->notNull(),
        ], $tableOptions);

        // Table Subcategories
        $this->createTable('subcategorie', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'categorie_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Table occurrence
        $this->createTable('occurrence', [
            'id' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'categorie_id' => $this->integer()->notNull(),
            'subcategorie_id' => $this->integer()->notNull(),
            'parish_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Table occurrence Photo
        $this->createTable('occurrence_photo', [
            'id' => $this->primaryKey(),
            'photo_path' => $this->string()->notNull(),
            'occurrence_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Table occurrence History
        $this->createTable('occurrence_history', [
            'id' => $this->primaryKey(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'occurrence_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Table occurrence Follow
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

        // Table User
        $this->addForeignKey('fk-user-parish_id', 'user', 'parish_id', 'parish', 'id',);

        // Table Contact
        $this->addForeignKey('fk-contact-categorie_id', 'contact', 'categorie_id', 'categorie', 'id',);
        $this->addForeignKey('fk-contact-parish_id', 'contact', 'parish_id', 'parish', 'id',);

        // Table Warning
        $this->addForeignKey('fk-warning-categorie_id', 'warning', 'categorie_id', 'categorie', 'id',);
        $this->addForeignKey('fk-warning-parish_id', 'warning', 'parish_id', 'parish', 'id',);

        // Table Subcategories
        $this->addForeignKey('fk-subcategorie-categorie_id', 'subcategorie', 'categorie_id', 'categorie', 'id',);

        // Table occurrence
        $this->addForeignKey('fk-occurrence-user_id', 'occurrence', 'user_id', 'user', 'id',);
        $this->addForeignKey('fk-occurrence-categorie_id', 'occurrence', 'categorie_id', 'categorie', 'id',);
        $this->addForeignKey('fk-occurrence-subcategorie_id', 'occurrence', 'subcategorie_id', 'subcategorie', 'id',);
        $this->addForeignKey('fk-occurrence-parish_id', 'occurrence', 'parish_id', 'parish', 'id',);

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

        // Insert Default Parishes
        $this->insert('parish', ['name' => 'A dos Cunhados e Maceira']);
        $this->insert('parish', ['name' => 'Campelos e Outeiro da Cabeça']);
        $this->insert('parish', ['name' => 'Carvoeira e Carmões']);
        $this->insert('parish', ['name' => 'Dois Portos e Runa']);
        $this->insert('parish', ['name' => 'Freiria']);
        $this->insert('parish', ['name' => 'Maxial e Monte Redondo']);
        $this->insert('parish', ['name' => 'Ponte de Rol']);
        $this->insert('parish', ['name' => 'Ramalhal']);
        $this->insert('parish', ['name' => 'Santa Maria, São Pedro e Matacães']);
        $this->insert('parish', ['name' => 'São Pedro da Cadeira']);
        $this->insert('parish', ['name' => 'Silveira']);
        $this->insert('parish', ['name' => 'Torres Vedras']);
        $this->insert('parish', ['name' => 'Turcifal']);
        $this->insert('parish', ['name' => 'Ventosa']);

        // Insert Default Administrator
        $this->insert('user', [
            'name' => 'Pedro',
            'surname' => 'Sousa',
            'auth_key' => 'bdpafnYNts_AznTmUbl9QNiZpf0Tg_4D',
            'password_hash' => '$2y$13$FctQ9hmiyRBry8ODgBVfp.f9MjkCQP13FBp5dHFx8wixZb/yj5wiu',
            'email' => 'admin@mm.pt',
            'created_at' => '1668559033',
            'parish_id' => 1,
        ]);

        // Insert Default User
        $this->insert('user', [
            'name' => 'Tomás',
            'surname' => 'Cândido',
            'auth_key' => 'bdpafnYNts_AznTmUbl9QNiZpf0Tg_4D',
            'password_hash' => '$2y$13$FctQ9hmiyRBry8ODgBVfp.f9MjkCQP13FBp5dHFx8wixZb/yj5wiu',
            'email' => 'user@mm.pt',
            'created_at' => '1668559033',
            'parish_id' => 1,
        ]);

    }

    public function safeDown() {

        /** ==============================
        // DROP FOREIGN KEYS
        ============================== */

        $this->dropForeignKey('fk-user-parish_id', 'user');
        $this->dropForeignKey('fk-contact-categorie_id', 'contact');
        $this->dropForeignKey('fk-contact-parish_id', 'contact');
        $this->dropForeignKey('fk-warning-categorie_id', 'warning');
        $this->dropForeignKey('fk-warning-parish_id', 'warning');
        $this->dropForeignKey('fk-subcategorie-categorie_id', 'subcategorie');
        $this->dropForeignKey('fk-occurrence-user_id', 'occurrence');
        $this->dropForeignKey('fk-occurrence-categorie_id', 'occurrence');
        $this->dropForeignKey('fk-occurrence-subcategorie_id', 'occurrence');
        $this->dropForeignKey('fk-occurrence-parish_id', 'occurrence');
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
        $this->dropTable('parish');
        $this->dropTable('contact');
        $this->dropTable('warning');
        $this->dropTable('categorie');
        $this->dropTable('subcategorie');
        $this->dropTable('occurrence');
        $this->dropTable('occurrence_photo');
        $this->dropTable('occurrence_history');
        $this->dropTable('occurrence_follow');
        $this->dropTable('suggestion');
        $this->dropTable('suggestion_history');
    }
}



























