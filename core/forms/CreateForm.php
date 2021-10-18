<?php

namespace kahanov\short_links\core\forms;

use Yii;
use yii\base\Model;

class CreateForm extends Model
{
    public $url;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['url'], 'required'],
            [['url'], 'string'],
            [['url'], 'trim'],
            [['url'], 'url', 'defaultScheme' => 'http'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'url' => Yii::t('app', 'Ссылка'),
        ];
    }
}
