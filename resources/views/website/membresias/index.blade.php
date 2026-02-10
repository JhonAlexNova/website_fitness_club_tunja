@extends("website.layouts.app")
@push("page_styles")
<link rel="stylesheet" href="{{url('template/website/assets/css/carrito.css')}}">
<style>
    /* Reset y configuración base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 50%, #2c3e50 100%);
    color: #ffffff;
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 80%, rgba(233, 30, 99, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(156, 39, 176, 0.1) 0%, transparent 50%);
    pointer-events: none;
    z-index: -1;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Header */
.header {
    padding: 30px 0;
    position: relative;
    z-index: 100;
}

.nav-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    display: flex;
    align-items: center;
    gap: 20px;
}

.logo-circle {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(45deg, #e91e63, #9c27b0);
    display: flex;
    align-items: center;
    justify-content: center;
    animation: logoFloat 3s ease-in-out infinite;
    position: relative;
}

.logo-inner {
    width: 45px;
    height: 45px;
    background: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-dot {
    width: 20px;
    height: 20px;
    background: linear-gradient(45deg, #e91e63, #9c27b0);
    border-radius: 50%;
    animation: logoPulse 2s ease-in-out infinite;
}

.logo-text h3 {
    font-size: 1.4rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 2px;
}

.logo-text span {
    font-size: 0.9rem;
    color: #bdc3c7;
    font-weight: 400;
}

.signup-btn {
    background: linear-gradient(45deg, #e91e63, #9c27b0);
    border: none;
    padding: 15px 35px;
    border-radius: 30px;
    color: white;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(233, 30, 99, 0.3);
    position: relative;
    overflow: hidden;
}

.signup-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(233, 30, 99, 0.4);
}

.signup-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s;
}

.signup-btn:hover::before {
    left: 100%;
}

/* Main Content */
.main-content {
    padding: 20px 0 80px;
}

.title-section {
    text-align: center;
    margin-bottom: 60px;
}

.main-title {
    font-size: 3.5rem;
    font-weight: 800;
    background: linear-gradient(45deg, #e91e63, #9c27b0, #673ab7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 15px;
    animation: titleGlow 3s ease-in-out infinite alternate;
}

.subtitle {
    font-size: 2.2rem;
    font-weight: 600;
    color: #ecf0f1;
    margin-bottom: 20px;
}

/* Membership Section */
.membership-section {
    margin-top: 40px;
}

.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.membership-card {
    background: rgba(44, 62, 80, 0.9);
    border-radius: 25px;
    padding: 35px;
    position: relative;
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    overflow: hidden;
    opacity: 0;
    transform: translateY(50px);
    animation: cardFadeIn 0.8s ease forwards;
}

.membership-card:nth-child(1) { animation-delay: 0.1s; }
.membership-card:nth-child(2) { animation-delay: 0.2s; }
.membership-card:nth-child(3) { animation-delay: 0.3s; }
.membership-card:nth-child(4) { animation-delay: 0.4s; }

.membership-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(233, 30, 99, 0.05), rgba(156, 39, 176, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.membership-card:hover::before {
    opacity: 1;
}

.membership-card:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    border-color: rgba(233, 30, 99, 0.3);
}

.membership-card.featured {
    border: 2px solid #e91e63;
    box-shadow: 0 15px 40px rgba(233, 30, 99, 0.2);
}

.popular-badge {
    position: absolute;
    top: -10px;
    right: 30px;
    background: linear-gradient(45deg, #e91e63, #9c27b0);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.card-content {
    text-align: center;
    position: relative;
    z-index: 2;
}

.plan-title {
    font-size: 1.6rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 20px;
    line-height: 1.3;
}

.price {
    font-size: 3rem;
    font-weight: 800;
    color: #e91e63;
    margin-bottom: 15px;
}

.multi-price .price-main {
    font-size: 2.2rem;
    margin-bottom: 8px;
}

.multi-price .price-alt {
    font-size: 1.6rem;
    color: #9c27b0;
}

.plan-subtitle {
    font-size: 0.95rem;
    color: #bdc3c7;
    line-height: 1.5;
    margin-bottom: 25px;
}

.features-list {
    list-style: none;
    text-align: left;
    margin-bottom: 30px;
}

.feature {
    display: flex;
    align-items: flex-start;
    padding: 12px 0;
    font-size: 0.95rem;
    line-height: 1.4;
    transition: all 0.3s ease;
}

.feature:hover {
    transform: translateX(5px);
}

.check, .cross {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: bold;
    margin-right: 15px;
    flex-shrink: 0;
    margin-top: 2px;
}

.feature.included .check {
    background: linear-gradient(45deg, #27ae60, #2ecc71);
    color: white;
}

.feature.excluded {
    color: #7f8c8d;
}

.feature.excluded .cross {
    background: linear-gradient(45deg, #e74c3c, #c0392b);
    color: white;
}

.flags-container {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin: 25px 0;
    padding: 20px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.flag {
    width: 35px;
    height: 25px;
    border-radius: 4px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    transition: transform 0.3s ease;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.flag:hover {
    transform: scale(1.1);
}

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

.cta-button {
    width: 100%;
    padding: 18px;
    border: none;
    border-radius: 30px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.cta-button.yellow {
    background: linear-gradient(45deg, #f39c12, #e67e22);
    color: white;
    box-shadow: 0 8px 25px rgba(243, 156, 18, 0.3);
}

.cta-button.pink {
    background: linear-gradient(45deg, #e91e63, #9c27b0);
    color: white;
    box-shadow: 0 8px 25px rgba(233, 30, 99, 0.3);
}

.cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
}

.cta-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s;
}

.cta-button:hover::before {
    left: 100%;
}

/* Notification */
#notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
}

.notification {
    background: linear-gradient(45deg, #27ae60, #2ecc71);
    color: white;
    padding: 15px 25px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    max-width: 400px;
    font-weight: 500;
    margin-bottom: 10px;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    animation: slideIn 0.3s ease forwards;
}

/* Animations */
@keyframes logoFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes logoPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

@keyframes titleGlow {
    0% { filter: brightness(1); }
    100% { filter: brightness(1.2); }
}

@keyframes cardFadeIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    to {
        transform: translateX(0);
    }
}

/* Responsive Design */
@media (max-width: 1200px) {
    .cards-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .nav-content {
        flex-direction: column;
        gap: 20px;
    }
    
    .main-title {
        font-size: 2.5rem;
    }
    
    .subtitle {
        font-size: 1.8rem;
    }
    
    .cards-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .membership-card {
        padding: 25px;
    }
    
    .price {
        font-size: 2.5rem;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 15px;
    }
    
    .main-title {
        font-size: 2rem;
    }
    
    .subtitle {
        font-size: 1.4rem;
    }
    
    .membership-card {
        padding: 20px;
    }
    
    .logo {
        gap: 15px;
    }
    
    .logo-circle {
        width: 60px;
        height: 60px;
    }
    
    .logo-inner {
        width: 38px;
        height: 38px;
    }
    
    .logo-dot {
        width: 16px;
        height: 16px;
    }
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
                            <h3 class="plan-title">SEMESTRAL<br>ELITE</h3>
                            <div class="price">$450.000</div>
                            <p class="plan-subtitle">Membresía free por $75.000 mensuales:</p>
                            
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
                                    <span class="text">Master clases</span>
                                </li>
                                <li class="feature excluded">
                                    <span class="cross">✗</span>
                                    <span class="text">Plan de Entrenamiento</span>
                                </li>
                                <li class="feature excluded">
                                    <span class="cross">✗</span>
                                    <span class="text">Valoración</span>
                                </li>
                            </ul>
                            
                            <button class="cta-button yellow" onclick="selectPlan('semestral', 'SEMESTRAL ELITE', '$450.000')">
                                Obtener ahora
                            </button>
                        </div>
                    </div>

                    <!-- Card 2: Elite Anual -->
                    <div class="membership-card featured" data-plan="anual">
                        <div class="popular-badge">POPULAR</div>
                        <div class="card-content">
                            <h3 class="plan-title">ELITE<br>ANUAL</h3>
                            <div class="price">$769.900</div>
                            <p class="plan-subtitle">Membresía elite por $64.158 mensuales:</p>
                            
                            <ul class="features-list">
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Master clases</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Personal Training</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Plan de Entrenamiento</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">App fitness club</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Clases grupales</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">LIVE y Entrenamiento en Línea</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Pausas Activas, Personales y Empresariales</span>
                                </li>
                            </ul>
                            
                            <button class="cta-button yellow" onclick="selectPlan('anual', 'ELITE ANUAL', '$769.900')">
                                Obtener ahora
                            </button>
                        </div>
                    </div>

                    <!-- Card 3: Elite Free -->
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
                            
                            <button class="cta-button pink" onclick="selectPlan('free', 'ELITE FREE', '$600.000')">
                                Obtener ahora
                            </button>
                        </div>
                    </div>

                    <!-- Card 4: Elite World -->
                    <div class="membership-card international" data-plan="world">
                        <div class="card-content">
                            <h3 class="plan-title">MEMBRESÍA<br>ELITE WORLD</h3>
                            <div class="price multi-price">
                                <div class="price-main">$35.900 COP</div>
                                <div class="price-alt">$15 CAD</div>
                            </div>
                            
                            <ul class="features-list">
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">LIVE y Entrenamiento en Línea</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">App Fitness Club</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Plan De Entrenamiento De acuerdo a tu necesidad</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">App Fitness Club OPEN</span>
                                </li>
                                <li class="feature included">
                                    <span class="check">✓</span>
                                    <span class="text">Material Educativo exclusivo Fitness club Colombia</span>
                                </li>
                            </ul>
                            
                            <div class="flags-container">
                                <div class="flag colombia" title="Colombia"></div>
                                <div class="flag mexico" title="México"></div>
                                <div class="flag canada" title="Canadá">🍁</div>
                            </div>
                            
                            <button class="cta-button yellow" onclick="selectPlan('world', 'ELITE WORLD', '$35.900 COP')">
                                Obtener ahora
                            </button>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>

    <!-- Notification Container -->
    <div id="notification-container"></div>

    <script src="script.js"></script>
@endsection