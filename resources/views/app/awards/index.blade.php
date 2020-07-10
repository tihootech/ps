@extends('layouts.app')
@section('title') Awards List @endsection
@section('content')
	<div class="card">
		<div class="card-body">

			@include('includes.awards_table')

			{{$awards->links()}}
		</div>
	</div>
@endsection
