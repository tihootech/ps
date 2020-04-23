@extends('layouts.app')
@section('title') Settings @endsection
@section('content')
	<div class="row justify-content-center">
		<div class="col-md-6">
			<form class="card" action="{{route('settings.modify')}}" method="post">
				@csrf
				@method('PUT')
				<div class="card-body">
					<h2> Base Points </h2>
					<hr>
					@foreach ($bases as $i => $base)
						<div class="row @if($i) mt-3 @endif">
							<div class="col-md-6">
								<label> Type </label>
								<input type="text" class="form-control" name="type[]" value="{{$base->type}}">
							</div>
							<div class="col-md-6">
								<label> Quantity </label>
								<input type="number" class="form-control" name="quantitiy[]" value="{{$base->quantitiy}}">
							</div>
						</div>
					@endforeach
				</div>
				<hr>
				<div class="text-center mb-3">
					<button type="submit" class="btn btn-primary" name="class" value="App\Base"> Confirm </button>
				</div>
			</form>
		</div>
		<div class="col-md-6">
			<form class="card" action="{{route('settings.modify')}}" method="post">
				@csrf
				@method('PUT')
				<div class="card-body">
					<h2> Base Trophies </h2>
					<hr>
					@foreach ($trophies as $i => $trophy)
						<div class="row @if($i) mt-3 @endif">
							<div class="col-md-8">
								<label> Title </label>
								<input type="text" class="form-control" name="title[]" value="{{$trophy->title}}">
							</div>
							<div class="col-md-4">
								<label> GAward </label>
								<select class="form-control" name="type[]">
									<option value="regular" @if($trophy->type == 'regular') selected @endif> Regular </option>
									<option value="gaward" @if($trophy->type == 'gaward') selected @endif> GAward </option>
									<option value="beauty" @if($trophy->type == 'beauty') selected @endif> Beauty </option>
								</select>
							</div>
						</div>
					@endforeach
				</div>
				<hr>
				<div class="text-center mb-3">
					<button type="submit" class="btn btn-primary" name="class" value="App\Trophy"> Confirm </button>
				</div>
			</form>
		</div>
	</div>
@endsection
