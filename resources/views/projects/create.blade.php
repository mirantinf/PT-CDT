@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add new</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ URL::to('/projects/index')}}"> Back</a>
            </div>
        </div>
    </div>
    <br>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ URL::to('/projects/create')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Projek</strong>
                    <input type="text" class="form-control" name="project_name" >
                </div>
                <div class="form-group">
                    <strong>Nama Klien</strong>
                    <input type="text" class="form-control" name="client_name" >
                </div>
                <div class="form-group">
                    <strong>Tlp Klien</strong>
                    <input type="text" class="form-control" name="tlp_client" >
                </div>
                <div class="form-group">
                    <strong>Informasi Projek</strong>
                    <input type="text" class="form-control" name="project_information" >
                </div>
                <div class="form-group">
                    <strong>Budget</strong>
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control" name="budget" >
                </div>
                <div class="form-group">
               <strong>Status</strong>
               <select class="form-control" name="status_id">
                  @foreach ($statuses as $status)
                     <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                  @endforeach
               </select>
            </div>
         </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
