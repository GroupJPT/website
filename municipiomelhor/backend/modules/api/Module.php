<?php

namespace app\modules\api;

use Yii;

class Module extends \yii\base\Module {

    public $controllerNameSpace = 'app\modules\api\controllers';

    public function init() {
        parent::init();
        Yii::$app->user->enableSession = false;
    }

}