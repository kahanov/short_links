<?php

namespace kahanov\shortlinks\core\bootstraps;

use yii\base\BootstrapInterface;

class ShortLinksBootstrap implements BootstrapInterface
{
    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {

        $app->getUrlManager()->addRules(
            [
                'short-links' => 'short-links/default/index',
                [
                    'pattern' => 'short-links/<slug:[\w\-]+>',
                    'route' => 'short-links/default/view',
                    'suffix' => '',
                ],
            ]
            , false);
    }
}