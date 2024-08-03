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
      <div class="export-excel">
        <div class="col-sm-12 col-md-6 col-lg-4 form-group align-self-end">
          <a href="{{ route('admin.dashboard.export') }}" class="btn btn-primary">Xuất Excel</a>
        </div>
      </div>
      
    </div> 
    
  </div>
</div>
{{-- End Total --}}

<div class="chart d-flex"  >
  <div id="total_employee"  ></div>
  <div id="total_department" ></div>
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