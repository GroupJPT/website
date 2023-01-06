<?php

namespace app\modules\v1;

use Yii;

class Module extends \yii\base\Module {

    public $controllerNameSpace = 'app\modules\v1\controllers';

    public function init() {
        parent::init();
        Yii::$app->user->enableSession = false;
    }

}