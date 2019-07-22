<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Market;
use app\models\Coupon;
use yii\data\ActiveDataProvider;
use yii\base\Model;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index', 'login', 'markets', 'coupons'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'markets', 'coupons'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login', 'index'],
                        'allow' => true,
                        'roles' => ['?'],
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
     * {@inheritdoc}
     */
    public function actions()
    {
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

    /**
     * Displays homepage->Login.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->actionLogin();
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            //return $this->goHome();
            return $this->actionMarkets();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays Markets page.
     *
     * @return
     */
    public function actionMarkets()
    {
        $markets = Market::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $markets,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('Markets', [ 
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays Coupons page.
     * @param string|NULL $market id of market.
     * @return  
     */
    public function actionCoupons($market = NULL)
    {
        $coupons = Coupon::find()->joinWith('market');
        $titleMarket = 'all';

        if(!is_null($market))
        {
            $coupons = $coupons->where('id_market = :id', [':id' => $market]);

            $titleMarket = Market::findOne(['id' => $market])->title;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $coupons,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
       
        return $this->render('Coupons', [ 
            'dataProvider' => $dataProvider,
            'titleMarket' => $titleMarket,
        ]);

    }
}
