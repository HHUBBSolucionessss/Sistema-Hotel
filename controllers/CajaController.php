<?php

namespace app\controllers;
use Yii;
use app\models\Reservacion;
use app\models\Caja;
use app\models\EstadoCaja;
use app\models\CajaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

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

        $totalCaja=Yii::$app->db->createCommand('SELECT Sum(efectivo), sum(tarjeta), sum(deposito) FROM caja AS Caja');

        $efectivo = Caja::find()->sum('efectivo');
        $deposito = Caja::find()->sum('deposito');
        $tarjeta = Caja::find()->sum('tarjeta');

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
            'efectivo'=>$efectivo,
            'tarjeta'=>$tarjeta,
            'deposito'=>$deposito,
        ]);
    }

    /*
      ID => folio
      FECHA,
      DESCRIPCIÓN,
      TIPO MOVIMIENTO Y
      CREATE USER
    */

    /**
     * Cierre de Caja.
     * Al cerrar caja se agrega un momivimiento en caja y se imprime el corte.
     * @return mixed
     */
    public function actionCierre()
    {
        $model = new Caja();
        $estadoCaja = new EstadoCaja();

        $totalCaja = Yii::$app->db->createCommand('SELECT Sum(efectivo), sum(tarjeta), sum(deposito) FROM caja AS Caja');

        $efectivo = Caja::find()->sum('efectivo');
        $deposito = Caja::find()->sum('deposito');
        $tarjeta = Caja::find()->sum('tarjeta');

        $usoSql = Reservacion::find()
        ->where(['fecha_entrada' => '2018-08-04'])
        ->andWhere(['status' => 1])
        ->all();

        $uso = COUNT($usoSql);

        $terminadaSql = Reservacion::find()
        ->where(['fecha_entrada' => '2018-08-04'])
        ->andWhere(['status' => 0])
        ->all();

        $terminada = COUNT($terminadaSql);

        $creadaSql = Reservacion::find()
        ->where(['fecha_entrada' => '2018-08-04'])
        ->andWhere(['status' => 0])
        ->all();

        $creada = COUNT($creadaSql);

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

              $content = $this->renderPartial('corteCaja',[

                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'efectivo'=>$efectivo,
                'tarjeta'=>$tarjeta,
                'deposito'=>$deposito,
                'uso' => $uso,
                'terminada' => $terminada,
                'creada' => $creada,
              ]);
                // setup kartik\mpdf\Pdf component
              $pdf = new Pdf([
                  // set to use core fonts only
                  'mode' => Pdf::MODE_CORE,
                  // A4 paper format
                  'format' => Pdf::FORMAT_A4,
                  // portrait orientation
                  'orientation' => Pdf::ORIENT_PORTRAIT,
                  // stream to browser inline
                  'destination' => Pdf::DEST_BROWSER,
                  // your html content input
                  'content' => $content,
                  // format content from your own css file if needed or use the
                  // enhanced bootstrap css built by Krajee for mPDF formatting
                  'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                  // any css to be embedded if required
                  'cssInline' => '.kv-heading-1{font-size:18px}',
                   // set mPDF properties on the fly
                  'options' => ['title' => 'Reporte Cierre'],
                   // call mPDF methods on the fly
                  'methods' => [
                      'SetHeader'=>['Reporte de cierre de caja '. '04-08-2018'],
                      'SetFooter'=>['Página {PAGENO}'],
                  ]
              ]);
              return $pdf->render();
            }
        }

        return $this->renderAjax('cierre', [
            'model' => $model,
            'efectivo'=>$efectivo,
            'tarjeta'=>$tarjeta,
            'deposito'=>$deposito,
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
