<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
    <div class="sidebar">
        <div class="widget">
            <h2 class="widget-title">Kategorije</h2>
            <div class="blog-list-widget">
                
                        <div class="w-100 justify-content-between">
                            
                            <div class="link-widget">
                                <ul>
                                @foreach($kategorije as $kateBroj)
                                    <li><a href="{{route('kat-all',['id'=>$kateBroj->idKategorija])}}">{{$kateBroj->nazivKategorije}} <span>({{$kateBroj->brojPostova}})</span></a></li>
                                @endforeach
                                </ul>
                            </div><!-- end link-widget -->
                        </div>
                    </a>
                
            </div><!-- end blog-list -->
        </div><!-- end widget -->

        <div class="widget">
            <h2 class="widget-title">Najkomentarisanije vesti</h2>
            <div class="blog-list-widget">
                <div class="list-group">                
                    @foreach($najkomentarisanije as $najKom)
                    <?php
                                    $vreme = $najKom->create_on;
                                    $datumNiz = explode(" ",$vreme);
                                    $datum = explode("-",$datumNiz[0]);
                                    $timestemp = mktime(0,0,0,$datum[1],$datum[2],$datum[0]);
                                    $datumPrikazKom = date("j F, Y ",$timestemp); 
                    ?>

                        <a href="{{ route('single',['id'=>$najKom->idPost])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="w-100 justify-content-between">
                                <img src="{{asset('/')}}upload/{{$najKom->putanja}}" alt="" class="img-fluid float-left">
                                <h5 class="mb-1">{{$najKom->naslov}}</h5>
                                <small>{{$datumPrikazKom}}</small>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div><!-- end blog-list -->
        </div><!-- end widget -->

        

       
    </div><!-- end sidebar -->
</div><!-- end col -->
</div><!-- end row -->
</div><!-- end container -->
</section>
