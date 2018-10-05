<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\models\Reservacion;
use app\models\PagoReservacion;


/**
* ReservacionSearch represents the model behind the search form of `app\models\Reservacion`.
 */
class ReservacionSearch extends Reservacion
{

	/**
	* @inheritdoc
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
	* @inheritdoc
	     */
	    public function scenarios()
	    {
		// 		bypass scenarios() implementation in the parent class
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
		$query = Reservacion::find();

		// 		add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
		            'query' => $query,
		        ]);

		$this->load($params);

		if (!$this->validate()) {
			// 			uncomment the following line if you do not want to return any records when validation fails
			            // 			$query->where('0=1');
			return $dataProvider;
		}

		// 		grid filtering conditions
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
		$query->andFilterWhere(['eliminado' => 0 ]);

		return $dataProvider;
	}

		/**
	* Creates data provider instance with search query applied
	     *
	     * @param array $params
	     *
	     * @return ActiveDataProvider
	     */
	    public function buscarPagos($id)
	    {
		$query = PagoReservacion::find()->where(['id_reservacion'=>$id]);
		$dataProvider = new ActiveDataProvider([
		            'query' => $query,
		        ]);

		if (!$this->validate()) {
			// 			uncomment the following line if you do not want to return any records when validation fails
			            // 			$query->where('0=1');
			return $dataProvider;
		}

		return $dataProvider;
	}



	/**
	* Creates data provider instance with search query applied
	     *
	     * @param array $params
	     *
	     * @return ActiveDataProvider
	     */
	    public function buscarDisponibles($fecha_entrada, $fecha_salida)
	    {
			$parametros=[':fecha_entrada'=>$fecha_entrada, ':fecha_salida'=>$fecha_salida];

			/*$count = Yii::$app->db->createCommand('SELECT id, descripcion, tipo_habitacion FROM habitacion WHERE id NOT IN (SELECT id_habitacion FROM reservacion WHERE (fecha_entrada BETWEEN :fecha_entrada AND :fecha_salida)  AND (fecha_salida BETWEEN :fecha_entrada AND :fecha_salida))',$parametros)
			->queryAll();
			*/
			$provider = new SqlDataProvider([
		    	        'sql' => 'SELECT id, descripcion, tipo_habitacion FROM habitacion WHERE id NOT IN (SELECT id_habitacion FROM reservacion WHERE (fecha_entrada BETWEEN :fecha_entrada AND :fecha_salida)  OR (fecha_salida BETWEEN :fecha_entrada AND :fecha_salida))',
		        	    'params' => [':fecha_entrada'=>$fecha_entrada, ':fecha_salida'=>$fecha_salida],
					]);
			$provider->pagination->pageSize = 10;
		return $provider;
	}



	public function buscarTarifas($fecha_inicio, $fecha_fin, $origen, $tipo, $personas)
    {
        $data=Yii::$app->db->createCommand('SELECT td.ninos,td.adultos,td.precio,t.id_origen,t.nombre,t.id_tipo_habitacion,t.fecha_ini,t.fecha_fin FROM tarifa  AS t INNER JOIN tarifa_detallada AS td ON (t.id=td.id_tarifa) WHERE ((:fecha_inicio BETWEEN t.fecha_ini AND t.fecha_fin)  OR (:fecha_fin BETWEEN t.fecha_ini AND t.fecha_fin)) AND (td.adultos=:personas AND t.id_origen=:origen AND t.id_tipo_habitacion=:tipo)')
           ->bindValue(':fecha_inicio', $fecha_inicio)
		   ->bindValue(':fecha_fin', $fecha_fin)
		   ->bindValue(':origen', $origen)
		   ->bindValue(':tipo', $tipo)
		   ->bindValue(':personas', $personas)
           ->queryAll();
        return $data;
	}


	/**
	* Creates data provider instance with search query applied
	     *
	     * @param array $params
	     *
	     * @return ActiveDataProvider
	     */
	    public function searchIn($params)
	    {
				// Consulta para el vencimiento de las entradas
		$query = Reservacion::find()->andWhere('status=2')->andWhere(['fecha_entrada'=>date('Y-m-d')]);

		// 		add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
		            'query' => $query,
		        ]);

		$this->load($params);

		if (!$this->validate()) {
			// 			uncomment the following line if you do not want to return any records when validation fails
			            // 			$query->where('0=1');
			return $dataProvider;
		}

		// 		grid filtering conditions
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
		        ]);

						$query->andFilterWhere(['eliminado' => 0 ]);

		return $dataProvider;
	}

	/**
	* Creates data provider instance with search query applied
	     *
	     * @param array $params
	     *
	     * @return ActiveDataProvider
	     */
	    public function searchOut($params)
	    {
				// Consulta para el vencimiento de las reservaciones
		$query = Reservacion::find()->andWhere('status!=0')->andWhere('status!=3')->andWhere('status!=4')->andWhere(['fecha_salida'=>date('Y-m-d')]);


		// 		add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
		            'query' => $query,
		        ]);

		$this->load($params);

		if (!$this->validate()) {
			// 			uncomment the following line if you do not want to return any records when validation fails
			            // 			$query->where('0=1');
			return $dataProvider;
		}

		// 		grid filtering conditions
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

		        ]);

						$query->andFilterWhere(['eliminado' => 0 ]);

		return $dataProvider;
	}
}
