@extends('admin.partials.master')

@section('title')
    Employees
@endsection
@section('users')
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
            <div class="row">
                <div class="col-sm-xs-12 col-md-12">
                    <div class="card pt-3">
                        <div class="card-header justify-content-between">
                            <h4>Add New Employee</h4>
                        </div>
                        <div class="card-body p-5">
                            <form method="POST" action="{{route('employee.register')}}" enctype="multipart/form-data">
                                @csrf                                
                                <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row mt-3">
                                        <label for="first_name" class="col-sm-4 col-form-label">First Name:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control custom-input" id="first_name" name="first_name" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="last_name" class="col-sm-4 col-form-label">Last Name:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control custom-input" id="last_name" name="last_name" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="email" class="col-sm-4 col-form-label">Email:</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control custom-input" id="email" name="email" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="phone" class="col-sm-4 col-form-label">Telephone:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control custom-input" id="phone" name="phone" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="address" class="col-sm-4 col-form-label">Address:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control custom-input" id="address" name="address" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="city" class="col-sm-4 col-form-label">City/Town:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control custom-input" id="city" name="city" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="postcode" class="col-sm-4 col-form-label">Postcode:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control custom-input" id="postcode" name="postcode" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3 mt-lg-0">   
                                    <div class="form-group row mt-3">
                                        <label for="age" class="col-sm-4 col-form-label">Age:</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control custom-input" id="age" name="age" placeholder="">
                                        </div>
                                    </div>   
                                    <div class="form-group row mt-3">
                                        <label class="col-sm-12 col-form-label">Do you own a van or car you can use for your gardening business?</label>
                                        <div class="col-sm-12 d-flex justify-content-around">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" name="van" id="yes" value="yes" required>
                                                <label class="form-check-label" for="yes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" name="van" id="no" value="no" required>
                                                <label class="form-check-label" for="no">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-3">
                                        <label for="about" class="col-sm-12 col-form-label">Why would you like to work for us?</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" id="about" name="about" placeholder=""></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="cv" class="col-sm-4 col-form-label">CV:</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control custom-input" id="cv" name="cv">                                            
                                        </div>
                                    </div>

                                    <div class="form-group row mt-3">
                                        <label for="id_document" class="col-sm-4 col-form-label">Passport / Driving License:</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control custom-input" id="id_document" name="id_document">                                            
                                        </div>
                                    </div>
                    
                                </div>
                                </div>                                
                                <div class="form-group mt-4 d-flex justify-content-between">
                                    <a href="{{route('admin.employees')}}" class="btn btn-outline-secondary">
                                        <i class="bx"></i>Back
                                    </a>
                                    <button type="submit" class="btn btn-outline-primary">Create</button>
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