<?php

/* @var $this \yii\web\View */

use common\models\material\Group;

?>
<header class="main-header">
    <div class="top">
        <div class="container">
            <div class="home">
                <a href="/">
                    <i class="fa fa-home"></i>
                </a>
            </div>
            <div class="address-info">
                <p class="hidden-sm">Программируем <span class="hidden-md">самые</span> сложные сайты</p>
                <p><a href="mailto:info@symbweb.ru">info@symbweb.ru</a></p>
                <p>+7 (953) 238-75-53</p>
            </div>
            <div class="online-top">
                <a href="#online_order" title="Онлайн заказ" data-toggle="modal" data-target="#myModal">
                    <div class="icon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="desc">
                        Онлайн заказ
                    </div>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <nav class="main-menu navbar">
        <? $title = \common\models\setting\Base::instance()->title ?>
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/"><img src="/img/logo.png"
                                                      alt="<?= $title ?>"></a>
                <div itemscope itemtype="http://schema.org/Organization" class="contact">
                    <meta itemprop="name" content="<?= $title ?>">
                    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                        <meta itemprop="addressCountry" content="Россия">
                    </div>
                    <a itemprop="telephone" href="tel:+79532387553" class="phone">
                        +7 (953) 238-75-53
                    </a>
                    <a itemprop="email" href="mailto:info@symbweb.ru" class="email">
                        info@symbweb.ru
                    </a>
                </div>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <div class="menu-wrap">
                    <ul class="navbar-nav navbar-right nav">
                        <li class="menu-item hidden-lg hidden-md hidden-sm"><a href="/">
                                <div class="menu-item-wrap">На главную</div>
                            </a></li>
                        <?
                        $subItems = [];
                        /** @var \common\models\material\Material $material */
                        foreach (Group::findOne(57)->materials as $material) :?>
                            <? $subItem = $material->getMaterials(59);
                            $href = $material->getValue(115); ?>
                            <li class="menu-item">
                                <a<?= $subItem ? ' data-target="#sub-menu-' . $material->id . '"' : '' ?>
                                        href="<?= $href ?>" class="<?= (explode('/', $href)[1] == $this->context->action->id) ? 'active' : '' ?>">
                                    <div class="menu-item-wrap">
                                        <?= $material->title ?>
                                        <? if ($subItem) : ?>
                                            <i class="fa fa-caret-down hidden-sm hidden-xs"></i>
                                            <? $subItems[] = $subItem; ?>
                                        <? endif; ?>
                                    </div>
                                </a>
                            </li>
                        <? endforeach; ?>
                    </ul>
                    <? /** @var \common\models\material\Material[] $subItem */
                    foreach ($subItems as $subItem) : ?>
                        <div id="<?= 'sub-menu-' . $subItem[0]->getMaterialParent()->id ?>" class="sub-menu"
                             style="display: none">
                            <div class="sub-menu-wrap">
                                <? $descriptions = [] ?>
                                <ul class="sub-menu-items">
                                    <? foreach ($subItem as $key => $item) : ?>
                                        <?
                                        $color = $item->getValue(118);
                                        if ($description = $item->getValue(119)) {
                                            $descriptions[$item->id] = $description;
                                        }
                                        ?>
                                        <li>
                                            <a data-target="#sub-menu-item-<?= $item->id ?>"
                                               href="<?= $item->getValue(120) ?>" data-color="<?= $color ?>">
                                                <div style="background: <?= $color ?>" class="icon-item">
                                                    <i class="fa <?= $item->getValue(117) ?>"></i>
                                                </div>
                                                <span class="sub-menu-title"><?= $item->title ?></span>
                                            </a>
                                        </li>
                                    <? endforeach; ?>
                                </ul>
                                <div class="clearfix"></div>
                                <? if ($descriptions) : ?>
                                    <div class="description">
                                        <? foreach ($descriptions as $key => $description) : ?>
                                            <div id="sub-menu-item-<?= $key ?>" class="description-item"
                                                 style="display: none">
                                                <?= $description ?>
                                            </div>
                                        <? endforeach; ?>
                                    </div>
                                <? endif; ?>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
            <div class="online-top hidden-lg hidden-md hidden-sm">
                <a href="#online_order" title="Онлайн заказ" data-toggle="modal" data-target="#myModal">
                    <div class="icon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="desc">
                        Онлайн заказ
                    </div>
                </a>
                <div class="clearfix"></div>
            </div>
        </div>
    </nav>
</header>
