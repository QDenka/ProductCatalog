# ProductCatalog
Тестовое задание для house.
____
## Предисловие
Все названия товаров/категорий в сидерах заданы Случайными словами, на английском языке, цены в долларах - float. Предположим что максимальные цены не более 99999$
Много чего еще я бы добавил, например логирование с ежедневной ротацией.<br>
Корзина будет очищаться по планировщику очередей с помощью Job dispatch, каждые 2 часа - если обновлена более чем 24 часа назад - корзина удаляется.<br>
API протестировано с помощью POSTMAN, на веб-сервере Nginx, PHP 8, система Ubuntu 20.
____
## Установка
Для установки необходимо клонировать репозиторий:
<br>`git clone https://github.com/QDenka/ProductCatalog.git`

Далее переименовать .env.example в .env и настроить подключения базы данных

Для полного запуска вместе с seed-ами и миграциями необходимо выполнить <b>команду</b>:
<br>`php artisan app:start`
Без сидеров:
<br>`php artisan migrate`
____
## Методы
### Регистрация
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">POST</span><span class="pl-c1"> /api/v1/auth/register</span></pre></div>
<table>
<thead>
<tr>
<th align="left">Параметр</th>
<th align="left">Тип</th>
<th align="left">Описание</th>
</tr>
</thead>
<tbody>
<tr>
<td align="left"><code>email</code></td>
<td align="left"><code>email</code></td>
<td align="left"><strong>Обязательный</strong>. Ваш E-Mail</td>
</tr>
<tr>
<td align="left"><code>password</code></td>
<td align="left"><code>string</code></td>
<td align="left"><strong>Обязательный</strong>. Ваш пароль</td>
</tr>
<tr>
<td align="left"><code>password_confirmation</code></td>
<td align="left"><code>string</code></td>
<td align="left"><strong>Обязательный</strong>. Подтверждение пароля</td>
</tr>
<tr>
<td align="left"><code>firstname</code></td>
<td align="left"><code>string</code></td>
<td align="left"><strong>Обязательный</strong>. Имя</td>
</tr>
<tr>
<td align="left"><code>lastname</code></td>
<td align="left"><code>string</code></td>
<td align="left"><strong>Обязательный</strong>. Фамилия</td>
</tr>
<tr>
<td align="left"><code>middlename</code></td>
<td align="left"><code>string</code></td>
<td align="left"><strong>Обязательный</strong>. Отчество</td>
</tr>
<tr>
<td align="left"><code>phone</code></td>
<td align="left"><code>tel</code></td>
<td align="left"><strong>Обязательный</strong>. Номер телефона</td>
</tr>
<tr>
<td align="left"><code>biling_address</code></td>
<td align="left"><code>string</code></td>
<td align="left"><strong>Обязательный</strong>. Адрес</td>
</tr>
</tbody>
</table>

<b>Ответ: </b>
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">{
    "status": "success",
    "data": {
        "token": "1|1MfhWzUBp0OJn8yPoZmfaznSyGTvChxLWMoZ2iCw"
    }
}</span></pre></div>

### Авторизация
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">POST</span><span class="pl-c1"> /api/v1/auth/login</span></pre></div>
<table>
<thead>
<tr>
<th align="left">Параметр</th>
<th align="left">Тип</th>
<th align="left">Описание</th>
</tr>
</thead>
<tbody>
<tr>
<td align="left"><code>email</code></td>
<td align="left"><code>email</code></td>
<td align="left"><strong>Обязательный</strong>. Ваш E-Mail</td>
</tr>
<tr>
<td align="left"><code>password</code></td>
<td align="left"><code>string</code></td>
<td align="left"><strong>Обязательный</strong>. Ваш пароль</td>
</tr>
</tbody>
</table>

### Получение дерева категорий
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">GET</span><span class="pl-c1"> /api/v1/categories/get</span></pre></div>

<b>Ответ: </b>
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">{
    "status": "success",
    "data": {
        "categories": [
            {
                "id": 1,
                "name": "numquam",
                "sub_id": null,
                "created_at": "2021-03-03T21:45:59.000000Z",
                "updated_at": "2021-03-03T21:45:59.000000Z",
                "children_category": [
                    {
                        "id": 92,
                        "name": "totam",
                        "sub_id": 1,
                        "created_at": "2021-03-03T21:46:12.000000Z",
                        "updated_at": "2021-03-03T21:46:12.000000Z",
                        "children_category": [
                            "id": 95,
                            "name": "totam",
                            "sub_id": 92,
                            "created_at": "2021-03-03T21:46:12.000000Z",
                            "updated_at": "2021-03-03T21:46:12.000000Z",
                            "children_category": []
                        ]
                    }
                ]
            }
    }</span></pre></div>

### Получение товаров, фильтрация
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">GET</span><span class="pl-c1"> /api/v1/products/get</span></pre></div>
<table>
<thead>
<tr>
<th align="left">Параметр</th>
<th align="left">Тип</th>
<th align="left">Описание</th>
</tr>
</thead>
<tbody>
<tr>
<td align="left"><code>categories[]</code></td>
<td align="left"><code>array, string</code></td>
<td align="left">Категории</td>
</tr>
<tr>
<td align="left"><code>features[]</code></td>
<td align="left"><code>array, string</code></td>
<td align="left">Название необходимых характеристик</td>
</tr>
<tr>
<td align="left"><code>price_to</code></td>
<td align="left"><code>float</code></td>
<td align="left">Цена ОТ</td>
</tr>
<tr>
<td align="left"><code>price_from</code></td>
<td align="left"><code>float</code></td>
<td align="left">Цена ДО</td>
</tr>
</tbody>
</table>

<b>Ответ: </b>
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">{
    "status": "success",
    "data": {
        "products": [
            {
                "id": 7,
                "name": "omnis",
                "slug": "quo-rem-incidunt-facilis-et-debitis-illo",
                "price": 6,
                "description": "Impedit sit et consectetur omnis. Odit dolore libero dicta magni sit. Quos odit officia ipsa molestias aut fuga veniam.",
                "created_at": "2021-03-03T18:21:33.000000Z",
                "updated_at": "2021-03-03T18:21:33.000000Z",
                "category": [
                    {
                        "category_id": 32,
                        "product_id": 7,
                        "category": {
                            "id": 32,
                            "name": "unde",
                            "sub_id": null,
                            "created_at": "2021-03-03T18:21:31.000000Z",
                            "updated_at": "2021-03-03T18:21:31.000000Z",
                            "children_category": [
                                {
                                    "id": 62,
                                    "name": "pariatur",
                                    "sub_id": 32,
                                    "created_at": "2021-03-03T18:24:18.000000Z",
                                    "updated_at": "2021-03-03T18:24:18.000000Z",
                                    "children_category": []
                                }
                            ]
                        }
                    },
                    {
                        "category_id": 41,
                        "product_id": 7,
                        "category": {
                            "id": 41,
                            "name": "saepe",
                            "sub_id": null,
                            "created_at": "2021-03-03T18:21:31.000000Z",
                            "updated_at": "2021-03-03T18:21:31.000000Z",
                            "children_category": []
                        }
                    },
                    {
                        "category_id": 42,
                        "product_id": 7,
                        "category": {
                            "id": 42,
                            "name": "numquam",
                            "sub_id": null,
                            "created_at": "2021-03-03T18:21:31.000000Z",
                            "updated_at": "2021-03-03T18:21:31.000000Z",
                            "children_category": [
                                {
                                    "id": 57,
                                    "name": "tempore",
                                    "sub_id": 42,
                                    "created_at": "2021-03-03T18:24:18.000000Z",
                                    "updated_at": "2021-03-03T18:24:18.000000Z",
                                    "children_category": []
                                },
                                {
                                    "id": 97,
                                    "name": "perspiciatis",
                                    "sub_id": 42,
                                    "created_at": "2021-03-03T18:24:18.000000Z",
                                    "updated_at": "2021-03-03T18:24:18.000000Z",
                                    "children_category": []
                                }
                            ]
                        }
                    },
                    {
                        "category_id": 28,
                        "product_id": 7,
                        "category": {
                            "id": 28,
                            "name": "nulla",
                            "sub_id": null,
                            "created_at": "2021-03-03T18:21:31.000000Z",
                            "updated_at": "2021-03-03T18:21:31.000000Z",
                            "children_category": [
                                {
                                    "id": 73,
                                    "name": "quisquam",
                                    "sub_id": 28,
                                    "created_at": "2021-03-03T18:24:18.000000Z",
                                    "updated_at": "2021-03-03T18:24:18.000000Z",
                                    "children_category": []
                                }
                            ]
                        }
                    }
                ],
                "features": [
                    {
                        "feature_id": 10,
                        "product_id": 7,
                        "value": "illo",
                        "feature": {
                            "id": 10,
                            "name": "tenetur",
                            "type": "expedita",
                            "features_connect": {
                                "feature_id": 10,
                                "product_id": 9,
                                "value": "iste"
                            }
                        }
                    },
                    {
                        "feature_id": 7,
                        "product_id": 7,
                        "value": "perferendis",
                        "feature": {
                            "id": 7,
                            "name": "rerum",
                            "type": "deserunt",
                            "features_connect": {
                                "feature_id": 7,
                                "product_id": 3,
                                "value": "quia"
                            }
                        }
                    },
                    {
                        "feature_id": 1,
                        "product_id": 7,
                        "value": "perferendis",
                        "feature": {
                            "id": 1,
                            "name": "consequatur",
                            "type": "quia",
                            "features_connect": {
                                "feature_id": 1,
                                "product_id": 33,
                                "value": "cupiditate"
                            }
                        }
                    },
                    {
                        "feature_id": 9,
                        "product_id": 7,
                        "value": "voluptas",
                        "feature": {
                            "id": 9,
                            "name": "nesciunt",
                            "type": "voluptas",
                            "features_connect": {
                                "feature_id": 9,
                                "product_id": 14,
                                "value": "provident"
                            }
                        }
                    }
                ]
            }
    }</span></pre></div>

### Получение товаров, фильтрация
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">GET</span><span class="pl-c1"> /api/v1/products/slug</span></pre></div>
<table>
<thead>
<tr>
<th align="left">Параметр</th>
<th align="left">Тип</th>
<th align="left">Описание</th>
</tr>
</thead>
<tbody>
<tr>
<td align="left"><code>value</code></td>
<td align="left"><code>string</code></td>
<td align="left"><strong>Обязательный</strong>. SLUG</td>
</tr>
</tbody>
</table>

<b>Ответ: </b>
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">{
    "status": "success",
    "data": {
        "product": [
            {
                "id": 3,
                "name": "quam",
                "slug": "autem-dignissimos-vitae-aut-harum",
                "price": 0,
                "description": "Sed magnam omnis et voluptas harum perspiciatis aspernatur. Doloremque rerum rerum rem vel quis sed tempora. Et ut illum labore adipisci voluptatem.",
                "created_at": "2021-03-03T21:45:59.000000Z",
                "updated_at": "2021-03-03T21:45:59.000000Z",
                "category": [
                    {
                        "category_id": 3,
                        "product_id": 3,
                        "category": {
                            "id": 3,
                            "name": "nihil",
                            "sub_id": null,
                            "created_at": "2021-03-03T21:45:59.000000Z",
                            "updated_at": "2021-03-03T21:45:59.000000Z",
                            "children_category": []
                        }
                    }
                ]
            }
        ]
    }
}</span></pre></div>

### Работа с корзиной - добавление
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">POST</span><span class="pl-c1"> /api/v1/cart/add</span></pre></div>
<table>
<thead>
<tr>
<th align="left">Параметр</th>
<th align="left">Тип</th>
<th align="left">Описание</th>
</tr>
</thead>
<tbody>
<tr>
<td align="left"><code>product_id</code></td>
<td align="left"><code>int</code></td>
<td align="left"><strong>Обязательный</strong>. ID товара</td>
</tr>
</tbody>
</table>

<b>Ответ: </b>
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">{
    "status": "success",
    "data": {
        "product": "6",
        "status": "added"
    }
}</span></pre></div>

### Работа с корзиной - удаление
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">POST</span><span class="pl-c1"> /api/v1/cart/delete</span></pre></div>
<table>
<thead>
<tr>
<th align="left">Параметр</th>
<th align="left">Тип</th>
<th align="left">Описание</th>
</tr>
</thead>
<tbody>
<tr>
<td align="left"><code>product_id</code></td>
<td align="left"><code>int</code></td>
<td align="left"><strong>Обязательный</strong>. ID товара</td>
</tr>
</tbody>
</table>

<b>Ответ: </b>
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">{
    "status": "success",
    "data": {
        "product": "6",
        "status": "deleted"
    }
}</span></pre></div>

### Работа с корзиной - изменение количества
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">POST</span><span class="pl-c1"> /api/v1/cart/product/count</span></pre></div>
<table>
<thead>
<tr>
<th align="left">Параметр</th>
<th align="left">Тип</th>
<th align="left">Описание</th>
</tr>
</thead>
<tbody>
<tr>
<td align="left"><code>product_id</code></td>
<td align="left"><code>int</code></td>
<td align="left"><strong>Обязательный</strong>. ID товара</td>
</tr>
<tr>
<td align="left"><code>type</code></td>
<td align="left"><code>string: increase, discrease</code></td>
<td align="left"><strong>Обязательный</strong>. Тип, increase - увеличить, discreas - уменьшить</td>
</tr>
<tr>
<td align="left"><code>count</code></td>
<td align="left"><code>int</code></td>
<td align="left"><strong>Обязательный</strong>. На сколько уменьшать-увеличивать</td>
</tr>
</tbody>
</table>

<b>Ответ: </b>
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">{
    "status": "success",
    "data": {
        "product": "6",
        "status": "increase",
        "at_count": "3"
    }
}</span></pre></div>

### Оформление заказа
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">POST</span><span class="pl-c1"> /api/v1/order/make</span></pre></div>
<table>
<thead>
<tr>
<th align="left">Параметр</th>
<th align="left">Тип</th>
<th align="left">Описание</th>
</tr>
</thead>
<tbody>
<tr>
<td align="left"><code>Token</code></td>
<td align="left"><code>Bearer Token</code></td>
<td align="left">Если передать, не нужно будет заполнять контактные данные, они подхватятся автоматически</td>
</tr>
</tbody>
</table>

<b>Ответ: </b>
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">{
    "status": "success",
    "data": {
        "message": "Success purchase!",
        "sum": 15
    }
}</span></pre></div>

### Просмотр заказов
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">GET</span><span class="pl-c1"> /api/v1/order/get</span></pre></div>
<table>
<thead>
<tr>
<th align="left">Параметр</th>
<th align="left">Тип</th>
<th align="left">Описание</th>
</tr>
</thead>
<tbody>
<tr>
<td align="left"><code>Token</code></td>
<td align="left"><code>Bearer Token</code></td>
<td align="left"><strong>Обязательный</strong>. Получить список заказов и информацию о них.</td>
</tr>
</tbody>
</table>

<b>Ответ: </b>
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">{
    "status": "success",
    "data": {
        "purchases": [
            {
                "id": 1,
                "user_id": 1,
                "contact_id": 1,
                "cart_id": 1,
                "purchase_amount": 15,
                "created_at": "2021-03-03T22:11:52.000000Z",
                "updated_at": "2021-03-03T22:11:52.000000Z",
                "contact": {
                    "id": 1,
                    "user_id": 1,
                    "email": null,
                    "firstname": "Vasya",
                    "lastname": "Vasiev",
                    "middlename": "Vasievich",
                    "phone": "+799999999",
                    "biling_address": "testtt"
                },
                "cart": {
                    "id": 1,
                    "identifier": "BAFTP9HV5i9DZsuJ4XNvrd4ATNYDNHG6aJcuHaPd",
                    "content": null,
                    "purchased": 1,
                    "created_at": "2021-03-03T21:47:28.000000Z",
                    "updated_at": "2021-03-03T22:11:52.000000Z",
                    "cart_list": [
                        {
                            "cart_id": 1,
                            "product_id": 6,
                            "count": 1,
                            "product": {
                                "id": 6,
                                "name": "at",
                                "slug": "et-sunt-at-optio-vero",
                                "price": 0,
                                "description": "Quis in iusto quia ut quidem sint eum. Aliquid amet enim explicabo perspiciatis animi est nihil. Et ea saepe eligendi modi molestias aut ipsum. Qui id perferendis commodi neque nostrum laudantium.",
                                "created_at": "2021-03-03T21:45:59.000000Z",
                                "updated_at": "2021-03-03T21:45:59.000000Z"
                            }
                        }
                    ]
                }
            }
        ]
    }
}</span></pre></div>

### Обработка ошибок

<b>Ответ при ошибке: </b>
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">{
    "status": "error",
    "message": "Product not found",
    "data": null
}</span></pre></div>

<b>Ответ при ошибке валидации: </b>
<div class="highlight highlight-source-httpspec"><pre><span class="pl-k">{
    "message": "The given data was invalid.",
    "errors": {
        "product_id": [
            "The selected product id is invalid."
        ]
    }
}</span></pre></div>
