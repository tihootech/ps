<div class="table-responsive-lg">
	<table class="table table-striped table-sm table-hover table-bordered text-center @isset($in_show) table-sm @endisset">
		<thead>
			<tr>
				@unless (isset($in_show))
					<th> Star </th>
				@endunless
				<th> Amount </th>
				<th> Type </th>
				<th> Year </th>
				<th> Month </th>
				<th> Actual Date </th>
				<th colspan="2"> Actions </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($points as $point)
				<tr>
					@unless (isset($in_show))
						<th>
							@if ($point->star)
								<a href="{{route('star.show', $point->star)}}"> {{$point->star->name}} </a>
							@else
								<em> STAR DELETED </em>
							@endif
						</th>
					@endunless
					<td> {{nf($point->amount)}} </td>
					<td> {{$point->type}} </td>
					<td> {{$point->year}} </td>
					<td> {{$point->month}} </td>
					<td> {{$point->created_at->format('Y-m-d, H:i')}} </td>
					<td>
						<a href="{{route('point.edit', $point)}}" class="btn btn-link">
							<i class="mdi mdi-pencil text-success"></i>
						</a>
					</td>
					<td>
						<form class="d-inline" action="{{route('point.destroy', $point)}}" method="post">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-link">
								<i class="mdi mdi-delete text-danger"></i>
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
