<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Solicitud;

/**
 * SolicitudSearch represents the model behind the search form about `frontend\models\Solicitud`.
 */
class SolicitudSearch extends Solicitud {

    public function rules() {
        return [
//                [['to_search'], 'string'],
                [['id', 'id_persona'], 'integer'],
                [['fecha_solicitud', 'fecha_realizacion', 'hora_realizacion', 'servicios', 'lugar_realizacion',], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = Solicitud::find();
        $query->orderBy(['id'=>SORT_DESC]);//Ultimas agregadas primero
        if (count($params) > 1) {
//            $query2 = Persona::find();
            $data = $params['SolicitudSearch']['to_search'];
//            $data = $params['SolicitudSearch']['servicios'];
//            $this->to_search=$data;
//            print_r($data);
//            $query  ->join("INNER JOIN", "persona", "persona.id = solicitud.id_persona and (nombre like'%$data%' or apellidos like'%$data%')")
//                    ->orFilterWhere(['like', 'fecha_realizacion', $data])
//                    ->orFilterWhere(['like', 'servicios', $data])
//                    ->orFilterWhere(['like', 'hora_realizacion', $data])
//                    ->orFilterWhere(['like', 'lugar_realizacion', $data]);
            $query->join("INNER JOIN", "persona", "persona.id = solicitud.id_persona and (nombre like'%$data%' or apellidos like'%$data%' or servicios like'%$data%' or lugar_realizacion like'%$data%' or hora_realizacion like'%$data%' or fecha_realizacion like'%$data%' or precio like'%$data%')");

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            return $dataProvider;
        }



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
//            'id' => $this->id,
//            'id_persona' => $this->id_persona,
            'fecha_solicitud' => $this->fecha_solicitud,
            'fecha_realizacion' => $this->fecha_realizacion,
            'hora_realizacion' => $this->hora_realizacion,
            'to_search' => $this->to_search,
        ]);


//        $query->andFilterWhere(['like', 'servicios', $this->servicios])
//        ->andFilterWhere(['like', 'lugar_realizacion', $this->lugar_realizacion]);


        return $dataProvider;
    }

}
