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
			<form action="{{route('award.assign')}}" method="post">
				@csrf
				<div id="parent">
					<div class="row justify-content-center">
						<div class="col-md-3 form-group">
							<label> Star </label>
							<input type="text" name="star[]" value="{{$star->name}}" class="form-control" required>
						</div>
						<div class="col-md-3 form-group">
							<label> Trophy </label>
							<select class="form-control" name="trophy[]" required>
								<option value=""> Please Select </option>
								@foreach ($trophies as $trophy)
									<option value="{{$trophy->id}}"> {{$trophy->title}} </option>
								@endforeach
							</select>
						</div>
						<div class="col-md-3 form-group">
							<label> Month </label>
							<input type="number" name="month[]" class="form-control" required>
						</div>
						<div class="col-md-3 form-group">
							<label> Year </label>
							<input type="number" name="year[]" class="form-control" required>
						</div>
					</div>
				</div>
				<hr>
				<div class="text-center">
					<button type="button" class="btn btn-warning mx-3" onclick="$('#parent .row:first').clone().appendTo('#parent')">
						Clone
					</button>
					<button type="submit" class="btn btn-primary mx-3">Assign</button>
				</div>
			</form>
		</div>
	</div>
@endsection
