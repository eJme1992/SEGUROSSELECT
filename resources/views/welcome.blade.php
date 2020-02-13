@extends('layouts.app')

@section('title','Importar y exportar datos')

@section('content')

<div class="col-md-4">
    <style> 
  .formu .form-control{
        margin-top:10px;
        margin-bottom:10px;
    }
    </style>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> <b>Exportar e importar datos Marcas</b></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
           
            <p>
                Clic <a href="">aquí</a> para descargar en EXCEL a las Marcas
            </p>
            <p> 
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal3">
                    <i class="fas fa-times-circle"></i> Reiniciar la base de datos
                </button>
                  
            </p>

            <form class="formu" action="{{ route('marcas.import.excel') }}" method="post" enctype="multipart/form-data">
                @csrf @if(Session::has('message3'))
                <p>{{ Session::get('message3') }}</p>
                @endif

                <input class="form-control" type="file" name="file" required>

                <button class="btn btn-primary"><i class="fas fa-database"></i> Importar Usuarios</button>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <!-- Footer -->
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- The Modal -->
<div class="modal" id="myModal3">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header text-center">
          <h4 class="modal-title text-center">Aviso de seguridad</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            Esta seguro que desea eliminar la base de datos de <b>Marcas</b> de Seguros select?
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="{{ route('marcas.Reiniciar') }}"  class="btn btn-danger" >Eliminar</a>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        </div>
  
      </div>
    </div>
  </div>
</div>

<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b> Exportar e importar datos Modelos</b></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
         
            <p>
                Clic <a href="">aquí</a> para descargar en EXCEL a los Modelos
            </p>
            <p> 
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal2">
                    <i class="fas fa-times-circle"></i> Reiniciar la base de datos
                </button>
                  
            </p>

            <form class="formu" action="{{ route('modelo.import.excel') }}" method="post" enctype="multipart/form-data">
                @csrf @if(Session::has('message2'))
                <p>{{ Session::get('message2') }}</p>
                @endif

                <input class="form-control" type="file" name="file" required>

                <button class="btn btn-primary"><i class="fas fa-database"></i> Importar Usuarios</button>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <!-- Footer -->
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- The Modal -->
<div class="modal" id="myModal2">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header text-center">
          <h4 class="modal-title text-center">Aviso de seguridad</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            Esta seguro que desea eliminar la base de datos de <b>Modelo</b> de Seguros select?
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="{{ route('modelos.Reiniciar') }}"  class="btn btn-danger" >Eliminar</a>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        </div>
  
      </div>
    </div>
  </div>
</div>

<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Exportar e importar datos Autos</b></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
        
            <p>
                Clic <a href="">aquí</a> para descargar en EXCEL de la base de datos
            </p>
            <p> 
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                    <i class="fas fa-times-circle"></i> Reiniciar la base de datos
                </button>
                  
            </p>

            <form class="row formu" action="{{ route('autos.import.excel') }}" method="post" enctype="multipart/form-data">
                @csrf @if(Session::has('message1'))
                <p>{{ Session::get('message1') }}</p>
                @endif
                <input class="form-control col-md-6" type="number" name="año_i" placeholder="Año de inicio" required>
              
                <input class="form-control col-md-6"  type="number" name="año_c" placeholder="Año de cierre" required>
               
                <input class="form-control" type="file" name="file" required>

                <button class="btn btn-primary"><i class="fas fa-database"></i> Importar Usuarios</button>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <!-- Footer -->
        </div>
        <!-- /.card-footer-->
    </div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header text-center">
          <h4 class="modal-title text-center">Aviso de seguridad</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            Esta seguro que desea eliminar la base de datos de <b>Autos</b> de Seguros select?
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="{{ route('autos.Reiniciar') }}"  class="btn btn-danger" >Eliminar</a>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        </div>
  
      </div>
    </div>
  </div>


</div>

@endsection