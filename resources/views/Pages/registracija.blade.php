@extends("Layout.index")


@section("sredina")
    @section("iconStranice")<i class="fa fa-user-o bg-orange"></i>@endsection
    @section("naslovStranice")Registracija @endsection
    @include("Parts.slajderZaOstale")

    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-lg-5">
                                <h4>Uputstvo za registraciju</h4>
                                <p>Vase ime mora da pocne velikim slovom, da ima minimum dva karaktera, a maksimalno deset.</p>
                                <p>Vase prezime mora da pocne velikim slovom, da ima minimum dva karaktera, a maksimalno petnaest.</p>
                                <p>Vasa lozinka mora da pocne velikim slovom, da ima minimum pet karaktera.</p>
                            </div>
                            <div class="col-lg-7">
                            @if(session()->has('uspesno'))
                                    <div class="alert alert-success">
                                        {{session()->get("uspesno")}}
                                    </div>
                            @endif

                                <form class="form-wrapper" enctype='multipart/form-data' action="{{route("registracija")}}" method="POST" onsubmit="return proveraRegistracije()">
                                @csrf
                                    <input type="text" class="form-control" name="imeReg" id="imeReg" placeholder="Ime">
                                    <!-- <small id="imeAlert" class="form-text">We'll never share your email with anyone else.</small> -->
                                    <div id="notifications"></div>

                                    <input type="text" class="form-control" name="prezimeReg" id="prezimeReg" placeholder="Prezime">
                                    
                                    <input type="email" class="form-control" name="emailReg" id="emailReg" placeholder="Email">
                                   
                                    <input type="password" class="form-control" name="sifraReg" id="sifraReg" placeholder="Lozinka">

                                    <select class="form-control" name="polList" id="polList">
                                        <option selected value="0">Pol...</option>
                                        @foreach($polovi as $pol)
                                            <option value="{{$pol->idPol}}">{{$pol->naziv}}</option>
                                            @endforeach
                                    </select>
                                    
                                    <input type="file" name="slikaKorisnika" id="slikaKorisnika">
                                    <small id="emailAlert" class="form-text text-muted">Izaberite vasu fotografiju.</small>
                                    
                                    <button type="submit" id="btnReg" class="btn btn-primary">Registruj se <i class="fa fa-user-o"></i></button>
                                </form>
                            </div>
                        </div>
                    </div><!-- end page-wrapper -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->

    </section>
@endsection

