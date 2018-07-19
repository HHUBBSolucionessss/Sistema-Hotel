<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Registrar-Usuario".
 *
 * @property int $id
 * @property string $username
 * @property string $nombre
 * @property string $password
 * @property string $email
 * @property int $status
 * @property string $create_time
 * @property string $update_time
 *
 * @property Reservacion[] $reservacions
 */
class RegistrarUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['status'], 'integer'],
          [['create_time', 'update_time'], 'safe'],
          [['username', 'nombre', 'password', 'email'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
          'id' => 'ID',
          'username' => 'Apodo',
          'nombre' => 'Nombre',
          'password' => 'Contraseña',
          'email' => 'Correo Electrónico',
          'status' => 'Estado',
          'create_time' => 'Fecha Creación',
        ];
    }

}
