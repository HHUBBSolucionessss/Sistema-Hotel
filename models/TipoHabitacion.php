<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_habitacion".
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property Tarifa[] $tarifas
 */
class TipoHabitacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_habitacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarifas()
    {
        return $this->hasMany(Tarifa::className(), ['id_tipo_habitacion' => 'id']);
    }
}
