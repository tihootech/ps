@extends('layouts.app')
@section('title') Edit Point @endsection
@section('content')
	<div class="card">
		<div class="card-body">
			<form class="row justify-content-center" action="{{route('point.update', $point)}}" method="post">
				@csrf
				@method('PUT')

				<div class="form-group col-md-3">
					<label> {{ucfirst('amount')}} </label>
					<input type="number" name="amount" value="{{$point->amount}}" class="form-control">
				</div>
				<div class="form-group col-md-3">
					<label> {{ucfirst('type')}} </label>
					<select class="form-control" name="type">
						<option value=""> Please Select </option>
						@foreach ($bases as $base)
							<option @if($base->type == $point->type) selected @endif> {{$base->type}} </option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-md-3">
					<label> {{ucfirst('month')}} </label>
					<input type="number" name="month" value="{{$point->month}}" class="form-control">
				</div>
				<div class="form-group col-md-3">
					<label> {{ucfirst('year')}} </label>
					<input type="number" name="year" value="{{$point->year}}" class="form-control">
				</div>
				<hr class="w-100">
				<div class="col-md-2">
					<button type="submit" class="btn btn-primary btn-block"> Update Star </button>
				</div>
			</form>
		</div>
	</div>

@endsection
