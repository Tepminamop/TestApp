<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UrlForm;
use app\models\Url;
use app\models\Check;
use Codeception\Lib\Interfaces\ActiveRecord;

class SiteController extends Controller
{
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new UrlForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $add = new Url();
            $add->url = $model->url;
            $add->frequency = $model->frequency;
            $add->current_time = 1;
            $add->current_count = 0;
            $add->count = $model->count;
            $add->save();

            return $this->render('index', ['model' => $model]);
        } else {
            return $this->render('index', ['model' => $model]);
        }
    }

    /**
     * Displays admin page.
     *
     * @return string
     */
    public function actionAdmin()
    {
        $urls = Url::find()
            ->asArray()
            ->all();
        $checks = Check::find()
            ->asArray()
            ->all();
        return $this->render('admin', ['urls' => $urls, 'checks' => $checks]);
    }
}
