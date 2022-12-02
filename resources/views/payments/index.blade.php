@extends('layouts.master')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Invoice</h4>
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
							<th>Project</th>
                            <th>Nama Item</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($payments as $payment)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $payment->no_invoice }}</td>
                                <td>@if ($payment->project)
                                    <span class="cat-links">
                                    {{ $payment->project->project_name }}
                                    </span>
                                @endif</td>
                                <td>{{ $payment->item_name }}</td>
                                <td>  @currency ($payment->price)</td>
                                <td>
                                    <a class="btn btn-danger" href="{{ URL::to('/add-payment/'.$payment->id) }}">Konfirmasi Pembayaran</a>
                                </tbody>
					        @endforeach
				</table>
			</div>
		</div>
	</div>
</div>

    {!! $payments->links() !!}

@endsection
