<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id
 * @property string $username
 * @property string $nombre
 * @property string $password
 * @property string $email
 * @property int $status
 * @property string $create_time
 * @property string $update_time
 */
class Usuario extends \yii\db\ActiveRecord
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
            'username' => 'Username',
            'nombre' => 'Nombre',
            'password' => 'Password',
            'email' => 'Email',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
