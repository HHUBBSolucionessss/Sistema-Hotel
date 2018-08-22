<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prueba;

/**
 * PruebaSearch represents the model behind the search form of `app\models\Prueba`.
 */
class PruebaSearch extends Prueba
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_habitacion', 'id_origen', 'id_huesped', 'adultos', 'ninos', 'noches', 'status', 'estado_pago', 'tipo', 'create_user', 'update_user'], 'integer'],
            [['fecha_entrada', 'fecha_salida', 'notas', 'create_time', 'update_time'], 'safe'],
            [['saldo', 'subtotal', 'descuento', 'total'], 'number'],
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
        $query = Prueba::find();

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
            'id_habitacion' => $this->id_habitacion,
            'id_origen' => $this->id_origen,
            'id_huesped' => $this->id_huesped,
            'fecha_entrada' => $this->fecha_entrada,
            'fecha_salida' => $this->fecha_salida,
            'adultos' => $this->adultos,
            'ninos' => $this->ninos,
            'noches' => $this->noches,
            'status' => $this->status,
            'estado_pago' => $this->estado_pago,
            'tipo' => $this->tipo,
            'saldo' => $this->saldo,
            'subtotal' => $this->subtotal,
            'descuento' => $this->descuento,
            'total' => $this->total,
            'create_time' => $this->create_time,
            'create_user' => $this->create_user,
            'update_time' => $this->update_time,
            'update_user' => $this->update_user,
        ]);

        $query->andFilterWhere(['like', 'notas', $this->notas]);

        return $dataProvider;
    }



}
