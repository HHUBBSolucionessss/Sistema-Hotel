<?php

namespace app\controllers;

use Yii;
use app\models\Huesped;
use app\models\HuespedSearch;
use app\models\RegistroSistema;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HuespedController implements the CRUD actions for Huesped model.
 */
class HuespedController extends Controller
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
     * Lists all Huesped models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HuespedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $id_current_user = Yii::$app->user->identity->id;
        $privilegio = Yii::$app->db->createCommand('SELECT * FROM privilegio WHERE id_usuario = '.$id_current_user)->queryAll();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'privilegio'=>$privilegio,
        ]);
    }

    /**
     * Displays a single Huesped model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $registroSistema= new RegistroSistema();
        if ($model->load(Yii::$app->request->post()))
        {
            $registroSistema->descripcion = Yii::$app->user->identity->nombre ." ha actualizado datos del huésped ". $model->nombre;
            $model->update_user=Yii::$app->user->identity->id;
            $model->update_time=date('Y-m-d H:i:s');

            $id_current_user = Yii::$app->user->identity->id;
            $privilegio = Yii::$app->db->createCommand('SELECT * FROM privilegio WHERE id_usuario = '.$id_current_user)->queryAll();

            if($privilegio[0]['modificar_huesped'] == 1){
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
            else{
              Yii::$app->session->setFlash('kv-detail-warning', 'No tienes los permisos para realizar esta acción');
              return $this->redirect(['view', 'id'=>$model->id]);
            }
        }
        else
        {
            return $this->render('view', ['model'=>$model]);

        }
    }

    /**
     * Creates a new Huesped model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $id_current_user = Yii::$app->user->identity->id;
        $privilegio = Yii::$app->db->createCommand('SELECT * FROM privilegio WHERE id_usuario = '.$id_current_user)->queryAll();

        if($privilegio[0]['crear_huesped'] == 1){
          $model = new Huesped();
          $registroSistema = new RegistroSistema();

          if ($model->load(Yii::$app->request->post())) {

            $model->create_user=Yii::$app->user->identity->id;
            $model->create_time=date('Y-m-d H:i:s');
            $registroSistema->descripcion = Yii::$app->user->identity->nombre ." ha registrado al huésped ". $model->nombre;

            if($model->save() && $registroSistema->save())
            {
              return $this->redirect(['view', 'id' => $model->id]);
            }
          }
        }
        else{
          return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Huesped model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionModal()
    {
        $model = new Huesped();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('modal', [
            'model' => $model,
        ]);
    }


    /**
     * Creates a new Huesped model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNuevo()
    {
        $model = new Huesped();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('nuevo', [
            'model' => $model,
        ]);
    }




    /**
     * Updates an existing Huesped model.
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
     * Deletes an existing Huesped model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
     public function actionDelete($id)
    {

      $model = $this->findModel($id);
      $id_current_user = Yii::$app->user->identity->id;
      $privilegio = Yii::$app->db->createCommand('SELECT * FROM privilegio WHERE id_usuario = '.$id_current_user)->queryAll();

      if($privilegio[0]['eliminar_huesped'] == 1){
        $registroSistema= new RegistroSistema();

        $model->eliminado = 1;
        $registroSistema->descripcion = Yii::$app->user->identity->nombre ." ha eliminado al huésped ". $model->nombre;

        if($model->save() && $registroSistema->save()){
          Yii::$app->session->setFlash('kv-detail-success', 'El huésped se ha eliminado correctamente');
          return $this->redirect(['index']);
        }
      }
      else{
        Yii::$app->session->setFlash('kv-detail-warning', 'No tienes los permisos para realizar esta acción');
        return $this->redirect(['view', 'id'=>$model->id]);
      }

    }

    /**
     * Finds the Huesped model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Huesped the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Huesped::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
