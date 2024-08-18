<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\db\Exception;

use app\models\Subscriber;

/**
 * Class SubscribeWidget
 * @package app\views\widgets
 */
class SubscribeWidget extends Widget
{
    /**
     * @return void
     */
    public function init(): void
    {
        parent::init();
    }

    /**
     * @return bool|string
     * @throws Exception
     */
    public function run(): bool | string
    {
        $model = new Subscriber();

        if ($model->load(Yii::$app->request->post())) {

            if (!$model->validate() || $model->getErrors() || !$model->save()) {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Error! You are already subscribed to the news!'));
//                Yii::$app->getResponse()->refresh();
                return false;
            }

            Yii::$app->session->setFlash('success', Yii::t('app', 'Success! You have subscribed to the news!'));
//            Yii::$app->getResponse()->refresh();
            return true;
        }

        return $this->render('subscribe', compact('model'));
    }
}
