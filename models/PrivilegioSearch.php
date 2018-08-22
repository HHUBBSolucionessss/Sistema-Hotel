<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Privilegio;

/**
 * PrivilegioSearch represents the model behind the search form of `app\models\Privilegio`.
 */
class PrivilegioSearch extends Privilegio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_usuario', 'crear_habitacion', 'modificar_habitacion', 'eliminar_habitacion', 'crear_tipo_habitacion', 'modificar_tipo_habitacion', 'eliminar_tipo_habitacion', 'movimientos_caja', 'apertura_caja', 'cierre_caja', 'crear_huesped', 'modificar_huesped', 'eliminar_huesped', 'crear_reservacion', 'modificar_reservacion', 'eliminar_reservacion', 'descuento', 'crear_tarifa', 'modificar_tarifa', 'eliminar_tarifa', 'crear_origen', 'modificar_origen', 'eliminar_origen', 'crear_usuario', 'modificar_usuario', 'eliminar_usuario', 'definir_privilegios'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Privilegio::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'crear_habitacion' => $this->crear_habitacion,
            'modificar_habitacion' => $this->modificar_habitacion,
            'eliminar_habitacion' => $this->eliminar_habitacion,
            'crear_tipo_habitacion' => $this->crear_tipo_habitacion,
            'modificar_tipo_habitacion' => $this->modificar_tipo_habitacion,
            'eliminar_tipo_habitacion' => $this->eliminar_tipo_habitacion,
            'movimientos_caja' => $this->movimientos_caja,
            'apertura_caja' => $this->apertura_caja,
            'cierre_caja' => $this->cierre_caja,
            'crear_huesped' => $this->crear_huesped,
            'modificar_huesped' => $this->modificar_huesped,
            'eliminar_huesped' => $this->eliminar_huesped,
            'crear_reservacion' => $this->crear_reservacion,
            'modificar_reservacion' => $this->modificar_reservacion,
            'eliminar_reservacion' => $this->eliminar_reservacion,
            'descuento' => $this->descuento,
            'crear_tarifa' => $this->crear_tarifa,
            'modificar_tarifa' => $this->modificar_tarifa,
            'eliminar_tarifa' => $this->eliminar_tarifa,
            'crear_origen' => $this->crear_origen,
            'modificar_origen' => $this->modificar_origen,
            'eliminar_origen' => $this->eliminar_origen,
            'crear_usuario' => $this->crear_usuario,
            'modificar_usuario' => $this->modificar_usuario,
            'eliminar_usuario' => $this->eliminar_usuario,
            'definir_privilegios' => $this->definir_privilegios,
        ]);

        return $dataProvider;
    }
}
