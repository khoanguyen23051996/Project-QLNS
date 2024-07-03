@extends('admin.layout.master')

@section('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tài khoản</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Edit tài khoản</h6>
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
              <h3 class="card-title">Edit tài khoản</h3>
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
                <form role="form" method="post" action="{{ route('admin.user.update', ['id' => $user->id]) }}" >
                  @csrf
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" value="{{ old('name') ?? $user['name'] }}" name="name" class="form-control" id="name" placeholder="Họ Tên">
                  </div>
                  @error('name')
                    <span class="text-danger">{{ $message }}<span>
                  @enderror 

                  <div class="input-group input-group-outline mb-3">
                    <input type="text" value="{{ old('email') ?? $user['email'] }}" name="email" class="form-control" id="email" placeholder="Email">
                  </div>
                  @error('email')
                    <span class="text-danger">{{ $message }}<span>
                  @enderror 

                  <div class="input-group input-group-outline mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  @error('password')
                    <span class="text-danger">{{ $message }}<span>
                  @enderror 

                  <div class="input-group input-group-outline mb-3">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                  </div>
                  @error('password_confirmation')
                    <span class="text-danger">{{ $message }}<span>
                  @enderror 
                  
                  <div class="form-group">
                    <label for="position">Phân quyền</label>                 
                    <div class="input-group input-group-outline mb-3">
                      <select name="position" class="form-control" id="position">
                        <option value="">---Please Select---</option>
                        <option {{ (old('position') ?? $user->position) == '1' ? 'selected' : '' }} value="1">Nhân viên</option>
                        <option {{ (old('position') ?? $user->position) == '0' ? 'selected' : '' }} value="0">Quản lí</option>
                      </select>
                    </div>
                    @error('position')
                      <span class="text-danger">{{ $message }}<span>
                    @enderror
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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