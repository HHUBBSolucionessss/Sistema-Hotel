<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Habitacion;

/**
 * HabitacionSearch represents the model behind the search form of `app\models\Habitacion`.
 */
class HabitacionSearch extends Habitacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo_habitacion', 'status', 'capacidad', 'create_user', 'update_user'], 'integer'],
            [['descripcion', 'create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Habitacion::find();

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
            'tipo_habitacion' => $this->tipo_habitacion,
            'status' => $this->status,
            'capacidad' => $this->capacidad,
            'create_user' => $this->create_user,
            'create_time' => $this->create_time,
            'update_user' => $this->update_user,
            'update_time' => $this->update_time,
            
        ]);

        $query->andFilterWhere(['eliminado' => 0 ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }





}
