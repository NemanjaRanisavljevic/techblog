<body>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">
            {{session('korisnik')->ime ." ".session('korisnik')->prezime}}
        </div>

        <div class="list-group list-group-flush">
        @if(session('korisnik')->naziv == "Admin" || session('korisnik')->naziv == "Moderator")
            <a href="{{route('admin-post')}}" class="list-group-item list-group-item-action bg-light">Objave</a>
            <a href="{{route('admin-kategorije')}}" class="list-group-item list-group-item-action bg-light">Kategorije</a> 
        @endif
        @if(session('korisnik')->naziv == "Admin")
            <a href="{{route('admin-panel')}}" class="list-group-item list-group-item-action bg-light">Korisnici</a>
            
            <a href="{{route('admin-uloge')}}" class="list-group-item list-group-item-action bg-light">Uloge</a>
            @endif
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">Meni</button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('index')}}">Povratak na sajt <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("logout")}}">Logout</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li> -->
                </ul>
            </div>
        </nav>