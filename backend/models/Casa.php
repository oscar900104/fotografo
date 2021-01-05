<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "casa".
 *
 * @property integer $id
 * @property integer $cant_cuartos
 * @property integer $cant_baños
 * @property integer $cant_pisos
 * @property integer $cant_cocinas
 * @property integer $garage
 * @property integer $patio
 * @property integer $jardin
 * @property integer $cant_cuartos_climatizados
 * @property integer $size
 * @property string $tipo_construccion
 * @property string $fecha_construccion
 * @property integer $piscina
 * @property integer $portal
 * @property integer $sala
 * @property integer $saleta
 * @property integer $carposh
 * @property integer $casa_independiente
 * @property integer $apto_en_pasillo
 * @property integer $apto_en_edificio
 * @property integer $cuarto_desahogo
 * @property integer $terraza
 * @property integer $cuarto_estudio
 * @property integer $balcon
 * @property integer $telefono
 * @property integer $calentadoor
 * @property integer $sala_comedor
 * @property integer $comedor
 * @property string $servicios
 * @property string $otros_detalles
 * @property string $direccion
 * @property string $foto1
 * @property string $foto2
 */
class Casa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'casa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cant_cuartos', 'cant_baños', 'cant_pisos', 'cant_cocinas', 'garage', 'patio', 'jardin', 'cant_cuartos_climatizados', 'size', 'piscina', 'portal', 'sala', 'saleta', 'carposh', 'casa_independiente', 'apto_en_pasillo', 'apto_en_edificio', 'cuarto_desahogo', 'terraza', 'cuarto_estudio', 'balcon', 'telefono', 'calentadoor', 'sala_comedor', 'comedor'], 'integer'],
            [['fecha_construccion'], 'safe'],
            [['servicios', 'otros_detalles', 'direccion', 'foto1', 'foto2'], 'string'],
            [['tipo_construccion'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cant_cuartos' => 'Cant Cuartos',
            'cant_baños' => 'Cant Baños',
            'cant_pisos' => 'Cant Pisos',
            'cant_cocinas' => 'Cant Cocinas',
            'garage' => 'Garage',
            'patio' => 'Patio',
            'jardin' => 'Jardin',
            'cant_cuartos_climatizados' => 'Cant Cuartos Climatizados',
            'size' => 'Size',
            'tipo_construccion' => 'Tipo Construccion',
            'fecha_construccion' => 'Fecha Construccion',
            'piscina' => 'Piscina',
            'portal' => 'Portal',
            'sala' => 'Sala',
            'saleta' => 'Saleta',
            'carposh' => 'Carposh',
            'casa_independiente' => 'Casa Independiente',
            'apto_en_pasillo' => 'Apto En Pasillo',
            'apto_en_edificio' => 'Apto En Edificio',
            'cuarto_desahogo' => 'Cuarto Desahogo',
            'terraza' => 'Terraza',
            'cuarto_estudio' => 'Cuarto Estudio',
            'balcon' => 'Balcon',
            'telefono' => 'Telefono',
            'calentadoor' => 'Calentadoor',
            'sala_comedor' => 'Sala Comedor',
            'comedor' => 'Comedor',
            'servicios' => 'Servicios',
            'otros_detalles' => 'Otros Detalles',
            'direccion' => 'Direccion',
            'foto1' => 'Foto1',
            'foto2' => 'Foto2',
        ];
    }
}
