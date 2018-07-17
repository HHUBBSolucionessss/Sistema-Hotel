<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tarifa_detallada".
 *
 * @property int $id
 * @property int $id_tarifa
 * @property int $ninos
 * @property int $adultos
 * @property string $precio
 *
 * @property Tarifa $tarifa
 */
class TarifaDetallada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tarifa_detallada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tarifa'], 'required'],
            [['id_tarifa', 'ninos', 'adultos'], 'integer'],
            [['precio'], 'number'],
            [['id_tarifa'], 'exist', 'skipOnError' => true, 'targetClass' => Tarifa::className(), 'targetAttribute' => ['id_tarifa' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tarifa' => 'Id Tarifa',
            'ninos' => 'Ninos',
            'adultos' => 'Adultos',
            'precio' => 'Precio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarifa()
    {
        return $this->hasOne(Tarifa::className(), ['id' => 'id_tarifa']);
    }
}
