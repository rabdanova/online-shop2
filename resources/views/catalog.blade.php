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
    <a href="/profile">Профиль</a>
    <a href="/cart">Корзина
    </a>
    <a href="/logout">Выйти</a>
</header>
<main>
    <h1>Смартфоны и гаджеты</h1>
    <div class="catalog">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image" />
                <div class="product-title">{{ $product->name }}</div>
                <div class="product-description">{{ $product->description }}</div>
                <div class="price-and-button">
                    <div class="product-price">{{ number_format($product->price, 0, '.', ' ') }} ₽</div>

                        <div class="quantity-control">
                            <form class="addUserProduct" onsubmit="return false" class="adjust-form-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" name="action" value="increase" class="btn-adjust-inline">+</button>
                            </form>

                            <form class="removeUserProduct" onsubmit="return false" class="adjust-form-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" name="action" value="decrease" class="btn-adjust-inline">−</button>
                            </form>
                        </div>
                </div>

            </div>
        @endforeach
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">
</script>

<script>
    $("document").ready(function () {
        var form =  $('.addUserProduct');
        console.log(form);

        form.submit(function () {
            $.ajax({
                type: "POST",
                url: "/addUserProduct",
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    $('.quantity').text(response.quantity);
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error('Ошибка при добавлении товара:', error);
                }
            });
        });
    });
</script>

<script>
    $("document").ready(function () {
        var form =  $('.removeUserProduct');
        console.log(form);

        form.submit(function () {
            $.ajax({
                type: "POST",
                url: "/removeUserProduct",
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    $('.quantity').text(response.quantity);
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error('Ошибка при уменьшении количества товара:', error);
                }
            });
        });
    });
</script>
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
        box-shadow: 0 3px 12px rgba(95,104,110,0.5);
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
        text-shadow: 1px 1px 4px rgba(94,89,110,0.3);
    }
    .catalog {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 40px;
    }
    .product-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(86,86,87,0.3);
        padding: 20px;
        display: flex;
        flex-direction: column;
        cursor: default;
        transition: transform 0.35s ease, box-shadow 0.35s ease;
        position: relative;
    }
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 35px rgba(197,43,56,0.45);
    }
    .product-image {
        width: 100%;
        max-height: 300px;
        border-radius: 12px;
        object-fit: contain;
        margin-bottom: 18px;
        box-shadow: 0 4px 15px rgba(74,51,152,0.15);
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
        text-align: left;
        min-width: 90px; /* фиксируем минимальную ширину для аккуратности */
    }
    .price-and-button {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 10px 0;
    }
    .add-form-inline,
    .adjust-form-inline {
        margin: 0;
        display: inline-block;
    }
    .btn-add-inline,
    .btn-adjust-inline {
        padding: 6px 12px;
        font-size: 18px;
        border-radius: 6px;
        cursor: pointer;
        background-color: #cd1352;
        color: white;
        border: none;
    }
    .quantity-control {
        position: absolute;
        bottom: 15px; /* отступ от низа */
        right: 15px;  /* отступ от правого края */
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.8); /* если нужно — фон для читаемости */
        padding: 4px 8px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .quantity-display {
        min-width: 24px;
        text-align: center;
        font-weight: 700;
        font-size: 16px;
        user-select: none;
    }

</style>
</body>
</html>
