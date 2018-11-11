<?php
namespace app\widgets;

class Currency
{
    public function _is_curl_installed() {
        if  (in_array  ('curl', get_loaded_extensions())) {
            return true;
        }
        else {
            return false;
        }
    }
    public function getKurs() {
        //проверить на актиность сайта, действует или нет, в ином случае использовать старые данные временно
        //а потом сменить сайт, но перед должно быть сообщение об ошибки по почте
        $json_daily_file = __DIR__.'/daily.json';
        if (!is_file($json_daily_file) || filemtime($json_daily_file) < time() - 3600) {
            if ($json_daily = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js')) {
                file_put_contents($json_daily_file, $json_daily);
            }
        }

        $data = json_decode(file_get_contents($json_daily_file));
        //var_dump($data);
        echo "Обменный курс USD по ЦБ РФ на сегодня: {$data->Valute->USD->Value}";
    }


//       Пример использования
//        if (isDomainAvailible('http://www.ruseller.com'))
//       {
//               echo "Работает и готов отвечать на запросы!";
//       }
//       else
//       {
//               echo "Ой, сайт не доступен.";
//       }

       //Возвращает true, если домен доступен
    public function isDomainAvailible($domain)
       {
               //Проверка на правильность URL
               if(!filter_var($domain, FILTER_VALIDATE_URL))
               {
                       return false;
               }

               //Инициализация curl
               $curlInit = curl_init($domain);
               curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
               curl_setopt($curlInit,CURLOPT_HEADER,true);
               curl_setopt($curlInit,CURLOPT_NOBODY,true);
               curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

               //Получаем ответ
               $response = curl_exec($curlInit);

               curl_close($curlInit);

               if ($response) return true;

               return false;
       }

       //функция подменяющая file_get_contents, если нет доступа браузера к данной
    public function file_get_contents_curl($url)
    {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Устанавливаем параметр, чтобы curl возвращал данные, вместо того, чтобы выводить их в браузер.
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

}
