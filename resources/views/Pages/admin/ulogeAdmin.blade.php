@extends("Layout.admin.index")
@section('sadrzaj')
    <section class="inter-section spad">
        <div class="container">
            <div class="section-title">
                <i class="fas fa-user-tag"></i>
                <h2>Uloge Korisnika</h2>
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
                        <th scope="col">Broj Korisnika</th>
                        <th scope="col">Izmeni</th>
                        <th scope="col">Obrisi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($uloge as $data)
                        <tr>
                            <td>{{$data->IdUloga}}</td>
                            <td>{{$data->naziv}}</td>
                            <td>{{$data->brojKorisnika}}</td>
                            <td><button type="button" data-toggle="modal" data-target="#modalEditUloge" class="btn btn-primary btnEditUloge" data-id="{{$data->IdUloga}}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            <td><button type="button" class="btnBrisanjeUloge btn btn-danger" data-id="{{$data->IdUloga}}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach 
                    </tbody>
                </table>
            </form>
            <div class="text-left">
                <button type="button" data-toggle="modal" data-target="#modalAddUloga"  class="btn btn-primary">Dodaj</button>
            </div>

             <!-- Modal Edit -->
             <div class="modal fade" id="modalEditUloge" tabindex="-1" role="dialog" aria-labelledby="modalEditUloge" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditUloge">Izmena Uloge</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form class="contact-form" action="{{route('admin-uloge')}}" onsubmit="return EditovanjeUloge()" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="nazivEditUloge" id="nazivEditUloge" placeholder="Naziv uloge">
                                              <input type="hidden" value="" name="ulogeEditId" id="ulogeEditId">
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
                            <button type="submit" class="btn btn-success">Izmeni</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- kraj -->


            <!-- Modal Add -->
            <div class="modal fade" id="modalAddUloga" tabindex="-1" role="dialog" aria-labelledby="modalAddUloga" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddUloga">Dodaj Ulogu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form class="contact-form" action="{{route('admin-uloge')}}" onsubmit="return DodavanjeUloge()" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="nazivUlogeAdd" id="nazivUlogeAdd" placeholder="Naziv uloge">
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
                            <button type="submit" id="btnAddUloge" class="btn btn-success">Dodaj</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- kraj -->

           

        </div>
    </section>
@endsection