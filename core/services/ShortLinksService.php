<?php

namespace kahanov\shortlinks\core\services;

use kahanov\shortlinks\core\forms\CreateForm;
use kahanov\shortlinks\core\models\ShortLinks;
use Yii;

class ShortLinksService
{
    /**
     * @param CreateForm $form
     * @return ShortLinks
     * @throws \yii\base\Exception
     */
    public function createShortLink(CreateForm $form): ShortLinks
    {
        $shortLink = ShortLinks::find()->where(['url' => $form->url])->limit(1)->one();
        if (!$shortLink) {
            $shortLink = new ShortLinks();
            $shortLink->url = $form->url;
            $shortLink->short_code = $this->generateShortCode();
            if (!$shortLink->save()) {
                throw new \RuntimeException(Yii::t('app', 'Не удалось сохранить'));
            }
        }

        return $shortLink;
    }

    /**
     * @return string
     */
    private function generateShortCode(): string
    {
        $allowedChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        do {
            $shortCode = substr(str_shuffle($allowedChars), 0, 6);
        } while (ShortLinks::find()->where(['short_code' => $shortCode])->limit(1)->one());

        return $shortCode;
    }
}
