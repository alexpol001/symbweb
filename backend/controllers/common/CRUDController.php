<?
namespace backend\controllers\common;

use kartik\grid\EditableColumnAction;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

abstract class CRUDController extends AdminController
{
    protected $mainClass;
    protected $searchClass;
    protected $parentController;

    /**
     * @param int $parent
     * @return string
     */
    public function actionIndex($parent = 0)
    {
        $searchModel = new $this->searchClass();
        $searchModel->setParent($parent);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param null $parent
     * @param null $copy
     * @param null $tab
     * @return bool|string
     * @throws NotFoundHttpException
     */
    public function actionCreate($parent = null, $copy = null, $tab = null)
    {
        /** @var ActiveRecord $model */
        $model = new $this->mainClass();
        if ($copy && method_exists($model , 'setCopy')) {
            $model->setCopy($copy);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->successSave();
            return $this->checkSubmitType(Yii::$app->request->post(), $model);
        }
        if ($copy) {
            $model = $this->findModel($copy);
            $model->title .= ' - Копия';
        }
        return $this->render('create', [
            'model' => $model,
            'parent' => $parent ? $model->findParent($parent) : null,
            'parentController' => $this->parentController,
            'tab' => $tab,
        ]);
    }

    /**
     * @param $id
     * @param null $tab
     * @return bool|string
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id, $tab=null)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->successSave();
            return $this->checkSubmitType(Yii::$app->request->post(), $model);
        }

        return $this->render('update', [
            'model' => $model,
            'parentController' => $this->parentController,
            'tab' => $tab,
        ]);
    }

    /**
     * @param $id
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function delete($id)
    {
        $this->findModel($id)->delete();
    }

    /**
     * @param null $parent
     * @param null $tab
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionMultiDelete($parent=null, $tab = null)
    {
        $this->multiDelete();
        if ($parent) {
            return $this->redirect([$this->parentController.'/update', 'id' => $parent, 'tab' => $tab]);
        }
        return $this->redirect(['index']);
    }

    protected function multiDelete() {
        if($keyList = Yii::$app->request->post('keyList'))
        {
            $arrKey = explode(',', $keyList);
            foreach ($arrKey as $item) {
                $this->delete($item);
            }
        }
    }

    /**
     * @return array
     */
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'edit' => [
                'class' => EditableColumnAction::className(),
                'modelClass' => ($this->mainClass)::className(),
                'scenario' => ($this->mainClass)::SCENARIO_EDIT,
                'outputValue' => function ($model, $attribute, $key, $index) {
                    return $model->$attribute;
                },
                'outputMessage' => function($model, $attribute, $key, $index) {
                    return '';
                },
                'showModelErrors' => true,
                'errorOptions' => ['header' => ''],
            ]
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = ($this->mainClass)::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    /**
     * @param $post
     * @param $model
     * @return bool
     */
    protected function checkSubmitType($post, $model)
    {
        if (isset($post['save'])) {
            $this->submitSave($model, $post['tab']);
        }
        if (isset($post['save-close'])) {
            $this->submitSaveClose($model);
        }
        if (isset($post['save-create'])) {
            $this->submitSaveCreate($model);
        }
        if (isset($post['save-copy'])) {
            $this->submitSaveCopy($model);
        }
        return false;
    }

    /**
     * @param $model
     * @param $tab
     * @return \yii\web\Response
     */
    protected function submitSave($model, $tab) {
        return $this->redirect(['update', 'id' => $model->id, 'tab' => $tab ? $tab : null]);
    }

    /**
     * @param $model
     * @return \yii\web\Response
     */
    protected function submitSaveClose($model) {
        return $this->redirect(['index']);
    }

    /**
     * @param $model
     * @return \yii\web\Response
     */
    protected function submitSaveCreate($model) {
        return $this->redirect(['create']);
    }

    /**
     * @param $model
     * @return \yii\web\Response
     */
    protected function submitSaveCopy($model) {
        return $this->redirect(['create', 'copy' => $model->id]);
    }

    protected function successSave() {
        Yii::$app->session->setFlash('success', 'Элемент успешно сохранён');
    }
}
