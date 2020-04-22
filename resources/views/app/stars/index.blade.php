@extends('layouts.app')
@section('title') Stars @endsection
@section('content')
	<div class="card mb-3">
		<div class="card-body">
			<form class="text-center">
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="tallest" name="order" class="custom-control-input" value="tallest"
					@if(request('order') == 'tallest') checked @endif>
					<label class="custom-control-label" for="tallest"> {{ucfirst('tallest')}} </label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="youngest" name="order" class="custom-control-input" value="youngest"
					@if(request('order') == 'youngest') checked @endif>
					<label class="custom-control-label" for="youngest"> {{ucfirst('youngest')}} </label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="oldest" name="order" class="custom-control-input" value="oldest"
					@if(request('order') == 'oldest') checked @endif>
					<label class="custom-control-label" for="oldest"> {{ucfirst('oldest')}} </label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="size" name="order" class="custom-control-input" value="size"
					@if(request('order') == 'size') checked @endif>
					<label class="custom-control-label" for="size"> {{ucfirst('size')}} </label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="boobs" name="order" class="custom-control-input" value="boobs"
					@if(request('order') == 'boobs') checked @endif>
					<label class="custom-control-label" for="boobs"> {{ucfirst('boobs')}} </label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="year" name="order" class="custom-control-input" value="year"
					@if(request('order') == 'year') checked @endif>
					<label class="custom-control-label" for="year"> {{ucfirst('year')}} </label>
				</div>
				<hr>
				<button type="submit" class="btn btn-warning"> Sort </button>
			</form>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			@include('includes.stars_table')
		</div>
	</div>
@endsection
