<nav class="navbar navbar-expand-lg navbar-dark" aria-label="Navegación principal">
   <div class="container">
      <div class="navbar-header">
         <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ url('img/logo10.png') }}" style="max-width:100px" alt="Logo Fitness Club Tunja">
         </a>

         <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
      </div>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
         <ul class="navbar-nav ml-auto">

            <li class="nav-item {{ request()->routeIs('website.home.*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ url('/') }}">
                  Inicio
               </a>
            </li>


            <!-- TIENDA -->
            <li class="nav-item {{ request()->routeIs('tienda.*') || request()->routeIs('website.productos.*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ url('tienda') }}">
                  Tienda
               </a>
            </li>

            <!-- MEMBRESIAS -->
            <li class="nav-item {{ request()->routeIs('website.membresias.*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ route('website.membresias.index') }}">
                  Membresías
               </a>
            </li>

            <!-- CAFETERÍA -->
            <li class="nav-item {{ request()->routeIs('website.cafeteria.*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ route('website.cafeteria.index') }}">
                  Cafetería
               </a>
            </li>

            <!-- CONTACTO -->
            <li class="nav-item">
               <a class="nav-link" href="{{ url('/') }}#contacto">
                  Contacto
               </a>
            </li>

            <li class="nav-item nav-cart-item">
               <a class="nav-link nav-cart-link" href="{{ route('website.carrito.index') }}" aria-label="Ver carrito de compras">
                  <i class="fa fa-shopping-cart"></i> Carrito
                  <span id="website-cart-count" class="cart-count" hidden>0</span>
               </a>
            </li>

            <li class="nav-item btnLogin">
               <a class="nav-link" href="https://dashboard.fitnessclubcolombia.com/">
                  Acceder
               </a>
            </li>

            

         </ul>
      </div>
   </div>
</nav>
<script>
(function () {
   function updateCartBadge() {
      var badge = document.getElementById('website-cart-count');
      if (!badge) return;
      var items = [];
      try { items = JSON.parse(localStorage.getItem('fitness_club_tunja_cart') || '[]'); } catch (e) { items = []; }
      var count = items.reduce(function (sum, item) { return sum + Math.max(1, Number(item.quantity || 1)); }, 0);
      badge.textContent = count;
      badge.hidden = count === 0;
   }
   document.addEventListener('DOMContentLoaded', updateCartBadge);
   window.addEventListener('storage', updateCartBadge);
})();
</script>
