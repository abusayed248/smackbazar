@extends('layouts.admin')

@section('title', 'Garden')
    
@section('admin_content')

	<div class="container-fluid px-4">
		<div class="row">
	        <div class="col-xl-4">
	            <h3 class="mt-4">Garden</h3>
	        </div>
	        <div class="col-xl-4">
	            <div class="mt-4">
	                
	            </div>
	        </div>
	        <div class="col-xl-4 text-end">
	            <a href="{{ route('admin.garden.create') }}" class="mt-4 btn btn-sm btn-danger">+Add</a>
	        </div>
	    </div>
	    
	    <div class="row">
	        <div class="col-xl-12 col-md-12">
	            <div class="card text-white mb-4">
	                <div class="card-body">
	                    <form action="{{ route('admin.garden.index') }}" method="get">

	                        <table class="table table-striped">
	                            <div class="row">
	                                <div class="col-xl-7">
	                                    <div class="form-group">
	                                        <select name="per_page" onchange="submit()" id="per_page" class="custom-select">
	                                            <option {{ request('per_page')==10?'selected':'' }} value="10">10</option>
	                                            <option {{ request('per_page')==20?'selected':'' }} value="20">20</option>
	                                            <option {{ request('per_page')==30?'selected':'' }} value="30">30</option>
	                                            <option {{ request('per_page')==40?'selected':'' }} value="40">40</option>
	                                            <option {{ request('per_page')==50?'selected':'' }} value="50">50</option>
	                                            <option {{ request('per_page')==60?'selected':'' }} value="60">60</option>
	                                            <option {{ request('per_page')==70?'selected':'' }} value="70">70</option>
	                                            <option {{ request('per_page')==80?'selected':'' }} value="80">80</option>
	                                            <option {{ request('per_page')==90?'selected':'' }} value="90">90</option>
	                                            <option {{ request('per_page')==100?'selected':'' }} value="100">100</option>
	                                        </select>
	                                        <label for="per_page" class="text-dark">Per Page</label>
	                                    </div>
	                                </div>

	                                <div class="col-xl-5">
	                                    <div class="row">
	                                        <div class="col-sm-7">
	                                            <input type="search" value="{{ request('keyword') }}" name="keyword" class="custom-select w-100">
	                                        </div>
	                                        <div class="col-sm-5 text-start"> 
	                                            <button onclick="click()" class="btn btn-success btn-sm">Search</button>
	                                            <a href="{{ route('admin.garden.index') }}" class="btn btn-danger btn-sm">Reset</a>
	                                        </div>
	                                    </div>
	                                </div>

	                            </div>

	                              <thead>
	                                <tr>
	                                  <th scope="col">SL</th>
	                                  <th scope="col">Garden Image</th>
	                                  <th scope="col">Garden Name English</th>
	                                  <th scope="col">Garden Name Bangla</th>
	                                  <th scope="col">Garden Location English</th>
	                                  <th scope="col">Garden Location Bangla</th>
	                                  <th scope="col">Status</th>
	                                  <th scope="col">Action</th>
	                                </tr>
	                              </thead>

	                              <tbody>
	                                @if(!empty($gardens) && $gardens->count())
	                                    @foreach ($gardens as $key => $garden)
	                                    <tr>
	                                          <th scope="row">{{ ++$key }}</th>
	                                          <td><img src="{{ asset('storage/'.$garden->garden_image) }}" height="60" width="100" alt=""></td>
	                                          <td>{{ $garden->garden_name_en }}</td>
	                                          <td>{{ $garden->garden_name_bn }}</td>
	                                          <td>{{ $garden->garden_location_en }}</td>
	                                          <td>{{ $garden->garden_location_bn }}</td>
	                                          <td>
	                                          	@if($garden->status == 1)
	                                          	<a href="{{ route('admin.garden.status.inactive', $garden->id) }}" title="Click to InActivate"><span class='badge bg-success'>Active</span></a>
	                                          	@else
	                                          	<a href="{{ route('admin.garden.status.active', $garden->id) }}" title="Click to Active"><span class='badge bg-danger'>InActive</span></a>
	                                          	@endif
	                                          </td>
	                                          <td colspan="2">
	                                              <a href="{{ route('admin.garden.edit', $garden->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
	                                              <a href="{{ route('admin.garden.destroy', $garden->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
	                                          </td>
	                                    </tr>
	                                    @endforeach
	                                @else
	                                    <tr>
	                                        <td class="text-danger text-center" colspan="10">Garden not found!</td>
	                                    </tr>
	                                @endif
	                              </tbody>
	                        </table>

	                        <div class="row">
	                            <div class="col-xl-12">
	                                {!! $gardens->appends(Request::all())->links() !!}
	                            </div>
	                        </div>  
	                    </form>
	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
    
@endsection
