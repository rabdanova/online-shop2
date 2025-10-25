<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Каталог товаров</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&family=Open+Sans&display=swap" rel="stylesheet" />

</head>
<body>
<header>
    <a href={{route('profile')}}>Профиль</a>
    <a href={{route('catalog')}}>Каталог</a>
    <a href={{route('logout')}}>Выйти</a>
</header>
<main>
    <h1>Корзина</h1>
    <div class="cart">
        @foreach($cart as $userProduct)
            <div class="product-card">
                <img src="{{ $userProduct->image_url }}" alt="{{ $userProduct->name }}" class="product-image" />
                <div class="product-title">{{ $userProduct->name }}</div>
                <div class="product-description">{{ $userProduct->description }}</div>
                <div class="product-price">{{ number_format($userProduct->price, 0, '.', ' ') }} ₽</div>
                <div> Количество: {{ number_format($userProduct->amount) }}</div>
            </div>

        @endforeach
    </div>

</main>
<style>
    body {
        font-family: 'Open Sans', Arial, sans-serif;
        background: linear-gradient(135deg, #e8efff 0%, #c6d7ff 50%, #a0bbff 100%);
        margin: 0;
        padding: 0;
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
        padding: 0 25px;
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
    .cart {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 40px;
    }
    .product-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(86, 86, 87, 0.3);
        padding: 20px;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 35px rgba(197, 43, 56, 0.45);
    }
    .product-image {
        width: 100%;
        height: auto;           /* Убираем фиксированную высоту */
        max-height: 300px;      /* Максимальная высота, можно менять */
        border-radius: 12px;
        object-fit: contain;    /* Чтобы вся картинка помещалась */
        margin-bottom: 18px;
        box-shadow: 0 4px 15px rgba(74, 51, 152, 0.15);
        transition: transform 0.35s ease;
    }
    .product-card:hover .product-image {
        transform: scale(1.05);
    }
    .product-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 22px;
        font-weight: 700;
        color: #3b2675;
        margin-bottom: 10px;
        min-height: 56px;
    }
    .product-description {
        font-size: 15.5px;
        color: #5c5c5c;
        flex-grow: 1;
        margin-bottom: 18px;
        line-height: 1.5;
    }
    .product-price {
        font-size: 20px;
        font-weight: 700;
        color: #cd1352;
        text-align: right;
        letter-spacing: 0.02em;
    }
</style>
</body>
</html>

