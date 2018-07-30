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
}
