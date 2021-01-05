<?php

namespace frontend\controllers;

use common\models\LoginForm;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\Solicitud;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
//    public function behaviors() {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout', 'signup'],
//                'rules' => [
//                        [
//                        'actions' => ['signup'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                        [
//                        'actions' => ['logout','index'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                        [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                        [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['@', '1'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
//        if (\Yii::$app->user->isGuest) {
//            return $this->redirect(['login']);
//        } else {
        $arr = Solicitud::find()->all();
        $completas = 0;
        $vencidas = 0;
        $pendientes = 0;
        $cantProximas = 0;
        $enLaSemana = 0;
        $hoy = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
        $dias_atras = mktime(0, 0, 0, date("m"), date("d") - 10, date("Y"));
        $pasado_manana = mktime(0, 0, 0, date("m"), date("d") + 2, date("Y"));
        $L_precios = "";
        foreach ($arr as $arr) {
            $fecha = $arr->fecha_realizacion;

            $date_arr = date_parse_from_format("Y-n-j ", $fecha);
            $time_int = mktime(0, 0, 0, $date_arr['month'], $date_arr['day'] + 2, $date_arr['year']);
            $fecha_realizacion = mktime(0, 0, 0, $date_arr['month'], $date_arr['day'], $date_arr['year']);
            $dias = ($time_int - $pasado_manana) / (60 * 60 * 24);
            $cantidadHecha = ($hoy - $dias_atras) / (60 * 60 * 24);
            $L_precios = $L_precios . $arr->precio . ",";
            if ($dias <= 2 && $dias >= 0) {
                $cantProximas++;
            }
            if ($cantidadHecha <= 10 && $cantidadHecha >= 0) {
                $enLaSemana++;
            }
            if ($arr->estado == 1) {
                $completas++;
            }
            if ($arr->estado == 2) {
                $vencidas++;
            }
            if ($arr->estado == 0) {
                $pendientes++;
            }
            if ($fecha_realizacion < $hoy) {
                $arr->estado = 2;
                $arr->save();
                $vencidas++;
            }
        }

//die;
        return $this->render('index', [
                    'completas' => $completas,
                    'vencidas' => $vencidas,
                    'pendientes' => $pendientes,
                    'proximas' => $cantProximas,
                    'enLaSemana' => $enLaSemana,
                    'L_precios' => $L_precios,
        ]);
//        }
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionSignup() {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();
//            print_r("el modelo lo creo");
//            print_r($model);
//            die;
            if ($user) {
//                if (Yii::$app->getUser()->login($user)) {
                return $this->goHome();
//                }
            }
        } else {
//            print_r(Yii::$app->request->post());
//            print_r("el modelo no cargo");
//            die;
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
