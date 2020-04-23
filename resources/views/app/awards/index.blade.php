@extends('layouts.app')
@section('title') Awards List @endsection
@section('content')
	<div class="card">
		<div class="card-body">

			<div class="table-responsive-lg">
				<table class="table table-striped table-hover table-sm table-bordered text-center">
					<thead>
						<tr>
							<th> # </th>
							<th> Star </th>
							<th> Title </th>
							<th> Year </th>
							<th> Month </th>
							<th> GAward </th>
							<th> Action </th>
						</tr>
					</thead>
					<tbody>
						@foreach ($awards as $i => $award)
							<tr>
								<th> {{$i+1}} </th>
								<td> <a href="{{route('star.show', $award->star_id)}}"> {{$award->star->name ?? 'DB Error'}} </a> </td>
								<td> {{$award->title ?? '-'}} </td>
								<td> {{$award->year ?? '-'}} </td>
								<td> {{$award->month ?? '-'}} </td>
								<td>
									@if ($award->gaward)
										<b class="text-success"> Yes </b>
									@else
										<span> No </span>
									@endif
								</td>
								<td>
									<form class="d-inline" action="{{route('award.destroy', $award)}}" method="post">
										@csrf
										@method('DELETE')
										<button type="submit" onclick="return confirm('Are you sure?');" class="btn btn-link btn-sm">
											<i class="material-icons icon text-danger">delete</i>
										</button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			{{$awards->links()}}
		</div>
	</div>
@endsection
