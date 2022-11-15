<?php

use yii\db\Migration;

/**
 * Class m221115_222834_init_rbac
 */
class m221115_222834_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $auth = Yii::$app->authManager;

        /** ==============================
        // PERMISSIONS
        ============================== **/
        $backendPermission = $auth->createPermission('backendPermission');
        $backendPermission->description = 'Permissão para aceder ao backend.';
        $auth->add($backendPermission);

        $userCRUD = $auth->createPermission('userCRUD');
        $userCRUD->description = 'Permissão para realizar gestão dos utilizadores.';
        $auth->add($userCRUD);

        /** ==============================
        // ROLES
        ============================== **/
        $admin = $auth->createRole('Admin');
        $auth->add($admin);
        $auth->addChild($admin, $backendPermission);
        $auth->addChild($admin, $userCRUD);

        $employee = $auth->createRole('Employee');
        $auth->add($employee);
        $auth->addChild($employee, $backendPermission);

        $user = $auth->createRole('User');
        $auth->add($user);

        /** ==============================
        // ASSIGNS
        ============================== **/
        //$auth->assign($admin, '1');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
