<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tarifa;

/**
 * TarifaSearch represents the model behind the search form of `app\models\Tarifa`.
 */
class TarifaSearch extends Tarifa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','id_tipo_habitacion', 'create_user', 'update_user','id_origen'], 'integer'],
            [['nombre', 'fecha_ini', 'fecha_fin', 'create_time', 'update_time'], 'safe'],
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
        $query = Tarifa::find();

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
            'fecha_ini' => $this->fecha_ini,
            'fecha_fin' => $this->fecha_fin,
            'id_tipo_habitacion'=>$this->id_tipo_habitacion,
            'id_origen'=>$this->id_origen,
            'create_user' => $this->create_user,
            'create_time' => $this->create_time,
            'update_user' => $this->update_user,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['eliminado' => 0 ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
