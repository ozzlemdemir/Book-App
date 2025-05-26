<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }} - Detaylar</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
</head>
<body>

    <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('user.profile') }}">
            <img src="{{ asset('images/user.png') }}" class="nav-icon" alt="Profil İkonu">
        </a>
            <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
        </div>
        <div class="navbar-right">
            <a href="{{ route('user.orders') }}"><img src="{{ asset('images/orders.png') }}" class="nav-icon" alt="Siparişlerim İkonu">Siparişlerim</a>
            <a href="{{ route('user.cart') }}"><img src="{{ asset('images/cart.png') }}" class="nav-icon">Sepet</a>
            <a href="{{ route('logout') }}"><img src="{{ asset('images/logout.png') }}" class="nav-icon"> Çıkış Yap</a>
        </div>
    </nav>

    <div class="product-detail-container">
        <h2>{{ $product->name }}</h2>
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
        <p><strong>Açıklama:</strong> {{ $product->description ?? 'Açıklama bulunmamaktadır.' }}</p>
        <p><strong>Satıcı:</strong> {{ $product->user->name ?? 'Bilinmiyor'}}</p>
        <p><strong>Fiyat:</strong> {{ number_format($product->price, 2) }} ₺</p>
        <a href="{{ route('user.dashboard') }}" class="btn btn-view" style="margin-top: 15px;">Geri Dön</a>
    </div>

</body>
</html>