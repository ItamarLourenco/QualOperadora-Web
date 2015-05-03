<?php

namespace app\modules\api\controllers;

use app\models\Portabilidade;
use yii\web\Controller;
use yii\helpers\Json;

class PortabilidadeController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        \Yii::$app->response->format = 'json';
        $json = Json::getJson();

        if(Portabilidade::isSecury($json))
        {
            if(sizeof($json['phones']) > 0)
            {
                $portabilidade = new Portabilidade();
                $portabilidade->setTelefone($json['phones']);
                echo Json::encode($portabilidade->getPortabilidade());
            }
        }

        \Yii::$app->end();
    }


}
