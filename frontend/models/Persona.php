<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellidos
 * @property string $telefonos
 * @property integer $ci
 * @property string $direccion
 * @property string $cumpleannos
 */
class Persona extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'persona';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['nombre', 'apellidos', 'telefonos', 'ci', 'direccion'], 'required'],
                [['ci'], 'integer'],
                [['cumpleannos'], 'safe'],
                [['nombre'], 'string', 'max' => 100],
                [['apellidos', 'telefonos'], 'string', 'max' => 150],
                [['direccion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'telefonos' => 'Teléfonos',
            'ci' => 'Ci',
            'direccion' => 'Dirección',
            'cumpleannos' => 'Cumpleaños',
        ];
    }

}
