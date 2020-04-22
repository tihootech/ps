<div class="table-responsive-lg">
	<table class="table table-striped table-hover table-bordered text-center">
		<thead>
			<tr>
				<th> Star </th>
				<th> Amount </th>
				<th> Type </th>
				<th> Year </th>
				<th> Month </th>
				@unless (isset($no_action))
					<th colspan="2"> Actions </th>
				@endunless
			</tr>
		</thead>
		<tbody>
			@foreach ($points as $point)
				<tr>
					<th>
						@if ($point->star)
							<a href="{{route('star.show', $point->star)}}"> {{$point->star->name}} </a>
						@else
							<em> STAR DELETED </em>
						@endif
					</th>
					<td> {{nf($point->amount)}} </td>
					<td> {{$point->type}} </td>
					<td> {{$point->year}} </td>
					<td> {{$point->month}} </td>
					@unless (isset($no_action))
						<td>
							<a href="{{route('point.edit', $point)}}" class="btn btn-link btn-sm">
								<i class="material-icons icon text-success">edit</i>
							</a>
						</td>
						<td>
							<form class="d-inline" action="{{route('point.destroy', $point)}}" method="post">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-link btn-sm">
									<i class="material-icons icon text-danger">delete</i>
								</button>
							</form>
						</td>
					@endunless
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
