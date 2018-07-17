<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "boveda".
 *
 * @property int $id
 * @property string $descripcion
 * @property string $efectivo
 * @property string $tarjeta
 * @property string $tipo_movimiento
 * @property string $tipo_pago
 * @property string $create_time
 * @property int $create_user
 */
class Boveda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'boveda';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'create_user'], 'integer'],
            [['efectivo', 'tarjeta', 'tipo_movimiento', 'tipo_pago'], 'number'],
            [['create_time'], 'safe'],
            [['descripcion'], 'string', 'max' => 45],
            [['id'], 'unique'],
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
            'tipo_movimiento' => 'Tipo Movimiento',
            'tipo_pago' => 'Tipo Pago',
            'create_time' => 'Create Time',
            'create_user' => 'Create User',
        ];
    }
}
