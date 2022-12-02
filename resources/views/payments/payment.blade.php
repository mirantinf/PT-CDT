@extends('layouts.master')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Invoice</h4>
                <a class="btn btn-success" href="{{ URL::to('/payments/create-payment/'.$invoiceId) }}">Add</a>
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
                            <th>Bukti Pembayaran</th>
							<th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($payments as $payment)
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{asset("/uploads/images/$payment->image")}}" class="card-img-top img-fluid">
                                </td>
                                <td>{{ $payment->description }}</td>
                                <td>
                                    <form action="{{ URL::to('payments/destroy/'.$payment->id) }}" method="POST">
                                        <a class="btn btn-primary" href="{{ URL::to('payments/edit/'.$payment->id) }}">Edit</a>
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

    {!! $payments->links() !!}

@endsection
