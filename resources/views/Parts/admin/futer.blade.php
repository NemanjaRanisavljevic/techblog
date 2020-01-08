</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script>
    const baseUrl = "{{ url('/') }}";
</script>

<script src="{{asset("vendor/jquery/jquery.min.js")}}"></script> 
<script src="{{asset("vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

<script src="{{asset('/')}}jsProvera/adminJs/adminBrisanje.js"></script>
<script src="{{asset('/')}}jsProvera/adminJs/adminFunkcije.js"></script>
<script src="{{asset('/')}}jsProvera/registracija.js"></script>
<script src="{{asset('/')}}plugin/notify.min.js"></script>
<script src="{{asset('/')}}plugin/notifySettings.js"></script>



<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>



</body>

</html>