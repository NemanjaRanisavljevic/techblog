@extends("Layout.index")


@section("sredina")
    @section("iconStranice")<i class="fa fa-newspaper-o bg-orange"></i>@endsection
    @section("naslovStranice")Kontakt @endsection
    @include("Parts.slajderZaOstale")

    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-lg-5">
                               

                                <h4>Kako vam mozemo pomoci?</h4>
                                <p>Za sve vase nedoumice kontaktirate nas. Odgovor u roku od 24h ocekujte</p>

                               
                            </div>
                            <div class="col-lg-7">
                            @if(session()->has('kontakt'))
                                    <div class="alert alert-success">
                                        {{session()->get("kontakt")}}
                                    </div>
                            @endif
                                <form class="form-wrapper" action="{{route('kontakt')}}" method="POST" onsubmit="return ProveraKontakta()">
                                @csrf
                                    <input type="text" class="form-control" id="imeKontakt" name="imeKontakt" placeholder="Vase ime">
                                    <input type="text" class="form-control" id="emailKontakt" name="emailKontakt" placeholder="Email adresa">
                                    <input type="text" class="form-control" id="telefonKontakt" name="telefonKontakt" placeholder="Telefon">
                                    <input type="text" class="form-control" id="naslovKontakt" name="naslovKontakt" placeholder="Naslov">
                                    <textarea class="form-control" id="porukaKontakt" name="porukaKontakt"  placeholder="Poruka"></textarea>
                                    <button type="submit" id="btnKontakt" class="btn btn-primary">Posalji <i class="fa fa-envelope-open-o"></i></button>
                                </form>
                            </div>
                        </div>
                    </div><!-- end page-wrapper -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->

    </section>
@endsection

