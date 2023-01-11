<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use Yii;
use yii\helpers\Url;

class OccurrenceCest {

    public function _before(AcceptanceTester $I) {
        $I->amOnPage(Yii::$app->homeUrl);
    }

    protected function formParamsLogin($email, $password) {
        return [
            'LoginForm[email]' => $email,
            'LoginForm[password]' => $password,
        ];
    }

    protected function formParamsOccurrence($category, $subcategory, $address, $region, $postal_code, $description, $lat, $lng,) {
        return [
            'Occurrence[category_id]' => $category,
            'Occurrence[subcategory_id]' => $subcategory,
            'Occurrence[address]' => $address,
            'Occurrence[region]' => $region,
            'Occurrence[postal_code]' => $postal_code,
            'Occurrence[description]' => $description,
            'Occurrence[lat]' => $lat,
            'Occurrence[lng]' => $lng,
        ];
    }

    public function occurrencesTest(AcceptanceTester $I)
    {
        $I->click('Entrar');

        $I->submitForm('#login-form', $this->formParamsLogin('admin@mm.pt', '12345678'));
        $I->wait(3);
    }
}
