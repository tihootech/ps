@extends('layouts.app')
@section('title') Upload Image @endsection
@section('content')
	<div class="card">
		<div class="card-body">
			<form class="row justify-content-center" action="{{route('image.upload')}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="col-md-3 form-group">
					<label> Star </label>
					<input type="text" name="star" value="{{$star->name}}" class="form-control">
				</div>
				<div class="col-md-3 form-group">
					<label> Type </label>
					<select class="form-control" name="type">
						<option value="regular"> {{ucfirst('regular')}} </option>
						<option value="compt"> {{ucfirst('compt')}} </option>
						<option value="profile"> {{ucfirst('profile')}} </option>
						<option value="cover"> {{ucfirst('cover')}} </option>
					</select>
				</div>
				<div class="col-md-3 form-group">
					<label> Upload Image </label>
					<input type="file" name="image" class="form-control">
				</div>
				<div class="col-md-12">
					<label>Info (Optional)</label>
					<textarea name="info" rows="2" class="form-control"></textarea>
				</div>
				<div class="col-md-2 mt-3">
					<button type="submit" class="btn btn-primary btn-block">Upload</button>
				</div>
			</form>
		</div>
	</div>
@endsection
