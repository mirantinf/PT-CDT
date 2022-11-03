@extends('layouts.master')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Status</h4>
                <a class="btn btn-success" href="{{ URL::to('/statuses/create-page') }}">Add</a>
			</div>
			<div class="card-body">
				@if (session('sukses'))
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					{{ session('sukses') }}
				</div>
				@elseif(session('gagal'))
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					{{ session('gagal') }}
				</div>
				@endif

				@if (count($errors) > 0)
				<div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<table id="table" class="table">
					<thead>
						<tr>
						<th>No</th>
                            <th>Status</th>
							<th>Action</th>
                        </tr>
                        @foreach ($statuses as $status)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $status->status_name }}</td>
                                <td>
                                    <form action="{{ URL::to('statuses/destroy/'.$status->id) }}" method="POST">
                                        <a class="btn btn-primary" href="{{ URL::to('statuses/edit/'.$status->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </tbody>
					        @endforeach
				</table>
			</div>
		</div>
	</div>
</div>

    {!! $statuses->links() !!}

@endsection
