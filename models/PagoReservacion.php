<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pago_reservacion".
 *
 * @property int $id
 * @property int $id_reservacion
 * @property string $efectivo
 * @property string $tarjeta
  * @property string $total
 * @property string $comision
 * @property string $deposito
 * @property int $tipo_pago
 * @property int $estado
 * @property string $create_time
 * @property int $create_user
 *
 * @property Reservacion $reservacion
 */
class PagoReservacion extends \yii\db\ActiveRecord
{
    public $total;
    public $saldo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pago_reservacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_reservacion', 'tipo_pago', 'create_time', 'create_user'], 'required'],
            [['id_reservacion', 'tipo_pago', 'estado', 'create_user'], 'integer'],
            [['efectivo', 'tarjeta', 'comision', 'deposito','total'], 'number'],
            [['create_time'], 'safe'],
            [['id_reservacion'], 'exist', 'skipOnError' => true, 'targetClass' => Reservacion::className(), 'targetAttribute' => ['id_reservacion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_reservacion' => 'Id Reservacion',
            'efectivo' => 'Efectivo',
            'tarjeta' => 'Tarjeta',
            'comision' => 'Comision',
            'deposito' => 'Deposito',
            'total' => 'Total',
            'tipo_pago' => 'Tipo Pago',
            'estado' => 'Estado',
            'create_time' => 'Create Time',
            'create_user' => 'Create User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservacion()
    {
        return $this->hasOne(Reservacion::className(), ['id' => 'id_reservacion']);
    }
}
