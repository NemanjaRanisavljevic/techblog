<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2>@yield('iconStranice') @yield('naslovStranice') <small class="hidden-xs-down hidden-sm-down"> </small></h2>
                <!-- fa fa-envelope-open-o bg-orange -->
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Pocetna</a></li>
                    <li class="breadcrumb-item active">@yield('naslovStranice')</li>
                </ol>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->
