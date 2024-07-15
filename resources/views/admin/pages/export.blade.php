<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 5px">#</th>
           
            <th>Mã nhân viên</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>Trạng thái</th>
            <th>Phòng ban</th>
            <th>Chức vụ</th>
        </tr>
    </thead>
    <tbody>
      @if(!$users->isEmpty())
        {{$index = 0}}
        @foreach ($users as $user)
            <tr>
                <td>{{ $index +=1 }}</td>
               
                <td>{{ $user->code }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->dob }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                        @if($user->status == 1)
                            Active
                        @else
                            Inactive
                        @endif     
                </td>
                <td>{{ optional($user->department)->name }}</td>
                <td>{{ optional($user->position)->name }}</td>
            </tr>
        @endforeach
        @else
      @endif
    </tbody>
</table>

