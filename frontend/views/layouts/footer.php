<?php

/* @var $this \yii\web\View */

use yii\helpers\Html;

?>
<footer class="footer fullscreen-element">
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <h2>О нас</h2>
                    <p>
                        Веб студия <strong>«Симбиоз»</strong> была основана в 2017
                        году. Наша компания не только создает сайты
                        любого уровня сложности, но и занимается их
                        поддержкой и продвижением. Мы работаем
                        удаленно по всей России. <strong>Можем создать все что
                            угодно, от простенького Лендинга до социальный
                            сети.</strong> Имеем огромный опыт в веб разработке,с помощью
                        него предоставляем нашим клиентам универсальные
                        решения.
                    </p>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-6 right">
                    <div class="right-wrap">
                        <h2>Контакты</h2>
                        <table class="contact-table">
                            <tr>
                                <td>Телефон для связи:</td>
                                <td><a href="tel:+79532387553">+7 (953) 238-75-53</a></td>
                            </tr>
                            <tr>
                                <td>Email @ организации:</td>
                                <td><a href="mailto:info@symbweb.ru">info@symbweb.ru</a></td>
                            </tr>
                            <tr>
                                <td>Skype:</td>
                                <td><a href="skype:live:deadorik"><i class="fa fa-skype"></i>Digital Симбиоз</a></td>
                            </tr>
                            <tr>
                                <td>Мы Вконтакте:</td>
                                <td><a href="https://vk.com/symbweb" target="_blank"><i class="fa fa-vk"></i></a></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-12 map">
                    <h2>Удаленное сотрудничество</h2>
                    <p>По всей Росиии</p>
                    <p>
                        <img src="/img/map1.png" alt="Работаем по всей России">
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="company">
                        Симбиоз
                    </span>
                    <p class="copyright">&copy; 2017-<?= date('Y') ?> «<?= Html::encode(Yii::$app->name) ?>» Все права
                        защищены.</p>
                </div>
                <div class="col-md-8">
                    <div class="logo-platforms">
                        <div class="col-sm-6">
                            <span class="logo-platform logo-1">
                            </span>
                            <span class="logo-platform logo-2">
                            </span>
                        </div>
                        <div class="col-sm-6">
                            <span class="logo-platform logo-3">
                            </span>
                            <span class="logo-platform logo-4">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
