@extends("Layout.admin.index")
@section('sadrzaj')
    <section class="inter-section spad">
        <div class="container">
            <div class="section-title">
                <i class="fas fa-newspaper"></i>
                <h2>Objave</h2>
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
                        <th scope="col">Naslov</th>
                        <th scope="col">Opis</th>
                        <th scope="col">Kategorija</th>  
                        <th scope="col">Korisnik</th>
                        <th scope="col">Slika</th>
                        <th scope="col">Izmeni</th>
                        <th scope="col">Obrisi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objave as $obj)
                    <?php
                    $opisPrikaz = substr($obj->opis,0,20);
                    ?>
                        <tr>
                            <td>{{$obj->idPost}}</td>
                            <td>{{$obj->naslov}}</td>
                            <td>{{$opisPrikaz}} ...</td>
                            <td>{{$obj->nazivKategorije}}</td>
                            <td>{{$obj->ime}} {{$obj->prezime}}</td>
                            <td><img  class="slikaKorisnika" src="{{asset("upload/"."$obj->putanja")}}" alt="{{$obj->naslov}}"/></td>
                            <td><button type="button" data-toggle="modal" data-target="#modalEditObjave" class="btnEditObjave btn btn-primary" data-id="{{$obj->idPost}}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            <td><button type="button" class="btnBrisanjeObjave btn btn-danger" data-id="{{$obj->idPost}}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
            <div class="text-left">
            {{$objave->links()}}
            </div>

             <!-- Modal Edit -->
             <div class="modal fade" id="modalEditObjave" tabindex="-1" role="dialog" aria-labelledby="modalEditObjave" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditObjave">Izmena Objave</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form class="contact-form" action="{{route('admin-post')}}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="custom-select" id="ddlKategorijeEdit" name="ddlKategorijeEdit">
                                            @foreach($kategorije as $kat)
                                                <option value="{{$kat->idKategorija}}">{{$kat->nazivKategorije}}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" name="naslovEdit" id="naslovEdit" placeholder="Naslov">
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" name="slikaObjaveAdminEdit" class="custom-file-input" id="slikaObjaveAdminEdit">
                                                <label class="custom-file-label" for="slikaObjaveAdminEdit" aria-describedby="inputGroupFileAddon02">Izaberi sliku</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="slikaObjaveAdminEdit">Upload</span>
                                            </div>
                                        </div>
                                        
                                        <textarea class="form-control"  id="opisEdit" name="opisEdit" placeholder="Opis"></textarea>
                                        <input type="hidden" value="" name="slikaIdEditObj" id="slikaIdEditObj">
                                        <input type="hidden" value="" name="korisnikIdEdit" id="korisnikIdEdit">
                                        <input type="hidden" value="" name="objaveIdEdit" id="objaveIdEdit">
                                        <input type="hidden" value="" name="putanjaEditObj" id="putanjaEditObj">
                                    </div>
        
                                </div>
                            
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
                            <button type="submit"  class="btn btn-success">Izmeni</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- kraj -->

        </div>
    </section>
@endsection