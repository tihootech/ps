@extends('layouts.app')
@section('title') Edit {{$star->name}} @endsection
@section('content')
	<div class="card">
		<div class="card-body">
			<form class="row justify-content-center" action="{{route('star.update', $star)}}" method="post">
				@csrf
				@method('PUT')

				<div class="form-group col-md-3">
					<label> {{ucfirst('name')}} </label>
					<input type="text" name="name" value="{{$star->name}}" class="form-control">
				</div>
				<div class="form-group col-md-3">
					<label> {{ucfirst('country')}} </label>
					<input type="text" name="country" value="{{$star->country}}" class="form-control">
				</div>
				<div class="form-group col-md-3">
					<label> {{ucfirst('height')}} </label>
					<input type="number" name="height" value="{{$star->height}}" class="form-control">
				</div>
				<div class="form-group col-md-3">
					<label> {{ucfirst('birthday')}} (YYYY-mm-dd) </label>
					<input type="text" name="birthday" value="{{$star->birthday ? $star->birthday->format('Y-m-d') : ''}}" class="form-control">
				</div>
				<div class="form-group col-md-3">
					<label> {{ucfirst('color')}} </label>
					<select class="form-control" name="color">
						<option value=""> Please Select </option>
						<option @if($star->color == 'White') selected @endif> White </option>
						<option @if($star->color == 'Brunette') selected @endif> Brunette </option>
						<option @if($star->color == 'Black') selected @endif> Black </option>
						<option @if($star->color == 'Caucasian') selected @endif> Caucasian </option>
						<option @if($star->color == 'Ginger') selected @endif> Ginger </option>
						<option @if($star->color == 'Asian') selected @endif> Asian </option>
						<option @if($star->color == 'Latin') selected @endif> Latin </option>
						<option @if($star->color == 'Arab') selected @endif> Arab </option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label> {{ucfirst('size')}} </label>
					<select class="form-control" name="size">
						<option value=""> Please Select </option>
						<option @if($star->size == 'TinySlim') selected @endif> TinySlim </option>
						<option @if($star->size == 'TinyFilled') selected @endif> TinyFilled </option>
						<option @if($star->size == 'Ave') selected @endif> Ave </option>
						<option @if($star->size == 'AveFilled') selected @endif> AveFilled </option>
						<option @if($star->size == 'Slender') selected @endif> Slender </option>
						<option @if($star->size == 'TallFilled') selected @endif> TallFilled </option>
						<option @if($star->size == 'Large') selected @endif> Large </option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label> {{ucfirst('boobs')}} </label>
					<select class="form-control" name="boobs">
						<option value=""> Please Select </option>
						<option @if($star->boobs == 'Small') selected @endif> Small </option>
						<option @if($star->boobs == 'Medium') selected @endif> Medium </option>
						<option @if($star->boobs == 'Average') selected @endif> Average </option>
						<option @if($star->boobs == 'Perfect') selected @endif> Perfect </option>
						<option @if($star->boobs == 'Large') selected @endif> Large </option>
						<option @if($star->boobs == 'Huge') selected @endif> Huge </option>
					</select>
				</div>
				<hr class="w-100">
				<div class="col-md-2">
					<button type="submit" class="btn btn-primary btn-block"> Update Star </button>
				</div>
			</form>
		</div>
	</div>

	<div class="card mt-3">
		<div class="card-body">
			<div class="table-responsive-lg">
				<table class="table table-bordered">
					<thead>
						<tr>
							@for ($i=1; $i <= 12; $i++)
								<th> {{mn($i)}} </th>
							@endfor
						</tr>
					</thead>
					<tbody>
						<tr>
							@for ($i=1; $i <= 12; $i++)
								<td> {{$i}} </td>
							@endfor
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

@endsection
