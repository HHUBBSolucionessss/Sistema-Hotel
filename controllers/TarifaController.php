<?php

namespace app\controllers;

use Yii;
use app\models\Tarifa;
use app\models\TarifaDetallada;
use app\models\TarifaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * TarifaController implements the CRUD actions for Tarifa model.
 */
class TarifaController extends Controller
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
     * Lists all Tarifa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TarifaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tarifa model.
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
     * Creates a new Tarifa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelTarifa = new Tarifa;
        $modelsTarifaDetallada = [new TarifaDetallada];
        if ($modelTarifa->load(Yii::$app->request->post()))
        {
            $modelTarifaDetallada = Model::createMultiple(TarifaDetallada::classname());
            Model::loadMultiple($modelTarifaDetallada, Yii::$app->request->post());
            // ajax validation
            if (Yii::$app->request->isAjax)
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelTarifaDetallada),
                    ActiveForm::validate($modelTarifa)
                );
            }
            // validate all models
            $valid = $modelTarifa->validate();
            //$modelTarifaDetallada->id_tarifa=0;
            $validacion=Model::validateMultiple($modelTarifaDetallada);
            //$valid =  $validacion && $valid;
            if ($valid)
            {
                $transaction = \Yii::$app->db->beginTransaction();
                try
                {
                    if ($flag = $modelTarifa->save(false))
                    {
                        foreach ($modelTarifaDetallada as $modelTarifaDetallada)
                        {
                            $modelTarifaDetallada->id_tarifa = $modelTarifa->id;
                            if (! ($flag = $modelTarifaDetallada->save(false)))
                            {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag)
                    {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelTarifa->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('_form', [
            'modelTarifa' => $modelTarifa,
            'modelTarifaDetallada' => (empty($modelTarifaDetallada)) ? [new TarifaDetallada] : $modelsTarifaDetallada
        ]);
    }


    /**
     * Updates an existing Tarifa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $tarifa = $this->findModel($id);
        $tarifasDetallada = $tarifa->detalleTarifa($tarifa->id);

        if ($tarifa->load(Yii::$app->request->post()))
        {

            $oldIDs = ArrayHelper::map($tarifasDetallada, 'id', 'id');
            $tarifasDetallada = Model::createMultiple(TarifaDetallada::classname(), $tarifasDetallada);
            Model::loadMultiple($tarifasDetallada, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($tarifasDetallada, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($tarifasDetallada),
                    ActiveForm::validate($tarifa)
                );
            }

            // validate all models
            $valid = $tarifa->validate();
            $valid = Model::validateMultiple($tarifasDetallada) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $tarifa->save()) {
                        if (! empty($deletedIDs)) {
                            TarifaDetallada::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($tarifasDetallada as $tarifaDetallada) {
                            $tarifaDetallada->id_tarifa = $tarifa->id;
                            if (! ($flag = $tarifaDetallada->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $tarifa->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'tarifa' => $tarifa,
            'tarifasDetallada' => (empty($tarifasDetallada)) ? [new TarifaDetallada] : $tarifasDetallada
        ]);











    }

    /**
     * Deletes an existing Tarifa model.
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
     * Finds the Tarifa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tarifa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tarifa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
