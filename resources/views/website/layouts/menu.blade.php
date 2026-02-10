<nav class="navbar navbar-expand-lg navbar-dark">
               <div class="container">
                  <div class="navbar-header">
                     <a class="navbar-brand" href="index.html"><img src="img/logo.png" style="max-width:100px" alt="BEFIT logo"></a>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                     </button>
                  </div>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                     <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                           <a class="nav-link " href="{{url('/')}}" >
                           Inicio<span class="sr-only"></span>
                           </a>
                        </li>
                        <li class="nav-item ">
                           <a class="nav-link " href="{{url('tienda')}}"  >
                           Tienda<span class="sr-only"></span>
                           </a>
                        </li>

                        <li class="nav-item ">
                           <a class="nav-link " href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Membresias<span class="sr-only"></span>
                           </a>
                        </li>

                        <li class="nav-item ">
                           <a class="nav-link " href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Contacto<span class="sr-only"></span>
                           </a>
                        </li>
                        <li class="nav-item btnLogin">
                        @guest
                           <a class="nav-link" href="{{ route('login') }}">
                                 Acceder
                           </a>
                        @else
                           @if(Auth::user()->rol()=='SUPER_ADMIN')
                              <a class="nav-link" href="{{ url('admon/home') }}">
                                    Mi Cuenta
                              </a>
                           @else
                               <a class="nav-link" href="{{ url('app') }}">
                                    Mi Cuenta
                              </a>
                           @endif
                        @endguest
                     </li>

                        <li class="nav-item d-none d-lg-block ">
                           <div class="icon-menu">
                           <ul>
                              <li>|</li>
                              <li><a href="{{route('website.carrito.index')}}"><i class="fa fa-shopping-cart"></i></a></li>
                           </ul>
                           </div>
                        </li>
                       
                    
                     </ul>
                  </div>
               </div>
            </nav>