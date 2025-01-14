@extends('admin.partials.master')

@section('title')
    Settings
@endsection
@section('settings')
    active
@endsection
@php
    if(isset($_GET['q'])){
        $q          = $_GET['q'];
    }
@endphp
@section('main-content')
    <section class="section">
        <div class="section-body">
            <div id="output-status"></div>
            <div class="row">
                <div class="col-sm-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-header input-title">
                            <h4>Settings</h4>
                        </div>
                        <div class="card-body">
                            <h5>Comming Soon....</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('admin.common.delete-ajax')
@include('admin.common.common-modal')
