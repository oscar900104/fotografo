<?php

namespace backend\controllers;

use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller {

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
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UsuarioSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Usuario();
        $pass = (string) Yii::$app->request->post('Pass');
        $user = (string) Yii::$app->request->post('Name');
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        echo 'entro = ' . $user;
//        if ($model->load(Yii::$app->request->post())) {
//        $atributes = ['password' => [$pass], 'username' => [$user], 'email' => [""], 'created_at' => [new \DateTime()], 'updated_at' => [new \DateTime()]];
//        $model = \common\models\User::createUser($pass,$user,1,1);
         $model->password_hash=  \yii\helpers\Security::generatePasswordHash($pass);
         $model->auth_key =  \yii\helpers\Security::generateRandomKey();
         $model->password_reset_token=  \yii\helpers\Security::generateRandomKey() . '_' . time();
         $model->username=$user;
        if ($model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
             
        } else {
            echo 'No se pudo crear el usuario con nombre= ' . $user;
           return $this->render('create', [ 'model' => $model,]);
             
        }
//        } else {
//            return $this->render('create', [
//                        'model' => $model,
//            ]);
//        }
    }

    /**
     * Updates an existing Usuario model.
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
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
