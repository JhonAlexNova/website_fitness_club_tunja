@extends("website.layouts.app")
@push("page_styles")
<link rel="stylesheet" href="{{url('template/website/assets/css/carrito.css')}}">
<style>
body {
    font-family: 'Montserrat', 'Poppins', sans-serif;
    background: radial-gradient(circle at top, #0f0f1f, #050505);
    color: #ffffff;
    min-height: 100vh;
}

.main-content {
    padding: 32px 0 96px;
    overflow: hidden;
}

/* TÍTULOS */
.title-section { text-align: center; margin-bottom: 50px; }

.main-title {
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    font-weight: 800;
    letter-spacing: 3px;
    text-transform: uppercase;
    background: linear-gradient(90deg, #8a2be2, #00f0ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 10px;
}

.subtitle {
    font-size: clamp(1.25rem, 3vw, 2rem);
    font-weight: 900;
    text-transform: uppercase;
    text-align: center;
    color: #fff;
    text-shadow: 0 0 15px rgba(138, 43, 226, 0.6);
}

/* GRID DE CARDS */
.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(100%, 320px), 1fr));
    gap: 25px;
    margin-top: 30px;
}

/* CARD */
.membership-card {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    transition: 0.3s;
    background: rgba(20, 20, 40, 0.6);
    backdrop-filter: blur(15px);
    padding: 18px 22px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.4);
    border-left: 4px solid #00f0ff;
    min-width: 0;
    opacity: 0;
    transform: translateY(40px);
    animation: cardFadeIn 0.8s ease forwards;
}

.membership-card:nth-child(even) { border-left-color: #8a2be2; }
.membership-card:nth-child(1) { animation-delay: 0.1s; }
.membership-card:nth-child(2) { animation-delay: 0.2s; }
.membership-card:nth-child(3) { animation-delay: 0.3s; }
.membership-card:nth-child(4) { animation-delay: 0.4s; }

.membership-card:hover { transform: translateY(-8px); }

.membership-card.featured {
    border: 2px solid #8a2be2;
    box-shadow: 0 0 20px rgba(138, 43, 226, 0.4);
}

/* BADGE POPULAR */
.popular-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(90deg, #8a2be2, #00f0ff);
    color: white;
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.card-content { text-align: center; }

/* NOMBRE DEL PLAN */
.plan-title {
    font-size: 1.6rem;
    font-weight: 800;
    color: #ffffff;
    text-align: center;
    margin-bottom: 15px;
    text-transform: uppercase;
}

/* PRECIO */
.price {
    font-size: 2.8rem;
    font-weight: 900;
    background: linear-gradient(90deg, #00f0ff, #8a2be2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 5px;
}

.multi-price .price-main {
    font-size: 2rem;
    margin-bottom: 5px;
}
.multi-price .price-alt {
    font-size: 1.5rem;
}

.plan-subtitle {
    font-size: 0.9rem;
    color: #aaa;
    margin-bottom: 20px;
}

/* FEATURES */
.features-list { list-style: none; text-align: left; margin-bottom: 25px; }

.feature {
    display: flex;
    align-items: flex-start;
    padding: 5px 0;
    font-size: 0.9rem;
    gap: 10px;
}

.feature .text {
    min-width: 0;
    overflow-wrap: anywhere;
}

.check, .cross {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: bold;
    flex-shrink: 0;
    margin-top: 1px;
}

.feature.included .check {
    background: linear-gradient(45deg, #27ae60, #2ecc71);
    color: white;
}

.feature.excluded { color: #555; }
.feature.excluded .cross {
    background: linear-gradient(45deg, #e74c3c, #c0392b);
    color: white;
}

/* BANDERAS */
.flags-container {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin: 20px 0;
    padding: 15px 0;
    border-top: 1px solid rgba(255,255,255,0.1);
}

.flag {
    width: 35px;
    height: 25px;
    border-radius: 4px;
    border: 1px solid rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: transform 0.3s;
}
.flag:hover { transform: scale(1.1); }
.flag.colombia {
    background: linear-gradient(to bottom,
        #ffcd00 0%, #ffcd00 50%,
        #0033a0 50%, #0033a0 75%,
        #ce1126 75%, #ce1126 100%);
}
.flag.mexico {
    background: linear-gradient(to right,
        #006847 0%, #006847 33%,
        white 33%, white 66%,
        #ce1126 66%, #ce1126 100%);
}
.flag.canada {
    background: linear-gradient(to right,
        #ff0000 0%, #ff0000 25%,
        white 25%, white 75%,
        #ff0000 75%, #ff0000 100%);
    font-size: 14px;
}

/* BOTÓN */
.cta-button {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: 0.3s;
    color: white;
}

.cta-button.yellow {
    background: linear-gradient(90deg, #8a2be2, #00f0ff);
    box-shadow: 0 8px 20px rgba(138,43,226,0.3);
}

.cta-button.pink {
    background: linear-gradient(90deg, #fc25dc, #f01919);
    box-shadow: 0 8px 20px rgba(252,37,220,0.3);
}

.cta-button:hover { transform: translateY(-3px); opacity: 0.9; }

@keyframes cardFadeIn {
    to { opacity: 1; transform: translateY(0); }
}

@media (prefers-reduced-motion: reduce) {
    .membership-card {
        animation: none;
        opacity: 1;
        transform: none;
    }
}

@media (max-width: 768px) {
    .main-title { font-size: 1.8rem; }
    .subtitle { font-size: 1.4rem; }
    .cards-grid { grid-template-columns: 1fr; }
}
/* Cards igual altura */
.cards-grid {
    align-items: stretch;
}
.membership-card {
    display: flex;
    flex-direction: column;
}
.card-content {
    display: flex;
    flex-direction: column;
    flex: 1;
}
.features-list {
    flex: 1;
}

/* Precio completo visible */
.price {
    font-size: 2.2rem;
    overflow: visible;
    line-height: 1.2;
    padding-bottom: 5px;
}

/* Todos los botones igual color */
.cta-button.yellow,
.cta-button.pink {
    background: linear-gradient(90deg, #8a2be2, #00f0ff);
    box-shadow: 0 8px 20px rgba(138,43,226,0.3);
}

/* Título visible */
.main-title {
    font-size: 2.8rem;
    background: linear-gradient(90deg, #8a2be2, #00f0ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    opacity: 1 !important;
    position: relative;
    z-index: 10;
}
@media (max-width: 768px) {
    .main-title { font-size: 1.8rem; }
    .subtitle { font-size: 1.3rem; }
    .cards-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    .membership-card { padding: 20px; }
    .price { font-size: 2rem; }
}
</style>
@endpush
@section("title","Membresias")
@section("content")
    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Title Section -->
            <section class="title-section">
                <h1 class="main-title">FITNESS CLUB COLOMBIA</h1>
                <h2 class="subtitle">MEMBRESÍAS PROMOCIONALES VIP</h2>
            </section>

            <!-- Membership Cards -->
            <section class="membership-section">
                <div class="cards-grid">
                    
                    <!-- Card 1: Semestral Elite -->
                    <div class="membership-card" data-plan="semestral">
                        <div class="card-content">
                            <h3 class="plan-title">SPORT</h3>
                            <div class="price">69.900</div>
                            
                            <ul class="features-list">
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Entrenamiento Asesorado</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Seguimiento de tu progreso</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Horario libre</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card 2: Elite Anual -->
                    <div class="membership-card featured" data-plan="anual">
                        <div class="popular-badge">POPULAR</div>
                        <div class="card-content">
                            <h3 class="plan-title">ELITE</h3>
                            <div class="price">$90.000</div>
                            
                            <ul class="features-list">
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Personal Training</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Entrenamiento Funcional</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Seguimiento de tu progreso</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Clases grupales</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Horario Especial</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card 3: Elite Free 
                    <div class="membership-card" data-plan="free">
                        <div class="card-content">
                            <h3 class="plan-title">ELITE FREE</h3>
                            <div class="price">$600.000</div>
                            <p class="plan-subtitle">Membresía elite por $50.000 mensuales:</p>
                            
                            <ul class="features-list">
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Personal Training</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">App Fitness Club</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Valoración física</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">App fitness Club</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Pausas Activas, Personales y Empresariales</span>
                                </li>
                            </ul>
                        </div>
                    </div>-->


                </div>
            </section>
        </div>
    </main>

    <!-- Notification Container -->
    <div id="notification-container"></div>

    <script src="script.js"></script>
@endsection
