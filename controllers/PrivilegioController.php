<?php

namespace app\controllers;

use Yii;
use app\models\Privilegio;
use app\models\Habitacion;
use app\models\PrivilegioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrivilegioController implements the CRUD actions for Privilegio model.
 */
class PrivilegioController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Privilegio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrivilegioSearch();

        $idHabitacion = new Habitacion();
        $idHabitacion->id;

        $objPHPExcel = new \PHPExcel();

        $sheet=0;

        $objPHPExcel->setActiveSheetIndex($sheet);
        $foos = [
                ['Habitacion'=>'3601',
                '08Ago'=>'Emmanuel Apodaca',
                '09Ago'=>'Emmanuel Apodaca',
                '10Ago'=>'Emmanuel Apodaca',
                '11Ago'=>'Emmanuel Apodaca',
                '12Ago'=>''],
                ['Habitacion'=>'3602',
                '08Ago'=>'Alejandra Correa',
                '09Ago'=>'Alejandra Correa',
                '10Ago'=>'',
                '11Ago'=>'',
                '12Ago'=>''],
        ];

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

        $objPHPExcel->getActiveSheet()->setTitle('Reservaciones')
         ->setCellValue('A1', 'Habitación')
         ->setCellValue('B1', '08 Ago')
         ->setCellValue('C1', '09 Ago')
         ->setCellValue('D1', '10 Ago')
         ->setCellValue('E1', '11 Ago')
         ->setCellValue('F1', '12 Ago');


         $row=2;

        foreach ($foos as $foo) {

          $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$foo['Habitacion']);
          $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$foo['08Ago']);
          $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$foo['09Ago']);
          $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$foo['10Ago']);
          $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$foo['11Ago']);
          $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$foo['12Ago']);
            $row++ ;
        }

        header('Content-Type: application/vnd.ms-excel');
        $filename = "MyExcelReport_".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');




        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Privilegio model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Privilegio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Privilegio();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Privilegio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $idPrivilegio = Yii::$app->db->createCommand('SELECT id FROM privilegio WHERE id_usuario='.$id)->queryOne();
        $model = $this->findModel($idPrivilegio);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['registrar-usuario/view', 'id' => $id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Privilegio model.
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
     * Finds the Privilegio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Privilegio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Privilegio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
