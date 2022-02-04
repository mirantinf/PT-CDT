@extends('layout.master')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Penerbit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('publishers.create') }}"> Create</a>
            </div>
        </div>
    </div>
    <br>

    <form class="form" method="get" action="{{ route('search_publish') }}">
    <div class="form-group w-100 mb-3">
        <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Cari Penerbit">
        <button type="submit" class="btn btn-primary mb-1">Cari</button>
    </div>
    </form>
     <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Penerbit</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($publishers as $publisher)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $publisher->penerbit }}</td>
            <td>
                <form action="{{ route('publishers.destroy',$publisher->id) }}" method="POST">
           
                    <a class="btn btn-primary" href="{{ route('publishers.edit',$publisher->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $publishers->links() !!}
        
@endsection