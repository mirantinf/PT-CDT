@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit</h2>
            </div>
            <div class="pull-right">

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

    <form action="{{ URL::to('/payments/update/'.$payment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @method('PATCH')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="my-2">
                    <input type="file" name="file" id="file" accept="image/*" class="form-control">
                  </div>
                  <img src="{{ asset("/uploads/images/$payment->image") }}" class="img-fluid img-thumbnail">
                <div class="form-group">
                    <strong>Keterangan</strong>
                    <input type="text" name="description"  class="form-control" value="{{$payment->description}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
