@extends('layouts.app')

@section('title') Home @endsection

@section('content')
    <div class="row">
        <div class="col-md-7">

            @if (count($birthdays))
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="m-0 text-primary"> <i class="mdi mdi-cake"></i> Todays Birthdays </h4>
                    </div>
                    <div class="card-body">
                        @foreach ($birthdays as $star_with_today_birthday)
                            <p>
                                <a href="{{route('star.show', $star_with_today_birthday)}}">
                                    {{$star_with_today_birthday->name}}
                                </a>
                                <span class="mx-1"> {{$star_with_today_birthday->age}} Years Old Now </span>
                            </p>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 text-primary"> <i class="mdi mdi-plus"></i> Quick Plus </h4>
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
                            <div class="col-md-8">
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
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="i3" name="points_type" class="custom-control-input" value="photo"
                                    @if(session('points_type') == 'photo') checked @endif>
                                    <label class="custom-control-label" for="i3"> photo </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="i4" name="points_type" class="custom-control-input" value="dream"
                                    @if(session('points_type') == 'dream') checked @endif>
                                    <label class="custom-control-label" for="i4"> dream </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" onclick="clone('#inputs > input:first', '#inputs')" class="btn btn-warning btn-block">
                                    New Row
                                </button>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block"> Confirm </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="m-0 text-primary"> <i class="mdi mdi-history"></i> Recently Added Stars </h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between text-center">
                        @foreach ($recent_stars as $recent_star)
                            <div>
                                <a href="{{route('star.show', $recent_star)}}">
                                    {{$recent_star->name}}
                                </a>
                                <hr>
                                <span>
                                    {{pdate($recent_star->created_at)}}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @if (session('stars'))
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="m-0 text-primary"> <i class="mdi mdi-format-list-bulleted"></i> Stars List </h4>
                    </div>
                    <div class="card-body">
                        @include('includes.stars_table', ['stars' => session('stars'), 'in_home' => true])
                    </div>
                </div>
            @endif

        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 text-primary"> <i class="mdi mdi-account-plus-outline"></i> Quick Add </h4>
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
                    <h4 class="m-0 text-primary"> <i class="mdi mdi-charity"></i> Quick Master </h4>
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
                    <h4 class="m-0 text-primary"> <i class="mdi mdi-face"></i> Quick Kid </h4>
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
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 text-primary"> <i class="mdi mdi-flag"></i> Watch List </h4>
                </div>
                <div class="card-body">
                    @foreach (settings()->watchListAsArray() as $name)
                        @if ($name)
                            <div class="card card-body bg-info text-light p-2 px-3 d-inline-block m-1">
                                {{$name}}
                                <form class="d-inline text-center" action="{{route('quick.add')}}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{$name}}" name="star">
                                    <button type="submit" class="btn btn-primary btn-sm ml-2 p-1" title="Promote">
                                        <i class="mdi mdi-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endforeach
                    <hr>
                    <a href="#edit-watch-list" data-toggle="collapse" class="text-success"> <i class="mdi mdi-pencil"></i> Edit </a>
                    <form class="collapse text-center" method="post" id="edit-watch-list" action="{{route('update_settings')}}">
                        @csrf
                        <input type="hidden" name="note" value="{{settings('note')}}">
                        <textarea name="watch_list" class="form-control mt-3">{{settings('watch_list')}}</textarea>
                        <button type="submit" class="btn btn-primary mt-2"> Save </button>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <form class="card" action="{{route('update_settings')}}" method="post">
                @csrf
                <div class="card-header">
                    <h4 class="m-0 text-primary"> <i class="mdi mdi-tooltip-edit"></i> Notepad </h4>
                </div>
                <div class="card-body">
                    <input type="hidden" name="watch_list" value="{{settings('watch_list')}}">
                    <textarea name="notepad" rows="4" class="form-control">{{settings('notepad')}}</textarea>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"> Save </button>
                </div>
            </form>
        </div>
    </div>
@endsection
