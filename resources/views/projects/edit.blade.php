@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ URL::to('/projects') }}"> Back</a>
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
    
    <form action="{{ URL::to('/projects/update/'.$project->id) }}" method="POST" enctype="multipart/form-data"> 
        @csrf

        @method('PATCH')
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status</strong>
                    <input type="text" name="project_name"  class="form-control" value="{{$project->project_name}}">
                </div>
                <div class="form-group">
                    <strong>Status</strong>
                    <input type="text" name="client_name" class="form-control" value="{{$project->client_name}}">
                </div>
                <div class="form-group">
                    <strong>Status</strong>
                    <input type="text" name="tlp_client"  class="form-control" value="{{$project->tlp_client}}">
                </div>
                <div class="form-group">
                    <strong>Status</strong>
                    <input type="text" name="project_information" class="form-control" value="{{$project->project_information}}">
                </div>
                <div class="form-group">
                    <strong>Status</strong>
                    <input type="text" name="budget"  class="form-control" value="{{$project->budget}}">
                </div>
                <div class="form-group">
                <strong>Status</strong>
                <select class="form-control" name="status_id">
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id}}" @if ($status->status_id === $status->id)selected @endif>{{ $status->status_name }}</option>
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