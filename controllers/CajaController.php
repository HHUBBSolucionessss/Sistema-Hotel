<?php

namespace app\controllers;
use Yii;
use app\models\Reservacion;
use app\models\Caja;
use app\models\EstadoCaja;
use app\models\CajaSearch;
use app\models\Privilegio;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\RegistroSistema;
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
        $id_current_user = Yii::$app->user->identity->id;

        $privilegio = Yii::$app->db->createCommand('SELECT * FROM privilegio WHERE id_usuario = '.$id_current_user)->queryAll();
        $totalCaja = Yii::$app->db->createCommand('SELECT Sum(efectivo), Sum(tarjeta), Sum(deposito) FROM caja AS Caja')->queryAll();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $estado_caja = new EstadoCaja();
        $estado_caja = Yii::$app->db->createCommand('SELECT * FROM estado_caja WHERE id = 1')->queryAll();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'estado_caja' => $estado_caja,
            'totalCaja'=>$totalCaja,
            'privilegio'=>$privilegio,
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
        $id_current_user = Yii::$app->user->identity->id;
        $privilegio = Yii::$app->db->createCommand('SELECT * FROM privilegio WHERE id_usuario = '.$id_current_user)->queryAll();

        if($privilegio[0]['movimientos_caja'] == 1){

          $model = new Caja();
          $registroSistema= new RegistroSistema();
          if ($model->load(Yii::$app->request->post()))
          {
            $totalCaja = Yii::$app->db->createCommand('SELECT Sum(efectivo), Sum(tarjeta), Sum(deposito) FROM caja AS Caja')->queryAll();
            $model->create_user=Yii::$app->user->identity->id;
            $model->create_time=date('Y-m-d H:i:s');

            if($model->tipo_movimiento == 1){
              $model->efectivo=-($model->efectivo);
              $registroSistema->descripcion = Yii::$app->user->identity->nombre ." retiró $".-($model->efectivo). ' de la caja';
            }
            else{
              $model->efectivo= $model->efectivo;
              $registroSistema->descripcion = Yii::$app->user->identity->nombre ." ingresó $".$model->efectivo. ' a la caja';
            }

              if($model->save() && $registroSistema->save())
              {
                    $searchModel = new CajaSearch();
                    $estado_caja = Yii::$app->db->createCommand('SELECT * FROM estado_caja WHERE id = 1')->queryAll();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    return $this->redirect(['index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'estado_caja' => $estado_caja,
                        'totalCaja'=>$totalCaja,
                    ]]);
              }
            }
          }
          else{
            return $this->redirect(['index']);
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
        $id_current_user = Yii::$app->user->identity->id;
        $privilegio = Yii::$app->db->createCommand('SELECT * FROM privilegio WHERE id_usuario = '.$id_current_user)->queryAll();
        $totalCaja=Yii::$app->db->createCommand('SELECT Sum(efectivo), Sum(tarjeta), Sum(deposito) FROM caja AS Caja')->queryAll();

        if($privilegio[0]['apertura_caja'] == 1){
          $model = new Caja();
          $registroSistema= new RegistroSistema();

          if ($model->load(Yii::$app->request->post()))
          {
            $model->descripcion="Apertura de caja";
            $model->tipo_movimiento = 0;
            $model->create_user=Yii::$app->user->identity->id;
            $model->create_time=date('Y-m-d H:i:s');
            $sql = EstadoCaja::findOne(['id' => 1]);
            $sql->estado_caja = 1;
            $registroSistema->descripcion = Yii::$app->user->identity->nombre ." ha realizado una apertura de caja con $".$model->efectivo. ' de efectivo';

            if($model->save() && $sql->save() && $registroSistema->save())
            {
                $searchModel = new CajaSearch();
                $estado_caja = new EstadoCaja();
                $estado_caja = Yii::$app->db->createCommand('SELECT * FROM estado_caja WHERE id = 1')->queryAll();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                return $this->redirect(['index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'estado_caja' => $estado_caja,
                    'totalCaja'=>$totalCaja,

                ]]);
            }
          }
        }
        else {
          return $this->redirect(['index']);
        }
        return $this->renderAjax('apertura', [
            'model' => $model,
            'totalCaja'=>$totalCaja,
        ]);
    }


    /**
     * Cierre de Caja.
     * Al cerrar caja se agrega un momivimiento en caja y se imprime el corte.
     * @return mixed
     */
    public function actionCierre()
    {
        $id_current_user = Yii::$app->user->identity->id;
        $privilegio = Yii::$app->db->createCommand('SELECT * FROM privilegio WHERE id_usuario = '.$id_current_user)->queryAll();
        $totalCaja=Yii::$app->db->createCommand('SELECT Sum(efectivo), Sum(tarjeta), Sum(deposito) FROM caja AS Caja')->queryAll();

        if($privilegio[0]['cierre_caja'] == 1){
          $model = new Caja();
          $estado_caja = new EstadoCaja();
          $registroSistema= new RegistroSistema();

          if ($model->load(Yii::$app->request->post()))
            {
              $registroSistema->descripcion = Yii::$app->user->identity->nombre ." ha realizado un cierre de caja de $".$model->efectivo. ' de efectivo';
              $sql = EstadoCaja::findOne(['id' => 1]);
              $sql->estado_caja = 0;
              $model->descripcion="Cierre de caja";
              $model->tipo_movimiento=1;
              $model->efectivo=-($model->efectivo);
              $model->create_user=Yii::$app->user->identity->id;
              $model->create_time=date('Y-m-d H:i:s');

              if($model->save() && $sql->save() && $registroSistema->save())
              {
                  return $this->render('info');
              }
            }
          }
        else {
          return $this->redirect(['index']);
        }

        return $this->renderAjax('cierre', [
            'model' => $model,
            'totalCaja'=>$totalCaja,
            'estado_caja' => $estado_caja,
        ]);
    }

    public function actionInfo(){

      $totalCaja = Yii::$app->db->createCommand('SELECT Sum(efectivo), Sum(tarjeta), Sum(deposito) FROM caja AS Caja')->queryAll();
      $totalesRetirado = Yii::$app->db->createCommand('SELECT * FROM caja WHERE id=(SELECT MAX(id) FROM caja WHERE descripcion=\'Cierre de caja\')')->queryAll();
      $habitacionesRealizadas = Yii::$app->db->createCommand('SELECT COUNT(*) FROM reservacion WHERE create_time BETWEEN (SELECT MAX(create_time) FROM caja WHERE descripcion=\'Apertura de caja\') AND (SELECT MAX(create_time) FROM caja WHERE descripcion=\'Cierre de caja\')')->queryAll();
      $searchModel = new CajaSearch();
      $dataProvider = $searchModel->buscarMovimientosCierre(Yii::$app->request->queryParams);
      $content = $this->renderPartial('corteCaja',[
          'dataProvider' => $dataProvider,
          'totalesRetirados'=>$totalesRetirado,
          'totalCaja'=>$totalCaja,
          'numHabitaciones'=>$habitacionesRealizadas,
      ]);

      $pdf = new Pdf([
          'mode' => Pdf::MODE_CORE,
          'format' => Pdf::FORMAT_A4,
          'orientation' => Pdf::ORIENT_PORTRAIT,
          'destination' => Pdf::DEST_BROWSER,
          'content' => $content,
          'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
          'cssInline' => '.kv-heading-1{font-size:18px}',
          'options' => ['title' => 'Reporte Cierre'],
          'methods' => [
              'SetHeader'=>['Reporte de cierre de caja '. date('d-m-Y')],
              'SetFooter'=>['Página {PAGENO}'],
          ]
      ]);
      return $pdf->render();

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
