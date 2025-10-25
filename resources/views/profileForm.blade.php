<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Профиль пользователя</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&family=Open+Sans&display=swap" rel="stylesheet" />
</head>
<body>
<header>
    <a href={{route('catalog')}}>Каталог</a>
    <a href={{route('cart')}}>Корзина</a>
    <a href={{route('logout')}}>Выйти</a>
</header>
<main>
    <img src="{{ $user->image ?? 'default-profile.png' }}" alt="Фото профиля" class="profile-image" />
    <div class="profile-name">{{ $user->name }}</div>
    <div class="profile-email">{{ $user->email }}</div>
    <a href={{route('editProfile')}}>
        <button class="edit-button">Редактировать профиль</button>
    </a>
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
        max-width: 400px;
        margin: 60px auto;
        background: white;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(86,86,87,0.3);
        padding: 30px;
        text-align: center;
    }
    .profile-image {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(74,51,152,0.15);
    }
    .profile-name {
        font-family: 'Montserrat', sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #3b2675;
        margin-bottom: 8px;
    }
    .profile-email {
        font-size: 16px;
        color: #5c5c5c;
        margin-bottom: 24px;
    }
    .edit-button {
        background-color: #cd1352;
        border: none;
        color: white;
        padding: 10px 24px;
        font-size: 16px;
        font-weight: 700;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .edit-button:hover {
        background-color: #a31040;
    }
</style>
</body>
</html>

