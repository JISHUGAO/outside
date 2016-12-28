<?php

namespace api\modules\v1\controllers;

use Yii;
/**
 * Default controller for the `v1` module
 */
class ErrorController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(Yii::getAlias('@frontendUrl'));
    }
}
