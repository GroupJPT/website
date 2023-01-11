<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use Yii;

class LoginCest {
    public function _before(FunctionalTester $I) { }

    public function loginTest(FunctionalTester $I) {
        $I->amOnPage(Yii::$app->homeUrl);
        $I->fillField('LoginForm[email]', 'admin@mm.pt');
        $I->fillField('LoginForm[password]', '12345678');
        $I->click('Sign In');
    }
}
