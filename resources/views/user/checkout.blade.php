<!DOCTYPE html>
<html>
<head>
    <title>Satın Alma</title>
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
        <a href="{{ route('user.cart') }}"><img src="{{ asset('images/shopping-cart.png') }}" class="nav-icon">Sepet</a>
        <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.png') }}" class="nav-icon">Çıkış Yap</a>
    </div>
</nav>

<h2 class="form-title">Satın Alma Bilgileri</h2>

<div class="form-container">
    @if (session('message'))
        <div class="message-box">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('user.purchase.confirm') }}" method="POST">
        @csrf
        <div>
            <label for="card_number">Kart Numarası</label>
            <input type="text" id="card_number" name="card_number" maxlength="16" required value="{{ old('card_number') }}">
            @error('card_number')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="expiry_date">Son Kullanma Tarihi (MM/YY)</label>
            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required value="{{ old('expiry_date') }}">
            @error('expiry_date')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" maxlength="3" required value="{{ old('cvv') }}">
            @error('cvv')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Siparişi Onayla</button>
            <a href="{{ route('user.cart') }}" class="btn btn-secondary">Vazgeç</a>
        </div>
    </form>
</div>

</body>
</html>