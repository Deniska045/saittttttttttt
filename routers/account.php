<?php

// Роутер
function route($method, $urlData, $formData) {
    
    // GET /account/{Id}
    if ($method === 'GET' && count($urlData) === 1) {
        $userId = $urlData[0];

        // Вытаскиваем все данные о пользователе из базы...

        // Выводим ответ клиенту
        echo json_encode(array(
            'method' => 'GET',
            'id' => $userId,
            'info' => array(
                'email' => 'webdevkin@gmail.com',
                'name' => 'Webdevkin'
            ),
            'orders' => array(
                array(
                    'orderId' => 5,
                    'summa' => 2000,
                    'orderDate' => '12.01.2017'
                ),
                array(
                    'orderId' => 8,
                    'summa' => 5000,
                    'orderDate' => '03.02.2017'
                )
            )
        ));

        return;
    }


    // Получение общей информации о пользователе
    // GET /users/{userId}/info
    if ($method === 'GET' && count($urlData) === 2 && $urlData[1] === 'info')  {
        // Получаем id товара
        $userId = $urlData[0];

        // Вытаскиваем общие данные о пользователе из базы...

        // Выводим ответ клиенту
        echo json_encode(array(
            'method' => 'GET',
            'id' => $userId,
            'info' => array(
                'email' => 'webdevkin@gmail.com',
                'name' => 'Webdevkin'
            )
        ));

        return;
    }

    // Получение заказов пользователя
    // GET /users/{userId}/orders
    if ($method === 'GET' && count($urlData) === 2 && $urlData[1] === 'orders')  {
        // Получаем id товара
        $userId = $urlData[0];

        // Вытаскиваем данные о заказах пользователя из базы...

        // Выводим ответ клиенту
        echo json_encode(array(
            'method' => 'GET',
            'id' => $userId,
            'orders' => array(
                array(
                    'orderId' => 5,
                    'summa' => 2000,
                    'orderDate' => '12.01.2017'
                ),
                array(
                    'orderId' => 8,
                    'summa' => 5000,
                    'orderDate' => '03.02.2017'
                )
            )
        ));

        return;
    }

    // Возвращаем ошибку
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(array(
        'error' => 'Bad Request'
    ));
}
