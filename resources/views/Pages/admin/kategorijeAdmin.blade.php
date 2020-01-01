@extends("Layout.admin.index")
@section('sadrzaj')
    <section class="inter-section spad">
        <div class="container">
            <div class="section-title">
                <i class="fas fa-folder"></i>
                <h2>Kategorije</h2>
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
                        <th scope="col">Naziv</th>
                        <th scope="col">Broj objava</th>
                        <th scope="col">Izmeni</th>
                        <th scope="col">Obrisi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($kategorije as $item)
                        <tr>
                            <td>{{$item->idKategorija}}</td>
                            <td>{{$item->nazivKategorije}}</td>
                            <td>{{$item->brojPostova}}</td>
                            <td><button type="button" data-toggle="modal" data-target="#modalEditKategorija" class="btnEditKorisnika btn btn-primary" data-id="{{$item->idKategorija}}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            <td><button type="button" class="btnBrisanjeKorisnika btn btn-danger" data-id="{{$item->idKategorija}}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                       {{-- ovde ispis --}}
                    </tbody>
                </table>
            </form>
            <div class="text-left">
                <button type="button" data-toggle="modal" data-target="#modalAddKategorija"  class="btn btn-primary">Dodaj</button>
            </div>

             <!-- Modal Edit -->
             <div class="modal fade" id="modalEditKategorija" tabindex="-1" role="dialog" aria-labelledby="modalEditKategorija" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditKategorija">Izmena Kategorije</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form class="contact-form" action="{{route('admin-kategorije')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="nazivEditKategorije" id="nazivEditKategorije" placeholder="Naziv kategorije">
                                              <input type="hidden" value="" name="kategorijaEditId" id="kategorijaEditId">
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


            <!-- Modal Add -->
            <div class="modal fade" id="modalAddKategorija" tabindex="-1" role="dialog" aria-labelledby="modalAddKategorija" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddKategorija">Dodaj Kategoriju</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form class="contact-form" action="{{route('admin-kategorije')}}" onsubmit="return DodavanjeKategorije()" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="nazivKatAdd" id="nazivKatAdd" placeholder="Naziv kategorije">
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
                            <button type="submit" id="btnAddKategorija" class="btn btn-success">Dodaj</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- kraj -->

           

        </div>
    </section>
@endsection