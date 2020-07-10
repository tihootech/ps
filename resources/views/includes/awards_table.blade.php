@if ($awards->count())
    <div class="table-responsive-lg">
        <table class="table table-striped table-hover table-sm table-bordered text-center">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Star </th>
                    <th> Title </th>
                    <th> Year </th>
                    <th> Month </th>
                    <th> Type </th>
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
                            @if ($award->type == 'gaward')
                                <b class="text-danger"> GAward </b>
                            @elseif($award->type == 'beauty')
                                <span class="text-success"> Beauty </span>
                            @else
                                <span> {{ucfirst($award->type)}} </span>
                            @endif
                        </td>
                        <td>
                            <form class="d-inline" action="{{route('award.destroy', $award)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?');" class="btn btn-link">
                                    <i class="mdi mdi-delete text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-warning">
        No Awards yet...
    </div>
@endif
