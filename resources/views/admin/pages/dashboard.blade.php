@extends('admin.layout.master')

@section('nav')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tổng quan</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Tổng quan</h6>
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

@section('total')
{{-- Total --}}
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-success shadow-dark text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">person</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Nhân viên</p>
              <h4 class="mb-0">{{ $datas['totalUser']}}</h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-success text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">person</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Nhân viên nghỉ việc</p>
              <h4 class="mb-0">{{ $datas['userOff']}}</h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">person</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Tổng Phòng ban</p>
              <h4 class="mb-0">{{ $datas['totalDepartment']}}</h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">person</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Tổng chức vụ</p>
              <h4 class="mb-0">{{ $datas['totalPosition']}}</h4>
            </div>
            
          </div>
          <hr class="dark horizontal my-0">
        </div>
      </div>
    </div> 
    <a href="{{ route('admin.dashboard.export') }}">Xuất Excel</a>
  </div>
</div>
{{-- End Total --}}

{{-- Container --}}
{{-- <div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Tổng nhân viên từng phòng ban</h6>
          </div>
        </div>
        <div class="card-body pb-2 row gx-4">
          <div class="table-responsive  col-6 ">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 70%">Tên phòng ban</th>
                  <th style="">Tổng nhân sự</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($datas['usersByDepartments'] as $usersByDepartment )
                  <tr>
                    <td>
                      {{$usersByDepartment->name}}
                    </td>
                    <td class="text-center">
                     {{$usersByDepartment->users_count}}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="table-responsive  col-6">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 70%">Tên Chức vụ</th>
                  <th style="">Tổng nhân sự</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($datas['usersByPositions'] as $usersByPosition )
                  <tr>
                    <td>
                      {{$usersByPosition->name}}
                    </td>
                    <td class="text-center">
                     {{$usersByPosition->users_count}}
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
</div> --}}
{{-- End Container --}}
<div class="chart d-flex" style="padding: 20px" >
  <div id="total_employee" style="width: 700px; height: 440px; padding: 20px; col-md-6" ></div>
  <div id="total_department" style="width: 700px; height: 440px; padding: 20px; col-md-6"></div>
</div>
@endsection

@section('my-script')
<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable(@json($data));
    console.log(data);
    var options = {
      title: 'Tổng nhân viên',
      is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('total_employee'));
    chart.draw(data, options);
  }
</script>

<script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable(@json($dataDepartment));

    // var view = new google.visualization.DataView(data);
    // view.setColumns([0, 1,
    //                  { calc: "stringify",
    //                    sourceColumn: 1,
    //                    type: "string",
    //                    role: "annotation" },
    //                  2]);

    var options = {
      title: "Tổng phòng ban",
      width: 600,
      height: 400,
      bar: {groupWidth: "95%"},
      legend: { position: "none" },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("total_department"));
    chart.draw(data, options);
}
</script>
@endsection