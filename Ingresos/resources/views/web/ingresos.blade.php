@extends('layouts.template', ['titulo' => 'Ingresos'])

@section('links')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('contenido')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Ingresos</h1>
        <a href="javascript:void(0)" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-download fa-sm text-white-50"></i> Nuevo Ingreso
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ingresos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="40%">Monto</th>
                            <th width="40%">Fecha</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($ingresos as $key => $ingreso)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $ingreso->monto }}</td>
                            <td>{{ $ingreso->fecha }}</td>
                            <td align="center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    {{-- <button type="button" class="btn btn-secondary edit_{{$ingreso->id}}">Editar</button> --}}
                                    <button type="submit" class="btn btn-danger" form="deleteForm_{{ $ingreso->id }}">Eliminar</button>
                                </div>
                            </td>
                            <form action="{{ route('ingreso.delete', $ingreso->id) }}" method="post" id="deleteForm_{{ $ingreso->id }}">@csrf @method('DELETE') </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
{{-- MODAL --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo Ingreso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('ingreso.store') }}" method="POST" id="ingresosStoreForm" >
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Monto</label>
                  <input type="number" name="monto" id="monto" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese Monto" required>
                  <small id="emailHelp" class="form-text text-muted">{{-- We'll never share your email with anyone else. --}}</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Fecha</label>
                  <input type="date" name="fecha" id="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                {{-- <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> --}}
                {{-- <button type="submit" class="btn btn-primary">Guardar</button> --}}
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" form="ingresosStoreForm" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
{{-- /MODAL --}}
@endsection

@section('scripts')
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script>
    // const endpoint = "http://localhost/api/ingreso";
    // const storeIngreso = async (e) => {
    //     console.log(e);
    //     e.preventDefault();
    //     console.log("ENVIANDO...", `${endpoint}/store`, JSON.stringify({
    //                 fecha: document.getElementById('fecha').value,
    //                 monto: document.getElementById('monto').value, 
    //             }))
    //     // await axios.post(`${endpoint}/store`, {fecha: fecha, monto: monto});
    //     await fetch(`${endpoint}/store`,
    //         {
    //             headers: {
    //                 "Content-Type": "application/json",
    //                 "Accept": "application/json",
    //               },
    //             method: 'POST',
    //             body : JSON.stringify({
    //                 fecha: document.getElementById('fecha').value,
    //                 monto: document.getElementById('monto').value, 
    //             })
    //         },
    //     ).then(response => {
    //         return response.json()
    //     })
    //     .then(data => {
    //         console.log(data);
    //         // setIngresos(data)
    //     });
    //     // getAllIngresos();
    // }
</script>
@endsection









