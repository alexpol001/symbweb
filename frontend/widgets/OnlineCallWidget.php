<?php

namespace frontend\widgets;

use common\models\setting\Mail;
use frontend\models\OnlineCallForm;
use Yii;
use yii\base\Widget;

class OnlineCallWidget extends Widget
{

    public function run()
    {
        $model = new OnlineCallForm();
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->sendEmail(Mail::instance()->login)) {
            Yii::$app->session->setFlash('onlineCallFormSubmitted');
        }
        return $this->render('onlineCall/index', [
            'model' => $model,
        ]);
    }

}
