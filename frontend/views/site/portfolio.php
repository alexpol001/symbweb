<?php

/* @var $this yii\web\View */
/* @var \common\models\material\Material $tag */

/* @var \common\models\material\Material $model */

use yii\helpers\Html;
use yii\helpers\Url;

if (!$tag) {
    $this->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
}

$tagTitle = $tag ? $tag->getValue(86) : null;
$this->title = $tagTitle ? $tagTitle : $model->getValue(67);
?>
<div class="site-portfolio">
    <h2><?= Html::encode($model->title) ?></h2>
    <?= $model->getValue(70) ?>
    <hr>
    <?= $this->render('section/portfolio_list', [
        'materials' => $model->getMaterials(35),
        'nav' => true,
        'tag' => $tag ? $tag->id : null
    ]) ?>
</div>
