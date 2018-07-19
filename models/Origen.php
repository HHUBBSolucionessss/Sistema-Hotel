<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "origen".
 *
 * @property int $id
 * @property string $nombre
 * @property string $create_time
 * @property int $create_user
 * @property string $update_time
 * @property int $update_user
 *
 * @property Reservacion[] $reservacions
 */
class Origen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'origen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['create_user', 'update_user'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
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
            'create_time' => 'Fecha Creación',
            'create_user' => 'Creado',
            'update_time' => 'Actualizado',
            'update_user' => 'Actualizó',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservacions()
    {
        return $this->hasMany(Reservacion::className(), ['id_origen' => 'id']);
    }

    public function obtenerOrigen($id)
    {
        $model=Origen::findOne($id);
        return $model->nombre;

    }
}
