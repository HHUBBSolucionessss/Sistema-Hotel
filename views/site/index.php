<?php
use yii\helpers\Url;
use yii\helpers\Html;

use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\daterange\DateRangePicker;
use demogorgorn\ajax\AjaxSubmitButton;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;

use app\models\Habitacion;
use app\models\Huesped;
use app\models\Origen;
use app\models\Reservacion;
use app\models\RegistrarUsuario;

use kartik\dynagrid\DynaGrid;

/* @var $this yii\web\View */

$this->title = 'Sistema Hotel';
?>

<div class="site-index">
    <div class="jumbotron">
        <?= Html::a('Habitaciones', ['/habitacion/index'], ['class'=>'btn']) ?>
        <?= Html::a('Caja', ['/caja/index'], ['class'=>'btn']) ?>
        <?= Html::a('Huéspedes', ['/huesped/index'], ['class'=>'btn']) ?>
        <?= Html::a('Reservaciones', ['/reservacion/index'], ['class'=>'btn']) ?>
        <?= Html::a('Tarifas', ['/tarifa/index'], ['class'=>'btn']) ?>
        <?= Html::a('Orígenes', ['/origen/index'], ['class'=>'btn']) ?>
        <?= Html::a('Registro Sistema', ['site/registro'], ['class'=>'btn']) ?>
        <?= Html::a('Usuarios', ['/registrar-usuario/index'], ['class'=>'btn']) ?>
        <?= Html::a('Reportes', ['/reportes/index'], ['class'=>'btn']) ?>
    </div>
    <div class="body-content">

      <div class="col-md-12">
          <div class="panel panel-success">
              <?php
              $gridColumnsIn = [
                  ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
                  [
                      'attribute' => 'id',
                      'vAlign'=>'middle',
                      'headerOptions'=>['class'=>'kv-sticky-column'],
                      'contentOptions'=>['class'=>'kv-sticky-column'],
                  ],
                  [
                      'attribute'=>'id_habitacion',
                      'vAlign'=>'middle',
                      'value'=>function ($model, $key, $index, $widget) {
                          $habitacion= new Habitacion();
                          return $habitacion->obtenerDescripcion($model->id_habitacion);
                      },
                      'format'=>'raw'
                  ],
                  [
                      'attribute'=>'id_huesped',
                      'vAlign'=>'middle',
                      'value'=>function ($model, $key, $index, $widget) {
                          $huesped= new Huesped();
                          return $huesped->obtenerNombre($model->id_huesped);
                      },
                      'format'=>'raw'
                  ],
                  [
                      'attribute' => 'total',
                      'vAlign'=>'middle',
                      'headerOptions'=>['class'=>'kv-sticky-column'],
                      'contentOptions'=>['class'=>'kv-sticky-column'],
                  ],
                  [
                    'class' => 'kartik\grid\EditableColumn',
                     'attribute' => 'status',
                     'value'=>function ($model, $key, $index, $widget) {
                       return $model->obtenerEstado($model->status);
                     },
                     'filterType'=>GridView::FILTER_SELECT2,
                     'filter'=> ['2' => 'Pendiente', '1' => 'Ocupada', '3' => 'No Show'],
                     'filterWidgetOptions'=>[
                         'pluginOptions'=>['allowClear'=>true],
                     ],
                     'filterInputOptions'=>['placeholder'=>'Estado ...'],
                     'format'=>'raw',
                     'editableOptions' => [
                             'header' => 'estado',
                             'size' => 'sm',
                             'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                             'data'=>['1'=>'Ocupada','3'=>'No Show']
                         ],

                  ],
                  [
                      'class'=>'kartik\grid\ActionColumn',
                      'dropdown'=>false,
                      'order'=>DynaGrid::ORDER_FIX_RIGHT
                  ],
                  ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
              ];

              echo DynaGrid::widget([
                'columns'=>$gridColumnsIn,
                'storage'=>DynaGrid::TYPE_COOKIE,
                'theme'=>'panel-success',
                'gridOptions'=>[
                    'dataProvider'=>$dataIn,
                    'filterModel'=>$searchModelIn,
                    'panel'=>['heading'=>'<h3 class="panel-title">Check In</h3>'],
                ],
                'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
              ]);
                ?>
          </div>
      </div>

      <div class="col-md-12">
          <div class="panel panel-success">
              <?php
              $gridColumnsOut = [
                  ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
                  [
                      'attribute' => 'id',
                      'vAlign'=>'middle',
                      'headerOptions'=>['class'=>'kv-sticky-column'],
                      'contentOptions'=>['class'=>'kv-sticky-column'],
                  ],
                  [
                      'attribute'=>'id_habitacion',
                      'vAlign'=>'middle',
                      'value'=>function ($model, $key, $index, $widget) {
                          $habitacion= new Habitacion();
                          return $habitacion->obtenerDescripcion($model->id_habitacion);
                      },
                      'format'=>'raw'
                  ],
                  [
                      'attribute'=>'id_huesped',
                      'vAlign'=>'middle',
                      'value'=>function ($model, $key, $index, $widget) {
                          $huesped= new Huesped();
                          return $huesped->obtenerNombre($model->id_huesped);
                      },
                      'format'=>'raw'
                  ],
                  [
                      'attribute' => 'total',
                      'vAlign'=>'middle',
                      'headerOptions'=>['class'=>'kv-sticky-column'],
                      'contentOptions'=>['class'=>'kv-sticky-column'],
                  ],
                  [
                      'attribute'=>'id_origen',
                      'vAlign'=>'middle',
                      'value'=>function ($model, $key, $index, $widget) {
                          $origen=new Origen();
                          return $origen->obtenerOrigen($model->id_origen);
                      },
                      'filterType'=>GridView::FILTER_SELECT2,
                      'filter'=>ArrayHelper::map(Origen::find()->all(), 'id', 'nombre'),
                      'filterWidgetOptions'=>[
                          'pluginOptions'=>['allowClear'=>true],
                      ],
                      'filterInputOptions'=>['placeholder'=>'Origen...'],
                      'format'=>'raw'
                  ],
                  [
                    'class' => 'kartik\grid\EditableColumn',
                     'attribute' => 'status',
                     'value'=>function ($model, $key, $index, $widget) {
                       return $model->obtenerEstado($model->status);
                     },
                     'filterType'=>GridView::FILTER_SELECT2,
                     'filter'=> ['2' => 'Pendiente', '1' => 'Ocupada', '3' => 'No Show'],
                     'filterWidgetOptions'=>[
                         'pluginOptions'=>['allowClear'=>true],
                     ],
                     'filterInputOptions'=>['placeholder'=>'Estado ...'],
                     'format'=>'raw',
                     'editableOptions' => [
                             'header' => 'estado',
                             'size' => 'sm',
                             'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                             'data'=>['1'=>'Ocupada','3'=>'No Show']
                         ],

                  ],
                  [
                      'class'=>'kartik\grid\ActionColumn',
                      'dropdown'=>false,
                      'order'=>DynaGrid::ORDER_FIX_RIGHT
                  ],
                  ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
              ];

              echo DynaGrid::widget([
                'columns'=>$gridColumnsOut,
                'moduleId' => 'dynagridCustom', // change the module identifier to use the respective module's settings
                'storage'=>DynaGrid::TYPE_COOKIE,
                'theme'=>'panel-danger',
                'gridOptions'=>[
                    'dataProvider'=>$dataOut,
                    'filterModel'=>$searchModelOut,
                    'panel'=>['heading'=>'<h3 class="panel-title">Check Out</h3>'],
                ],
                'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
              ]);
                ?>
          </div>
      </div>

        <div class="col-md-12">
            <div class="panel panel-danger">
            <div class="panel-heading">Check Out</div>
                <?php Pjax::begin(); ?>
                <?php
                $gridColumnsOut = [
                    ['class' => 'kartik\grid\SerialColumn'],
                    [
                        'attribute' => 'id',
                        'vAlign'=>'middle',
                        'headerOptions'=>['class'=>'kv-sticky-column'],
                        'contentOptions'=>['class'=>'kv-sticky-column'],
                    ],
                    [
                        'attribute'=>'id_habitacion',
                        'vAlign'=>'middle',
                        'value'=>function ($model, $key, $index, $widget) {
                            $habitacion= new Habitacion();
                            return $habitacion->obtenerDescripcion($model->id_habitacion);
                        },
                        'format'=>'raw'
                    ],
                    [
                        'attribute'=>'id_huesped',
                        'vAlign'=>'middle',
                        'value'=>function ($model, $key, $index, $widget) {
                            $huesped= new Huesped();
                            return $huesped->obtenerNombre($model->id_huesped);
                        },
                        'format'=>'raw'
                    ],
                    [
                        'attribute' => 'total',
                        'vAlign'=>'middle',
                        'headerOptions'=>['class'=>'kv-sticky-column'],
                        'contentOptions'=>['class'=>'kv-sticky-column'],
                    ],
                    [
                        'attribute'=>'id_origen',
                        'vAlign'=>'middle',
                        'value'=>function ($model, $key, $index, $widget) {
                            $origen=new Origen();
                            return $origen->obtenerOrigen($model->id_origen);
                        },
                        'filterType'=>GridView::FILTER_SELECT2,
                        'filter'=>ArrayHelper::map(Origen::find()->all(), 'id', 'nombre'),
                        'filterWidgetOptions'=>[
                            'pluginOptions'=>['allowClear'=>true],
                        ],
                        'filterInputOptions'=>['placeholder'=>'Origen...'],
                        'format'=>'raw'
                    ],
                    [
                      'class' => 'kartik\grid\EditableColumn',
                       'attribute' => 'status',
                       'value'=>function ($model, $key, $index, $widget) {
                         return $model->obtenerEstado($model->status);
                       },
                       'filterType'=>GridView::FILTER_SELECT2,
                       'filter'=> ['1' => 'Ocupada', '0' => 'Terminado'],
                       'filterWidgetOptions'=>[
                           'pluginOptions'=>['allowClear'=>true],
                       ],
                       'filterInputOptions'=>['placeholder'=>'Estado ...'],
                       'format'=>'raw',
                       'editableOptions' => [
                               'header' => 'estado',
                               'size' => 'sm',
                               'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                               'data'=>['1' => 'Ocupada', '0' => 'Terminado']
                           ],

                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'template'=>'{view}',
                        'vAlign'=>'middle',

                    ],
                ];

                echo GridView::widget([
                    'dataProvider' => $dataOut,
                    'filterModel' => $searchModelOut,
                    'columns' => $gridColumnsOut,
                    'containerOptions' => ['style'=>'overflow: false'], // only set when $responsive = false
                    'beforeHeader'=>[
                        [
                            'options'=>['class'=>'skip-export'] // remove this row from export
                        ]
                    ],
                    'toolbar' =>  [

                    ],
                    'pjax' => true,
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => false,
                    'responsive' => true,
                    'hover' => true,
                    //'floatHeader' => false,
                    'showPageSummary' => true,
                    'panel' => [
                        //'type' => GridView::TYPE_PRIMARY
                    ],
                ]);
            ?>
        <?php Pjax::end(); ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-warning">
            <div class="panel-heading">Buscar Disponibilidad</div>
            <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
                    <?php
                        echo DatePicker::widget([
                            'name' => 'fecha_entrada',
                            'value' => date('Y-m-d'),
                            'type' => DatePicker::TYPE_RANGE,
                            'name2' => 'fecha_salida',
                            'value2' => date('Y-m-d',strtotime("+1 days")),
                            'pluginOptions' => [
                                'todayHighlight' => true,
                                'todayBtn' => true,
                                'format' => 'yyyy-mm-d',
                                'autoclose'=>true,
                            ]
                        ]);
                    ?>

              <br>  <?php AjaxSubmitButton::begin([
                'label' => 'Comprobar',
                'ajaxOptions' => [
                    'type'=>'POST',
                    'url'=>\yii\helpers\Url::to(['reservacion/habitaciones']),
                    'success' => new \yii\web\JsExpression('function(html){
                        $("#output").html("");
                        $("#output").html(html);
                        }'),
                ],
                'options' => ['class' => 'customclass', 'type' => 'submit', 'class' => 'btn btn-success', 'id' => 'modalButton'],
                ]);
                AjaxSubmitButton::end();
            ?>
          </br>

           <?php ActiveForm::end(); ?>

            <div id="output"></div>
            </div>

            </div>
        </div>
    </div>
</div>
