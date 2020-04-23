@extends('layouts.app')
@section('title') {{$star->name}} @endsection
@section('content')
	<div class="card text-center">
		<div class="card-body pb-5 p-relative">
			@if ($star->profile)
				<img src="{{asset($star->profile->path)}}" class="img-fluid profile-picture d-md-block d-none">
			@endif
			<div class="row">
				<div class="col-md-6">
					<h2 class="text-primary"> {{$star->name}} </h2>
					<hr>
					<h5>
						<span class="float-left"> This Month Rank : <b class="text-danger"> {{$star->rank('month')}} </b> </span>
						<b class="m-1">-</b>
						<span class="float-right"> This Year Rank : <b class="text-danger"> {{$star->rank('year')}} </b> </span>
					</h5>
					<hr>
					<p class="my-4">
						Born in <b class="text-info"> {{$star->country}} </b>
						in <b class="text-info"> {{$star->birthday->toFormattedDateString()}} </b>
						and she's <b class="text-info"> {{$star->age}} </b> years old.
						Persian birthdate is : <b class="text-info"> {{pdate($star->birthday)}} </b>
						<hr>
						<b class="text-danger"> GAwards </b>
						<div class="mt-2">
							@if ($star->gawards->count())
								@foreach ($star->gawards as $award)
									<span class="bg-danger d-inline-block text-light m-1 px-2 py-1">
										{{$award->title}} ({{$award->year}})
									</span>
								@endforeach
							@else
								None
							@endif
						</div>
						<hr>
						<b class="text-success"> Beauty Awards </b>
						<div class="mt-2">
							@if ($star->bawards->count())
								@foreach ($star->bawards as $award)
									<span class="bg-success d-inline-block text-light m-1 px-2 py-1">
										{{$award->title}} ({{$award->year}})
									</span>
								@endforeach
							@else
								None
							@endif
						</div>
					</p>
					<div class="table-responsive-lg">
						<table class="table">
							<thead>
								<tr>
									<th> Height </th>
									<th> Color </th>
									<th> Size </th>
									<th> Boobs </th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td> {{$star->height}} cm </td>
									<td> {{$star->color}} </td>
									<td> {{$star->size}} </td>
									<td> {{$star->boobs}} </td>
								</tr>
							</tbody>
						</table>
					</div>
					<hr>
					<a href="{{route('star.edit', $star)}}" class="btn btn-outline-primary m-1">
						<i class="material-icons">edit</i> Edit
					</a>
					<a href="{{route('image.upload_form', $star)}}" class="btn btn-outline-primary m-1">
						<i class="material-icons">photo</i> Upload Photo
					</a>
					<a href="{{route('image.index')}}?star={{$star->id}}" class="btn btn-outline-primary m-1">
						<i class="material-icons">settings</i> Manage Images
					</a>
					<a href="{{route('award.assign_form', $star)}}" class="btn btn-outline-primary m-1">
						<i class="material-icons">add</i> Assign Award
					</a>
					<a href="{{route('award.index')}}?star={{$star->id}}" class="btn btn-outline-primary m-1">
						<i class="material-icons">list</i> Awards List
					</a>
					<a href="{{route('point.index')}}?star={{$star->id}}" class="btn btn-outline-primary m-1">
						<i class="material-icons">list</i> Her Recent Points
					</a>
				</div>
				<div class="col-md-6">
					@include('includes.points_table', ['points' => $star->points, 'in_show' =>true])
				</div>
			</div>

			<div class="table-responsive-lg my-3">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							@for ($i=2019; $i <= now()->year; $i++)
								<th> Rank In {{$i}} </th>
							@endfor
						</tr>
					</thead>
					<tbody>
						<tr>
							@for ($i=2019; $i <= now()->year; $i++)
								<th> {{$star->rank('year', $i)}} </th>
							@endfor
						</tr>
					</tbody>
				</table>
			</div>

			@if ($star->awards->count())
				<div class="row justify-content-center">
					@foreach ($star->awards as $award)
						<div class="col-md-2 p-1">
							<div class="card
								@if($award->type == 'gaward')
									text-dark bg-warning
								@elseif ($award->type == 'beauty')
									text-light bg-success
								@else
									text-light bg-secondary
								@endif
								">
								<div class="card-header lead">{{$award->title}}</div>
								<div class="card-body">
									{{mn($award->month)}}, {{$award->year}}
								</div>
							</div>
						</div>
					@endforeach
				</div>
			@else
				<div class="alert alert-warning">
					No Awards Yet :(
				</div>
			@endif

		</div>
	</div>
	@if ($star->cover)
		<img src="{{asset($star->cover->path)}}" class="img-fluid">
	@endif

@endsection
