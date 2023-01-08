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

        $appraiser = $auth->createRole('Appraiser');
        $auth->add($appraiser);

        $employee = $auth->createRole('Employee');
        $auth->add($employee);

        $user = $auth->createRole('User');
        $auth->add($user);

        /** ==============================
        // BACKEND PERMISSIONS
        ============================== **/

        // Backend Permission
        $backendAccess = $auth->createPermission('backendAccess');
        $backendAccess->description = 'Permission to access the backend.';
        $auth->add($backendAccess);
        $auth->addChild($admin, $backendAccess);
        $auth->addChild($appraiser, $backendAccess);
        $auth->addChild($employee, $backendAccess);

        // User Crud Permission
        $userCreate = $auth->createPermission('userCreate');
        $userCreate->description = 'Permission to create users.';
        $auth->add($userCreate);
        $auth->addChild($admin, $userCreate);

        $userRead = $auth->createPermission('userRead');
        $userRead->description = 'Permission to read users.';
        $auth->add($userRead);
        $auth->addChild($admin, $userRead);

        $userUpdate = $auth->createPermission('userUpdate');
        $userUpdate->description = 'Permission to update users.';
        $auth->add($userUpdate);
        $auth->addChild($admin, $userUpdate);

        $userDelete = $auth->createPermission('userDelete');
        $userDelete->description = 'Permission to delete users.';
        $auth->add($userDelete);
        $auth->addChild($admin, $userDelete);

        /** ==============================
        // ASSIGNS
        ============================== **/
        $auth->assign($admin, '1');
        $auth->assign($appraiser, '2');
        $auth->assign($employee, '3');
        $auth->assign($user, '4');
    }

    public function safeDown() {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
