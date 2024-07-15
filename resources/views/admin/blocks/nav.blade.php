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