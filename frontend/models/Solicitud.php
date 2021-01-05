<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "solicitud".
 *
 * @property integer $id
 * @property integer $id_persona
 * @property integer $estado
 * @property string $fecha_solicitud
 * @property string $fecha_realizacion
 * @property string $hora_realizacion
 * @property string $servicios
 * @property string $precio
 * @property string $lugar_realizacion
 * @property string 
 */
class Solicitud extends ActiveRecord {

    public $to_search;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'solicitud';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['id_persona', 'fecha_solicitud', 'fecha_realizacion', 'servicios', 'lugar_realizacion'], 'required'],
                [['id_persona', 'estado'], 'integer'],
                [['fecha_solicitud', 'fecha_realizacion'], 'string'],
                [['servicios', 'hora_realizacion'], 'string'],
                [['lugar_realizacion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'id_persona' => 'Cliente',
            'fecha_solicitud' => 'Fecha en que se solicitó',
            'fecha_realizacion' => 'Fecha para la realización',
            'hora_realizacion' => 'Hora de inicio',
            'servicios' => 'Servicios',
            'precio' => 'Precio (cuc)',
            'monto_inicial' => 'Pago anticipado (cuc)',
            'lugar_realizacion' => 'Lugar de realización',
            'to_search' => '',
        ];
    }

    public function toString() {
        if ($this->id) {
            $current = Persona::findOne(['id' => $this->id_persona]);
//        print_r("la persona");
//        print_r($this->fecha_realizacion);
//        die;
            return $current->nombre . " " . $current->apellidos . " " . $this->fecha_realizacion . " " . $this->hora_realizacion . " " . $this->lugar_realizacion . " " . $this->servicios . " " . $this->precio;
        }
    }

}
