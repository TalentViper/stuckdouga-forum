@extends('admin.partials.master')

@section('title')
    {{__('Dashboard')}}
@endsection
@section('dashboard')
    active
@endsection

@section('main-content')
    <section class="section">
        <div class="row row-cards-one">
            <div class="col-md-12 col-lg-6 col-xl-4">
                <div class="mycard bg1">
                    <div class="left">
                        <h5 class="title">Today's Visits</h5>
                        <span class="number">{{$visits}}</span>
                        <a href="#" class="link">View All</a>
                    </div>
                    <div class="right d-flex align-self-center">
                        <div class="icon">
                            <i class="bx bx-calendar font-size-60"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-4">
                <div class="mycard bg4">
                    <div class="left">
                        <h5 class="title">Total Users</h5>
                        <span class="number">{{$customerCount}}</span>
                        <a href="#" class="link">View All</a>
                    </div>
                    <div class="right d-flex align-self-center">
                        <div class="icon">
                            <i class="bx bxs-user-detail font-size-60"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-4">
                <div class="mycard bg2">
                    <div class="left">
                        <h5 class="title">New Users</h5>
                        <span class="number">{{$todaynewcustomerCount}}</span>
                        <a href="#" class="link">View All</a>
                    </div>
                    <div class="right d-flex align-self-center">
                        <div class="icon">
                            <i class="bx bxs-user-detail font-size-60"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-4">
                <div class="mycard bg3">
                    <div class="left">
                        <h5 class="title">All Galleries</h5>
                        <span class="number">{{$totalGalleries}}</span>
                        <a href="#" class="link">View All</a>
                    </div>
                    <div class="right d-flex align-self-center">
                        <div class="icon">
                            <i class="bx bx-image-alt font-size-60"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-4">
                <div class="mycard bg5" style="min-height: 183px">
                    <div class="left">
                        <h5 class="title">New Galleries</h5>
                        <span class="number">{{$newGalleries}}</span>
                        <a href="#" class="link">View All</a>
                    </div>
                    <div class="right d-flex align-self-center">
                        <div class="icon">
                        <i class="bx bx-image-alt font-size-60"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-4">
                <div class="mycard bg6">
                    <div class="left">
                        <h5 class="title">Total Items</h5>
                        <span class="number">{{$totalMarketItems}}</span>
                        <a href="#" class="link">View All</a>
                    </div>
                    <div class="right d-flex align-self-center">
                        <div class="icon">
                            <i class="bx bxs-news font-size-60"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </section>

    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-sm-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>Latest Users</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Active</th>
                                        <th class="d-flex justify-content-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="result">
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{$customer->full_name}}</td>
                                            <td>{{$customer->email}}</td>
                                            <td>{{$customer->location}}</td>
                                            <td>
                                                @if($customer->is_active == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <div class="form-group">
                                                    <!-- Edit Customer Button with Tooltip -->
                                                    <button class="btn btn-outline-primary edit-customer-btn" data-customer-id="{{ $customer->id }}" data-toggle="tooltip" data-placement="top" title="Edit Customer">
                                                        <i class="bx bx-edit"></i>
                                                    </button>

                                                    <!-- Remove Customer Button with Tooltip -->
                                                    <button class="btn btn-danger remove-customer-btn" style="border-radius: 4px" data-customer-id="{{ $customer->id }}" data-toggle="tooltip" data-placement="top" title="Remove Customer">
                                                        <i class="bx bx-trash"></i>
                                                    </button>

                                                </div>
                                                <!-- <div class="form-group">
                                                    <select class="form-control" name="s">
                                                        <option value="0">Action</option>
                                                        <option value="1">View Customer Details</option>
                                                        <option value="2">Contact Customer</option>
                                                        <option value="3">Customer Bookings</option>
                                                        <option value="4">Customer Jobs</option>
                                                        <option value="5">Create Booking</option>
                                                        <option value="6">Block Customer</option>
                                                    </select>
                                                </div> -->
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                        <div class="row justify-content-center">
                            <nav class="d-flex" id="pagination">
                                 {{ $customers->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-sm-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>Latest Gallery</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Gallery</th>
                                        <th>Last Updated</th>
                                        <th>ArtWorks</th>
                                        <th>Popularity</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="result">
                                    @foreach($galleries as $gallery)
                                        <tr>
                                            <td>{{$gallery -> id}}</td>
                                            <td>{{$gallery -> gallery_name}}</td>
                                            <td><img class="side_links"
                                                src="{{ static_asset('uploads') . '/' . $gallery->gallery_url }}" alt="sidebar links" width="100px"/></td>
                                            <td>{{ \Carbon\Carbon::parse($gallery->created_at)->format('d-m-Y H:i:s') }}</td>
                                            <td>{{$gallery -> artwork_count}}</td>
                                            <td>{{$gallery -> likes}}</td>
                                            <td>@if($gallery->status != 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="justify-content-center">
                                            <div class="form-group">
                                                    <button class="btn btn-outline-primary edit-customer-btn" data-customer-id="{{ $gallery->id }}" data-toggle="tooltip" data-placement="top" title="Edit Gallery">
                                                        <i class="bx bx-edit"></i>
                                                    </button>

                                                    <!-- Remove Customer Button with Tooltip -->
                                                    <button class="btn btn-danger remove-customer-btn" style="border-radius: 4px" data-customer-id="{{ $gallery->id }}" data-toggle="tooltip" data-placement="top" title="Remove Gallery">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                        <div class="row justify-content-center">
                            <nav class="d-flex" id="pagination">
                                {{ $galleries->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
<script>
    $(document).ready(function() {
       

    });
</script>
@endpush
