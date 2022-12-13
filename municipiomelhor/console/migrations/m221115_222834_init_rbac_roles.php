<?php

use yii\db\Migration;

class m221115_222834_init_rbac_roles extends Migration {

    public function safeUp() {
        $auth = Yii::$app->authManager;

        /** ==============================
        // ROLES
        ============================== **/

        $admin = $auth->createRole('Admin');
        $auth->add($admin);

        $employee = $auth->createRole('Employee');
        $auth->add($employee);

        $user = $auth->createRole('User');
        $auth->add($user);

        /** ==============================
        // PERMISSIONS
        ============================== **/

        // Backend Permission
        $backendPermission = $auth->createPermission('backendPermission');
        $backendPermission->description = 'Permissão para aceder ao backend.';
        $auth->add($backendPermission);
        $auth->addChild($admin, $backendPermission);
        $auth->addChild($employee, $backendPermission);

        // User Crud Permission
        $userCRUD = $auth->createPermission('userCRUD');
        $userCRUD->description = 'Permissão para realizar gestão dos utilizadores.';
        $auth->add($userCRUD);
        $auth->addChild($admin, $userCRUD);

        /** ==============================
        // ASSIGNS
        ============================== **/
        $auth->assign($admin, '1');
    }

    public function safeDown() {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
