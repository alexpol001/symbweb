<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

?>

<?php if (Yii::$app->session->hasFlash('onlineCallFormSubmitted')) { ?>

    <?php
    $this->registerJs(
        "$('#myModalCallSendOk').modal('show');",
        yii\web\View::POS_READY
    );
    ?>

    <!-- Modal -->
    <div class="modal fade" id="myModalCallSendOk" tabindex="-1" role="dialog" aria-labelledby="myModalCallLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalCallLabel">Обратный звонок</h4>
                </div>
                <div class="modal-body">
                    <p>Благодарим вас за заявку. В ближайшее время наш менеджер свяжется с вами.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<!-- Modal -->
<div class="modal fade" id="myModalCall" tabindex="-1" role="dialog" aria-labelledby="myModalCallLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <?php $form = ActiveForm::begin(['id' => 'online-call-form']); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">х</span></button>
                <div class="modal-title">
                    <p class="modal-icon">
                        <i class="fa fa-phone"></i>
                    </p>
                    <h4 class="modal-title-text" id="myModalCallLabel">Обратный звонок</h4>
                </div>
            </div>
            <div class="modal-body">

                <?= $form->field($model, 'name')->label(false)->textInput(['placeholder' => 'Введите ваше имя*']) ?>

                <?= $form->field($model, 'phone')->label(false)->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '+7 (999) 999 99 99', 'clientOptions' => ['showMaskOnHover' => false]
                ])->textInput(['placeholder' => 'Введите свой номер телефона*']) ?>

                <?= $form->field($model, 'check', ['template' => "{label}\n{input}"])->label(false)->textInput(['placeholder' => true, 'class' => 'hidden']) ?>

                <?= $form->field($model, 'verifyCode')->label(false)->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-sm-6 captcha-input">{input}</div><div class="col-sm-6">{image}<a class="refresh-captcha"><i class="fa fa-refresh"></i></a></div></div>',
                    'options' => [
                        'placeholder' => true,
                        'class' => 'form-control',
                    ],
                    'imageOptions' => [
                        'class' => 'my-captcha-image'
                    ]
                ]) ?>

                <p class="politics">
                    Нажимая кнопку «Жду звонка» вы даете свое согласие на <a target="_blank" href="<?=\frontend\components\Frontend::getUrlArticle(\common\models\material\Material::findOne(124))?>">обработку персональных данных.</a>
                </p>

            </div>

            <?php $this->registerJs(" 
    $('.my-captcha-image').yiiCaptcha('refresh'); 
    
    $('.refresh-captcha').on('click', function(e){ 
     e.preventDefault(); 

     $('.my-captcha-image').yiiCaptcha('refresh'); 
    });
    
    $('.my-captcha-image').on('click', function(e){ 
     $('.my-captcha-image').yiiCaptcha('refresh'); 
     }); 
     
     $('#myModal, #myModalCall').on('show.bs.modal', function () {
        $('.my-captcha-image').yiiCaptcha('refresh'); 
    });
"); ?>

            <div class="modal-footer">
                <?= Html::submitButton('Жду звонка', ['class' => 'btn btn-primary', 'name' => 'online-call', 'onclick' => "dataLayer.push({'event': 'onlinecall'});"]) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
