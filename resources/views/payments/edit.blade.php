@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ URL::to('/invoices') }}"> Back</a>
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

    <form action="{{ URL::to('/invoices/update/'.$invoice->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @method('PATCH')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>No invoice</strong>
                    <input type="text" name="no_invoice"  class="form-control" value="{{$invoice->no_invoice}}">
                </div>
                <div class="form-group">
                    <strong>List Project</strong>
                    <select class="form-control" name="project_id">
                        @foreach ($projects as $project)
                            <option value="{{ $project->id}}" @if ($project->project_id === $project->id)selected @endif>{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <strong>Nama Item</strong>
                    <input type="text" name="item_name"  class="form-control" value="{{$invoice->item_name}}">
                </div>
                <div class="form-group">
                    <strong>Harga</strong>
                    <span class="input-group-text">Rp</span>
                    <input type="text" name="price"  class="form-control" value="{{$invoice->price}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
