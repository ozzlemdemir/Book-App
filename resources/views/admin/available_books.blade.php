<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Satıştaki Kitaplar</title>
    <link rel="stylesheet" href="{{ asset('css/available_books.css') }}">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('images/seller-icon.jpg') }}" alt="Satıcı İkonu" class="seller-icon">
        <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
    </div>
    <div class="navbar-right">
        <a href="{{ route('admin.dashboard') }}">Tüm Kitaplar</a>
        <a href="{{ route('admin.soldBooks') }}">Satılan Kitaplar</a>
       <a href="{{ route('admin.earnings') }}">Kazanç</a>
     <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.jpg') }}" class="nav-icon">Çıkış Yap</a>
    </div>
</nav>


<!-- Content -->
<div class="content">

    <div class="book-list">
       @if($products->where('is_sold', 0)->count())
    @foreach($products->where('is_sold', 0) as $product)
        <div class="book-card">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <p>Fiyat: {{ $product->price }} TL</p>
            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-update">Güncelle</a>
        </div>
    @endforeach
@else
    <p>Satışta kitap bulunmamaktadır.</p>
@endif
    </div>
</div>

</body>
</html>
