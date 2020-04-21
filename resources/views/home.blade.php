@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 text-primary"> <i class="material-icons">add</i> Quick Plus </h4>
                </div>
                <div class="card-body">
                    <form class="" action="index.html" method="post">
                        <div id="inputs">
                            <input type="text" class="form-control form-control-lg my-1" name="strings[]">
                        </div>
                        <hr>
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="i1" name="type" class="custom-control-input" value="regular" checked>
                                    <label class="custom-control-label" for="i1"> regular </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="i2" name="type" class="custom-control-input" value="instagram" >
                                    <label class="custom-control-label" for="i2"> instagram </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="button" onclick="clone('#inputs > input:first', '#inputs')" class="btn btn-warning btn-block">
                                    Add
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-block"> Confirm </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
