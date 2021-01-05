<?php

namespace backend\controllers;

use Yii;
use app\models\Casa;
use app\models\CasaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CasaController implements the CRUD actions for Casa model.
 */
class CasaController extends Controller {

    public function behaviors() {
        return [
//            'access' => [
//                'class' => VerbFilter::className(),
//                'rules' => [
//                    [
//                        'actions' => ['show_create', 'list', 'update', 'index', 'view', 'create', 'delete', 'load_excel', 'excel', 'findbyukjson', 'load'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ]
//                ],
//            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Casa models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CasaSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

//        return $this->render('gestionCasa', [
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Casa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Casa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Casa;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionShow_create() {
        return $this->render('create');
    }

    /**
     * Updates an existing Casa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Casa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionProvincia() {
        $rows = new \ArrayIterator();
        $rows->append("Pinar del Rio");
        $rows->append("Artemisa");
        $rows->append("La Habana");
        $rows->append("Mayabeque");
        $rows->append("Matanzas");
        $rows->append("Villaclara");
        $rows->append("Cien Fuegos");
        $rows->append("Las Tunas");
        $rows->append("Camaguey");
        $rows->append("Holguin");
        $rows->append("Granma");
        $rows->append("Santiago de Cuba");
        $rows->append("Guantanamo");
        $rows->append("Isla de la Juventud");

        $result['data'] = $rows;
        $rows = $result;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $rows;
    }

    /**
     * Finds the Casa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Casa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Casa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
