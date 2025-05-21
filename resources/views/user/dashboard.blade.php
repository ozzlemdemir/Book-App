<!DOCTYPE html>
<html>
<head>
    <title>Alıcı Paneli</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css')}}">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <img src="{{ asset('images/seller-icon.jpg') }}" alt="Kullanıcı ikonu" class="seller-icon">
            <span>Hoş geldiniz, {{ Auth::user()->name }}</span>

        </div>
        <div class="navbar-right">
            <a href="#"><img src="{{ asset('images/shopping-cart.jpg') }}" class="nav-icon">Sepet</a>
            <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.jpg') }}" class="nav-icon">Çıkış Yap</a>
        </div>
    </nav>

    <h2>Satışta Olan Kitaplar</h2>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

@foreach($products as $product)
    <div class="product-card">
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
        <div class="product-info">
            <h3>{{ $product->name }}</h3>
            <p><strong>{{ number_format($product->price, 2) }} ₺</strong></p>
            <div class="btn-group">
        <form action="{{ route('user.cart.add', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-add-to-cart" style="padding:10px 18px; font-size:16px; max-height:48px;">
            <img src="{{ asset('images/shopping-bag.jpg') }}" alt="Sepete Ekle" style="width:22px; height:22px; object-fit: contain; vertical-align: middle; margin-right:8px;"> Sepete Ekle
            </button>
        </form>

        <a href="{{ route('user.products.show', $product->id) }}" class="btn btn-view" style="padding:10px 18px; font-size:16px; max-height:48px; display: inline-flex; align-items: center; gap: 8px;">
        <img src="{{ asset('images/overview.jpg') }}" alt="İncele" style="width:22px; height:22px; object-fit: contain; vertical-align: middle;"> İncele
        </a>

            </div>
        </div>
    </div>
@endforeach
    
</body>
</html>