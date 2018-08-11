<?php

namespace app\controllers;


use Yii;

use app\models\User;
use app\models\Privilegio;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\SignupForm;



/**
 * UserController implements the CRUD actions for User model.
 */

class RegistrarUsuarioController extends Controller
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
     * Lists all User models.
     * @return mixed
     */

	public function actionIndex()
	{

		$searchModel = new UsuarioSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
		'searchModel' => $searchModel,
		'dataProvider' => $dataProvider,
		]);

	}



	/**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */

	public function actionView($id)
	{

		$model = $this->findModel($id);

		$idUsuario = Yii::$app->db->createCommand('SELECT id FROM privilegio WHERE id_usuario='.$id)->queryOne();

		if ($model->load(Yii::$app->request->post()))
		{

			if ($model->save())
			{

				Yii::$app->session->setFlash('kv-detail-success', 'La información se actualizó correctamente');

				$content = $this->renderPartial('view',[

					'idUsuario' => $idUsuario,

				]);

				return $this->redirect(['view', 'id'=>$model->id,
				'idUsuario' => $idUsuario,
			]);

			}

			else
			{

				Yii::$app->session->setFlash('kv-detail-warning', 'Ha ocurrido un error al guardar la información');

				return $this->redirect(['view', 'id'=>$model->id]);


			}

		}

		else
		{

			return $this->render('view', ['model'=>$model]);


		}

	}

	/**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

	public function actionCreate()
	{

		$model = new SignupForm();
		$usuario = new User();
		$privilegio= new Privilegio();

		if ($model->load(Yii::$app->request->post()))
		{

			if ($model->signup())
			{

				$sql = User::findOne(['email' => $model->email]);

				$id = $sql->id;
				$privilegio->id_usuario = $id;
				$privilegio->crear_habitacion=1;
				$privilegio->modificar_habitacion=1;
				$privilegio->eliminar_habitacion=1;
				$privilegio->crear_tipo_habitacion=1;
				$privilegio->modificar_tipo_habitacion=1;
				$privilegio->eliminar_tipo_habitacion=1;
				$privilegio->movimientos_caja=1;
				$privilegio->apertura_caja=1;
				$privilegio->cierre_caja=1;
				$privilegio->crear_reservacion=1;
				$privilegio->modificar_reservacion=1;
				$privilegio->eliminar_reservacion=1;

				if($privilegio->save()){
					return $this->redirect(['index']);
				}

			}

		}

		return $this->renderAjax('create', [
		'model' => $model,
		]);



	}




	/**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

	public function actionUpdate($id)
	{

		$model = $this->findModel($id);

		//$model->create_user=Yii::$app->user->identity->id;

		if ($model->load(Yii::$app->request->post()) && $model->save()) {

			return $this->redirect(['index', 'id' => $model->id]);

		}


		return $this->render('update', [
		'model' => $model,
		]);

	}



	/**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

	protected function findModel($id)
	{

		if (($model = User::findOne($id)) !== null) {

			return $model;

		}


		throw new NotFoundHttpException('The requested page does not exist.');

	}

}
