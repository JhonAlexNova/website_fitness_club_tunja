<!DOCTYPE html>
<html lang="en">
    <head>
        <title>FITNESS CLUB CENTRO DE ACTIVIDAD FISICA</title>
        <meta charset="UTF-8" />
        <base href="https://innostudents.com/fit/">
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" type="image/png" href="images/icons/favicon.ico" />

        <link rel="stylesheet" type="text/css" href="{{ url('templates/login/vendor/bootstrap/css/bootstrap.min.css')}}" />

        <link rel="stylesheet" type="text/css" href="{{ url('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}" />

        <link rel="stylesheet" type="text/css" href="{{ url('fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}" />

        <link rel="stylesheet" type="text/css" href="{{ url('templates/login/vendor/animate/animate.css')}}" />

        <link rel="stylesheet" type="text/css" href="{{ url('templates/login/vendor/css-hamburgers/hamburgers.min.css')}}" />

        <link rel="stylesheet" type="text/css" href="{{ url('templates/login/vendor/animsition/css/animsition.min.css')}}" />

        <link rel="stylesheet" type="text/css" href="{{ url('templates/login/vendor/select2/select2.min.css')}}" />

        <link rel="stylesheet" type="text/css" href="{{ url('templates/login/vendor/daterangepicker/daterangepicker.css')}}" />

        <link rel="stylesheet" type="text/css" href="{{ url('templates/login/css/util.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ url('templates/login/css/main.css')}}" />

        <link rel="stylesheet" href="/css/login.min.css">

        <meta name="robots" content="noindex, follow" />
        <script nonce="a523d088-bd93-4176-ae53-34942a066c9d">
            (function (w, d) {
                !(function (j, k, l, m) {
                    j[l] = j[l] || {};ConfiguracionController
                    j[l].executed = [];
                    j.zaraz = { deferred: [], listeners: [] };
                    j.zaraz.q = [];
                    j.zaraz._f = function (n) {
                        return async function () {
                            var o = Array.prototype.slice.call(arguments);
                            j.zaraz.q.push({ m: n, a: o });
                        };
                    };
                    for (const p of ["track", "set", "debug"]) j.zaraz[p] = j.zaraz._f(p);
                    j.zaraz.init = () => {
                        var q = k.getElementsByTagName(m)[0],
                            r = k.createElement(m),
                            s = k.getElementsByTagName("title")[0];
                        s && (j[l].t = k.getElementsByTagName("title")[0].text);
                        j[l].x = Math.random();
                        j[l].w = j.screen.width;
                        j[l].h = j.screen.height;
                        j[l].j = j.innerHeight;
                        j[l].e = j.innerWidth;
                        j[l].l = j.location.href;
                        j[l].r = k.referrer;
                        j[l].k = j.screen.colorDepth;
                        j[l].n = k.characterSet;
                        j[l].o = new Date().getTimezoneOffset();
                        if (j.dataLayer) for (const w of Object.entries(Object.entries(dataLayer).reduce((x, y) => ({ ...x[1], ...y[1] }), {}))) zaraz.set(w[0], w[1], { scope: "page" });
                        j[l].q = [];
                        for (; j.zaraz.q.length; ) {
                            const z = j.zaraz.q.shift();
                            j[l].q.push(z);
                        }
                        r.defer = !0;
                        for (const A of [localStorage, sessionStorage])
                            Object.keys(A || {})
                                .filter((C) => C.startsWith("_zaraz_"))
                                .forEach((B) => {
                                    try {
                                        j[l]["z_" + B.slice(7)] = JSON.parse(A.getItem(B));
                                    } catch {
                                        j[l]["z_" + B.slice(7)] = A.getItem(B);
                                    }
                                });
                        r.referrerPolicy = "origin";
                        r.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(j[l])));
                        q.parentNode.insertBefore(r, q);
                    };
                    ["complete", "interactive"].includes(k.readyState) ? zaraz.init() : j.addEventListener("DOMContentLoaded", zaraz.init);
                })(w, d, "zarazData", "script");
            })(window, document);
        </script>
        <style>
            button.login100-form-btn {
                background: #68216F;
            }
        </style>
    </head>
    <body style="background-color: #666666;">
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <form class="login100-form validate-form" method="post" action="{{ url('/login') }}">
                        @csrf
                       

                        <div class="logo">
                            <img src="{{url('storage',$configGlobal->logo)}}" alt="" style="max-width:100px;margin:50px auto;display:block">
                        </div>

                        @if(!empty($_REQUEST['error']) && $_REQUEST['error'])
                            <p class="error text-danger"> Contacte al administrador... </p>
                        @endif
                        
                        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                            <input 
                            class="input100" 
                            name="email"
                            value="{{ old('email') }}"
                            type="text" name="email" autocomplete="none" />
                            <span class="focus-input100"></span>
                            <span class="label-input100">Usuario</span>
                           
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" name="password" autocomple='new-password' />
                            <span class="focus-input100"></span>
                            <span class="label-input100">Contraseña</span>
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex-sb-m w-full p-t-3 p-b-32">
                            <div class="contact100-form-checkbox">
                                <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me" />
                                <label class="label-checkbox100" for="ckb1">
                                    Remember me
                                </label>
                            </div>
                            <div>
                                <!-- <a href="#" class="txt1">
                                    Forgot Password?
                                </a> -->
                            </div>
                        </div>
                        <div class="container-login100-form-btn">
                            <button type='submit' class="login100-form-btn">
                                Acceder
                            </button>
                        </div>
                        
                        
                    </form>
                    <div class="login100-more" style="background-image: url({{url('img/background-login.png')}})"></div>
                </div>
            </div>
        </div>

        <script src="/templates/login/vendor/jquery/jquery-3.2.1.min.js"></script>

        <script src="/templates/login/vendor/animsition/js/animsition.min.js"></script>

        <script src="/templates/login/vendor/bootstrap/js/popper.js"></script>
        <script src="/templates/login/vendor/bootstrap/js/bootstrap.min.js"></script>

        <script src="/templates/login/vendor/select2/select2.min.js"></script>

        <script src="/templates/login/vendor/daterangepicker/moment.min.js"></script>
        <script src="/templates/login/vendor/daterangepicker/daterangepicker.js"></script>

        <script src="/templates/login/vendor/countdowntime/countdowntime.js"></script>

        <script src="/templates/login/js/main.js"></script>

        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());

            gtag("config", "UA-23581568-13");
        </script>
        <script
            defer
            src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854"
            integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg=="
            data-cf-beacon='{"rayId":"7fa388995fc8370d","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.8.0","si":100}'
            crossorigin="anonymous"
        ></script>
    </body>
</html>
