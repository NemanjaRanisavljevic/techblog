@extends("Layout.admin.index")
@section('sadrzaj')
    <section class="inter-section spad">
        <div class="container">
            <div class="section-title">
                <i class="fas fa-user"></i>
                <h2>Korisnici</h2>
            </div>
            @if(session()->has('uspesno'))
                <div class="alert alert-success">
                    {{session()->get("uspesno")}}
                </div>
            @endif
            <form method="POST" action="">
                @csrf
                <table class="table table-striped table-admin">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Ime</th>
                        <th scope="col">Prezime</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Uloga</th>
                        <th scope="col">Aktivan</th>
                        <th scope="col">Pol</th>
                        <th scope="col">Slika</th>
                        <th scope="col">Izmeni</th>
                        <th scope="col">Obrisi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($korisnici as $kor)
                    
                        <tr>
                            <td scope="row">{{$kor->idKorisnik}}</td>
                            <td>{{$kor->ime}}</td>
                            <td>{{$kor->prezime}}</td>
                            <td>{{$kor->email}}</td>
                            <td>{{$kor->naziv}}</td>
                            <td>{{$kor->aktivan}}</td>
                            <td>@if($kor->idPol == 1)  {{"musko"}}@else {{"zensko"}}@endif</td>
                            <td><img  class="slikaKorisnika" src="{{asset("upload/"."$kor->putanja")}}" alt="{{$kor->ime}}"/></td>
                            <td><button type="button" data-toggle="modal" data-target="#modalEditKorisnika" class="btnEditKorisnika btn btn-primary" data-id="{{$kor->idKorisnik}}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            <td><button type="button" class="btnBrisanjeKorisnika btn btn-danger" data-id="{{$kor->idKorisnik}}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
            <div class="text-left">
                <button type="button" data-toggle="modal" data-target="#modalAddKorisnika" id="btnLog" class="btn btn-primary">Dodaj</button>
            </div>

             <!-- Modal Edit -->
             <div class="modal fade" id="modalEditKorisnika" tabindex="-1" role="dialog" aria-labelledby="modalEditKorisnika" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditKorisnika">Izmena Korisnika</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="contact-form" action="" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="ime" id="ime" placeholder="Ime">
                                        <input type="text" name="prezime" id="prezime" placeholder="Prezime">
                                        <input type="text" name="email" id="email" placeholder="E-mail">
                                        <input type="password" name="sifra" id="sifra" placeholder="Sifra">
                                        <input type="hidden"  name="skrivnoId" id="skrivnoId">
                                        <select class="custom-select" id="ddlAktivan" name="ddlAktivan">
                                            <option selected value="0">Nije Aktivan</option>
                                                <option value="1">Aktivan</option>
                                        </select>
                                        <select class="custom-select" id="ddlUloga" name="ddlUloga">
                                            <option selected value="0">Izaberi Ulogu</option>
                                            
                                            
                                            
                                        </select>
                                        <select class="custom-select" id="ddlPol" name="ddlPol">
                                            <option selected value="0">Izaberi Pol</option>
                                            
                                            <option value=""></option>
                                               
                                        </select>
                                    </div>
        
                                </div>
                            </form>
                            <div class="ispisGresaka">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                            <button type="button" id="btnLog" class="btn btn-success">Izmeni</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- kraj -->


            <!-- Modal Add -->
            <div class="modal fade" id="modalAddKorisnika" tabindex="-1" role="dialog" aria-labelledby="modalAddKorisnika" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddKorisnika">Dodaj Korisnika</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="contact-form" action="" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="ime" id="ime" placeholder="Ime">
                                        <input type="text" name="prezime" id="prezime" placeholder="Prezime">
                                        <input type="text" name="email" id="email" placeholder="E-mail">
                                        <input type="password" name="sifra" id="sifra" placeholder="Sifra">
                                        <input type="hidden"  name="skrivnoId" id="skrivnoId">
                                        <select class="custom-select" id="ddlAktivan" name="ddlAktivan">
                                            <option selected value="0">Nije Aktivan</option>
                                                <option value="1">Aktivan</option>
                                        </select>
                                        <select class="custom-select" id="ddlUloga" name="ddlUloga">
                                            <option selected value="0">Izaberi Ulogu</option>
                                            
                                            
                                            
                                        </select>
                                        <select class="custom-select" id="ddlPol" name="ddlPol">
                                            <option selected value="0">Izaberi Pol</option>
                                            
                                            <option value=""></option>
                                               
                                        </select>
                                    </div>
        
                                </div>
                            </form>
                            <div class="ispisGresaka">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                            <button type="button" id="btnLog" class="btn btn-success">Dodaj</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- kraj -->

           

        </div>
    </section>
@endsection