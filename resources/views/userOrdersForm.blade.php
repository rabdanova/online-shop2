<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Мои заказы</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&family=Open+Sans&display=swap" rel="stylesheet" />
</head>
<body>
<header>
    <a href="{{ route('profile') }}">Профиль</a>
    <a href={{route('catalog')}}>Каталог
    </a>
    <a href="{{ route('cart') }}">Корзина</a>
    <a href="{{ route('logout') }}">Выйти</a>
</header>
<main>
    <h1>Мои заказы</h1>

    @foreach($userOrders as $userOrder)
        <h2>Заказ №{{ $userOrder->id }}</h2>
        <p>Контактное имя: {{ $userOrder->name }}</p>
        <p>Контактный номер телефона: {{ $userOrder->phone_number }}</p>
        <p>Адрес: {{ $userOrder->address }}</p>
        <p>Комментарий: {{ $userOrder->comment }}</p>

        <table>
            <thead>
            <tr>
                <th>Название товара</th>
                <th>Фото товара</th>
                <th>Цена за единицу</th>
                <th>Количество</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
            @foreach($userOrder->orderProducts as $orderProduct)
                <tr>
                    <td>{{ $orderProduct->name }}</td>
                    <td><img src="{{ $orderProduct->image_url }}" alt="Фото {{ $orderProduct->name }}"></td>
                    <td>{{ number_format($orderProduct->price, 0, '.', ' ') }} ₽</td>
                    <td>{{ $orderProduct->amount }}</td>
                    <td>{{ number_format($orderProduct->totalSum, 0, '.', ' ') }} ₽</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Итого:</strong></td>
                <td>{{ number_format($userOrder->total, 0, '.', ' ') }} ₽</td>
            </tr>
            </tfoot>
        </table>
    @endforeach
</main>
</body>
<style>
    body {
        font-family: 'Open Sans', Arial, sans-serif;
        background: linear-gradient(135deg, #e8efff 0%, #c6d7ff 50%, #a0bbff 100%);
        margin: 0;
        padding: 0 25px 40px;
        color: #222;
    }
    header {
        background: linear-gradient(135deg, #e8efff 0%, #c6d7ff 50%, #a0bbff 100%);
        color: white;
        padding: 20px 40px;
        display: flex;
        justify-content: flex-end;
        gap: 30px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        box-shadow: 0 3px 12px rgba(95, 104, 110, 0.5);
    }
    header a {
        color: #504f4f;
        text-decoration: none;
        font-size: 17px;
        position: relative;
        transition: color 0.3s ease;
    }
    header a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -4px;
        left: 0;
        background: #ff4081;
        transition: width 0.3s ease;
    }
    header a:hover {
        color: rgba(197, 43, 56, 0.45);
    }
    header a:hover::after {
        width: 100%;
    }
    main {
        max-width: 1250px;
        margin: 40px auto;
    }
    h1 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 36px;
        color: #3b2675;
        margin-bottom: 40px;
        text-align: center;
        text-shadow: 1px 1px 4px rgba(94, 89, 110, 0.3);
    }
    h2 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        color: #3b2675;
        margin-top: 30px;
        margin-bottom: 15px;
        text-shadow: 1px 1px 2px rgba(94, 89, 110, 0.25);
    }
    p {
        font-size: 16px;
        color: #5c5c5c;
        margin: 4px 0;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        box-shadow: 0 6px 20px rgba(86, 86, 87, 0.3);
        border-radius: 10px;
        overflow: hidden;
    }
    th, td {
        padding: 10px 15px;
        border-bottom: 1px solid #ddd;
        text-align: center;
        font-family: 'Open Sans', Arial, sans-serif;
    }
    th {
        background-color: #cd1352;
        color: white;
        font-weight: 700;
        font-size: 16px;
    }
    td img {
        border-radius: 12px;
        max-width: 160px;
        height: 160px;
        object-fit: contain;
    }
    tfoot td {
        font-weight: 700;
        font-size: 18px;
        color: #3b2675;
        text-align: right;
        padding-right: 30px;
    }
</style>
</html>

