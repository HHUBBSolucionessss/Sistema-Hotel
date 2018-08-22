<?php

namespace app\controllers;

use Yii;
use app\models\Prueba;
use app\models\PruebaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PruebaController implements the CRUD actions for Prueba model.
 */
class PruebaController extends Controller
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
     * Lists all Prueba models.
     * @return mixed
     */
    public function actionIndex()
    {



              /* Error reporting
              error_reporting(E_ALL);
              ini_set('display_errors', TRUE);
              ini_set('display_startup_errors', TRUE);
              date_default_timezone_set('Europe/London');

              define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');


              // Create new PHPExcel object
              echo date('H:i:s') , " Create new PHPExcel object" , EOL;
              $objPHPExcel = new \PHPExcel();

              // Set document properties
              echo date('H:i:s') , " Set document properties" , EOL;
              $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
              							 ->setLastModifiedBy("Maarten Balliauw")
              							 ->setTitle("Office 2007 XLSX Test Document")
              							 ->setSubject("Office 2007 XLSX Test Document")
              							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
              							 ->setKeywords("office 2007 openxml php")
              							 ->setCategory("Test result file");


              // Add some data, we will use some formulas here
              echo date('H:i:s') , " Add some data" , EOL;
              $objPHPExcel->getActiveSheet()->setCellValue('A5', 'Sum:');

              $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Range #1')
                                            ->setCellValue('B2', 3)
                                            ->setCellValue('B3', 7)
                                            ->setCellValue('B4', 13)
                                            ->setCellValue('B5', '=SUM(B2:B4)');
              echo date('H:i:s') , " Sum of Range #1 is " ,
                                   $objPHPExcel->getActiveSheet()->getCell('B5')->getCalculatedValue() , EOL;

              $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Range #2')
                                            ->setCellValue('C2', 5)
                                            ->setCellValue('C3', 11)
                                            ->setCellValue('C4', 17)
                                            ->setCellValue('C5', '=SUM(C2:C4)');
              echo date('H:i:s') , " Sum of Range #2 is " ,
                                   $objPHPExcel->getActiveSheet()->getCell('C5')->getCalculatedValue() , EOL;

              $objPHPExcel->getActiveSheet()->setCellValue('A7', 'Total of both ranges:');
              $objPHPExcel->getActiveSheet()->setCellValue('B7', '=SUM(B5:C5)');
              echo date('H:i:s') , " Sum of both Ranges is " ,
                                   $objPHPExcel->getActiveSheet()->getCell('B7')->getCalculatedValue() , EOL;

              $objPHPExcel->getActiveSheet()->setCellValue('A8', 'Minimum of both ranges:');
              $objPHPExcel->getActiveSheet()->setCellValue('B8', '=MIN(B2:C4)');
              echo date('H:i:s') , " Minimum value in either Range is " ,
                                   $objPHPExcel->getActiveSheet()->getCell('B8')->getCalculatedValue() , EOL;

              $objPHPExcel->getActiveSheet()->setCellValue('A9', 'Maximum of both ranges:');
              $objPHPExcel->getActiveSheet()->setCellValue('B9', '=MAX(B2:C4)');
              echo date('H:i:s') , " Maximum value in either Range is " ,
                                   $objPHPExcel->getActiveSheet()->getCell('B9')->getCalculatedValue() , EOL;

              $objPHPExcel->getActiveSheet()->setCellValue('A10', 'Average of both ranges:');
              $objPHPExcel->getActiveSheet()->setCellValue('B10', '=AVERAGE(B2:C4)');
              echo date('H:i:s') , " Average value of both Ranges is " ,
                                   $objPHPExcel->getActiveSheet()->getCell('B10')->getCalculatedValue() , EOL;


              // Rename worksheet
              echo date('H:i:s') , " Rename worksheet" , EOL;
              $objPHPExcel->getActiveSheet()->setTitle('Formulas');


              // Set active sheet index to the first sheet, so Excel opens this as the first sheet
              $objPHPExcel->setActiveSheetIndex(0);


              // Save Excel 2007 file
              echo date('H:i:s') , " Write to Excel2007 format" , EOL;
              $callStartTime = microtime(true);

              $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

              //
              //  If we set Pre Calculated Formulas to true then PHPExcel will calculate all formulae in the
              //    workbook before saving. This adds time and memory overhead, and can cause some problems with formulae
              //    using functions or features (such as array formulae) that aren't yet supported by the calculation engine
              //  If the value is false (the default) for the Excel2007 Writer, then MS Excel (or the application used to
              //    open the file) will need to recalculate values itself to guarantee that the correct results are available.
              //
              //$objWriter->setPreCalculateFormulas(true);
              $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
              $callEndTime = microtime(true);
              $callTime = $callEndTime - $callStartTime;

              echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
              echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
              // Echo memory usage
              echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


              // Save Excel 95 file
              echo date('H:i:s') , " Write to Excel5 format" , EOL;
              $callStartTime = microtime(true);

              $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
              $objWriter->save(str_replace('.php', '.xls', __FILE__));
              $callEndTime = microtime(true);
              $callTime = $callEndTime - $callStartTime;

              echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
              echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
              // Echo memory usage
              echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


              // Echo memory peak usage
              echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

              // Echo done
              echo date('H:i:s') , " Done writing files" , EOL;
              echo 'Files have been created in ' , getcwd() , EOL;*/

        $searchModel = new PruebaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Consulta de los datos de la reservación

        $sql = Yii::$app->db->createCommand('SELECT
          (SELECT descripcion FROM habitacion AS hab WHERE hab.id= r.id) as habitacion,
          (SELECT nombre FROM huesped AS h WHERE id =r.id_huesped) as huesped, r.fecha_entrada, r.fecha_salida
          FROM reservacion AS r WHERE (r.status=1 OR r.status=2)
          AND r.fecha_entrada BETWEEN :fecha_entrada AND :fecha_salida')
        ->bindValue(':fecha_entrada', '2018-08-01')
        ->bindValue(':fecha_salida', '2018-08-17')
        ->queryAll();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sql' => $sql,
        ]);
    }

    /**
     * Displays a single Prueba model.
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
     * Creates a new Prueba model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Prueba();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Prueba model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Prueba model.
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
     * Finds the Prueba model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prueba the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prueba::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
