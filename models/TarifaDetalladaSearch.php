<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TarifaDetallada;

/**
 * TarifaDetalladaSearch represents the model behind the search form of `app\models\TarifaDetallada`.
 */
class TarifaDetalladaSearch extends TarifaDetallada
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tarifa', 'ninos', 'adultos'], 'integer'],
            [['precio'], 'number'],
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
        $query = TarifaDetallada::find();

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
            'id_tarifa' => $this->id_tarifa,
            'ninos' => $this->ninos,
            'adultos' => $this->adultos,
            'precio' => $this->precio,
        ]);

        return $dataProvider;
    }


    public function buscarPrecios($id)
    {			
        $query = TarifaDetallada::find()
            ->where(['id_tarifa'=>$id]);

        $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        return $dataProvider;
	}
}
