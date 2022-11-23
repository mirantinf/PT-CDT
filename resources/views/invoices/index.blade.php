@extends('layouts.master')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Invoice</h4>
                <a class="btn btn-success" href="{{ URL::to('/invoices/create-invoice') }}">Add</a>
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
                            <th>No Invoice</th>
							<th>project</th>
                            <th>Nama Item</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($invoices as $invoice)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $invoice->no_invoice }}</td>
                                <td>@if ($invoice->project)
                                    <span class="cat-links">
                                    {{ $invoice->project->project_name }}
                                    </span>
                                @endif</td>
                                <td>{{ $invoice->item_name }}</td>
                                <td>{{ $invoice->price }}</td>
                                <td>
                                    <form action="{{ URL::to('invoices/destroy/'.$invoice->id) }}" method="POST">
                                        <a class="btn btn-warning" href="{{ URL::to('invoices/print', $invoice->id) }}" >Print</a>
                                        <a class="btn btn-primary" href="{{ URL::to('invoices/edit/'.$invoice->id) }}">Edit</a>
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

    {!! $invoices->links() !!}

@endsection
