<div class="table-responsive-lg">
	<table class="table table-striped table-hovere table-sm table-bordered text-center">
		<thead>
			<tr>
				<th> id </th>
				<th> Name </th>
				<th> Country </th>
				<th> Height </th>
				<th> Age </th>
				<th> Size </th>
				<th> Boobs </th>
				<th colspan="2"> Actions </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($stars as $star)
				<tr>
					<th> {{$star->id}} </th>
					<td> <a href="{{route('star.show', $star)}}"> {{$star->name}} </a> </td>
					<td> {{$star->country ?? '-'}} </td>
					<td> {{$star->height ?? '-'}} </td>
					<td> {{$star->age ?? '-'}} </td>
					<td> {{$star->size ?? '-'}} </td>
					<td> {{$star->boobs ?? '-'}} </td>
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
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
