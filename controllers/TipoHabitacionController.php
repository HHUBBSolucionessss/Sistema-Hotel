<?php

namespace app\controllers;

use Yii;
use app\models\TipoHabitacion;
use app\models\TipoHabitacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
