@extends("Layout.index")


@section("sredina")


<section class="section first-section">
    <div class="container-fluid">
        <div class="masonry-blog clearfix">

        @if(session()->has('uspesno'))
            <div class="alert alert-success">
                {{session()->get("uspesno")}}
            </div>
        @endif
        
        @foreach($slajderData as $x)

        <?php
            $vreme = $x->create_on;
            $datumNiz = explode(" ",$vreme);
            $datum = explode("-",$datumNiz[0]);
            $timestemp = mktime(0,0,0,$datum[1],$datum[2],$datum[0]);
            $datumPrikaz = date("j F, Y",$timestemp);
            $naslovSlajder = substr($x->naslov,0,38);
        ?>

        @switch($loop->index)
            @case(0)
                <div class="first-slot">
            @break
            @case(1)
                <div class="second-slot">
            @break
            @case (2)
                <div class="last-slot">
        @endswitch
            
                <div class="masonry-box post-media">
                    <img src="{{asset('/')}}upload/{{ $x->putanja}}" alt="" class="img-fluid sliderOne">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a href="{{route('kat-all',['id'=>$x->idKategorija])}}" title="">{{ $x->nazivKategorije }}</a></span>
                                <h4><a href="{{ route('single',['id'=>$x->idPost])}}" title="">{{ $naslovSlajder }} ...</a></h4>
                                <small><a href="{{ route('single',['id'=>$x->idPost])}}" title="">{{$datumPrikaz}}</a></small>
                                <small><a href="{{ route('single',['id'=>$x->idPost])}}" title="">{{ $x->ime }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end first-side -->

            @endforeach

            
        </div><!-- end masonry -->
    </div>
</section>




<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-top clearfix">
                        <h4 class="pull-left">Najnovije vesti <a href="#"><i class="fa fa-rss"></i></a></h4>
                    </div><!-- end blog-top -->

                    <div class="blog-list clearfix">

                    
                @foreach($postovi as $p)
                <?php
                        $vreme = $p->create_on;
                        $datumNiz = explode(" ",$vreme);
                        $datum = explode("-",$datumNiz[0]);
                        $timestemp = mktime(0,0,0,$datum[1],$datum[2],$datum[0]);
                        $datumPrikaz = date("j F, Y",$timestemp);
                        $opisPosta = substr($p->opis,0,206);
                ?>



                    <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="{{ route('single',['id'=>$p->idPost])}}" title="">
                                        <img src="{{asset("upload/"."$p->putanja")}}" alt="{{ $p->alt}}" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="{{ route('single',['id'=>$p->idPost])}}" title="">{{ $p->naslov }}</a></h4>
                                <p>{{ $opisPosta }} ...</p>
                                <small class="firstsmall"><a class="bg-orange" href="{{route('kat-all',['id'=>$p->idKategorija])}}" title="">{{ $p->nazivKategorije }}</a></small>
                                <small><a href="{{ route('single',['id'=>$p->idPost])}}" title="">{{$datumPrikaz}}</a></small>
                                <small><a href="{{ route('single',['id'=>$p->idPost])}}" title="">{{ $p->ime}} {{$p->prezime }}</a></small>
                                
                            </div><!-- end meta -->
                    </div><!-- end blog-box -->

                        <hr class="invis">
                @endforeach
                {{$postovi->links()}}

                    
                      

                    </div><!-- end blog-list -->
                </div><!-- end page-wrapper -->

                 <hr class="invis">

            </div><!-- end col -->
@include("Parts.reklameBaneri")
@endsection
