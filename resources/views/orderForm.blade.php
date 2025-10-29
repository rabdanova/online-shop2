<main>
    <h1>Ваш заказ</h1>

    @if (!empty($userProductsForOrder) && isset($totalSum))
        <div style="padding: 10px 30px;">
            <h3>Ваш заказ</h3>
            <table class="table-order">
                <thead>
                <tr>
                    <th>Товар</th>
                    <th>Цена за 1 шт</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($userProductsForOrder as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ number_format($item['price'], 2, ',', ' ') }} руб.</td>
                        <td>{{ (int) $item['amount'] }}</td>
                        <td>{{ number_format($item['sum'], 2, ',', ' ') }} руб.</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Итого:</strong></td>
                    <td><strong>{{ number_format($totalSum, 2, ',', ' ') }} руб.</strong></td>
                </tr>
                </tfoot>
            </table>
        </div>
    @endif

    <form action="{{ route('createOrder') }}" method="POST" class="order-form">
        @csrf
        <div class="field">
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            <label for="name">Имя</label>
            @error('name')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="field">
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required>
            <label for="phone_number">Номер телефона</label>
            @error('phone_number')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="field">
            <input type="text" name="address" id="address" value="{{ old('address') }}" required>
            <label for="address">Адрес</label>
            @error('address')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="field">
            <input type="text" name="comment" id="comment" value="{{ old('comment') }}">
            <label for="comment">Комментарий</label>
            @error('comment')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="field">
            <input type="submit" value="Оформить заказ" class="btn-add-inline">
            <a href="{{ route('cart') }}" class="btn-link">Корзина</a>
        </div>
    </form>
</main>

<style>
    .table-order {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        font-family: 'Open Sans', Arial, sans-serif;
        font-size: 16px;
        color: #333;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .table-order thead tr {
        background-color: #4a6ed1;
        color: white;
        font-weight: 700;
        text-align: left;
        box-shadow: 0 2px 8px rgba(74,110,209,0.5);
    }

    .table-order thead th {
        padding: 15px 20px;
        border: none;
    }

    .table-order tbody tr {
        background-color: #f8faff;
        box-shadow: 0 2px 5px rgba(74,110,209,0.1);
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .table-order tbody tr:hover {
        background-color: #e2e8ff;
    }

    .table-order tbody td {
        padding: 15px 20px;
        border: none;
        vertical-align: middle;
    }

    .table-order tfoot tr {
        background-color: #4a6ed1;
        color: white;
        font-weight: 700;
    }

    .table-order tfoot td {
        padding: 15px 20px;
        border: none;
    }

    .table-order tbody tr td:first-child,
    .table-order thead th:first-child,
    .table-order tfoot td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .table-order tbody tr td:last-child,
    .table-order thead th:last-child,
    .table-order tfoot td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    /* Остальные стили формы и кнопок */
    body {
        font-family: 'Open Sans', Arial, sans-serif;
        background: linear-gradient(135deg, #e8efff 0%, #c6d7ff 50%, #a0bbff 100%);
        margin: 0;
        padding: 0;
        color: #222;
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
    .order-form {
        max-width: 450px;
        margin: 0 auto 60px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(86,86,87,0.3);
        padding: 30px 25px;
        font-family: 'Open Sans', Arial, sans-serif;
    }
    .order-form .field {
        position: relative;
        margin-bottom: 28px;
    }
    .order-form input[type="text"] {
        width: 100%;
        border: none;
        border-bottom: 2px solid #cd1352;
        padding: 8px 10px;
        font-size: 16px;
        outline: none;
        transition: border-color 0.3s ease;
        font-family: 'Open Sans', Arial, sans-serif;
    }
    .order-form input[type="text"]:focus {
        border-color: #3b2675;
    }
    .order-form label {
        position: absolute;
        left: 10px;
        top: 6px;
        font-size: 14px;
        font-weight: 600;
        color: #cd1352;
        pointer-events: none;
        transition: transform 0.2s ease, font-size 0.2s ease;
        font-family: 'Montserrat', sans-serif;
    }
    .order-form input:focus + label,
    .order-form input:not(:placeholder-shown) + label {
        transform: translateY(-24px);
        font-size: 12px;
        color: #3b2675;
    }
    .btn-add-inline {
        background-color: #cd1352;
        color: white;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    .btn-add-inline:hover {
        background-color: #a0113f;
    }
    .btn-link {
        margin-left: 20px;
        font-size: 16px;
        color: #3b2675;
        font-weight: 700;
        text-decoration: underline;
        cursor: pointer;
        font-family: 'Montserrat', sans-serif;
        vertical-align: middle;
    }
    .error-message {
        color: #cd1352;
        font-size: 13px;
        margin-top: 6px;
        font-family: 'Open Sans', Arial, sans-serif;
    }
</style>
