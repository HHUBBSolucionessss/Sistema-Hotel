<?php

namespace app\controllers;

use Yii;
use app\models\Habitacion;
use app\models\HabitacionSearch;
use app\models\RegistroSistema;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;


use yii\db\Expression;

/**
 * HabitacionController implements the CRUD actions for Habitacion model.
 */
class HabitacionController extends Controller
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
     * Lists all Habitacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HabitacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    /**
     * Displays a single Habitacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $registroSistema= new RegistroSistema();
        if ($model->load(Yii::$app->request->post()))
        {
            $registroSistema->descripcion = Yii::$app->user->identity->nombre ." ha actualizado la habitación ".$model->descripcion;
            $model->update_user=Yii::$app->user->identity->id;
            $model->update_time=date('Y-m-d H:i:s');

            if ($model->save() && $registroSistema->save())
            {
                Yii::$app->session->setFlash('kv-detail-success', 'La información se actualizó correctamente');
                return $this->redirect(['view', 'id'=>$model->id]);
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
     * Creates a new Habitacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Habitacion();
        $registroSistema = new RegistroSistema();

        if ($model->load(Yii::$app->request->post()))
        {

            $model->create_user=Yii::$app->user->identity->id;
            $model->create_time=date('Y-m-d H:i:s');
            $model->status=1;
            $registroSistema->descripcion = Yii::$app->user->identity->nombre ." ha registrado la habitación ".$model->descripcion;

            if ($model->save()&&$registroSistema->save())
                return $this->redirect(['view', 'id' => $model->id]);

        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Habitacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
   	{

   		$model = $this->findModel($id);
   		$registroSistema= new RegistroSistema();

      $model->eliminado = 1;
 			$registroSistema->descripcion = Yii::$app->user->identity->nombre ." ha eliminado la habitación ". $model->descripcion;

 			if($model->save() && $registroSistema->save()){
 				return $this->redirect(['index']);
 			}

   	}

    /**
     * Finds the Habitacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Habitacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Habitacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
