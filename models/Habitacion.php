<?php

namespace app\models;
use app\models\TipoHabitacion;
use Yii;

/**
 * This is the model class for table "habitacion".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $tipo_habitacion
 * @property int $status
 * @property int $capacidad
 * @property int $create_user
 * @property string $create_time
 * @property int $update_user
 * @property string $update_time
 *
 * @property Reservacion[] $reservacions
 * @property Tarifa[] $tarifas
 */
class Habitacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'habitacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['tipo_habitacion','status', 'capacidad', 'create_user', 'update_user'],'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripción',
            'tipo_habitacion' => 'Tipo De Habitación',
            'status' => 'Estado', //Libre Ocupada
            'capacidad' => 'Capacidad',
            'create_user' => 'Registró',
            'create_time' => 'Fecha Creación',
            'update_user' => 'Update User',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservacions()
    {
        return $this->hasMany(Reservacion::className(), ['id_habitacion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarifas()
    {
        return $this->hasMany(Tarifa::className(), ['id_habitacion' => 'id']);
    }

    public function obtenerEstado($key)
    {
        switch ($key)
        {
            case 0:
                return 'Inactivo';
                break;
            case 1:
                return 'Activo';
                break;
            default:
                return 'Sin información';
                break;
        }
    }

    public function obtenerTipoHabitacion($id)
    {
        $model=TipoHabitacion::findOne($id);
        return $model->descripcion;
    }

    public function obtenerDescripcion($id)
    {
        $model=Habitacion::findOne($id);
        return $model->descripcion;

    }
    public function gettipoHabitacion()
    {
                return $this->obtenerTipoHabitacion($this->id);
    }



}
