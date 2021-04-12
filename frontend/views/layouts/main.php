<?php

/* @var $this \yii\web\View */
/* @var \common\models\material\Material $model */

/* @var $content string */

use frontend\widgets\ConsultantWidget;
use frontend\widgets\OnlineCallWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\widgets\OnlineOrderWidget;

AppAsset::register($this);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Url::to(['/img/favicon.png'])]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta name="yandex-verification" content="774af7c22258dad3"/>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(($this->title ? $this->title . ' | ' : '') . \common\models\setting\Base::instance()->title) ?></title>
    <meta name="description"
          content="<?= ($description = $this->context->description) ? $description : \common\models\setting\Base::instance()->description ?>">
    <meta name="keywords" content="<?= $this->context->keywords ?>">
    <?php $this->head() ?>
</head>
<body>
<!-- Google Tag Manager -->
<script>(function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start':
                new Date().getTime(), event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5995JC6');</script>
<!-- End Google Tag Manager -->
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5995JC6"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
            (m[i].a = m[i].a || []).push(arguments)
        };
        m[i].l = 1 * new Date();
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(47225511, "init", {
        id: 47225511,
        clickmap: true,
        trackLinks: true,
        accurateTrackBounce: true,
        webvisor: true
    });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/47225511" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->
<?php $this->beginBody() ?>
<?//= $this->render('elements/preloader'); ?>
<a href="#" class="scrollup hidden-xs"><i class="fa fa-angle-up"></i></a>
<h1 class="hidden"><?= Html::encode($this->title) ?></h1>
<?= $this->render('header'); ?>
<div class="content">
    <? if (!$this->context->fullscreen) : ?>
        <div class="container inner">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    <? else : ?>
        <div class="fullscreen">
            <?= $content ?>
        </div>
    <? endif; ?>
</div>
<?= $this->render('footer'); ?>

<?= OnlineOrderWidget::widget([]) ?>
<?= OnlineCallWidget::widget([]) ?>
<?= ConsultantWidget::widget([]) ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
