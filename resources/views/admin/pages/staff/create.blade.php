@extends('admin.layout.master')

@section('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Nhân viên</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Danh sách nhân viên</h6>
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
              <h3 class="card-title">Thêm nhân viên</h3>
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
                <form role="form" method="POST" action="{{ route('admin.staff.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" name="employeeid" placeholder="Mã nhân viên">
                  </div>
                  @error('employeeid')
                    <span class="text-danger">{{ $message }}<span>
                  @enderror 
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Họ tên nhân viên">
                  </div>
                  @error('name')
                    <span class="text-danger">{{ $message }}<span>
                  @enderror
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" name="email" class="form-control" placeholder="Email">
                  </div>
                  @error('email')
                    <span class="text-danger">{{ $message }}<span>
                  @enderror
                  <div class="input-group input-group-outline mb-3">
                    <input type="date" name="dob" class="form-control" placeholder="Ngày sinh">
                  </div>
                  @error('dob')
                    <span class="text-danger">{{ $message }}<span>
                  @enderror
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" name="address" class="form-control" placeholder="Địa chỉ">
                  </div>
                  @error('address')
                    <span class="text-danger">{{ $message }}<span>
                  @enderror
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Số điện thoại">
                  </div>
                  @error('phone')
                    <span class="text-danger">{{ $message }}<span>
                  @enderror
                  <div class="input-group input-group-outline mb-3">
                    <input type="file" name="image" class="form-control" placeholder="Hình ảnh">
                  </div>
                  @error('image')
                    <span class="text-danger">{{ $message }}<span>
                  @enderror
                  <label for="status">Trạng thái</label>
                  <select name="status" class="form-control" id="status">
                    <option value="">---Please Select---</option>
                    <option {{ old('status') == '0' ? 'selected' : '' }} value="0">Đang làm việc</option>
                    <option {{ old('status') == '1' ? 'selected' : '' }} value="1">Đã nghỉ việc</option>
                  </select>
                  @error('status')
                      <span class="text-danger">{{ $message }}<span>
                  @enderror
                  <label for="position">Chức vụ</label>
                  <select name="position" class="form-control" id="status">
                    <option value="">---Please Select---</option>
                    <option {{ old('position') == '0' ? 'selected' : '' }} value="0">Quản lí</option>
                    <option {{ old('position') == '1' ? 'selected' : '' }} value="1">Nhân viên</option>
                  </select>
                  @error('position')
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