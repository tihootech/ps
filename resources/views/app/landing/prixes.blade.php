@extends('layouts.app')
@section('title') Prixes, Year : {{$year}} @endsection
@section('content')


	<div class="row">
		@foreach ($prixes as $i => $collection)
			@if ($collection->count())
				<div class="col-md-4 my-2">
					<div class="card">
						<div class="card-body text-center">
							<h3 class="mb-3"> {{mn($i+1)}} </h3>
							<table class="table">
								<thead>
									<tr>
										<th> Star </th>
										<th> Points </th>
									</tr>
								</thead>
								<tbody>
									@foreach ($collection as $star)
										<tr>
											<td> <a href="{{route('star.show', $star->id)}}"> {{$star->name}} </a> </td>
											<td class="text-danger"> {{nf($star->sum)}} </td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			@endif
		@endforeach
	</div>

	<div class="card">
		<div class="card-body">
			<div class="table-responsive-lg">
				<table class="table table-striped table-sm table-hover table-bordered text-center">
					<thead>
						<tr>
							<th> Star </th>
							<th> Golden Prixes </th>
							<th> Silver Prixes </th>
							<th> Bronze Prixes </th>
							<th> Positions </th>
						</tr>
					</thead>
					<tbody>
						@foreach ($grands as $star_name => $counts)
							<tr>
								<th> {{$star_name}} </th>
								<td> {{$counts['Golden Prix']}} </td>
								<td> {{$counts['Silver Prix']}} </td>
								<td> {{$counts['Bronze Prix']}} </td>
								<td> {{$counts['Position']}} </td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="card my-3">
		<div class="card-body">
			@for ($x=0; $x < 2; $x++)
				<div class="table-responsive-lg">
					<table class="table table-striped table-hover table-sm table-bordered text-center">
						<thead>
							<tr>
								<th> Rank </th>
								@for ($i=6*$x; $i < 6+(6*$x); $i++)
									<th colspan="2"> {{mn($i+1)}} </th>
								@endfor
							</tr>
						</thead>
						<tbody>
							@for ($y=0; $y < 10; $y++)
								<tr>
									<td> {{$y+1}} </td>
									@for ($z=6*$x; $z < 6+(6*$x); $z++)
										<td>
											@isset($tracks[$z][$y])
												<a href="{{route('star.show', $tracks[$z][$y]->id)}}"> {{$tracks[$z][$y]->name}} </a>
											@else
												-
											@endisset
										</td>
										<td>
											@isset($tracks[$z][$y])
												{{nf($tracks[$z][$y]->sum)}}
											@else
												-
											@endisset
										</td>
									@endfor
								</tr>
							@endfor
						</tbody>
					</table>
				</div>
			@endfor
		</div>
	</div>
@endsection
