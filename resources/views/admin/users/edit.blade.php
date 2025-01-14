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
                            <h4>Edit Employee</h4>
                        </div>
                        <div class="card-body p-5">
                            <form method="POST" action="{{route('admin.employee.update')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$employee->id}}">
                                <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row mt-3">
                                        <label for="first_name" class="col-sm-4 col-form-label">First Name:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control custom-input" id="first_name" name="first_name" placeholder="" value="{{old('first_name', $employee->first_name)}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="last_name" class="col-sm-4 col-form-label">Last Name:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control custom-input" id="last_name" name="last_name" placeholder="" value="{{old('last_name', $employee->last_name)}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="email" class="col-sm-4 col-form-label">Email:</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control custom-input" id="email" name="email" placeholder="" value="{{old('email', $employee->email)}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="phone" class="col-sm-4 col-form-label">Telephone:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control custom-input" id="phone" name="phone" value="{{old('phone', $employee->phone)}}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="address" class="col-sm-4 col-form-label">Address:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control custom-input" id="address" name="address" value="{{old('address', $employee->address)}}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="city" class="col-sm-4 col-form-label">City/Town:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control custom-input" id="city" name="city" value="{{old('city', $employee->city)}}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="postcode" class="col-sm-4 col-form-label">Postcode:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control custom-input" id="postcode" name="postcode" value="{{old('postcode',$employee->postcode)}}" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3 mt-lg-0">   
                                    <div class="form-group row mt-3">
                                        <label for="age" class="col-sm-4 col-form-label">Age:</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control custom-input" id="age" name="age" value="{{old('age', $employee->age)}}" placeholder="">
                                        </div>
                                    </div>   
                                    <div class="form-group row mt-3">
                                        <label class="col-sm-12 col-form-label">Do you own a van or car you can use for your gardening business?</label>
                                        <div class="col-sm-12 d-flex justify-content-around">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" name="van" id="yes" value="yes" {{ old('van', $employee->van) === 'Yes' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="yes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" name="van" id="no" value="no" {{ old('van', $employee->van) === 'No' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="no">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-3">
                                        <label for="about" class="col-sm-12 col-form-label">Why would you like to work for us?</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" id="about" name="about" placeholder="">{{ old('about', $employee->about) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="cv" class="col-sm-4 col-form-label">CV:</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control custom-input" id="cv" name="cv">
                                            @if($errors->has('cv'))
                                                <span class="text-danger">{{ $errors->first('cv') }}</span>
                                            @else
                                                @if($employee->cv)
                                                    <p>Current CV: <a href="{{ asset('public/uploads/' . $employee->cv) }}" target="_blank">{{ $employee->cv }}</a></p>
                                                @else
                                                    <p>No CV uploaded.</p>
                                                @endif
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mt-3">
                                        <label for="id_document" class="col-sm-4 col-form-label">Passport / Driving License:</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control custom-input" id="id_document" name="id_document">
                                            @if($errors->has('id_document'))
                                                <span class="text-danger">{{ $errors->first('id_document') }}</span>
                                            @else
                                                @if($employee->id_document)
                                                    <p>Current Document: <a href="{{ asset('public/uploads/' . $employee->id_document) }}" target="_blank">{{ $employee->id_document }}</a></p>
                                                @else
                                                    <p>No document uploaded.</p>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                    
                                </div>
                                </div>                                
                                <div class="form-group mt-4 d-flex justify-content-between">
                                    <a href="{{route('admin.employees')}}" class="btn btn-outline-secondary">
                                        <i class="bx"></i>Back
                                    </a>
                                    <button type="submit" class="btn btn-outline-primary">Edit</button>
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