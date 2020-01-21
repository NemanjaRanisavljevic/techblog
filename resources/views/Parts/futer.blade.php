<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="widget">
                    <div class="footer-text text-left">
                        <a href="index.html"><img src="{{asset('/')}}images/version/tech-footer-logo.png" alt="" class="img-fluid"></a>
                        <p>Tech Blog je blog vezan za tehnologiju i nova otkrica na ostale teme.</p>
                        <div class="social">
                           
                        </div>

                        <hr class="invis">

                        <!-- <div class="newsletter-widget text-left">
                            <form class="form-inline">
                                <input type="text" class="form-control" placeholder="Enter your email address">
                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                            </form>
                        </div>end newsletter -->
                    </div><!-- end footer-text -->
                </div><!-- end widget -->
            </div><!-- end col -->

            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Kategorije</h2>
                    <div class="link-widget">
                        <ul>
                        @foreach($kategorije as $kateBroj)
                            <li><a href="{{route('kat-all',['id'=>$kateBroj->idKategorija])}}">{{$kateBroj->nazivKategorije}} <span>({{$kateBroj->brojPostova}})</span></a></li>
                        @endforeach
                        </ul>
                    </div><!-- end link-widget -->
                </div><!-- end widget -->
            </div><!-- end col -->

            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Meni</h2>
                    <div class="link-widget">
                        <ul>
                            <li><a href="{{route('index')}}">Pocetna</a></li>
                            <li><a href="{{route('kontakt')}}">Kontakt</a></li>
                        @if(session()->has('korisnik') && session('korisnik')->naziv == "Admin")
                            <li>
                                <a href="{{route('post')}}">Kreiranje objave</a>
                            </li>
                            <li>
                                <a href="{{route('admin-panel')}}">Admin panel</a>
                            </li>
                        @endif
                        @if(!session()->has('korisnik'))
                            <li>
                                <a href="{{route('registracija')}}">Registracija</a>
                            </li>
                        @endif
                            
                        </ul>
                    </div><!-- end link-widget -->
                </div><!-- end widget -->
            </div><!-- end col -->
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <br>
                <div class="copyright">&copy; Nemanja Ranisavljevic 86/16.</div>
            </div>
        </div>
    </div><!-- end container -->
</footer><!-- end footer -->

<div class="dmtop">Scroll to Top</div>

</div><!-- end wrapper -->

<!-- Core JavaScript
================================================== -->

<script>
    const baseUrl = "{{ url('/') }}";
</script>

<script src="{{asset('/')}}js/jquery.min.js"></script>
<script src="{{asset('/')}}js/tether.min.js"></script>
<script src="{{asset('/')}}js/bootstrap.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
<script src="{{asset('/')}}js/custom.js"></script>
<script src="{{asset('/')}}plugin/notify.min.js"></script>
<script src="{{asset('/')}}plugin/notifySettings.js"></script>

<script src="{{asset('/')}}jsProvera/registracija.js"></script>
<script src="{{asset('/')}}jsProvera/post.js"></script>
<script src="{{asset('/')}}jsProvera/slajderJs.js"></script>
<script src="{{asset('/')}}jsProvera/kontakt.js"></script>

</body>
</html>
