@extends('admin.layout.master')

@section('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Chức vụ</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Danh sách chức vụ</h6>
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
          <h6 class="text-white text-capitalize ps-3">Danh sách chức vụ</h6>
        </div>
      </div>
      <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 5px">#</th>
                <th >Mã chức vụ</th>
                <th >Chức vụ</th>
                <th >Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <form action="{{ route('admin.position.create') }}" method="GET">
                <button id="add-button"  class="btn btn-insert" type="submit" style="background-color: rgb(57, 223, 57)"><i class="fa fa-plus">     Thêm chức vụ</i></button>
              </form>
              @foreach ($positions as $index => $position)
              <tr>
                <td>{{ ($positions->currentPage() - 1) * $positions->perPage() + $index + 1  }}</td>
                <td>{{ $position->code }}</td>
                <td>{{ $position->name }}</td>
                <td>
                  @if($position->trashed())
                    <form action="{{ route('admin.position.restore', ['id' => $position->id]) }}" method="post">
                      @csrf
                      <button onclick="return confirm('Bạn muốn khôi phục?')" class="btn btn-success" type="submit" >Restore</button>
                    </form>
                  @else
                    <form id="delete-edit-form" action="{{ route('admin.position.destroy', ['id' => $position->id]) }}" method="post">
                      @csrf
                      <button id="delete-button" onclick="return confirm('Bạn muốn xoá?')" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                      <a id="edit-button" href="{{ route('admin.position.edit', ['id' => $position->id]) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    </form>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $positions->links('vendor.pagination.paginate') }}  
        </div>
      </div>
    </div>
  </div>
</div>
@endsection