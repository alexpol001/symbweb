<?

use yii\web\JsExpression;

/* @var $this yii\web\View */

$this->title = 'Файловый менеджер';
?>
<div class="files-index">
    <?= \mihaildev\elfinder\ElFinder::widget([
        'language' => 'ru',
        'controller' => 'elfinder',
        'callbackFunction' => new JsExpression('function(file, id){}')
    ]);
    ?>
</div>
