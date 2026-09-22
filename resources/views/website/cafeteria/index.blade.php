@extends("website.layouts.app")
@section("seo_description", "Conoce la cafetería de Fitness Club Tunja: opciones para recargar energía antes o después de tu entrenamiento.")
@section("seo_canonical", url('cafeteria'))
@section("title", "Cafetería")
@section("content")
<style>
    #cafeteria-section {
        background: radial-gradient(circle at top, #0f0f1f, #050505);
        padding: 56px 0 96px;
    }

    #cafeteria-section .title-section {
        text-align: center;
        margin-bottom: 50px;
        width: 100%;
        min-width: 0;
    }

    #cafeteria-section .main-title {
        font-size: clamp(1.8rem, 6vw, 2.6rem);
        font-weight: 900;
        text-transform: uppercase;
        background: linear-gradient(90deg, #8a2be2, #00f0ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
        width: 100%;
        overflow-wrap: anywhere !important;
        word-break: normal !important;
        white-space: normal !important;
    }

    #cafeteria-section .subtitle {
        color: #aaa;
        font-size: 1rem;
        line-height: 1.5;
        max-width: 620px;
        margin: 0 auto;
        overflow-wrap: anywhere !important;
        word-break: normal !important;
        white-space: normal !important;
        white-space: normal;
    }

    #cafeteria-section .category-block {
        margin-bottom: 55px;
    }

    #cafeteria-section .category-title {
        font-size: 1.5rem;
        font-weight: 800;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: 8px;
        padding-left: 4px;
        border-left: 4px solid #00f0ff;
        padding-left: 14px;
    }

    #cafeteria-section .category-divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #00f0ff, #8a2be2);
        border-radius: 3px;
        margin: 0 0 30px 14px;
    }

    #cafeteria-section .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(100%, 260px), 1fr));
        gap: 25px;
    }

    #cafeteria-section .container,
    #cafeteria-section .category-block {
        min-width: 0;
    }

    #cafeteria-section .product-card {
        background: rgba(20, 20, 40, 0.8);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        overflow: hidden;
        border-left: 4px solid #00f0ff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        transition: 0.3s;
        display: flex;
        flex-direction: column;
    }

    #cafeteria-section .product-card:nth-child(even) {
        border-left-color: #8a2be2;
    }

    #cafeteria-section .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    }

    #cafeteria-section .product-img {
        width: 100%;
        height: 220px;
        overflow: hidden;
        background: #111;
    }

    #cafeteria-section .product-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    #cafeteria-section .product-body {
        padding: 20px 22px;
        text-align: center;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    #cafeteria-section .product-name {
        font-size: 1.2rem;
        font-weight: 800;
        color: #fff;
        text-transform: uppercase;
        margin-bottom: 10px;
        overflow-wrap: anywhere;
    }

    #cafeteria-section .product-desc {
        color: #aaa;
        font-size: 0.9rem;
        flex: 1;
        margin-bottom: 15px;
        overflow-wrap: anywhere;
    }

    #cafeteria-section .product-price {
        font-size: 1.6rem;
        font-weight: 900;
        background: linear-gradient(90deg, #00f0ff, #8a2be2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    #cafeteria-section .empty-state {
        text-align: center;
        color: #aaa;
        padding: 42px 20px;
        font-size: 1.1rem;
        max-width: 680px;
        margin: 0 auto;
        overflow-wrap: anywhere;
    }

    #cafeteria-section .empty-category {
        text-align: center;
        color: #777;
        padding: 20px 0 10px;
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        #cafeteria-section { width: 100vw; padding: 36px 0 70px; }
        #cafeteria-section .title-section,
        #cafeteria-section .main-title,
        #cafeteria-section .subtitle { width: calc(100vw - 30px); max-width: calc(100vw - 30px); margin-left: auto; margin-right: auto; }
        #cafeteria-section .main-title { font-size: 1.8rem; }
        #cafeteria-section .subtitle { font-size: .78rem !important; line-height: 1.45; width: 260px !important; }
        #cafeteria-section .empty-state { width: min(100%, 300px) !important; font-size: .95rem; }
        #cafeteria-section .products-grid { grid-template-columns: 1fr; }
        #cafeteria-section .category-block { margin-bottom: 40px; }
    }
</style>

<div id="cafeteria-section">
    <div class="container">
        <div class="title-section">
            <h1 class="main-title">Cafetería</h1>
            <p class="subtitle">Recarga energía antes o después de tu entrenamiento</p>
        </div>

        @if($categorias->count())
            @foreach($categorias as $categoria)
                <div class="category-block">
                    <h2 class="category-title">{{ $categoria->nombre }}</h2>
                    <div class="category-divider"></div>

                    @if($categoria->coffeeProducts->count())
                        <div class="products-grid">
                            @foreach($categoria->coffeeProducts as $producto)
                                <div class="product-card">
                                    @if($producto->imagen)
                                        <div class="product-img">
                                            <img src="{{ url('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                                        </div>
                                    @endif
                                    <div class="product-body">
                                        <h3 class="product-name">{{ $producto->nombre }}</h3>
                                        <p class="product-desc">{{ $producto->descripcion }}</p>
                                        <div class="product-price">${{ number_format($producto->precio, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-category">Sin productos en esta categoría por ahora.</div>
                    @endif
                </div>
            @endforeach
        @else
            <div class="empty-state">
                Muy pronto tendremos productos disponibles. ¡Vuelve pronto!
            </div>
        @endif
    </div>
</div>
@endsection
