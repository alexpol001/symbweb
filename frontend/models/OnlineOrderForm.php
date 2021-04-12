<?php

namespace frontend\models;

use common\models\setting\Base;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class OnlineOrderForm extends Model
{
    public $name;
    public $phone;
    public $email;
    public $body;
    public $check;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'verifyCode'], 'required'],
            [['phone'], 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{3}\s[0-9]{2}\s[0-9]{2}$/', 'message' => 'Неверный формат сотового телефона'],
            [['email'], 'email'],
            [['name', 'check'], 'string', 'max' => 255],
            [['body'], 'string'],
            [['verifyCode'], 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'Электронная почта',
            'body' => 'Комментарий',
            'check' => 'Привет бот',
            'verifyCode' => 'Введите код с картинки',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        if (!$this->check && $this->validate()) {
            return Yii::$app->mailer
                ->compose(
                    ['html' => 'online-order/html', 'text' => 'online-order/text'],
                    ['model' => $this]
                )
                ->setTo($email)
                ->setFrom([$email => Base::instance()->title])
                ->setSubject('Онлайн-заказ | ' . Base::instance()->title)
                ->send();
        }
        return false;
    }
}
