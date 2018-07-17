<?php

namespace app\controllers;


use app\models\Huesped;
use Yii;
use app\models\Reservacion;
use app\models\Habitacion;
use app\models\Tarifa;
use app\models\Caja;
use app\models\RegistroSistema;
use app\models\TarifaDetallada;
use app\models\PagoReservacion;
use app\models\ReservacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;







/**
*ReservacionController implements the CRUD actions for Reservacion model.
*/


class ReservacionController extends Controller
{
	
	
	
	
	
	/**
	* @inheritdoc
		    */
	
	
	public function behaviors()
	{	
		return [
			'access' => 
			[
				'class' => AccessControl::className(),
				'only'=>['index','view','create','delete'],
				'rules' => 
				[
					[
						'allow' => true,
						'roles' => ['@'],   
					],
				],
			],
			'verbs' => 
			[
				'class' => VerbFilter::className(),
				'actions' => [
				'delete' => ['POST'],
				],	
			],
			[
				'class' =>  'yii\filters\ContentNegotiator',
				'only' => ['obtener-tarifa'],
				'formats' => [
					'application/json' => Response::FORMAT_JSON,
				],
				'languages' => [
					'es',
				],
			],
			[
				'class' =>  'yii\filters\ContentNegotiator',
				'only' => ['obtener-habitaciones'],
				'formats' => [
					'application/json' => Response::FORMAT_JSON,
				],
				'languages' => [
					'es',
				],
			],
		];
		
		
	}
	
	
	
	
	
	
	
	
	/**
* Lists all Reservacion models.
	* @return mixed
	*/
	
	
	public function actionIndex()
	{
		
		
		$searchModel = new ReservacionSearch();
		
		
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		
		return $this->render('index', [
		'searchModel' => $searchModel,
		'dataProvider' => $dataProvider,
		]);
		
		
	}
	
	
	
	
	
	
	
	
	
	/**
	* Displays a single Reservacion model.
	* @param integer $id
	* @return mixed
	*/
	
	
	public function actionView($id)
	{
		
		
		$searchModel = new ReservacionSearch();
		
		$dataProvider = $searchModel->buscarPagos(Yii::$app->request->queryParams);
		return $this->render('view', [
		'model' => $this->findModel($id),
		'dataProvider'=>$dataProvider
		]);
		
		
	}
	
	
	
	
	
	/**
	* Updates an existing Reservacion model.
		* If update is successful, the browser will be redirected to the 'view' page.
		* @param integer $id
		* @return mixed
		*/
	
	
	public function actionUpdate($id)
	{
		
		
		$model = $this->findModel($id);
	
		$habitacion=Habitacion::find()->where(['id' => $model->id_habitacion])->one();
		if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			return $this->redirect(['view', 'id' => $model->id]);	
		}
		
		
		return $this->render('update', [
		'model' => $model,
		'tipo_habitacion'=>$habitacion->tipo_habitacion,
		]);
		
		
	}
	
	
	
	
	
	
	
	
	
	/**
	* Deletes an existing Reservacion model.
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
	* Finds the Reservacion model based on its primary key value.
	* If the model is not found, a 404 HTTP exception will be thrown.
	* @param integer $id
	* @return Reservacion the loaded model
	* @throws NotFoundHttpException if the model cannot be found
	*/
	
	
	protected function findModel($id)
	{
		
		
		if (($model = Reservacion::findOne($id)) !== null) {
			
			
			return $model;
			
			
		}
		
		
		throw new NotFoundHttpException('The requested page does not exist.');
		
		
	}
	
	
	
	
	
	
	
	
	
	/**
	* Busca los nombres que contengan el parametro $nombre
		* @param string $nombre 
		* @return Arreglo codificado en JSON que contiene los nombres de huespedes que coincidan con la busqueda
		*/
	
	
	public function actionHuespedes($q = null, $id = null) 
	{
		
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = ['results' => ['id' => '', 'text' => '']];	
		if (!is_null($q)) 
		{			
			$query = new \yii\db\Query;		
			$query->select('id, nombre AS text')
			->from('huesped')
			->where(['like', 'nombre', $q])
			->limit(20);	
			$command = $query->createCommand();			
			$data = $command->queryAll();	
			$out['results'] = array_values($data);	
		}	
		elseif ($id > 0) 
		{	
			$out['results'] = ['id' => $id, 'text'=>Huesped::find($id)->nombre];	
		}
		
		
		return $out;
		
		
	}
	
	
	
	public function actionPagoReservacion($id)
	{
				
		$pagoReservacion = new PagoReservacion();				
		$caja= new Caja();				
		$registroSistema= new RegistroSistema();				
		$reservacion =  $this->findModel($id);				
		if ($pagoReservacion->load(Yii::$app->request->post())) 
		{						
			$pagoReservacion->id_reservacion=$id;						
			$pagoReservacion->create_user=1;			
			$pagoReservacion->create_time=date('Y-m-d H:i:s');
			$pagoReservacion->estado=1;
			//0			Cancelado 1 Activo 
			$caja->descripcion="PAGO A LA RESERVACION CON FOLIO ".$id;
			$caja->tipo_movimiento=0;
			//0			=>'Entrada' 1=>'Salida'
			$caja->efectivo=$pagoReservacion->efectivo;
			$caja->tarjeta=$pagoReservacion->tarjeta;
			$caja->deposito=$pagoReservacion->deposito;
			$caja->tipo_pago=$pagoReservacion->tipo_pago;
			$caja->create_user=1;
			$caja->create_time=date('Y-m-d H:i:s');
			$registroSistema->descripcion="EL USUARIO ". 1 ." HA REGISTRADO UN PAGO A LA RESERVACION CON FOLIO ". $id ." CON UN MONTO DE ".$pagoReservacion->total;
			$reservacion->saldo=$pagoReservacion->saldo;
			if ($reservacion->saldo==0) 
			{	
				$reservacion->estado_pago=1;	
			}
			else 
			{
				$reservacion->estado_pago=0;					
			}
			
			if ($pagoReservacion->save() && $caja->save() && $registroSistema->save() && $reservacion->save() )  
			{
				return $this->redirect(['view', 'id' => $pagoReservacion->id_reservacion]);	
			}
					
		}
		
		
		return $this->render('pago_reservacion', [
		'model' => $this->findModel($id),
		'pago'=>$pagoReservacion,
		]);
		
		
	}
	
	
	
	public function actionHabitaciones()
	{
		
		
		if (Yii::$app->request->post()) 
		{
			
			
			$searchModel = new ReservacionSearch();
			
			
			$dataProvider = $searchModel->buscarDisponibles(Yii::$app->request->post('fecha_entrada'),Yii::$app->request->post('fecha_salida'));
			return $this->renderAjax('_reservacion', [
			'dataProvider' => $dataProvider,
			'fecha_entrada'=>Yii::$app->request->post('fecha_entrada'),
			'fecha_salida'=>Yii::$app->request->post('fecha_salida'),
			'tipo_habitacion'=>Yii::$app->request->post('tipo_habitacion'),
			
			]);
			
			
		}
		
		
		
		
	}
	
	
	public function actionNueva()
	{
			
		$model = new Reservacion();	
		$tipo_habitacion;
		if ($model->load(Yii::$app->request->post())) 
		{
			$model->create_user=1;
			$model->status=1;
			$model->saldo=Yii::$app->request->post('total');
			$model->create_time=date('Y-m-d H:i:s');		
			$model->save();
			return $this->redirect([
				'pago-reservacion', 
				'id' => $model->id,
				'total'=>$model->total,]);
			
		}		
		else if (Yii::$app->request->post()) 
		{			
			$model->id_habitacion=Yii::$app->request->post('id_habitacion');			
			$model->fecha_entrada=Yii::$app->request->post('fecha_entrada');			
			$model->fecha_salida=Yii::$app->request->post('fecha_salida');			
			$tipo_habitacion=Yii::$app->request->post('tipo_habitacion');
		}
	
		return $this->render('_form', [
		'model' => $model,
		'tipo_habitacion'=>$tipo_habitacion,
		
		]);
		
		
		
	}
	
	
	
	
	/**
	* @param $id
	* @return array
	* @throws NotFoundHttpException
	*/
	public function actionObtenerTarifa()
	{		
		if(Yii::$app->request->post()) 
		{			
			$searchModel = new ReservacionSearch();			
			return Json::encode($searchModel->buscarTarifas(Yii::$app->request->post('fecha_entrada'),Yii::$app->request->post('fecha_salida'),Yii::$app->request->post('origen'),Yii::$app->request->post('tipo'),Yii::$app->request->post('personas')));			
		}	
	}

	public function actionHabitacionesDisponibles()
	{		
		if(Yii::$app->request->post()) 
		{			
			$habitaciones=Yii::$app->db->createCommand('SELECT id, descripcion, tipo_habitacion FROM habitacion WHERE id NOT IN (SELECT id_habitacion FROM reservacion WHERE (fecha_entrada BETWEEN :fecha_entrada AND :fecha_salida)  OR (fecha_salida BETWEEN :fecha_entrada AND :fecha_salida))')
			->bindValue(':fecha_entrada', Yii::$app->request->post('fecha_entrada'))
			->bindValue(':fecha_salida', Yii::$app->request->post('fecha_salida'))
			->queryAll();
			if(count($habitaciones)>0)
			{
				$tipoHabitacion= new Habitacion();
				foreach ($habitaciones as $habitacion)
				{
					$tipo=$tipoHabitacion->obtenerTipoHabitacion($habitacion['tipo_habitacion']);
					echo "<optgroup label=".$tipo.">";
					echo "<option value=".$habitacion["id"].">".$habitacion["descripcion"]."</option>";
					echo "</optgroup>";
				}	
			}
			else
			{
            	echo "<option>Habitaciones No Disponibles</option>";
        	}

		}	
	}
	
	
	
	
	
}


