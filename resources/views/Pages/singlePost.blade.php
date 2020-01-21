@extends("Layout.index")


@section("sredina")


<section class="section single-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-title-area text-center">
                                <ol class="breadcrumb hidden-xs-down">
                                    <li class="breadcrumb-item"><a href="{{ route('index')}}">Pocetna</a></li>
                                    <li class="breadcrumb-item"><a href="#">Izabrani post</a></li>
                                    <li class="breadcrumb-item active">{{$infoPost[0]->naslov}}</li>
                                </ol>

                                <span class="color-orange"><a href="{{route('kat-all',['id'=>$infoPost[0]->idKategorija])}}" title="">{{$infoPost[0]->nazivKategorije}}</a></span>

                                <h3>{{$infoPost[0]->naslov}}</h3>

                                <?php
                                    $vreme = $infoPost[0]->create_on;
                                    $datumNiz = explode(" ",$vreme);
                                    $datum = explode("-",$datumNiz[0]);
                                    $timestemp = mktime(0,0,0,$datum[1],$datum[2],$datum[0]);
                                    $datumPrikaz = date("j F, Y",$timestemp);
                                ?>


                                <div class="blog-meta big-meta">
                                    <small><a href="tech-single.html" title="">{{$datumPrikaz}}</a></small>
                                    <small><a href="tech-author.html" title="">{{$infoPost[0]->ime}} {{$infoPost[0]->prezime}}</a></small>
                                    
                                </div><!-- end meta -->

                               
                            </div><!-- end title -->

                            <div class="single-post-media">
                                <img src="{{asset('/')}}upload/{{$infoPost[0]->putanja}}" alt="{{$infoPost[0]->naslov}}" class="img-fluid">
                            </div><!-- end media -->

                            <div class="blog-content">  
                                <div class="pp">
                                    
                                    <p>{{$infoPost[0]->opis}}</p>

                                </div><!-- end pp -->

                                
                            </div><!-- end content -->


                            <hr class="invis1">

                            
                            <div class="custombox clearfix" id="ispisKomentara">
                            @if(!empty($komentari))
                                <h4 class="small-title">0 Komentara</h4>
                            @endif

                            <?php
                                $brKomentara = 0;
                            ?>
                            @foreach($komentari as $komentar)
                            <?php
                                    $vreme = $komentar->create_on;
                                    $datumNiz = explode(" ",$vreme);
                                    $datum = explode("-",$datumNiz[0]);
                                    $timestemp = mktime(0,0,0,$datum[1],$datum[2],$datum[0]);
                                    $datumPrikazKom = date("j F, Y ",$timestemp); 
                                    $brKomentara = $loop->index + 1;
                                ?>
                            <h4 class="small-title">{{$loop->index + 1}} Komentara</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="comments-list">
                                            <div class="media">
                                                <a class="media-left" href="#">
                                                    <img src="{{asset('/')}}upload/{{$komentar->putanja}}" alt="" class="rounded-circle">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading user_name">{{$komentar->ime}} {{$komentar->prezime}}<small>{{$datumPrikazKom}}</small>
                                                        @if(session()->has('korisnik'))
                                                        @if($komentar->idKorisnik == session('korisnik')->idKorisnik || session('korisnik')->naziv == 'Admin' || session('korisnik')->naziv == 'Moderator')
                                                        <button type="button" class="btn-danger btn-sm kom-delete btn-delete-kom" data-id="{{$komentar->idKomentar}}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                        @endif
                                                        @endif
                                                    </h4>
                                                    <p>{{$komentar->sadrzaj}}</p>
                                                    
                                                    <!-- <a href="#" class="btn btn-primary btn-sm">Reply</a>  -->
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                                
                                @endforeach
                            </div><!-- end custom-box -->
                            

                            <hr class="invis1">
                            @if(session()->has('korisnik'))
                                <div class="custombox clearfix">
                                    <h4 class="small-title">Komentarisi</h4>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form class="form-wrapper" method="POST">
                                            @csrf 
                                                <input type="hidden" class="form-control" id="skriveniBrKomentara" name="skriveniBrKomentara" value="{{$brKomentara}}">                                          
                                                <input type="hidden" class="form-control" id="skriveniIdPosta" name="skriveniIdPosta" value="{{$infoPost[0]->idPost}}">
                                                <input type="hidden" class="form-control" id="skriveniIdKorisnika" name="skriveniIdKorisnika" value="{{session('korisnik')->idKorisnik}}">
                                                <textarea class="form-control" id="txtKomentar" name="txtKomentar" placeholder="Tvoj komentar"></textarea>
                                                <button type="button" id="btnKomentar" name="btnKomentar" class="btn btn-primary">Komentarisi</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif


                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->
@include("Parts.reklameBaneri")
@endsection
