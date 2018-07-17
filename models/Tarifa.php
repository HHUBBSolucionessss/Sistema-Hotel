<?php

namespace app\models;

use Yii;


/**
* This is the model class for table "tarifa".
 *
 * @property int $id
 * @property int $id_tipo_habitacion
 * @property int $id_origen
 * @property string $nombre
 * @property string $fecha_ini
 * @property string $fecha_fin
 * @property int $tipo
 * @property int $estado
 * @property int $create_user
 * @property string $create_time
 * @property int $update_user
 * @property string $update_time
 * @property TipoHabitacion $tipoHabitacion
 * @property Origen $origen
 * @property TarifaDetallada[] $tarifaDetalladas
 */


class Tarifa extends \yii\db\ActiveRecord
{
	
	public $createTimeRange;
	
	/**
	* @inheritdoc
	     */
	    public static function tableName()
	    {
		return 'tarifa';
	}
	
	
	/**
	* @inheritdoc
	     */
	    public function rules()
	    {
		return [
                    [['id_tipo_habitacion', 'id_origen'], 'required'],
		            [['id_tipo_habitacion', 'id_origen', 'estado', 'create_user', 'update_user'], 'integer'],
		            [['fecha_ini', 'fecha_fin', 'create_time', 'update_time'], 'safe'],
		            [['nombre'], 'string', 'max' => 45],
		            [['id_origen'], 'exist', 'skipOnError' => true, 'targetClass' => Origen::className(), 'targetAttribute' => ['id_origen' => 'id']],
		        ];
	}
	
	
	/**
	* @inheritdoc
	     */
	    public function attributeLabels()
	    {
		return [
		            'id' => 'ID',
		            'id_tipo_habitacion' => 'Tipo Habitación',
		            'id_origen' => 'Origen',
		            'nombre' => 'Nombre',
		            'fecha_ini' => 'Fecha Ini',
		            'fecha_fin' => 'Fecha Fin',
		            'estado' => 'Estado',
		            'create_user' => 'Create User',
		            'create_time' => 'Create Time',
		            'update_user' => 'Update User',
		            'update_time' => 'Update Time',
		        ];
	}
	
	
	/**
	* @return \yii\db\ActiveQuery
	     */
    public function getTipoHabitacion()
    {
        return $this->hasOne(TipoHabitacion::className(), ['id' => 'id_tipo_habitacion']);
    }
	
	
	/**
	* @return \yii\db\ActiveQuery
	     */
	    public function getOrigen()
	    {
		return $this->hasOne(Origen::className(), ['id' => 'id_origen']);
	}
	
	
	/**
	* @return \yii\db\ActiveQuery
	     */
	    public function getTarifaDetallada()
	    {
		return $this->hasMany(TarifaDetallada::className(), ['id_tarifa' => 'id']);
	}



	public function detalleTarifa($id)
    {
      $detalleTarifa = TarifaDetallada::find()->where(['id_tarifa' => $id])->all();
      return $detalleTarifa;
    }
	
	
	/**
	* Creates and populates a set of models.
	     *
	     * @param string $modelClass
	     * @param array $multipleModels
	     * @return array
	     */
	    public static function createMultiple($modelClass, $multipleModels = [], $data = null)
	    {
		$model    = new $modelClass;
		$formName = $model->formName();
		$post     = empty($data) ? Yii::$app->request->post($formName) : $data[$formName];
		$models   = [];
		
		if (! empty($multipleModels)) {
			$keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
			$multipleModels = array_combine($keys, $multipleModels);
		}
		
		if ($post && is_array($post)) {
			foreach ($post as $i => $item) {
				if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
					$models[] = $multipleModels[$item['id']];
				}
				else {
					$models[] = new $modelClass;
				}
			}
		}
		
		unset($model, $formName, $post);
		
		return $models;
	}
	
}
