@extends('layouts.app')
@section('title') Assign Award @endsection
@section('content')
	<div class="card">
		<div class="card-body text-center">
			<a href="{{route('award.index')}}" class="btn btn-warning"> List All Awards </a>
		</div>
	</div>
	<div class="card mt-3">
		<div class="card-body">
			<form class="row justify-content-center" action="{{route('award.assign')}}" method="post">
				@csrf
				<div class="col-md-3 form-group">
					<label> Star </label>
					<input type="text" name="star" value="{{$star->name}}" class="form-control">
				</div>
				<div class="col-md-3 form-group">
					<label> Trophy </label>
					<select class="form-control" name="trophy">
						<option value=""> Please Select </option>
						@foreach ($trophies as $trophy)
							<option value="{{$trophy->id}}"> {{$trophy->title}} </option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3 form-group">
					<label> Month </label>
					<select class="form-control" name="month">
						<option value=""> Please Select </option>
						@for ($i=1; $i <= 12; $i++)
							<option value="{{$i}}"> {{mn($i)}} ({{$i}}) </option>
						@endfor
					</select>
				</div>
				<div class="col-md-3 form-group">
					<label> Year </label>
					<input type="number" name="year" class="form-control">
				</div>
				<div class="col-md-2 mt-3">
					<button type="submit" class="btn btn-primary btn-block">Upload</button>
				</div>
			</form>
		</div>
	</div>
@endsection
