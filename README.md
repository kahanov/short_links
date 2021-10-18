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
php composer.phar require --prefer-dist kahanov/short_links "*"
```

Использование
-----

Подключите модуль в файле конфигурации config/main.php

```php
'bootstrap' => [
        'kahanov\short_links\core\bootstraps\ShortLinksBootstrap',
    ],
'modules' => [
    'short-links' => [
        'class' => 'kahanov\short_links\Module',
    ],
    ...
],
```

Выполните миграцию

```php

./yii migrate --migrationPath=@vendor/kahanov/short_links/migrations

```

Функционал будет доступен по адресу http://site/short-links
