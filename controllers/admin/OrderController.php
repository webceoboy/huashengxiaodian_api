<?php

namespace app\controllers\admin;

use app\models\Order;
use app\models\OrderConsignForm;
use app\models\OrderItem;
use app\models\OrderSearch;
use app\models\UpdatePriceForm;
use app\services\ApiService;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionImg($id)
    {
        $item = OrderItem::findOne($id);
        $binary = Yii::$app->cache->getOrSet($item->image_url, function () use ($item) {
            return ApiService::img($item->image_url);
        }, 8640000);
        Yii::$app->response->content = $binary;
        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->send();
    }

    public function actionPrice()
    {
        if (Yii::$app->request->isPost) {
            $model = new UpdatePriceForm();
            $model->load(Yii::$app->request->getBodyParams());
            if ($model->validate()) {
                try {
                    $result = ApiService::updatePrice($model);
                } catch (\Throwable $exception) {
                    Yii::$app->session->addFlash('error', $exception->getMessage());
                }
                if (isset($result)) {
                    ApiService::updateOrder($model->id);
                    Yii::$app->session->addFlash('success', '修改价格成功');
                }

            } else {
                Yii::$app->session->addFlash('error', array_values($model->getFirstErrors())[0]);
            }
            return $this->redirect(['admin/order/view', 'id' => $model->id]);
        }
    }

    public function actionConsign()
    {
        if (Yii::$app->request->isPost) {
            $model = new OrderConsignForm();
            $model->load(Yii::$app->request->getBodyParams());
            if ($model->validate()) {
                try {
                    $result = ApiService::orderConsign($model);
                } catch (\Throwable $exception) {
                    Yii::$app->session->addFlash('error', $exception->getMessage());
                }
                if (isset($result)) {
                    ApiService::updateOrder($model->id);
                    Yii::$app->session->addFlash('success', '发货成功');
                }

            } else {
                Yii::$app->session->addFlash('error', array_values($model->getFirstErrors())[0]);
            }
            return $this->redirect(['admin/order/view', 'id' => $model->id]);
        }
    }
}
