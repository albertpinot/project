<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Soundcloud</title>
        <!-- Styles -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/jquery.pjax.js') }}"></script>
        <script src="{{ asset('js/toastr.min.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai" rel="stylesheet"> 
    </head>
    <body>

        <div class="content">   
            <!--  {{ config('app.name', 'Soundclound') }}-->
            <div id="header">
                    <div class="profil">
                        <div class="contentLinkProfil">
                            <img class="profil" src="/img/profil.svg" />
                            <a>Profil</a>
                        </div>
                        <!-- Authentication Links -->
                        <div>
                        @guest
                            <a href="{{ route('login') }}" data-pjax>Login</a>
                            <a href="{{ route('register') }}" data-pjax>Register</a>
                        @else
                            <li> Bonjour {{ Auth::user()->name }} </li>
                        </div>
                        <div>
                            <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                        </div>
                    </div>
            </div>
            <div class="container">
                <div id="menu">
                    <div class="center">
                        <a href="{{ url('/') }}" data-pjax>
                        <img class="logo" src="/img/logo.svg" />
                            </a>
                        <hr/>
                    
                        <form id="search">
                            <input  class="recherche" type="search" name="search" required placeholder=" Votre recherche" />
                            <input class="btEnvoyer" type="submit"/>
                        </form>
                        
                        <div class="itemFlex">
                            <img src="/img/rock.svg" />
                            <a class="linkMenu" >Rock</a>
                        </div>

                        <div class="itemFlex">
                            <img src="/img/classique.svg" />
                            <a class="linkMenu" >Classique</a>
                        </div>

                        <div class="itemFlex">
                            <img src="/img/pop.svg" />
                            <a class="linkMenu" > Pop</a>
                        </div>

                        <div class="itemFlex">
                            <img src="/img/rap.svg" />
                            <a class="linkMenu" >Rap</a>
                        </div>

                        <hr/>

                        <div class="itemFlex">
                            <img class="plus" src="/img/plus.svg" />
                            <a class="linkMenu" >Playlists</a>
                        </div>

                        <div class="itemFlex">
                            <img class="plus" src="/img/plus.svg" />
                            <a  href="/nouvelle" class="linkMenu" data-pjax >Upload</a>
                        </div>

                    </div>
            
                </div>

                <div class="banierePub">
                    <img class="pub" src="/img/baniere_pub.svg" />
                    <main id="pjax-container">
                        @yield('content')
                    </main>
                </div>
            
            </div>
                <audio id="audio" controls>
                    <source src="" type="audio/mp3" />
                </audio>
        </div>
    </body>
</html>