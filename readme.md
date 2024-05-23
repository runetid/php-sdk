# Установка

```bash
composer require runetid/php-sdk
```

Для начала работы, необходимо получить ApiKey и Secret 

# Использование

## Инициализация клиента

```php
$client = new \runetid\sdk\Client($key, $secret);
```

SDK изпользует [API runet.id](https://api.runet.id/swagger/index.html) на данный момент не все методы реализованы.
Для отправки запроса к методу, не реализованному в данном SDK, можно использовать сырой запрос:

```php
$params = [
    'limit' => 10,
    'offset' => 0,
    'pagination' => [
        'page' => 1,
        'perPage' => 10
    ],
];
$url = 'storage/list?'.http_build_query($params); // адрес ендпоинта

$client->request($url, 'GET')
```

## Доступные методы

### Пользователи
#### Поиск по почте
```php
$client->user()->search('test@example.com');
```
#### Создание пользователя (регистрация)
```php
$client->user()->create($user);
```
В качестве аргумента принимает DTO \runetid\sdk\models\User у которого есть дополнительные методы. Пример использования:

```php
$user = new \runetid\sdk\models\User()
$user->load([
    'first_name' => '',
    'last_name' => '',
    'father_name' => '',
    'email' => '',
    'password' => ''
])
```

#### Получение токена
```php
$client->user()->getToken($login, $password);
```

В качестве логина может выступать runetId или почта пользователя

#### Получение информации о пользователе по токену

```php
$client->user()->byToken($token);
```

В качестве токена используется ответ из предыдущего запроса

Для использования API от имени авторизованного пользователя, необходимо указать токен в клиенте

```php
$client->bearer = $token;
```

### Мероприятия

#### Получение информации о мероприятии
```php
$client->event()->getByAlias($alias)
```

### Регистрация участника на мероприятие
```php
$client->event()->register($userId, $eventId, $attributes)
```

Аргументы функции:

* $userId - Идентификатор пользователя (Не путать с RunetId, это два разных поля)
* $eventId - Идентификатор мероприятия
* $attributes - Массив дополнительных аттрибутов, необязательное поле

### Программа мероприятия

```php
$client->event()->program()
```

Получает список секций мероприятия, к которому привязан API ключ

### Товары
```php
$client->event()->products()
```

Получает список товаров мероприятия, к которому привязан API ключ

### Поиск по базе участников

```php
$client->event()->searchParticipant('test@example.com')
```

## Заказы

### Добавить позицию в заказ

```php
$client->order()->addOrderItem($item)
```

В качестве аргумента принимает DTO \runetid\sdk\models\OrderItem, у которого есть дополнительные методы. Пример использования:

```php
$item = new \runetid\sdk\models\OrderItem();
$item->load([
    'owner_id' => 123, // Идентификатор получателя товара (Не путать с RunetId, это два разных поля)
    'payer_id' => 123, // Идентификатор плательщика (Не путать с RunetId, это два разных поля)
    'product_id' => 123, // Идентификатор товара
    'attributes' => [], // Массив дополнительных аттрибутов (необязательный параметр)
])
```

Возвращает \runetid\sdk\models\OrderItem с указанием номера заказа

### Удаление позиции
```php
$client->order()->deleteOrderItem($itemId)
```

### Получение ссылки на оплату

```php
$client->order()->actionGetPayUrl($orderId)
```