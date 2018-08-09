<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Huesped;

/**
 * HuespedSearch represents the model behind the search form of `app\models\Huesped`.
 */
class HuespedSearch extends Huesped
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_user', 'update_user'], 'integer'],
            [['nombre', 'email', 'calle', 'ciudad', 'colonia', 'estado', 'pais', 'cp', 'telefono', 'create_time', 'update_time'], 'safe'],
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
        $query = Huesped::find();

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
            'create_user' => $this->create_user,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'update_user' => $this->update_user,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'calle', $this->calle])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad])
            ->andFilterWhere(['like', 'colonia', $this->colonia])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'cp', $this->cp])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'create_user', $this->create_user])
            ->andFilterWhere(['like', 'create_time', $this->create_time])
            ->andFilterWhere(['like', 'update_user', $this->update_user])
            ->andFilterWhere(['like', 'update_time', $this->update_time]);

        return $dataProvider;
    }
}
