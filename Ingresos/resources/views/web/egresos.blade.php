@extends('layouts.template', ['titulo' => 'Egresos'])

@section('links')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('contenido')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Egresos</h1>
        <a href="javascript:void(0)" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-download fa-sm text-white-50"></i> Nuevo Egreso
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Egresos</h6>
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
                        @foreach($egresos as $key => $egreso)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $egreso->monto }}</td>
                            <td>{{ $egreso->fecha }}</td>
                            <td align="center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    {{-- <button type="button" class="btn btn-secondary edit_{{$egreso->id}}">Editar</button> --}}
                                    <button type="submit" class="btn btn-danger" form="deleteForm_{{ $egreso->id }}">Eliminar</button>
                                </div>
                            </td>
                            <form action="{{ route('egreso.delete', $egreso->id) }}" method="post" id="deleteForm_{{ $egreso->id }}">@csrf @method('DELETE') </form>
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
          <h5 class="modal-title" id="exampleModalLabel">Nuevo egreso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('egreso.store') }}" method="POST" id="egresosStoreForm">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Monto</label>
                  <input type="number" name="monto" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese Monto" required>
                  <small id="emailHelp" class="form-text text-muted">{{-- We'll never share your email with anyone else. --}}</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Fecha</label>
                  <input type="date" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
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
          <button type="submit" form="egresosStoreForm" class="btn btn-primary">Guardar</button>
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
@endsection
