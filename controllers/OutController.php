<?php
namespace app\controllers;

use app\models\Currency;
use yii\web\Controller;

class OutController extends Controller
{
    public $layout = 'master';

    public function actionIndex()
    {
        $dateObj = new \DateTime(null, new \DateTimeZone(ini_get('date.timezone')));
        $dateRequest = $dateObj->format('Y-m-d');

        $currencies = Currency::find()->where(['date_created' => $dateRequest])->all();
        if ($currencies) {
//            var_dump($currencies);die();
            return $this->render('index',['currencies' => $currencies]);
        } else {
            $soap = new \SoapClient('https://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL');
            $result = $soap->GetCursOnDateXML([
                'On_date' => $dateRequest,
            ]);
            $data = new \SimpleXMLElement($result->GetCursOnDateXMLResult->any);
//            var_dump($data);

            $currencies = [];
            foreach ($data->ValuteCursOnDate as $curs) {
                if ((string)$curs->Vcode === "840" || (string)$curs->Vcode === "978") {
                    $model = new Currency();
                    $model->vchcode = (string)$curs->VchCode;
                    $model->vcode = (string)$curs->Vcode;
                    $model->vcurs = (string)$curs->Vcurs;
                    $model->vnom = (string)$curs->Vnom;
                    $model->vname = (string)trim($curs->Vname);
                    $model->date_created = $dateRequest;
                    $model->save();
                    $currencies[] = $model;
                }
            }
            return $this->render('index',['currencies' => $currencies]);
        }
    }
}
