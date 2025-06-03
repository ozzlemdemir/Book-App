<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Siparişler</title>
    <link rel="stylesheet" href="{{ asset('css/adminorders.css') }}">
</head>
<body>


<nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
         <span class="welcome-text" id="welcome-message">Hoş geldiniz, {{ Auth::user()->name }}</span>
    </div>

    <div class="navbar-right">
    <div class="link-group close-group">
        <img src="{{ asset('images/books.png') }}" alt="Book Icon" class="nav-icon book-icon">
        <a href="{{ route('admin.availableBooks') }}">Satıştaki Kitaplar</a>
        <span class="divider">|</span>
        <a href="{{ route('admin.soldBooks') }}">Satılan Kitaplar</a>
    </div>

    <div class="link-group normal-group">
        <img src="{{ asset('images/orders.png') }}" alt="Orders Icon" class="nav-icon orders-icon">
        <a href="{{ route('admin.orders') }}">Siparişler</a>
        <a href="/admin/earnings">
            <img src="{{ asset('images/coins.png') }}" class="nav-icon">Kazanç
        </a>
        <a href="{{ route('admin.profile') }}">
            <img src="{{ asset('images/seller.png') }}" class="nav-icon" alt="Profil">
            <span>Profilim</span>
        </a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
   style="font-size: 16px; display: flex; align-items: center; text-decoration: none; cursor: pointer;">
    <img src="{{ asset('images/logout.png') }}" class="nav-icon" alt="Çıkış Yap İkonu">
    <span style="margin-left: 5px;">Çıkış Yap</span>
</a>
    </div>
</div>
</nav>


<div class="content">
    <h2>Siparişler</h2>

    @forelse ($orders as $order)
        <div class="order-card">
            <p>Kullanıcı: {{ $order->user->name }}</p>
            <p>Adres: {{ $order->user->address }}</p>
            <p>Toplam Tutar: {{ $order->total_price }} ₺</p>
            <p>Tarih: {{ $order->created_at->format('d.m.Y H:i') }}</p>

            <h4>Ürünler:</h4>
            <ul>
                @foreach ($order->orderItems as $item)
                    <li>
                        {{ $item->product->name }} - {{ $item->quantity }} adet - {{ $item->price }} ₺
                        <div class="btn-group">
                            
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