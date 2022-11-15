<?php

use yii\db\Migration;

/**
 * Class m221114_112759_init_rbac
 */
class m221114_112759_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // ==============================
        // PERMISSIONS
        // ==============================
        $backendPermission = $auth->createPermission('backendPermission');
        $backendPermission->description = 'Consegue realizar autenticação no backend.';
        $auth->add($backendPermission);

        // ==============================
        // ROLES
        // ==============================
        $admin = $auth->createRole('Admin');
        $auth->add($admin);
        $auth->addChild($admin, $backendPermission);

        $employee = $auth->createRole('Employee');
        $auth->add($employee);

        $user = $auth->createRole('User');
        $auth->add($user);

        // ==============================
        // ASSIGNS
        // ==============================
        $auth->assign($admin, '1');

    }

    /**
     * {@inheritdoc}     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
