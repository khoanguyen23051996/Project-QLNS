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
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4">
                <div class="ms-md-auto pe-md-3 d-flex">
                    <div class="input-group input-group-outline">
                        <h4>Hello, {{ $user->name }}</h4>
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
                                    <input type="text" name="name" value="{{ $name ?? '' }}" class="form-control"
                                        id="txt_name" placeholder="Enter name">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                                <label for="txt_name">Status</label>
                                <div class="input-group input-group-outline mb-3">
                                    @php($status = $status ?? null)
                                    <select name="status" class="form-control" id="position">
                                        <option value="">---Please Select---</option>
                                        <option value="1" {{ $status == 1 ? 'selected' : '' }}>Đang làm việc</option>
                                        <option value="-1" {{ $status == -1 ? 'selected' : '' }}>Đã nghỉ việc</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                                <label for="txt_name">Chức vụ</label>
                                <div class="input-group input-group-outline mb-3">
                                    @php($position = $status ?? null)
                                    <select name="position" class="form-control" id="position">
                                        <option value="">---Please Select---</option>
                                        <option value="1" {{ $position == 1 ? 'selected' : '' }}>Quản lí</option>
                                        <option value="2" {{ $position == 2 ? 'selected' : '' }}>Nhân viên</option>
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
                                    <th>Hình ảnh</th>
                                    <th>Mã nhân viên</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Ngày sinh</th>
                                    <th>Địa chỉ</th>
                                    <th>Điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Phòng ban</th>
                                    <th>Chức vụ</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if(!$users->isEmpty())
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                                        <td>
                                            <img src="{{ $user->image ? asset('/uploads/images/' . $user->image) : asset('/asset/img/36.jpeg') }}"
                                                alt="" width="100px" height="125px">
                                        </td>
                                        <td>{{ $user->code }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->dob }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            @if (Auth()->user()->role == 0)
                                                <form action="{{ route('admin.user.change_status') }}" method="post" class="statusForm">
                                                @csrf
                                                    <input type="checkbox" {{ $user->status == 1 ? 'checked' : '' }}
                                                        class="switch-status">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                </form>
                                            @else 
                                                @if($user->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">Inactive</span> 
                                                @endif   
                                            @endif
                                            
                                        </td>
                                        <td>{{ optional($user->department)->name }}</td>
                                        <td>{{ optional($user->position)->name }}</td>
                                        <td>
                                            @if (auth()->user()->role == 0)
                                                <form id="delete-edit-form"
                                                    action="{{ route('admin.user.destroy', ['user' => $user->id, 'page' => $users->currentPage(), 'name' => $name, 'status' => $status]) }}"
                                                    method="post">
                                                    @csrf
                                                    <button id="delete-button"
                                                        onclick="return confirm('Bạn muốn xoá nhân viên này?')"
                                                        class="btn btn-danger" type="submit"><i
                                                            class="fa fa-trash"></i></button>
                                                    <a id="edit-button"
                                                        href="{{ route('admin.user.edit', ['id' => $user->id]) }}"
                                                        class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                              @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        {{ $users->links('vendor.pagination.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkboxes = document.querySelectorAll('.switch-status');
        var forms = document.querySelectorAll('.statusForm');

        checkboxes.forEach(function(checkbox, index) {
            checkbox.addEventListener('change', function() {
                var isChecked = checkbox.checked;
                var message = isChecked ? 'Bạn có chắc chắn muốn bật trạng thái này không?' :
                    'Bạn có chắc chắn muốn tắt trạng thái này không?';

                if (confirm(message)) {
                    forms[index].submit();
                } else {
                    checkbox.checked = !isChecked;
                }
            });
        });
    });
</script>
