<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Продукт</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&family=Open+Sans&display=swap" rel="stylesheet" />

</head>
<body>
<header>
    <a href="{{ route('profile') }}">Профиль</a>
    <a href="{{ route('catalog') }}">Каталог</a>
    <a href="{{ route('cart') }}">Корзина</a>
    <a href="{{ route('userOrders') }}">Мои заказы</a>
    <a href="{{ route('logout') }}">Выйти</a>
</header>
<main>
    <h1>Отзывы о товаре</h1>
    <div class="product-card">
        <div class="product-main">
            <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" class="product-image" />
            <div class="product-info">
                <div class="product-title">{{ $product->name }}</div>
                <div class="product-description">{{ $product->description }}</div>
                <div class="product-price">{{ number_format($product->price, 0, '.', ' ') }} ₽</div>

                @php
                    // Правильное вычисление среднего рейтинга по коллекции отзывов
                    $reviews = $product->reviews ?? collect();
                    $averageRating = $reviews->avg('rating') ?? 0;
                    $averageRating = round($averageRating, 2);
                @endphp

                @if ($averageRating > 0)
                    <div class="rating">
                        @for ($i = 1; $i <= 5; $i++)
                            {!! $i <= round($averageRating) ? '⭐' : '☆' !!}
                        @endfor
                        <span>{{ number_format($averageRating, 1) }}</span>
                    </div>
                @else
                    <p>Пока нет оценок.</p>
                @endif
            </div>
        </div>

        <div class="reviews">
            @foreach ($reviews as $review)
                <div class="review-card">
                    <p>{{ $review->comment }}</p>
                    <p class="review-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            {!! $i <= $review->rating ? '⭐' : '☆' !!}
                        @endfor
                        <span>{{ $review->rating }}</span>
                    </p>
                </div>
            @endforeach
        </div>

        <button class="btn-show-review-form" onclick="document.querySelector('.review-form').style.display = 'block'; this.style.display = 'none';">
            Добавить отзыв
        </button>

        <form action="{{ route('addReview') }}" method="POST" class="review-form" style="display:none;">
            @csrf
            <h2>Оставить отзыв</h2>

            <input type="hidden" name="product_id" value="{{ $product->id }}" required>

            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" placeholder="Ваше имя" value="{{ old('name') }}" required>

            <label for="rating">Рейтинг:</label>
            <select id="rating" name="rating" required>
                <option value="" disabled selected>Выберите рейтинг</option>
                <option value="5">5 - Отлично</option>
                <option value="4">4 - Хорошо</option>
                <option value="3">3 - Средне</option>
                <option value="2">2 - Плохо</option>
                <option value="1">1 - Очень плохо</option>
            </select>

            <label for="comment">Комментарий:</label>
            <textarea id="comment" name="comment" rows="5" placeholder="Напишите ваш отзыв здесь..." required>{{ old('comment') }}</textarea>

            <button type="submit">Отправить отзыв</button>
        </form>
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
    .product-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(86,86,87,0.3);
        padding: 20px;
        margin-bottom: 40px;
        display: flex;
        flex-direction: column;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
    }
    .product-main {
        display: flex;
        gap: 30px;
        align-items: flex-start;
    }
    .product-image {
        width: 400px;
        height: 400px;
        border-radius: 12px;
        object-fit: contain;
        box-shadow: 0 4px 15px rgba(74,51,152,0.15);
    }
    .product-info {
        flex-grow: 1;
        max-width: 450px; /* уменьшаем ширину информации чтобы не соприкасалась с фото */
    }
    .product-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #3b2675;
        margin-bottom: 10px;
    }
    .product-description {
        font-size: 16px;
        color: #5c5c5c;
        line-height: 1.5;
        margin-bottom: 15px;
    }
    .product-price {
        font-size: 24px;
        font-weight: 700;
        color: #cd1352;
        margin-bottom: 25px;
    }
    .rating {
        font-size: 20px;
        color: #ffb400;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        margin-bottom: 20px;
    }
    .reviews {
        margin-top: 30px;
        max-width: 460px; /* уже, чтобы не сливалось с фото */
    }
    .review-card {
        background: #f9f9f9;
        border-radius: 12px;
        margin-bottom: 20px;
        padding: 15px 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .review-stars {
        font-size: 18px;
        color: #ffb400;
        margin-top: 6px;
    }
    .review-form {
        max-width: 600px;
        margin: 20px auto 0 auto;
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(86,86,87,0.2);
        font-family: 'Open Sans', Arial, sans-serif;
        display: none; /* по умолчанию скрыта */
    }
    .review-form h2 {
        color: #3b2675;
        font-weight: 700;
        margin-bottom: 20px;
        text-align: center;
    }
    .review-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #504f4f;
    }
    .review-form input[type="text"],
    .review-form select,
    .review-form textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 16px;
        font-family: 'Open Sans', Arial, sans-serif;
        box-sizing: border-box;
    }
    .review-form button {
        background-color: #cd1352;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%;
    }
    .review-form button:hover {
        background-color: #a0113f;
    }
    .btn-show-review-form {
        display: block;
        max-width: 600px;
        margin: 0 auto 25px;
        background-color: #337ab7;
        color: white;
        border: none;
        padding: 10px 25px;
        font-size: 16px;
        font-weight: 700;
        border-radius: 12px;
        cursor: pointer;
        user-select: none;
        transition: background-color 0.3s ease;
    }
    .btn-show-review-form:hover {
        background-color: #2a5c8d;
    }
</style>
</body>

</html>
