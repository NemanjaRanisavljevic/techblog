@extends("Layout.index")


@section("sredina")
    @section("naslovStranice")Registracija @endsection
    @include("Parts.slajderZaOstale")

    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-lg-5">
                                <h4>Who we are</h4>
                                <p>Tech Blog is a personal blog for handcrafted, cameramade photography content, fashion styles from independent creatives around the world.</p>
                            </div>
                            <div class="col-lg-7">
                                <form class="form-wrapper">
                                @csrf
                                    <input type="text" class="form-control" id="imeReg" placeholder="Ime">
                                    <!-- <small id="imeAlert" class="form-text">We'll never share your email with anyone else.</small> -->
                                    <div id="notifications"></div>

                                    <input type="text" class="form-control" id="prezimeReg" placeholder="Prezime">
                                    
                                    <input type="email" class="form-control" id="emailReg" placeholder="Email">
                                   
                                    <input type="password" class="form-control" id="sifraReg" placeholder="Password">

                                    <select class="form-control" id="polList">
                                        <option selected value="0">Pol...</option>
                                        <option value="1">Musko</option>
                                    </select>
                                    
                                    <input type="file" id="slikaKorisnika">
                                    <small id="emailAlert" class="form-text text-muted">Izaberite vasu fotografiju.</small>
                                    
                                    <button type="button" id="btnReg" class="btn btn-primary">Registruj se <i class="fa fa-envelope-open-o"></i></button>
                                </form>
                            </div>
                        </div>
                    </div><!-- end page-wrapper -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->

    </section>
@endsection

