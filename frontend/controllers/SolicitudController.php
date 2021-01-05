<?php

namespace frontend\controllers;

use frontend\models\Persona;
use frontend\models\Solicitud;
use frontend\models\SolicitudSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * SolicitudController implements the CRUD actions for Solicitud model.
 */
class SolicitudController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Solicitud models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SolicitudSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Solicitud model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $persona = Persona::findOne(['id' => $model->id_persona]);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'persona' => $persona
        ]);
    }

    /**
     * Creates a new Solicitud model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Solicitud;
        $persona = new Persona;
        $arrpost = Yii::$app->request->post();
        if (count($arrpost) > 0) {
            $persona->nombre = $arrpost['Persona']['nombre'];
            $persona->apellidos = $arrpost['Persona']['apellidos'];
            $persona->ci = $arrpost['Persona']['ci'];
            $persona->telefonos = $arrpost['Persona']['telefonos'];
            $persona->direccion = $arrpost['Persona']['direccion'];
            $arr = Persona::find()->orderBy(['id' => SORT_DESC])->where(['ci' => $persona->ci])->all();
            if (count($arr) == 0) {//No esta creado
                if ($persona->save()) {
                    $current = Persona::findOne(['ci' => $persona->ci]);
//                $current = $arr[count($arr) - 1];
//                    $current = $arr[0];
                    $model->id_persona = $current->id;
                    $model->fecha_realizacion = $arrpost["Solicitud"]["fecha_realizacion"];
                    $model->hora_realizacion = $arrpost["Solicitud"]["hora_realizacion"];
                    $model->monto_inicial = $arrpost["Solicitud"]["monto_inicial"];
                    $model->precio = $arrpost["Solicitud"]["precio"];
                    $model->fecha_solicitud = date("Y-m-d H:i:s");
                    $model->servicios = $arrpost["Solicitud"]["servicios"];
                    $model->lugar_realizacion = $arrpost["Solicitud"]["lugar_realizacion"];
                    $model->estado = 0;

                    if ($model->save()) {
                        return $this->redirect(["index"]);
                    } else {
                        echo "No salvo la solicitud ";
                    }
                }
//            }
                else {
                    echo "No cargo la persona";
//                print_r($arrpost['Persona']);
                }
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'persona' => $persona,
            ]);
        }
    }

    /**
     * Updates an existing Solicitud model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $persona = Persona::findOne(['id' => $model->id_persona]);
        $arrpost = Yii::$app->request->post();
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if (count($arrpost) > 0) {
            $persona->nombre = $arrpost['Persona']['nombre'];
            $persona->apellidos = $arrpost['Persona']['apellidos'];
            $persona->ci = $arrpost['Persona']['ci'];
            $persona->telefonos = $arrpost['Persona']['telefonos'];
            $persona->direccion = $arrpost['Persona']['direccion'];
            if ($persona->save()) {
                $arr = Persona::find()->all();
                $current = $arr[count($arr) - 1];
                $model->id_persona = $current->id;
                $model->fecha_realizacion = $arrpost["Solicitud"]["fecha_realizacion"];
                $model->hora_realizacion = $arrpost["Solicitud"]["hora_realizacion"];
                $model->monto_inicial = $arrpost["Solicitud"]["monto_inicial"];
                $model->precio = $arrpost["Solicitud"]["precio"];
                $model->fecha_solicitud = date("Y-m-d H:i:s");
                $model->servicios = $arrpost["Solicitud"]["servicios"];
                $model->lugar_realizacion = $arrpost["Solicitud"]["lugar_realizacion"];
                $model->estado = $arrpost["Solicitud"]["estado"];
                if ($model->save()) {
                    return $this->redirect(["index"]);
                } else {
                    echo "No salvo la solicitud ";
                }
            }
//            }
            else {
                echo "No cargo la persona";
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'persona' => $persona,
            ]);
        }
    }

    /**
     * Deletes an existing Solicitud model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $persona = Persona::findOne(['id' => $model->id_persona]);
        $persona->delete();
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Solicitud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Solicitud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Solicitud::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
