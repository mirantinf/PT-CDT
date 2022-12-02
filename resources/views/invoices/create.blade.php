@extends('layouts.master')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add new</h2>
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

    <form action="{{ URL::to('/invoices/create') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>No Invoice</strong>
                    <input type="text" name="no_invoice" class="form-control" placeholder="no invoice">
                </div>

                <div class="form-group">
                    <strong>List Project</strong>
                    <select class="form-control" name="project_id">
                       @foreach ($projects as $project)
                          <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                       @endforeach
                    </select>
                 </div>

                <div class="form-group">
                    <strong>Nama Item</strong>
                    <input type="text" name="item_name" class="form-control" placeholder="Nama Item">
                </div>

                <div class="form-group">
                    <strong>Harga</strong>
                    <span class="input-group-text">Rp</span>
                    <input type="text" name="price" class="form-control" placeholder="Harga">
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
