<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "huesped".
 *
 * @property int $id
 * @property string $nombre
 * @property string $email
 * @property string $calle
 * @property string $ciudad
 * @property string $colonia
 * @property string $estado
 * @property string $pais
 * @property string $cp
 * @property string $telefono
 * @property string $create_time
 * @property int $create_user
 * @property string $update_time
 * @property int $update_user
 *
 * @property Reservacion[] $reservacions
 */
class Huesped extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'huesped';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_user', 'update_user'], 'integer'],
            [['update_time'], 'safe'],
            [['nombre', 'email', 'calle', 'ciudad', 'colonia', 'estado', 'pais', 'cp', 'telefono', 'create_time'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'email' => 'Correo Electrónico',
            'calle' => 'Calle',
            'ciudad' => 'Ciudad',
            'colonia' => 'Colonia',
            'estado' => 'Estado',
            'pais' => 'País',
            'cp' => 'Código Postal',
            'telefono' => 'Teléfono',
            'create_time' => 'Fecha Creación',
            'create_user' => 'Creó',
            'update_time' => 'Actualizado',
            'update_user' => 'Actualizó',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservacions()
    {
        return $this->hasMany(Reservacion::className(), ['id_huesped' => 'id']);
    }

    public function obtenerNombre($id)
    {
        $model=Huesped::findOne($id);
        return $model->nombre;

    }
    public function obtenerTelefono($id)
    {
        $model=Huesped::findOne($id);
        return $model->telefono;

    }
}
