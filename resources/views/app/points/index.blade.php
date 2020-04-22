@extends('layouts.app')
@section('title') Stars @endsection
@section('content')
	<div class="card mb-3">
		<div class="card-body">
			<form class="text-center">
				<div class="row">
					<div class="col-md-8">
						@foreach ($bases as $key => $base)
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="b-{{$base->id}}" name="type" class="custom-control-input" value="{{$base->type}}"
								@if(request('type') == $base->type) checked @endif>
								<label class="custom-control-label" for="b-{{$base->id}}"> {{ucfirst($base->type)}} </label>
							</div>
						@endforeach
					</div>
					<div class="col-md-4">
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" id="latest" name="order" class="custom-control-input" value="latest"
							@if(request('order') == 'latest') checked @endif>
							<label class="custom-control-label" for="latest"> {{ucfirst('latest')}} </label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" id="highest" name="order" class="custom-control-input" value="highest"
							@if(request('order') == 'highest') checked @endif>
							<label class="custom-control-label" for="highest"> {{ucfirst('highest')}} </label>
						</div>
					</div>
				</div>
				<hr>
				<button type="submit" class="btn btn-warning"> Filter </button>
			</form>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			@include('includes.points_table')
			{{$points->appends($_GET)->links()}}
		</div>
	</div>
@endsection
