<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use Yii;

class SignupCest {

    public function _before(FunctionalTester $I) {    }

    public function SignupTest(FunctionalTester $I) {
        $I->amOnPage(Yii::$app->homeUrl);
        $I->click('Entrar');
        $I->click('aqui');
        $I->fillField('SignupForm[name]', 'António');
        $I->fillField('SignupForm[surname]', 'Silva');
        $I->fillField('SignupForm[email]', 'user2@mm.pt');
        $I->fillField('SignupForm[password]', '12345678');
        $I->click('signup-button');
    }
}