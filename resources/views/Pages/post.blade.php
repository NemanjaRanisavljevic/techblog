@extends("Layout.index")


@section("sredina")
    @section("iconStranice")<i class="fa fa-newspaper-o bg-orange"></i>@endsection
    @section("naslovStranice")Kreiranje objave @endsection
    @include("Parts.slajderZaOstale")

    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-lg-5">
                                <h4>Uputstvo</h4>
                                <p>Naslov mora da pocne sa velikim slovom i sadrzi slova i brojeve, minimalan broj karaktera je deset karaktera.</p>

                            </div>
                            <div class="col-lg-7">

                            @if(session()->has('uspesno'))
                                    <div class="alert alert-error">
                                        {{session()->get("NotFoundPost")}}
                                    </div>
                            @endif
                            
                                <form class="form-wrapper" enctype='multipart/form-data' action="{{route("post")}}" method="POST" onsubmit="return CreatePost()">
                                @csrf
                                
                                    <select class="form-control" id="ddlKategorija" name="ddlKategorija">
                                    <option value="0">Izaberite kategoriju</option>
                                    @foreach($kategorije as $kat)
                                        <option value="{{$kat->idKategorija}}">{{$kat->nazivKategorije}}</option>
                                    @endforeach
                                    </select>
                                    <input type="text" class="form-control" id="naslov" name="naslov" placeholder="Naslov"> 
                                    
                                    <input type="file" name="slikaObjava" id="slikaObjava">
                                    <small id="emailAlert" class="form-text text-muted">Izaberite fotografiju.</small>    

                                    <textarea class="form-control"  id="opis" name="opis" placeholder="Opis"></textarea>

                                    <button type="submit" id="btnPost" class="btn btn-primary">Objavi<i class="fa fa-newspaper-o"></i></button>
                                </form>
                            </div>
                        </div>
                    </div><!-- end page-wrapper -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->

    </section>
@endsection

