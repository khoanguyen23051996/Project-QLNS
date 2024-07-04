@extends('admin.layout.master')

@section('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tài khoản</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">{{ config('apps.user.title') }}</h6>
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
<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3">Tài khoản nhân viên</h6>
        </div>
      </div>
      <div class="card-body px-0 pb-2">
        <form method="post" action="{{ route('admin.user.search') }}">
          @csrf
          <div class="form-group row px-4">
            <div class="col-sm-12 col-md-6 col-lg-4 form-group">
              <label for="txt_name">Name</label>
              <div class="input-group input-group-outline mb-3">
                <input type="text" name="name" value="{{ $name ?? ''}}" class="form-control" id="txt_name" placeholder="Enter name">
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 form-group">
              <label for="txt_name">Status</label>             
              <div class="input-group input-group-outline mb-3">
                @php($status = $status ?? null)
              <select name="status" class="form-control" id="position" >
                <option value="">---Please Select---</option>
                <option value="1" {{$status == 1 ? 'selected' : ''}}>Đang làm việc</option>
                <option value="-1" {{$status == -1 ? 'selected' : ''}}>Đã nghỉ việc</option>
              </select>
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
                <th style="width: 5px">#</th>
                <th >Hình ảnh</th>
                <th >Mã nhân viên</th>
                <th >Họ tên</th>
                <th >Email</th>
                <th >Ngày sinh</th>
                <th >Địa chỉ</th>
                <th >Điện thoại</th>
                <th >Trạng thái</th>
                <th >Phòng ban</th>
                <th >Chức vụ</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $index => $user)
             
              <tr>
                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1  }}</td>
                <td>
                  <img src="{{asset('/uploads/images/'.$user->image)}}" alt="" width="50px" height="50px">
                </td>
                <td>{{ $user->code }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->dob }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->status == 1 ? 'Đang làm việc' : 'Đã nghỉ việc' }}</td>
                <td>{{ optional($user->department)->name}}</td>
                <td>{{ optional($user->position)->name }}</td>
                {{-- <td>{{ $user->role ? 'Nhân viên' : 'Quản lí' }}</td>
                <td>{{ $user->status_text  }}</td> --}}
                <td>
                  @if(auth()->user()->role == 0)
                  <form method="post" action="{{ route('admin.user.change_status', ['user' => $user->id, 'page'=> $users->currentPage(), 'name'=>$name, 'status'=>$status]) }}">
                    @csrf
                    <button id="delete-button" onclick="return confirm('Bạn muốn đổi trạng thái nhân viên này?')" class="btn btn-warning" type="submit"><i class="fa fa-trash"></i></button>
                  </form>
                  <form id="delete-edit-form" action="{{ route('admin.user.destroy', ['user' => $user->id,'page'=> $users->currentPage(), 'name'=>$name, 'status'=>$status]) }}" method="post">
                    @csrf
                    <button id="delete-button" onclick="return confirm('Bạn muốn xoá nhân viên này?')" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                    <a id="edit-button" href="{{ route('admin.user.detail', ['id' => $user->id]) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                  </form>
                  @endif
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <div class="col-12">
          {{ $users->links('vendor.pagination.paginate') }}  
          {{-- {{ $users->links() }} --}}
          {{-- <div class="btn-group" role="group" aria-label="Basic outlined example">
            <button type="button" class="btn btn-outline-primary">Trang {{ $page }} của {{$totalPage}}</button>
            @if ($page >= 3)
              <a href="{{ route('admin.user.index', ['id' => $user->id, 'page'=> 1, 'name'=>$name, 'status'=>$status]) }}" class="btn btn-outline-primary">Trang đầu</a>
            @endif
            @if($page > 1)
            <a href="{{ route('admin.user.index', ['id' => $user->id, 'page'=> $page - 1, 'name'=>$name, 'status'=>$status]) }}" class="btn btn-outline-primary">{{ $page -1 }}</a>
            @endif
            <button type="button" class="btn btn-outline-primary btn-primary">{{ $page }}</button>
            @if(( $page + 1) <= $totalPage)
              @for ($i= 1 ; $i <= ($page != 1  || ($page + 1 == $totalPage)? 1 : 2); $i++)
                <a href="{{ route('admin.user.index', ['id' => $user->id, 'page'=> $i + $page, 'name'=>$name, 'status'=>$status]) }}" class="btn btn-outline-primary">{{ $i + $page }}</a>
              @endfor
            @endif
            @if ($page <= $totalPage - 2 )
              <a href="{{ route('admin.user.index', ['id' => $user->id, 'page' => $totalPage, 'name' => $name, 'status' => $status]) }}" class="btn btn-outline-primary">Trang cuối</a>
            @endif
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<script type="text/javascript">
$(document).ready(function(){

});
</script>