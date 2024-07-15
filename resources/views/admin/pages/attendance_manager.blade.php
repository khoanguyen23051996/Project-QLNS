@extends('admin.layout.master')

@section('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Chấm công</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Quản lí chấm công</h6>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" >
      <div class="ms-md-auto pe-md-3 d-flex" >
        <div class="input-group input-group-outline" >
            <h4 >Hello, {{ $user->name }}</h4> 
        </div>
      </div>
      <ul class="navbar-nav  justify-content-end">
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
<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3">Quản lí chấm công</h6>
        </div>
      </div>

      <div class="card-body px-0 pb-2">
        <form method="post" action="{{ route('admin.attendance_manager.search') }}">
            @csrf
            <div class="form-group row px-4">
              <div class="col-sm-12 col-md-6 col-lg-4 form-group">
                <label for="txt_name">Name</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="text" name="name" value="{{ $name ?? '' }}" class="form-control" id="txt_name" placeholder="Enter name">
                </div>
              </div>  
                <div class="col-sm-12 col-md-6 col-lg-4 form-group">
                  <label for="">Tháng/Năm</label>
                  <div class="input-group input-group-outline mb-3">
                     <input type="month" name="monthYear" id="" class="form-control">
                  </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 form-group align-self-end">
                  <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <div class="table-responsive p-0">
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Tên nhân viên</th>
                  <th>Giờ vào</th>
                  <th>Giờ ra</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance )
                  <tr>
                    <td>{{$attendance->user->name}}</td>
                    <td>{{$attendance->checkin_at}}</td>
                    <td>{{$attendance->checkout_at}}</td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection