Yii2 short_links модуль
=============

Прописываем в composer.json проекта

```
"repositories":[
        {
            "type":"git",
            "url":"https://github.com/kahanov/short_links"
        }
    ]
```

Запустите

```
composer require kahanov/shortlinks "dev-main"
```

Использование
-----

Подключите модуль в файле конфигурации config/main.php

```php
'bootstrap' => [
        'kahanov\shortlinks\core\bootstraps\ShortLinksBootstrap',
    ],
'modules' => [
    'short-links' => [
        'class' => 'kahanov\shortlinks\Module',
    ],
    ...
],
```

Выполните миграцию

```php

php yii migrate --migrationPath=@vendor/kahanov/shortlinks/migrations

```

Функционал будет доступен по адресу http://site/short-links
