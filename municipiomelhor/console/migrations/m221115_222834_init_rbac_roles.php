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
        $userCRUD = $auth->createPermission('userCRUD');
        $userCRUD->description = 'Permission to management users.';
        $auth->add($userCRUD);
        $auth->addChild($admin, $userCRUD);

        // Occurrence Crud Permission
        $occurrenceCRUD = $auth->createPermission('occurrenceCRUD');
        $occurrenceCRUD->description = 'Permission to management occurrences.';
        $auth->add($occurrenceCRUD);
        $auth->addChild($admin, $occurrenceCRUD);
        $auth->addChild($appraiser, $occurrenceCRUD);
        $auth->addChild($employee, $occurrenceCRUD);

        // Suggestion Crud Permission
        $suggestionCRUD = $auth->createPermission('suggestionCRUD');
        $suggestionCRUD->description = 'Permission to management suggestion.';
        $auth->add($suggestionCRUD);
        $auth->addChild($admin, $suggestionCRUD);
        $auth->addChild($appraiser, $suggestionCRUD);

        // Warning Crud Permission
        $warningCRUD = $auth->createPermission('warningCRUD');
        $warningCRUD->description = 'Permission to management warnings.';
        $auth->add($warningCRUD);
        $auth->addChild($admin, $warningCRUD);
        $auth->addChild($appraiser, $warningCRUD);

        // Category Crud Permission
        $categoryCRUD = $auth->createPermission('categoryCRUD');
        $categoryCRUD->description = 'Permission to management categories.';
        $auth->add($categoryCRUD);
        $auth->addChild($admin, $categoryCRUD);
        $auth->addChild($appraiser, $categoryCRUD);

        // DevTools Permission
        $devTools = $auth->createPermission('devTools');
        $devTools->description = 'Permission to management dev tools.';
        $auth->add($devTools);
        $auth->addChild($admin, $devTools);

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
