@extends("Layout.index")


@section("sredina")


<section class="section first-section">
    <div class="container-fluid">
        <div class="masonry-blog clearfix">
        
            <div class="first-slot">
                <div class="masonry-box post-media">
                    <img src="" alt="" class="img-fluid">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a href="tech-category-01.html" title="">{{ $slajderData[0]->nazivKategorije }}</a></span>
                                <h4><a href="tech-single.html" title="">{{ $slajderData[0]->naslov }}</a></h4>
                                <small><a href="tech-single.html" title="">24 July, 2017</a></small>
                                <small><a href="tech-author.html" title="">{{ $slajderData[0]->ime }} {{ $slajderData[0]->prezime }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end first-side -->

            <div class="second-slot">
                <div class="masonry-box post-media">
                    <img src="upload/tech_02.jpg" alt="" class="img-fluid">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a href="tech-category-01.html" title="">{{ $slajderData[1]->nazivKategorije }}</a></span>
                                <h4><a href="tech-single.html" title="">{{ $slajderData[1]->naslov }}</a></h4>
                                <small><a href="tech-single.html" title="">03 July, 2017</a></small>
                                <small><a href="tech-author.html" title="">{{ $slajderData[1]->ime }} {{ $slajderData[1]->prezime }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end second-side -->

            <div class="last-slot">
                <div class="masonry-box post-media">
                    <img src="upload/tech_03.jpg" alt="" class="img-fluid">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a href="tech-category-01.html" title="">{{ $slajderData[2]->nazivKategorije }}</a></span>
                                <h4><a href="tech-single.html" title="">{{ $slajderData[2]->naslov }}</a></h4>
                                <small><a href="tech-single.html" title="">01 July, 2017</a></small>
                                <small><a href="tech-author.html" title="">{{ $slajderData[2]->ime }} {{ $slajderData[2]->prezime }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end second-side -->
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

                ?>



                    <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="{{asset("upload/"."$p->putanja")}}" alt="{{ $p->alt}}" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="tech-single.html" title="">{{ $p->naslov }}</a></h4>
                                <p>{{ $p->opis }}</p>
                                <small class="firstsmall"><a class="bg-orange" href="tech-category-01.html" title="">{{ $p->nazivKategorije }}</a></small>
                                <small><a href="tech-single.html" title="">{{$datumPrikaz}}</a></small>
                                <small><a href="#" title="">{{ $p->ime}} {{$p->prezime }}</a></small>
                                
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
