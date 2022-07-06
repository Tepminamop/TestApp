<?php

namespace app\models;

use Yii;
use yii\base\Model;

class UrlForm extends Model
{
    public $url;
    public $frequency;
    public $count;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['url', 'frequency', 'count'], 'required'],
            ['url', 'url', 'defaultScheme' => 'http'],
            ['count', 'integer', 'min' => 0, 'max' => 10],
            ['frequency', 'validateFrequency', 'when' => function ($model) {
                return $model->frequency > 0;
            }],
        ];
    }

    public function validateFrequency($attribute, $params)
    {
        if (!($this->frequency == 1 || $this->frequency == 5 || $this->frequency == 10)) {
            $this->addError('frequency', 'Frequency must be 1, 5 or 10');
        }
    }

}
