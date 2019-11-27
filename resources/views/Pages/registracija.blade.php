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
                                    <input type="text" class="form-control" placeholder="Ime">
                                    <!-- <small id="imeAlert" class="form-text">We'll never share your email with anyone else.</small> -->
                                    <div id="notifications"></div>

                                    <input type="text" class="form-control" placeholder="Prezime">
                                    
                                    <input type="email" class="form-control" placeholder="Email">
                                   

                                    <input type="password" class="form-control" placeholder="Password">

                                    <select class="form-control" id="polList">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    


                                    <input type="file" id="slikaKorisnika">
                                    <small id="emailAlert" class="form-text text-muted">Izaberite vasu fotografiju.</small>
                                    
                                    <button type="button" id="dugme" class="btn btn-primary">Send <i class="fa fa-envelope-open-o"></i></button>
                                </form>
                            </div>
                        </div>
                    </div><!-- end page-wrapper -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->

    </section>
@endsection

