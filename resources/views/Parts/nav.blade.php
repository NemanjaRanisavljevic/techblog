<body>

<div id="wrapper">
    <header class="tech-header header">
        <div class="container-fluid">
            <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('/')}}images/version/tech-logo.png" alt="logo"></a>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('index')}}">Pocetna</a>
                        </li>
                        <li class="nav-item dropdown has-submenu menu-large hidden-md-down hidden-sm-down hidden-xs-down">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">Kategorije</a>
                            <ul class="dropdown-menu megamenu" aria-labelledby="dropdown01">
                                <li>
                                    <div class="container">
                                        <div class="mega-menu-content clearfix">
                                            <div class="tab">
                                            @foreach($kategorije as $k)

                                            @switch($loop->index)
                                                @case(0)
                                                <button class="tablinks linkSlajder" data-id="{{$kategorije[0]->idKategorija}}">
                                                    @break
                                                @default
                                                <button class="tablinks linkSlajder" data-id="{{$k->idKategorija}}">
                                                    @break
                                            @endswitch
                                                {{$k->nazivKategorije}}
                                            </button>
                                            @endforeach
                                                
                                            </div>

                                            <div class="tab-details clearfix">
                                                <div id="cat01" class="tabcontent active">
                                                    <div class="row" id="ispisNavKat">
                                                        
                                                    </div><!-- end row -->
                                                </div>
                                                
                                               
                                            </div><!-- end tab-details -->
                                        </div><!-- end mega-menu-content -->
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('kontakt')}}">Kontakt</a>
                        </li>

                        
                        
                        @if(session()->has('korisnik'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('post')}}">Kreiranje objave</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin-panel')}}">Admin panel</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('registracija')}}">Registracija</a>
                            </li>
                        @endif
                        
                        

                    </ul>
                    <ul class="navbar-nav">
                    @if(session()->has('korisnik'))
                        <li class="nav-item">
                           <a class="nav-link" href="{{route('logout')}}">Izloguj se</a>   
                        </li>
                    @else
                        <li class="nav-item">
                           <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">Logovanje</a>   
                        </li>
                    @endif
                    </ul>

                     

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Logovanje</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                    @csrf
                                    <div class="form-group">
                                            <input type="email" class="form-control" id="emailLog" name="emailLog" aria-describedby="emailHelp" placeholder="Email">
                                            
                                    </div>
                                    <div class="form-group">
                                            <input type="password" class="form-control" id="sifraLog" name="sifraLog" placeholder="Sifra">  
                                            <small id="passwordAlert" class="form-text text-muted">Sifra mora poceti velikim slovom i imati najmanje sest karaktera.</small>
                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                                    <button type="button" id="btnLog" class="btn btn-primary">Uloguj se</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- kraj -->
                    

                    </div>





                </div>
            </nav>
        </div><!-- end container-fluid -->
    </header><!-- end market-header -->

