@extends('admin.layout.master')

@section('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tài khoản</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Tạo tài khoản</h6>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group input-group-outline">
            <label class="form-label">Type here...</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <i class="fa fa-bell cursor-pointer"></i>
            </a>
            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            </ul>
          </li>
          <li class="nav-item d-flex align-items-center">
              <i class="fa fa-user me-sm-1"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
@endsection

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tạo tài khoản</h3>
            </div>
            @if (session('message'))
              <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-success" role="alert">
                          {{ session('message') }}
                      </div>
                  </div>
              </div>
            @endif
            <!-- form start -->      
            <div class="card card-plain">
              <div class="card-body">
                <form role="form" method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="code">Mã nhân viên</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="text" value="{{ old('code') }}" name="code" class="form-control" placeholder="Mã nhân viên">
                    </div>
                  </div>
                  @error('code')
                    <span class="text-danger">{{ $message }}<span>
                  @enderror 
                  </div>
                    
                  <div class="form-group">
                    <label for="name">Họ tên</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="text" value="{{ old('name') }}" name="name" class="form-control" placeholder="Họ Tên">
                    </div>
                    @error('name')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror 
                  </div>
                  

                  <div class="form-group">'
                    <label for="email">Email</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="text" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email">
                    </div>
                    @error('email')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror
                  </div>
                   

                  <div class="form-group">
                    <div class="input-group input-group-outline mb-3">
                      <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    @error('password')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror 
                  </div>
                  

                  <div class="form-group">
                    <div class="input-group input-group-outline mb-3">
                      <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                    @error('password_confirmation')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror 
                  </div>
                 

                  <div class="form-group">
                    <label for="dob">Ngày sinh</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="date" class="form-control" value="{{ old('dob') }}" name="dob" placeholder="Ngày sinh">
                    </div>
                    @error('dob')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror
                  </div>
                  

                  <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="text" class="form-control" value="{{ old('address') }}" name="address" placeholder="Địa chỉ">
                    </div>
                    @error('address')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror 
                  </div>
                 

                  <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="text" class="form-control" value="{{ old('phone') }}" name="phone" placeholder="Số điện thoại">
                    </div>
                    @error('phone')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror 
                  </div>
                  

                  <div class="form-group">
                    <label for="image">Hình ảnh</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="file" class="form-control" value="{{ old('image') }}" name="image" placeholder="Hình ảnh">
                    </div>
                    @error('image')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror 
                  </div>
                  
                  <div class="form-group">
                    <label for="role">Phòng ban</label>
                    <div class="input-group input-group-outline mb-3" style="border: black 1px">
                      <select name="department" class="form-control" id="department">
                        <option value="">---Please Select---</option>
                        @foreach ($departments as $department)
                          <option {{ old('department') == $department->id ? 'selected' : '' }} value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('department')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="role">Chức vụ</label>
                    <div class="input-group input-group-outline mb-3" style="border: black 1px">
                      <select name="position" class="form-control" id="position">
                        <option value="">---Please Select---</option>
                        @foreach ($positions as $position)
                        <option {{ old('position') == $position->id ? 'selected' : '' }} value="{{$position->id}}">{{$position->name}}</option>
                      @endforeach
                      </select>
                    </div>
                    @error('position')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <div class="input-group input-group-outline mb-3" style="border: black 1px">
                      <select name="status" class="form-control" id="status">
                        <option value="">---Please Select---</option>
                        <option {{ old('role') == '-1' ? 'selected' : '' }} value="0">Đã nghỉ việc</option>
                        <option {{ old('role') == '1' ? 'selected' : '' }} value="1">Đang làm việc</option>
                      </select>
                    </div>
                    @error('status')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="role">Phân quyền</label>
                    <div class="input-group input-group-outline mb-3" style="border: black 1px">
                      <select name="role" class="form-control" id="role">
                        <option value="">---Please Select---</option>
                        <option {{ old('role') == '0' ? 'selected' : '' }} value="0">Quản lí</option>
                        <option {{ old('role') == '1' ? 'selected' : '' }} value="1">Nhân viên</option>
                        <option {{ old('role') == '2' ? 'selected' : '' }} value="2">HR</option>
                      </select>
                    </div>
                    @error('role')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror
                  </div>
                  <div class="card-footer">
                    @csrf
                    <button type="submit" class="btn btn-primary">Create</button>
                  </div>
              </form>   
            </div>
          </div>
        </div>  
      </div>      
    </div>
  </div>
</section>
@endsection