<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kazançlar</title>
    <link rel="stylesheet" href="{{ asset('css/earnings.css') }}"> 
</head>
<body>

<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('admin.profile') }}">
            <img src="{{ asset('images/seller.png') }}" alt="Admin" class="nav-icon seller-icon"> 
        </a>
        <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
    </div>

    <div class="navbar-right">
    <div class="link-group close-group">
         <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/add-book.png') }}" class="nav-icon">Tüm Kitaplar
        </a>
        <span class="divider">|</span>
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
    <h2>Satılan Kitapların Kazancı</h2>

    @if($soldProducts->isEmpty())
        <p>Satılan kitap bulunmamaktadır.</p>
    @else
        <ul>
@foreach($soldProducts as $book)
    <li>
        Kitap Adı: {{ $book->name }} — Fiyat: {{ number_format($book->price, 2, ',', '.') }} ₺
    </li>
@endforeach
</ul>

<p>Toplam Kazanç: {{ number_format($totalEarnings, 2, ',', '.') }} ₺</p>
    @endif
</div>

</body>
</html>