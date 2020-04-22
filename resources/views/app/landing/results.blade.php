@extends('layouts.app')
@section('title') Results, Year : {{$year}} @endsection
@section('content')
	<div class="card">
		<div class="card-body p-0">
	        <table class="table table-bordered table-hover table-striped table-sm text-center">
	            <thead>
	                <tr>
	                    <th scope="col">#</th>
	                    <th scope="col">Star</th>
	                    @for ($i=1; $i <= 12; $i++)
	                        <th scope="col" class="text-capitalize">
	                            <a href="?order={{mn($i)}}" class="@if($active_month == mn($i)) text-danger @endif"> {{mn($i)}} </a>
	                        </th>
	                    @endfor
	                    <th scope="col">
							<a href="?order=sum" class="@if($active_month == 'sum') text-danger @else text-success @endif"> Sum </a>
						</th>
	                </tr>
	            </thead>
	            <tbody>
	                @foreach ($results as $i => $star)
	                    <tr>
	                        <th scope="row">{{$i+1}}</th>
	                        <td> <a href="{{route("star.show", $star->id)}}"> {{$star->name}} </a> </td>
	                        @for ($i=1; $i <= 12; $i++)
	                            @php $month = mn($i); @endphp
	                            <td> {{nf($star->$month ?? 0)}} </td>
	                        @endfor
	                        <td> {{nf($star->sum)}} </td>
	                    </tr>
	                @endforeach
	                <tr>
	                    <th scope="col">#</th>
	                    <th scope="col"> {{count($results)}} </th>
	                    @for ($i=1; $i <= 12; $i++)
	                        @php $month = mn($i); @endphp
	                        <th scope="col" class="text-capitalize"> {{nf($results->sum($month))}} </th>
	                    @endfor
	                    <th scope="col" class="text-success"> {{nf($results->sum('sum'))}} </th>
	                </tr>
	            </tbody>
	        </table>
	    </div>
	</div>
@endsection
