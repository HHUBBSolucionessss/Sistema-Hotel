<?php

namespace app\models;


use Yii;



/**
 * This is the model class for table "reservacion".
 *
 * @property int $id
 * @property int $id_habitacion
 * @property int $id_origen
 * @property int $id_huesped
 * @property string $fecha_entrada
 * @property string $fecha_salida
 * @property string $notas
 * @property int $adultos
 * @property int $ninos
 * @property int $noches
 * @property int $status
 * @property int $estado_pago
 * @property int $tipo
 * @property string $saldo
 * @property string $subtotal
 * @property string $descuento
 * @property string $total
 * @property string $create_time
 * @property int $create_user
 * @property string $update_time
 * @property int $update_user
 *
 * @property PagoReservacion[] $pagoReservacions
 * @property Habitacion $habitacion
 * @property Huesped $huesped
 * @property Origen $origen
 */

class Reservacion extends \yii\db\ActiveRecord
{
	
	
	/**
     * {@inheritdoc}
     */
	
	public static function tableName()
	{
		
		return 'reservacion';
		
	}
	
	
	
	/**
     * {@inheritdoc}
     */
	
	public function rules()
	{
		
		return [
		[['id_habitacion', 'id_origen', 'id_huesped'], 'required'],
		[['id_habitacion', 'id_origen', 'id_huesped', 'adultos', 'ninos', 'noches', 'status', 'estado_pago', 'tipo', 'create_user', 'update_user'], 'integer'],
		[['fecha_entrada', 'fecha_salida', 'create_time', 'update_time'], 'safe'],
		[['saldo', 'subtotal', 'descuento', 'total'], 'number'],
		[['notas'], 'string', 'max' => 45],
		[['id_habitacion'], 'exist', 'skipOnError' => true, 'targetClass' => Habitacion::className(), 'targetAttribute' => ['id_habitacion' => 'id']],
		[['id_huesped'], 'exist', 'skipOnError' => true, 'targetClass' => Huesped::className(), 'targetAttribute' => ['id_huesped' => 'id']],
		[['id_origen'], 'exist', 'skipOnError' => true, 'targetClass' => Origen::className(), 'targetAttribute' => ['id_origen' => 'id']],
		];
		
	}
	
	
	
	/**
     * {@inheritdoc}
     */
	
	public function attributeLabels()
	{
		
		return [
		'id' => 'ID',
		'id_habitacion' => 'Habitación',
		'id_origen' => 'ID Origen',
		'id_huesped' => 'Huésped',
		'fecha_entrada' => 'Fecha Entrada',
		'fecha_salida' => 'Fecha Salida',
		'notas' => 'Notas',
		'adultos' => 'Adultos',
		'ninos' => 'Niños',
		'noches' => 'Noches',
		'status' => 'Estado',
		'estado_pago' => 'Estado Pago',
		'tipo' => 'Tipo',
		'saldo' => 'Saldo',
		'subtotal' => 'Subtotal',
		'descuento' => 'Descuento',
		'total' => 'Total',
		'create_time' => 'Fecha Creación',
		'create_user' => 'Create User',
		'update_time' => 'Update Time',
		'update_user' => 'Update User',
		];
		
	}
	
	
	
	/**
     * @return \yii\db\ActiveQuery
     */
	
	public function getPagoReservacions()
	{
		
		return $this->hasMany(PagoReservacion::className(), ['id_reservacion' => 'id']);
		
	}
	
	
	
	/**
     * @return \yii\db\ActiveQuery
     */
	
	public function getHabitacion()
	{
		
		return $this->hasOne(Habitacion::className(), ['id' => 'id_habitacion']);
		
	}
	
	
	
	/**
     * @return \yii\db\ActiveQuery
     */
	
	public function getHuesped()
	{
		
		return $this->hasOne(Huesped::className(), ['id' => 'id_huesped']);
		
	}
	
	
	
	/**
     * @return \yii\db\ActiveQuery
     */
	
	public function getOrigen()
	{
		
		return $this->hasOne(Origen::className(), ['id' => 'id_origen']);
		
	}
	
	
	public function obtenerDescuentos()
	{
		return [
		'0' => 'Sin Descuento',
		'1' => '5%',
		'2' => '10%',
		'3' => '15%',
		'4' => '20%',
		'5' => '50%',
		'6' => '100%',
		];	
	}
	

	
	public function obtenerComprobante($key)
	{
		switch ($key) {		
			case 0:
			return 'Remisión';
			break;
			case 1:
			return 'Factura';
			break;
			default:
			return 'Sin información';
			break;
		}
	}
	
	
	
	public function obtenerEstadoChekIn($key)
	{	
		switch ($key)
		{
			case 0:
			return 'Terminado';
			break;
			case 1:
			return 'Ocupada';
			break;
			case 2:
			return 'Pendiente';
			break;
			case 3:
			return 'No Show';
			break;			
			default:
			return 'Sin información';	
			break;
		}
	}
	
	
	

public function obtenerEstado($key)
  {
      switch ($key)
      {
          case 0:
              return 'Terminada';
              break;
          case 1:
              return 'Ocupada';
              break;
          case 2:
              return 'Pendiente';
              break;
          case 3:
              return 'No Show';
              break;
          case 3:
              return 'Cancelada';
              break;
          default:
              return 'Sin información';
              break;
      }
}


	public function estadosReservacion()
	{
		
		return $estados=[
		0 => 'Terminada',
		1 => 'Ocupada',
		2 => 'Pendiente',
        3 => 'No Show',
        4=>'Cancelada',
		
		];
			
	}
	
	
	public function obtenerDisponibles($fecha_entrada,$fecha_Salida)
	{
		$habitaciones=Yii::$app->db->createCommand('SELECT id, descripcion, tipo_habitacion FROM habitacion WHERE id NOT IN (SELECT id_habitacion FROM reservacion WHERE (fecha_entrada BETWEEN :fecha_entrada AND :fecha_salida)  OR (fecha_salida BETWEEN :fecha_entrada AND :fecha_salida))')
		->bindValue(':fecha_entrada', $fecha_entrada)
		->bindValue(':fecha_salida', $fecha_salida)
		->queryAl();
		
		return $habitaciones;
		
	}
	
	
	
	
	
	
	
	
}

