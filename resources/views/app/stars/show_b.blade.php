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
						<i class="mdi mdi-pencil"></i> Edit
					</a>
					<a href="{{route('image.upload_form', $star)}}" class="btn btn-outline-primary m-1">
						<i class="mdi mdi-image"></i> Upload Photo
					</a>
					<a href="{{route('image.index')}}?star={{$star->id}}" class="btn btn-outline-primary m-1">
						<i class="mdi mdi-settings"></i> Manage Images
					</a>
					<a href="{{route('award.assign_form', $star)}}" class="btn btn-outline-primary m-1">
						<i class="mdi mdi-plus"></i> Assign Award
					</a>
					<a href="{{route('award.index')}}?star={{$star->id}}" class="btn btn-outline-primary m-1">
						<i class="mdi mdi-format-list-bulleted"></i> Awards List
					</a>
					<a href="{{route('point.index')}}?star={{$star->id}}" class="btn btn-outline-primary m-1">
						<i class="mdi mdi-format-list-bulleted"></i> Her Recent Points
					</a>
				</div>
				<div class="col-md-6">
					@for ($i=2019; $i <= now()->year; $i++)
						<h4> Year {{$i}} </h4>
						<canvas id="year-{{$i}}"></canvas>
						@if ($i != now()->year)
							<hr>
						@endif
					@endfor
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

			

		</div>
	</div>
	@if ($star->cover)
		<img src="{{asset($star->cover->path)}}" class="img-fluid">
	@endif

@endsection


@section('charts')

	@for ($year_in_loop=2019; $year_in_loop <= now()->year; $year_in_loop++)

		@php
			$untill = ($year_in_loop == now()->year) ? now()->month : 12;
		@endphp
		<script>
			var ctx = document.getElementById('year-{{$year_in_loop}}');
			var colors = [
				@for ($i=1; $i <= $untill; $i++)
					'#3490DC',
				@endfor
			];

			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: [
						@for ($i=1; $i <= $untill; $i++)
							'{{mn($i)}}',
						@endfor
					],
					datasets: [{
						label: 'Rank In That Month',
						fill : false,
						borderColor: "#3490DC",
						pointBackgroundColor: "#fff",
						pointBorderColor: "#3490DC",
						pointHoverBackgroundColor: "#3490DC",
						pointHoverBorderColor: "#3490DC",
						data: [
							@for ($i=1; $i <= $untill; $i++)
								-{{$star->rank('month', $year_in_loop, $i)}},
							@endfor
						],
						borderWidth: 2
					},
					{
						label: 'Rank In General',
						fill : false,
						borderColor: "#E3342F",
						pointBackgroundColor: "#fff",
						pointBorderColor: "#E3342F",
						pointHoverBackgroundColor: "#E3342F",
						pointHoverBorderColor: "#E3342F",
						data: [
							@for ($i=1; $i <= $untill; $i++)
								-{{$star->rank('general', $year_in_loop, $i)}},
							@endfor
						],
						borderWidth: 2
					}
				]
				},
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}]
					}
				}
			});
		</script>
	@endfor

@endsection
