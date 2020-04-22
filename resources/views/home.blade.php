@extends('layouts.app')
@section('title') Home @endsection

@section('content')
    <div class="row">
        <div class="col-md-6">

            @if (count($birthdays))
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="m-0 text-primary"> <i class="material-icons">cake</i> Todays Birthdays </h4>
                    </div>
                    <div class="card-body">
                        @foreach ($birthdays as $star_with_today_birthday)
                            <a href="{{route('star.show', $star_with_today_birthday)}}" class="mx-2">
                                {{$star_with_today_birthday->name}}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 text-primary"> <i class="material-icons">add</i> Quick Plus </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('quick.plus')}}" method="post">
                        @csrf
                        <div id="inputs">
                            @foreach ($strings as $string)
                                <input type="text" class="form-control form-control-lg my-1" name="strings[]" value="{{$string}}" autocomplete="off">
                            @endforeach
                        </div>
                        <hr>
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="i1" name="points_type" class="custom-control-input" value="regular"
                                    @if(!session('points_type') || session('points_type') == 'regular') checked @endif>
                                    <label class="custom-control-label" for="i1"> regular </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="i2" name="points_type" class="custom-control-input" value="instagram"
                                    @if(session('points_type') == 'instagram') checked @endif>
                                    <label class="custom-control-label" for="i2"> instagram </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="button" onclick="clone('#inputs > input:first', '#inputs')" class="btn btn-warning btn-block">
                                    New Row
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-block"> Confirm </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if (session('stars'))
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="m-0 text-primary"> <i class="material-icons">list</i> Stars List </h4>
                    </div>
                    <div class="card-body">
                        @include('includes.stars_table', ['stars' => session('stars'), 'no_action' => true])
                    </div>
                </div>
            @endif

        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 text-primary"> <i class="material-icons">person_add</i> Quick Add </h4>
                </div>
                <div class="card-body">
                    <form class="text-center" action="{{route('quick.add')}}" method="post">
                        @csrf
                        <input type="text" class="form-control form-control-lg mb-2" autocomplete="off" name="star">
                        <button type="submit" class="btn btn-primary"> Add New Star </button>
                    </form>
                </div>
            </div>
            <div class="card my-3">
                <div class="card-header">
                    <h4 class="m-0 text-primary"> <i class="material-icons">rate_review</i> Quick Master </h4>
                </div>
                <div class="card-body">
                    <form class="row" action="{{route('quick.master')}}" method="post">
                        @csrf
                        <div class="col-md-6">
                            <label> Star </label>
                            <input type="text" class="form-control form-control-lg" name="star">
                        </div>
                        <div class="col-md-3">
                            <label> Degree </label>
                            <input type="number" class="form-control form-control-lg" name="degree">
                        </div>
                        <div class="col-md-3 align-self-center">
                            <button type="submit" class="btn btn-primary btn-block"> Confirm </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 text-primary"> <i class="material-icons">spa</i> Quick Kid </h4>
                </div>
                <div class="card-body">
                    <form class="row" action="{{route('quick.kid')}}" method="post">
                        @csrf
                        <div class="col-md-5">
                            <label> Star </label>
                            <input type="text" class="form-control form-control-lg" name="star">
                        </div>
                        <div class="col-md-4">
                            <label> Degrees </label>
                            <input type="text" class="form-control form-control-lg" name="degrees">
                        </div>
                        <div class="col-md-3 align-self-center">
                            <button type="submit" class="btn btn-primary btn-block"> Confirm </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
