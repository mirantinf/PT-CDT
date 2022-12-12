@extends('layout.master')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Data Project</h4>
                <a class="btn btn-success" href="{{ URL::to('/projects/create-page')}}">Add</a>
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
                            <th>Nama Projek</th>
							<th>Nama Klien</th>
							<th>Tlp Klien</th>
							<th>Informasi Projek</th>
							<th>Budget</th>
							<th>Status</th>
							<th>Action</th>
                        </tr>
                        @foreach ($projects as $project)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $project->project_name }}</td>
								<td>{{ $project->client_name }}</td>
								<td>{{ $project->tlp_client }}</td>
								<td>{{ $project->project_information }}</td>
								<td>@currency( $project->budget )</td>
								@if($project->status === null)
								<td>
                                    Tidak Ada Status
                                </td>
								@else
								<td>{{ $project->status->status_name}}</td>
								@endif
                                <td>
                                    <form action="{{ URL::to('/projects/destroy' ,$project->id) }}" method="POST">
                                        <a class="btn btn-primary" href="{{ URL::to('/projects/edit' ,$project->id)}}">Edit</a>
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

    {!! $projects->links() !!}

@endsection
