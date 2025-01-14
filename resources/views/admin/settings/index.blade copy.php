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
                            <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
                                @csrf                                
                                <div id="smtpDiv" class="">
                                    <div class="form-group">
                                        <label for="paypal_email" class="form-control-label">Paypal Settings:</label>
                                        <input type="email" name="paypal_email" placeholder="Account email address" value="{{ $setting->paypal_email }}" class="form-control" id="paypal_email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="paypal_api_key" placeholder="API key" value="{{ $setting->paypal_api_key }}" class="form-control" id="paypal_api_key">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="paypal_api_password" placeholder="API password" value="{{ $setting->paypal_api_password }}" class="form-control" id="paypal_api_password">
                                    </div>
                                </div>

                                <div id="smtpDiv" class="">
                                    <div class="form-group">
                                        <label for="stripe_email" class="form-control-label">Stripe Settings:</label>
                                        <input type="email" name="stripe_email" placeholder="Account email address" value="{{ $setting->stripe_email }}" class="form-control" id="stripe_email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="stripe_api_key" placeholder="API key" value="{{ $setting->stripe_api_key }}" class="form-control" id="stripe_api_key">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="stripe_api_password" placeholder="API password" value="{{ $setting->stripe_api_password }}" class="form-control" id="stripe_api_password">
                                    </div>
                                </div>

                                <div id="smtpDiv" class="">
                                    <div class="form-group">
                                        <label for="google_api_key" class="form-control-label">Google API:</label>
                                        <input type="text" name="google_api_key" placeholder="Google API key" value="{{ $setting->google_api_key }}" class="form-control" id="google_api_key">
                                    </div>
                                </div>

                                <div id="smtpDiv" class="row">
                                    <div class="form-group col-md-6">
                                        <label for="hourly_rate" class="form-control-label">Hourly Rate:</label>
                                        <input type="text" name="hourly_rate" placeholder="Hourly Rate" value="{{ $setting->hourly_rate }}" class="form-control" id="hourly_rate">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="jumbo_bag_rate" class="form-control-label">Jumbo Bag Rate:</label>
                                        <input type="text" name="jumbo_bag_rate" placeholder="Jumbo Bag Rate" value="{{ $setting->jumbo_bag_rate }}" class="form-control" id="jumbo_bag_rate">
                                    </div>
                                </div>

                                <hr>

                                @for ($i = 0; $i < count($conditionsLabels); $i += 4)
                                    <div class="row">
                                        @for ($j = $i; $j < $i + 4; $j++)
                                            <div class="form-group col-md-3">
                                                <label for="condition{{ $j + 1 }}" class="form-control-label">{{ $conditionsLabels[$j] }}</label>
                                                <input type="text" name="condition{{ $j + 1 }}" placeholder="" value="{{ $conditions[$j]->value }}" class="form-control" id="condition{{ $j + 1 }}">
                                            </div>
                                        @endfor
                                    </div>
                                @endfor

                                <hr>

                                @for ($i = 0; $i < count($servicesLabels); $i += 4)
                                    <div class="row">
                                        @for ($j = $i; $j < $i + 4; $j++)
                                            <div class="form-group col-md-3">
                                                <label for="service{{ $j + 1 }}" class="form-control-label">{{ $servicesLabels[$j] }}</label>
                                                <input type="text" name="service{{ $j + 1 }}" placeholder="" value="{{ $services[$j]->value }}" class="form-control" id="service{{ $j + 1 }}">
                                            </div>
                                        @endfor
                                    </div>
                                @endfor

                                
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-outline-primary" tabindex="4"> Save Settings</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('admin.common.delete-ajax')
@include('admin.common.common-modal')
