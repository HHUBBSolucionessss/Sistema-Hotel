<?php

namespace app\controllers;

use Yii;
use app\models\Habitacion;
use app\models\HabitacionSearch;
use app\models\RegistroSistema;

use app\models\Reservacion;
use app\models\ReservacionSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use yii\db\Expression;

/**
 * HabitacionController implements the CRUD actions for Habitacion model.
 */
class ReportesController extends Controller
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
     * Lists all Reportes models.
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
     * Lists all Reportes models.
     * @return mixed
     */
    public function actionTabla()
    {

      $searchModel = new ReservacionSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
/*
        $sql="SELECT * FROM reservacion";
        $date="SELECT * FROM reservacion WHERE fecha_entrada = '2018-08-01'";
        $date = Reservacion::$app->createCommand($date)->queryScalar();
        $dataProvider = new SqlDataProvider([
              'sql' => $sql,
              'db'=>'hotel',
              'totalCount' => $date,
              'pagination' => [
                 'pageSize' => 10,
              ],
          ]);*/

        return $this->render('tabla', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
}
