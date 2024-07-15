@extends('admin.layout.master')

@section('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Phòng ban</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Danh sách phòng ban</h6>
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
  @error('title')
      <div class="alert alert-danger">{{ $message }}</div>
  @enderror
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Danh sách phòng ban</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 5px">#</th>
                  <th >Mã phòng ban</th>
                  <th >Tên phòng ban</th>
                  <th >Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <form action="{{ route('admin.department.create') }}" method="GET">
                  <button id="add-button"  class="btn btn-insert" type="submit" style="background-color: rgb(57, 223, 57)"><i class="fa fa-plus">     Thêm phòng ban</i></button>
                </form>
                @foreach ($departments as $index => $department)
                <tr>
                  <td>{{ ($departments->currentPage() - 1) * $departments->perPage() + $index + 1  }}</td>
                  <td>{{ $department->code }}</td>
                  <td>{{ $department->name }}</td>
                  <td>
                    @if($department->trashed())
                      <form action="{{ route('admin.department.restore', ['id' => $department->id]) }}" method="post">
                        @csrf
                        <button onclick="return confirm('Bạn muốn khôi phục?')" class="btn btn-success" type="submit" >Restore</button>
                      </form>
                    @else
                      <form id="delete-edit-form" action="{{ route('admin.department.destroy', ['departmentid' => $department->id]) }}" method="post">
                      @csrf
                        <button id="delete-button" onclick="return confirm('Bạn muốn xoá?')" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                        <a id="edit-button" href="{{ route('admin.department.edit', ['departmentid' => $department->id]) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                      </form>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $departments->links('vendor.pagination.paginate') }}  
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection