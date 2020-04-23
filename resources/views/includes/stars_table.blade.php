<div class="table-responsive-lg">
	<table class="table table-striped table-hover table-sm table-bordered text-center">
		<thead>
			<tr>
				<th> # </th>
				<th> Name </th>
				<th> Country </th>
				<th> Height </th>
				<th> Age </th>
				@unless (isset($in_home))
					<th> Birthday </th>
				@endunless
				<th> Color </th>
				<th> Size </th>
				<th> Boobs </th>
				@unless (isset($in_home))
					<th> Year Added </th>
					<th> Awards </th>
					<th colspan="2"> Actions </th>
				@endunless
			</tr>
		</thead>
		<tbody>
			@foreach ($stars as $i => $star)
				<tr>
					<th> {{$i+1}} </th>
					<td> <a href="{{route('star.show', $star)}}"> {{$star->name}} </a> </td>
					<td> {{$star->country ?? '-'}} </td>
					<td> {{$star->height ?? '-'}} </td>
					<td @if($star->birthday) data-toggle="popover"
						data-content="{{$star->birthday->toFormattedDateString()}}" @endif>
						{{$star->age ?? '-'}}
					</td>
					@unless (isset($in_home))
						<td @if($star->younger_than_me()) class="text-danger" @endif>
							{{$star->birthday ? pdate($star->birthday) : '-'}}
						</td>
					@endunless
					<td> {{$star->color ?? '-'}} </td>
					<td> {{$star->size ?? '-'}} </td>
					<td> {{$star->boobs ?? '-'}} </td>
					@unless (isset($in_home))
						<td @if($star->created_at) data-toggle="popover"
							data-content="{{$star->created_at->toFormattedDateString()}}" @endif>
							{{$star->year ?? '-'}}
						</td>
						<td> {{$star->awards_count ?? 0}} </td>
						<td>
							<a href="{{route('star.edit', $star)}}" class="btn btn-link btn-sm">
								<i class="material-icons icon text-success">edit</i>
							</a>
						</td>
						<td>
							<form class="d-inline" action="{{route('star.destroy', $star)}}" method="post">
								@csrf
								@method('DELETE')
								<button type="submit" onclick="return confirm('Are you sure?');" class="btn btn-link btn-sm">
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
