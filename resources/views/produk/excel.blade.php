@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
       <div class="panel-heading">
         <h4>Import/Export Excel</h4>
       </div>
      <div class="panel-body">
		 
<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('importproduk') }}">
  {{ csrf_field() }}
   <div class="form-group">
     <div class="col-md-3 col-md-offset-3">
       <a href="{{ url('exportproduk') }}" class="btn btn-success">Export</a>
     </div>
   </div>
	  
   <div class="form-group">
     <label for="file" class="col-md-3 control-label">File Excel</label>
     <div class="col-md-3">
       <input id="file" type="file" class="form-control" name="file">
     </div>
   </div>
   
   <div class="form-group">
     <div class="col-md-3 col-md-offset-3">
       <button type="submit" class="btn btn-primary">Import</button>
     </div>
   </div>
   
</form>
       </div>
      </div>
    </div>
   </div>
</div>
@endsection
