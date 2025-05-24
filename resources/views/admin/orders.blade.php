<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Siparişler</title>
    <link rel="stylesheet" href="{{ asset('css/adminorders.css') }}">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('images/seller-icon.jpg') }}" alt="Satıcı İkonu" class="seller-icon">
        <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
    </div>
    <div class="navbar-right">
        <a href="{{ route('admin.dashboard') }}">Satıştaki Kitaplar</a>
        <a href="{{ route('admin.soldBooks') }}">Satılan Kitaplar</a>
        <a href="{{ route('admin.orders') }}">Siparişler</a>
        <a href="#"><img src="{{ asset('images/coins.jpg') }}" class="nav-icon">Kazanç</a>
        <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.jpg') }}" class="nav-icon">Çıkış Yap</a>
    </div>
</nav>

<!-- Content -->
<div class="content">
    <h2>Siparişler</h2>

    @forelse ($orders as $order)
        <div class="order-card">
            <h3>Sipariş ID: {{ $order->id }}</h3>
            <p>Kullanıcı: {{ $order->user->name }}</p>
            <p>Toplam Tutar: {{ $order->total_price }} ₺</p>
            <p>Tarih: {{ $order->created_at->format('d.m.Y H:i') }}</p>

            <h4>Ürünler:</h4>
            <ul>
                @foreach ($order->orderItems as $item)
                    <li>
                        {{ $item->product->name }} - {{ $item->quantity }} adet - {{ $item->price }} ₺
                        <div class="btn-group">
                            <form action="{{ route('admin.updateOrderState', [$item->id, 1]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn">Alındı</button>
                            </form>
                            <form action="{{ route('admin.updateOrderState', [$item->id, 2]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn">Hazırlanıyor</button>
                            </form>
                            <form action="{{ route('admin.updateOrderState', [$item->id, 3]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn">Kargoya Verildi</button>
                            </form>
                        </div>
                        <p>Durum:
                            @if ($item->state == 1)
                                Alındı
                            @elseif ($item->state == 2)
                                Hazırlanıyor
                            @elseif ($item->state == 3)
                                Kargoya Verildi
                            @endif
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
    @empty
        <p>Henüz sipariş yok.</p>
    @endforelse
</div>

</body>
</html>
