@extends('admin.layout.master')

@section('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Nhân viên</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Danh sách Nhân viên</h6>
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
</nav>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Danh sách nhân viên</h6>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center">
              <thead>
                <tr>
                  <th >#</th>
                  <th >MSNV</th>
                  <th >Họ tên</th>
                  <th >Email</th>
                  <th >Ngày sinh</th>
                  <th >Địa chỉ</th>
                  <th >SĐT</th>
                  <th >Trạng thái</th>
                  <th >Hình ảnh</th>
                  <th >Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <form action="{{ route('admin.staff.create') }}" method="GET">
                  <button id="add-button"  class="btn btn-insert" type="submit" style="background-color: rgb(57, 223, 57)"><i class="fa fa-plus">     Thêm nhân viên</i></button>
                </form>
                @foreach ($datas as $data)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->employeeid }}</td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->email }}</td>
                  <td>{{ $data->dob }}</td>
                  <td>{{ $data->address }}</td>
                  <td>{{ $data->phone }}</td>
                  <td>{{ $data->status }}</td>
                  <td>{{ $data->image }}</td>
                  <td>
                    @if($data->trashed())
                      <form action="{{ route('admin.staff.restore', ['id' => $data->id]) }}" method="post">
                        @csrf
                        <button onclick="return confirm('Bạn muốn khôi phục?')" class="btn btn-success" type="submit" >Restore</button>
                      </form>
                    @endif
                    <form id="delete-edit-form" action="{{ route('admin.department.destroy', ['departmentid' => $data->id]) }}" method="post">
                      @csrf
                      <button id="delete-button" onclick="return confirm('Bạn muốn xoá?')" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                      <a id="edit-button" href="{{ route('admin.department.detail', ['departmentid' => $data->id]) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection