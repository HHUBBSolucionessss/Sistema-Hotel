<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "caja".
 *
 * @property int $id
 * @property string $descripcion
 * @property string $efectivo
 * @property string $tarjeta
 * @property string $deposito
 * @property int $tipo_movimiento
 * @property int $tipo_pago
 * @property string $create_time
 * @property int $create_user
 */
class Caja extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'caja';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['efectivo', 'tarjeta', 'deposito'], 'number'],
            [['tipo_movimiento', 'tipo_pago', 'create_user'], 'integer'],
            [['create_time'], 'safe'],
            [['create_user'], 'required'],
            [['descripcion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'efectivo' => 'Efectivo',
            'tarjeta' => 'Tarjeta',
            'deposito' => 'Deposito',
            'tipo_movimiento' => 'Tipo Movimiento',
            'tipo_pago' => 'Tipo Pago',
            'create_time' => 'Create Time',
            'create_user' => 'Create User',
        ];
    }
}
