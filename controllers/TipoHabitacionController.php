<?php

namespace app\controllers;

use Yii;
use app\models\TipoHabitacion;
use app\models\TipoHabitacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\RegistroSistema;
use yii\filters\VerbFilter;

/**
 * TipoHabitacionController implements the CRUD actions for TipoHabitacion model.
 */
class TipoHabitacionController extends Controller
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
     * Lists all TipoHabitacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoHabitacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoHabitacion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $registroSistema= new RegistroSistema();
        if ($model->load(Yii::$app->request->post()))
        {
            $registroSistema->descripcion = Yii::$app->user->identity->nombre ." ha actualizado el tipo de habitación ".$model->descripcion;
            $model->update_user=Yii::$app->user->identity->id;
            $model->update_time=date('Y-m-d H:i:s');

            if ($model->save() && $registroSistema->save())
            {
                Yii::$app->session->setFlash('kv-detail-success', 'La información se actualizo correctamente');
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
     * Creates a new TipoHabitacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoHabitacion();
        $registroSistema = new RegistroSistema();
        if($model->load(Yii::$app->request->post())){
            $registroSistema->descripcion=Yii::$app->user->identity->nombre ." ha registrado el tipo de habitación ". $model->descripcion;
            $model->create_user=Yii::$app->user->identity->id;

            if ($model->save()&&$registroSistema->save()){
              return $this->redirect(['view', 'id' => $model->id]);
            }
      }

      return $this->renderAjax('create', [
          'model' => $model,
      ]);

    }



    /**
     * Deletes an existing TipoHabitacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionDelete($id)
    {

      $model = $this->findModel($id);
      $registroSistema= new RegistroSistema();

      $model->eliminado = 1;
      $registroSistema->descripcion = Yii::$app->user->identity->nombre ." ha eliminado el tipo de habitación ". $model->descripcion;
 
      if($model->save() && $registroSistema->save()){
        return $this->redirect(['index']);
      }

    }

    /**
     * Finds the TipoHabitacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoHabitacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TipoHabitacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
