<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Origen;

/**
 * OrigenSearch represents the model behind the search form of `app\models\Origen`.
 */
class OrigenSearch extends Origen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_user', 'update_user'], 'integer'],
            [['nombre', 'create_time', 'update_time'], 'safe'],
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
        $query = Origen::find();

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
            'create_time' => $this->create_time,
            'create_user' => $this->create_user,
            'update_time' => $this->update_time,
            'update_user' => $this->update_user,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        $query->andFilterWhere(['eliminado' => 0 ]);

        return $dataProvider;
    }
}
