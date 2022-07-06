<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Url;
use app\models\Check;

class CheckController extends Controller
{
    public function actionCheck()
    {
        $urls = Url::find()
            ->all();

        foreach($urls as $url) {
            if ($url->frequency != $url->current_time) {
                $url->current_time = $url->current_time + 1;
                $url->save();
                continue;
            }

            if ($url->current_count >= $url->count) {
                continue;
            }

            $check = new Check();
            $handle = curl_init($url->url);
            curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
            curl_exec($handle);
            $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
            if ($httpCode == 200) {
                $check->date = date("Y-m-d h:i:s");
                $check->url = $url->url;
                $check->code = 200;
                $check->try = $url->current_count;
                $check->save();

                $url->current_time = 1;
                $url->current_count = 0;
                $url->save();
            }
            else {
                $check->date = date("Y-m-d h:i:s");
                $check->url = $url->url;
                $check->code = $httpCode;
                $check->try = $url->current_count;
                $check->save();

                $url->current_time = $url->frequency;
                $url->current_count = $url->current_count + 1;
                $url->save();
            }

            curl_close($handle);
        }
    }
}
