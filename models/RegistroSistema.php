<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registro_sistema".
 *
 * @property int $id
 * @property string $descripcion
 * @property string $create_time
 */
class RegistroSistema extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registro_sistema';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time'], 'safe'],
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
            'descripcion' => 'Descripción de movimiento',
            'create_time' => 'Fecha Creación',
        ];
    }
}
