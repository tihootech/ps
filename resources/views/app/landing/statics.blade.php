@extends('layouts.app')
@section('title') Statics @endsection
@section('content')
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-4">
					<table class="table table-striped table-hover table-sm table-bordered text-center">
						<thead>
							<tr>
								<th> # </th>
								<th> Star </th>
								<th> Points </th>
							</tr>
						</thead>
						<tbody>
							@foreach ($tops as $i => $star)
								<tr>
									<th> {{$i+1}} </th>
									<td> <a href="{{route('star.show', $star->id)}}"> {{$star->name}} </a> </td>
									<td> {{nf($star->points->sum('amount'))}} </td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="col-md-8 text-center">
					<form class="row justify-content-center mb-3">
						<div class="col-md-3">
							<label> Enter Count Manually </label>
							<input type="number" name="count" value="{{$count}}" class="form-control">
						</div>
						<div class="col-md-2 align-self-end">
							<button class="btn btn-primary btn-block"> Confirm </button>
						</div>
					</form>
					<canvas id="super-general"></canvas>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<h3 class="mb-3"> Teams (Body Types) Count </h3>
							<canvas height="200px" id="teams-count"></canvas>
						</div>
						<div class="col-md-6">
							<h3 class="mb-3"> Teams (Body Types) Point Sum </h3>
							<canvas height="200px" id="teams-sum"></canvas>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<h3 class="mb-3"> Star Colors Count </h3>
							<canvas height="200px" id="colors-count"></canvas>
						</div>
						<div class="col-md-6">
							<h3 class="mb-3"> Star Colors Point Sum </h3>
							<canvas height="200px" id="colors-sum"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('charts')

<script type="text/javascript">
var config1 = {
	type: 'pie',
	data: {
		datasets: [{
			data: [
				@foreach ($tops as $star)
				{{$star->points->sum('amount')}},
				@endforeach
				{{$others_points}}
			],
			backgroundColor: [
				@foreach ($tops as $star)
				"{{random_rgba(1)}}",
				@endforeach
				'red'
			],
		}],
		labels: [
			@foreach ($tops as $star)
			'{{$star->name}}',
			@endforeach
			'Others Points'
		]
	},
	options: {
		legend: {
			display: false
		},
		responsive: true
	}
};


var colors = [
	@foreach ($teams as $body_type => $array)
	"{{random_rgba(1)}}",
	@endforeach
];

var config2 = {
	type: 'bar',
	data: {
		datasets: [{
			data: [
				@foreach ($teams as $body_type => $array)
				{{$array['count']}},
				@endforeach
			],
			backgroundColor: colors,
		}],
		labels: [
			@foreach ($teams as $body_type => $array)
			'{{$body_type}}',
			@endforeach
		]
	},
	options: {
		legend: {
			display: false
		},
		responsive: true
	}
};

var config3 = {
	type: 'pie',
	data: {
		datasets: [{
			data: [
				@foreach ($teams as $body_type => $array)
				{{$array['sum']}},
				@endforeach
			],
			backgroundColor: colors,
		}],
		labels: [
			@foreach ($teams as $body_type => $array)
			'{{$body_type}}',
			@endforeach
		]
	},
	options: {
		legend: {
			display: false
		},
		responsive: true
	}
};


var colors = [
	@foreach ($colors as $color => $array)
	"{{random_rgba(1)}}",
	@endforeach
];

var config4 = {
	type: 'bar',
	data: {
		datasets: [{
			data: [
				@foreach ($colors as $color => $array)
				{{$array['count']}},
				@endforeach
			],
			backgroundColor: colors,
		}],
		labels: [
			@foreach ($colors as $color => $array)
			'{{$color}}',
			@endforeach
		]
	},
	options: {
		legend: {
			display: false
		},
		responsive: true
	}
};

var config5 = {
	type: 'pie',
	data: {
		datasets: [{
			data: [
				@foreach ($colors as $color => $array)
				{{$array['sum']}},
				@endforeach
			],
			backgroundColor: colors,
		}],
		labels: [
			@foreach ($colors as $color => $array)
			'{{$color}}',
			@endforeach
		]
	},
	options: {
		legend: {
			display: false
		},
		responsive: true
	}
};

</script>


<script type="text/javascript">
	window.onload = function() {
		var ctx1 = document.getElementById('super-general').getContext('2d');
		window.myPie = new Chart(ctx1, config1);

		var ctx2 = document.getElementById('teams-count').getContext('2d');
		window.myPie = new Chart(ctx2, config2);

		var ctx3 = document.getElementById('teams-sum').getContext('2d');
		window.myPie = new Chart(ctx3, config3);

		var ctx4 = document.getElementById('colors-count').getContext('2d');
		window.myPie = new Chart(ctx4, config4);

		var ctx5 = document.getElementById('colors-sum').getContext('2d');
		window.myPie = new Chart(ctx5, config5);
	};
</script>
@endsection
