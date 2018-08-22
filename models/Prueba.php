<?php

namespace app\models;
use yii\data\SqlDataProvider;

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
class Prueba extends \yii\db\ActiveRecord
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
            'id_habitacion' => 'Id Habitacion',
            'id_origen' => 'Id Origen',
            'id_huesped' => 'Id Huesped',
            'fecha_entrada' => 'Fecha Entrada',
            'fecha_salida' => 'Fecha Salida',
            'notas' => 'Notas',
            'adultos' => 'Adultos',
            'ninos' => 'Ninos',
            'noches' => 'Noches',
            'status' => 'Status',
            'estado_pago' => 'Estado Pago',
            'tipo' => 'Tipo',
            'saldo' => 'Saldo',
            'subtotal' => 'Subtotal',
            'descuento' => 'Descuento',
            'total' => 'Total',
            'create_time' => 'Create Time',
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

    public function getReservaciones(){

      /*$sel = Reservacion::find()
      ->where(['status'=>1])
      ->orWhere(['status'=>2])
      ->where(['between', 'fecha_entrada', "2018-08-01", "2018-08-17"])
      ->all();


      $sql = Habitacion::find('descripcion')
      ->where(['id'=>$sel->id])
      ->all();

      $fin = Huesped::find('nombre')
      ->where(['id'=>$sel->id_huesped]);

      // add conditions that should always apply here

      $dataProvider = new ActiveDataProvider([
          'query' => $query,
          'pagination' => [ 'pageSize' => 'all' ],
      ]);

      return $dataProvider;*/

      // Consulta de los datos de la reservación

        $sql = Yii::$app->db->createCommand('SELECT
          (SELECT descripcion FROM habitacion AS hab WHERE hab.id= r.id) as habitacion,
          (SELECT nombre FROM huesped AS h WHERE id =r.id_huesped) as huesped, r.fecha_entrada, r.fecha_salida
          FROM reservacion AS r WHERE (r.status=1 OR r.status=2)
          AND r.fecha_entrada BETWEEN :fecha_entrada AND :fecha_salida')
        ->bindValue(':fecha_entrada', '2018-08-01')
        ->bindValue(':fecha_salida', '2018-08-17')
        ->queryAll();

        return $sql->habitacion;

    }

}
