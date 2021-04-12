<?php

/* @var $this yii\web\View */
/* @var \common\models\material\Material[] $materials */
/* @var int $tag */

/* @var bool $nav */

use yii\helpers\Url; ?>
<div class="row">
    <? if ($nav) : ?>
        <div id="filters-container">
            <a href="<?= Url::to(['site/portfolio']) ?>" class="filter-item<?= !$tag ? ' active' : '' ?>"><i
                        class="fa fa-caret-square-o-right"></i>Все
            </a>
            <?
            /** @var \common\models\material\Material $item */
            foreach ($materials[0]->getMaterialParent()->getMaterials(33) as $item) : ?>
                <a href="<?= Url::to(['site/portfolio', 'tag' => $item->slug]) ?>"
                   class="filter-item<?= ($tag == $item->id) ? ' active' : '' ?>"><i
                            class="fa <?= $item->getValue(72) ?>"></i><?= $item->title ?></a>
            <? endforeach; ?>
        </div>
    <? endif; ?>
    <div class="col-lg-10 col-lg-offset-1">
        <ul <?= $nav ? 'id="portfolio" ' : '' ?>class="portfolio-list">
            <? /** @var \common\models\material\Material $material */
            foreach ($materials as $material) :?>
                <? if (!$tag || in_array('m_' . $tag, explode(", ", $material->getValue(74)))): ?>
                    <?=
                    $this->render('../element/portfolio_item', [
                        'model' => $material,
                    ]);
                    ?>
                <? endif; ?>
            <? endforeach; ?>
        </ul>
    </div>
</div>
