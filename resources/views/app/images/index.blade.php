@extends('layouts.app')
@section('title') Uploaded Images @endsection
@section('content')
	<div class="card">
		<div class="card-body">

			<div class="table-responsive-lg">
				<table class="table table-striped table-hover table-sm table-bordered text-center">
					<thead>
						<tr>
							<th> # </th>
							<th> Star </th>
							<th> Type </th>
							<th> Info </th>
							<th colspan="2"> Actions </th>
						</tr>
					</thead>
					<tbody>
						@foreach ($images as $i => $image)
							<tr>
								<th> {{$i+1}} </th>
								<td> <a href="{{route('star.show', $image->star_id)}}"> {{$image->star->name ?? 'DB Error'}} </a> </td>
								<td> {{$image->type ?? '-'}} </td>
								<td> {{$image->info ?? '-'}} </td>
								<td>
									<a href="{{asset($image->path)}}" target="_blank"> Open Image In A New Tab </a>
								</td>
								<td>
									<form class="d-inline" action="{{route('image.destroy', $image)}}" method="post">
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

			{{$images->links()}}
		</div>
	</div>
@endsection
