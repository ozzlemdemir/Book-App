<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Satılan Kitaplar</title>
    <link rel="stylesheet" href="{{ asset('css/sold_books.css') }}">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('admin.profile') }}">
            <img src="{{ asset('images/seller.png') }}" alt="Admin" class="nav-icon"> 
        </a>
        <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
    </div>
    <div class="navbar-right">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/add-book.png') }}" class="nav-icon">Tüm Kitaplar
        </a>
        <span class="divider">|</span>
         <a href="{{ route('admin.availableBooks') }}">
        <img src="{{ asset('images/books.png') }}" alt="Book Icon" class="nav-icon book-icon">    
        Satıştaki Kitaplar</a>
        <a href="{{ route('admin.orders') }}">
        <img src="{{ asset('images/orders.png') }}" alt="Orders Icon" class="nav-icon orders-icon">    
        Siparişler</a>
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
</nav>

<!-- Content -->
<div class="content">
    <h2>Satılan Kitaplar</h2>

    <div class="book-list">
        @forelse ($products as $product)
            <div class="book-card">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <p>Satış Fiyatı: {{ $product->price }} TL</p>
            </div>
        @empty
            <p>Satılmış kitap bulunmamaktadır.</p>
        @endforelse
    </div>
</div>

</body>
</html>