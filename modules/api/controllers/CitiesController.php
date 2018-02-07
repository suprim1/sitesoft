<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use app\modules\api\models\Cities;
use app\modules\api\models\Region;
use app\modules\api\models\Country;
use yii\filters\AccessControl;
use app\modules\comment\models\Comment;

class CitiesController extends Controller {

    public function actions() {
        parent::actions();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex() {
        $cities = Cities::getCities()->all();
        if (empty($cities)) {
            return Yii::$app->response->setStatusCode(400);
        }
        return $cities;
    }

    public function actionView(int $id) {

        $cities = (new Cities)->findOne($id);
        if (!$cities->id) {
            return Yii::$app->response->setStatusCode(400);
        }
        $country = (new Country)->findOne($cities['id_country']);
        $region = (new Region)->findOne($cities['id_region']);
        return [
            'id' => $cities->id,
            'name' => $cities->name,
            'country' => [
                'id' => $country->id,
                'name' => $country->name,
            ],
            'region' => [
                'id' => $region->id,
                'name' => $region->name,
            ],
        ];
    }

    public function actionUpdate(int $id) {
        $params = Yii::$app->request->post();
        $duble = Cities::findOne([
                    'name' => $params['name'],
                    'id_region' => $params['id_region'],
        ]);
        if (!$duble) {
            $model = Cities::findOne($id);
            $model->name = Comment::xss($params['name']);
            $model->id_country = Comment::xss($params['id_country']);
            $model->id_region = Comment::xss($params['id_region']);
            if ($model->save()) {
                return Cities::getCities($model->id)->one();
            }
        }
        return Yii::$app->response->setStatusCode(400);
    }

    public function actionCreate() {
        $post = Yii::$app->request->post();
        $duble = Cities::findOne([
                    'name' => $post['name'],
                    'id_region' => $post['id_region'],
        ]);
        if (!$duble) {
            $model = new Cities;
            if ($model->load($post, '') && $model->validate()) {
                Yii::$app->response->setStatusCode(201);
                $model->save(false);
                return Cities::getCities($model->id)->one();
            }
        }
        return Yii::$app->response->setStatusCode(204);
    }

    public function actionDelete(int $id) {
        $model = Cities::findOne($id);
        if ($model->delete()) {
            return $id;
        } else {
            return Yii::$app->response->setStatusCode(400);
        }
    }

}

?>
