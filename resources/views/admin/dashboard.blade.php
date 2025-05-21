<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Satıcı Paneli</title>
    <link rel="stylesheet" href="{{ asset('css/admindashboard.css') }}">
   
</head>
<body>

    <nav class="navbar">
        <div class="navbar-left">
            <img src="{{ asset('images/seller-icon.jpg') }}" alt="Satıcı İkonu" class="seller-icon">
           <span>Hoş geldiniz, {{ Auth::user()->name }}</span>

        </div>
        <div class="navbar-right">
            <a href="#">Satıştaki Kitaplar</a>
            <a href="#">Satılan Kitaplar</a>
            <a href="#"><img src="{{ asset('images/coins.jpg') }}" class="nav-icon">Kazanç</a>
            <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.jpg') }}" class="nav-icon">Çıkış Yap</a>
        </div>
    </nav>

    <div class="content">
        <div class="product-list" id="productList">
            @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ asset($product->image) }}" alt="Kitap Görseli" width="150">
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <p class="product-price">{{ number_format($product->price, 2) }} ₺</p>
                        <div class="btn-group">
                            <button class="btn btn-update" onclick="toggleUpdateForm({{ $product->id }})">Güncelle</button>
                            <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Emin misiniz?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-delete">Sil</button>
</form>
                        </div>
                        <form id="updateForm-{{ $product->id }}" action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" style="display:none; margin-top:10px;">
                @csrf
                <label>Başlık:</label>
                <input type="text" name="name" value="{{ $product->name }}" required>

                <label>Açıklama:</label>
                <textarea name="description" rows="2" required>{{ $product->description }}</textarea>

                <label>Fiyat:</label>
                <input type="number" step="0.01" name="price" value="{{ $product->price }}" required>

                <label>Yeni Görsel (opsiyonel):</label>
                <input type="file" name="image" accept="image/*">

                <button type="submit" class="btn btn-update" style="margin-top:10px;">Kaydet</button>
            </form>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="add-product-btn" id="addProductBtn">+</button>

        <form id="addProductForm" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Kitap Başlığı</label>
            <input type="text" name="name" id="name" required>

            <label for="description">Açıklama</label>
            <textarea name="description" id="description" rows="3" required></textarea>

            <label for="price">Fiyat (₺)</label>
            <input type="number" step="0.01" name="price" id="price" required>

            <label for="image">Kitap Görseli (opsiyonel)</label>
            <input type="file" name="image" id="image" accept="image/*">

            <button type="submit">Kitap Ekle</button>
        </form>
    </div>

    <script>
        const addBtn = document.getElementById('addProductBtn');
        const form = document.getElementById('addProductForm');

        addBtn.addEventListener('click', () => {
            if(form.style.display === 'flex') {
                form.style.display = 'none';
            } else {
                form.style.display = 'flex';
                form.scrollIntoView({behavior: 'smooth'});
            }
        });
    </script>
    <script>
    function toggleUpdateForm(id) {
        const form = document.getElementById('updateForm-' + id);
        if (form.style.display === 'block') {
            form.style.display = 'none';
        } else {
            form.style.display = 'block';
            form.scrollIntoView({behavior: 'smooth'});
        }
    }
</script>

</body>
</html>