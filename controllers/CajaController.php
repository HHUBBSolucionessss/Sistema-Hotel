<?php

namespace app\controllers;
use Yii;
use app\models\Caja;
use app\models\EstadoCaja;
use app\models\CajaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CajaController implements the CRUD actions for Caja model.
 */
class CajaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Caja models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CajaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Caja model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Caja model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Caja();
        $model->create_user=Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Caja model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionApertura()
    {
        $model = new Caja();
        $estadoCaja= new EstadoCaja();
        if ($model->load(Yii::$app->request->post()))
        {
            $model->descripcion="Apertura de caja";
            $model->tipo_movimiento=0;	
			$model->create_user=Yii::$app->user->identity->id;
			$model->create_time=date('Y-m-d H:i:s');
            $estadoCaja=0;
            if($model->save())
            //if ($model->save()&&$estadoCaja->save())
            {
                $searchModel = new CajaSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
         
        }

        return $this->renderAjax('apertura', [
            'model' => $model,
        ]);
    }
    /**
     * Cierre de Caja.
     * Al cerrar caja se agrega un momivimiento en caja y se imprime el corte.
     * @return mixed
     */
    public function actionCierre()
    {
        $model = new Caja();
        $estadoCaja= new EstadoCaja();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->descripcion="Cierre de caja";
            $model->tipo_movimiento=1;	
			$model->efectivo=-($model->efectivo);
			$model->create_user=Yii::$app->user->identity->id;
            $model->create_time=date('Y-m-d H:i:s');
            $estadoCaja=1;
           if($model->save())
            // if ($model->save()&&$estadoCaja->save())
            {
                $searchModel = new CajaSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }       
        }

        return $this->renderAjax('cierre', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Caja model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->create_user=Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Caja model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Caja model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Caja the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Caja::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
