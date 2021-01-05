<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Casa;

/**
 * CasaSearch represents the model behind the search form about `app\models\Casa`.
 */
class CasaSearch extends Casa
{
    public function rules()
    {
        return [
            [['id', 'cant_cuartos', 'cant_baños', 'cant_pisos', 'cant_cocinas', 'garage', 'patio', 'jardin', 'cant_cuartos_climatizados', 'size', 'piscina', 'portal', 'sala', 'saleta', 'carposh', 'casa_independiente', 'apto_en_pasillo', 'apto_en_edificio', 'cuarto_desahogo', 'terraza', 'cuarto_estudio', 'balcon', 'telefono', 'calentadoor', 'sala_comedor', 'comedor'], 'integer'],
            [['tipo_construccion', 'fecha_construccion', 'servicios', 'otros_detalles', 'direccion', 'foto1', 'foto2'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Casa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cant_cuartos' => $this->cant_cuartos,
            'cant_baños' => $this->cant_baños,
            'cant_pisos' => $this->cant_pisos,
            'cant_cocinas' => $this->cant_cocinas,
            'garage' => $this->garage,
            'patio' => $this->patio,
            'jardin' => $this->jardin,
            'cant_cuartos_climatizados' => $this->cant_cuartos_climatizados,
            'size' => $this->size,
            'fecha_construccion' => $this->fecha_construccion,
            'piscina' => $this->piscina,
            'portal' => $this->portal,
            'sala' => $this->sala,
            'saleta' => $this->saleta,
            'carposh' => $this->carposh,
            'casa_independiente' => $this->casa_independiente,
            'apto_en_pasillo' => $this->apto_en_pasillo,
            'apto_en_edificio' => $this->apto_en_edificio,
            'cuarto_desahogo' => $this->cuarto_desahogo,
            'terraza' => $this->terraza,
            'cuarto_estudio' => $this->cuarto_estudio,
            'balcon' => $this->balcon,
            'telefono' => $this->telefono,
            'calentadoor' => $this->calentadoor,
            'sala_comedor' => $this->sala_comedor,
            'comedor' => $this->comedor,
        ]);

        $query->andFilterWhere(['like', 'tipo_construccion', $this->tipo_construccion])
            ->andFilterWhere(['like', 'servicios', $this->servicios])
            ->andFilterWhere(['like', 'otros_detalles', $this->otros_detalles])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'foto1', $this->foto1])
            ->andFilterWhere(['like', 'foto2', $this->foto2]);

        return $dataProvider;
    }
}
