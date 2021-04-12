<?php

namespace frontend\controllers;

use common\models\material\Group;
use common\models\material\Material;
use common\models\setting\Base;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $fullscreen = false;
    public $description = "";
    public $keywords = "";

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'httpCache' => [
                'class' => 'yii\filters\HttpCache',
                'lastModified' => function ($action, $params) {
                    return time();
                },
                'sessionCacheLimiter' => 'public',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'common\components\NumericCaptcha',
                'width' => '80',
                'height' => '34',
                'testLimit' => '1',
                'padding' => '5',
                'foreColor' => 0x000000,
                'backColor' => 0xfcf439,
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $model =  Group::findOne(11)->material;
        $this->fullContent();
        $this->setMetaData($model,23, 24);
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionService()
    {
        $model = Group::findOne(21)->material;
        $this->fullContent();
        $this->setMetaData($model,43, 44);
        return $this->render('service', [
            'model' => $model,
        ]);
    }

    /**
     * @param null $item
     * @param null $tag
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPortfolio($item = null, $tag = null)
    {
        $portfolio = Group::findOne(31)->material;
        if ($item) {
            $model = $this->getPortfolioItem($item);
            $this->fullContent();
            /** @var Material[] $recommend */
            $recommend = $portfolio->getMaterials(35, [$model->id]);
            while (($count = count($recommend)) > 3) {
                unset($recommend[rand(0, $count - 1)]);
            }
            return $this->render('inner/portfolio', [
                'portfolio' => $portfolio,
                'model' => $model,
                'recommend' => $recommend,
            ]);
        }
        $this->setMetaData($portfolio,68, 69);
        return $this->render('portfolio', [
            'model' => $portfolio,
            'tag' => $tag ? Material::findOne(['slug' => $tag, 'group_id' => 33]) : null,
        ]);
    }

    public function actionPriceList()
    {
        $model = Group::findOne(41)->material;
        $this->setMetaData($model,89, 90);
        return $this->render('price-list', [
            'model' => $model,
        ]);
    }

    public function actionFaq()
    {
        $model = Group::findOne(49)->material;
        $this->setMetaData($model,101, 102);
        return $this->render('faq', [
            'model' => $model,
        ]);
    }

    public function actionContact()
    {
        $model = Group::findOne(53)->material;
        $this->setMetaData($model,108, 109);
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionArticle($slug) {
        $model = $this->getArticle($slug);
        $this->setMetaData($model, 123, 124);
        return $this->render('inner/article', [
            'model' => $model
        ]);
    }

    protected function fullContent()
    {
        $this->fullscreen = true;
    }

    /**
     * @param Material $model
     * @param $description_id
     * @param $keywords_id
     */
    protected function setMetaData($model, $description_id, $keywords_id) {
        $this->description = $model->getValue($description_id);
        $this->keywords = $model->getValue($keywords_id);
    }

    /**
     * @param $slug
     * @return Material|null
     * @throws NotFoundHttpException
     */
    protected function getPortfolioItem($slug)
    {
        $material = Material::findOne(['group_id' => 35, 'slug' => $slug]);
        if (!$material) {
            throw new NotFoundHttpException();
        }
        return $material;
    }

    /**
     * @param $slug
     * @return Material|null
     * @throws NotFoundHttpException
     */
    protected function getArticle($slug)
    {
        $material = Material::findOne(['group_id' => 61, 'slug' => $slug]);
        if (!$material) {
            throw new NotFoundHttpException();
        }
        return $material;
    }
}
