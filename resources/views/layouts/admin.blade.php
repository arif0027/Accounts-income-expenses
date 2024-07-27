<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{asset('contents/admin')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/css/all.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/css/datatables.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/css/style.css">

  </head>
  <body>
    <header>
        <div class="container-fluid header_part">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-7"></div>
                <div class="col-md-3 top_right_menu text-end">
                    <div class="dropdown">
                      <button class="btn dropdown-toggle top_right_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <img src="{{asset('contents/admin')}}/images/avatar.png" class="img-fluid">
                          {{ Auth::user()->name }}
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-tie"></i> My Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Manage Account</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                      </ul>
                    </div>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </header>
    <section>
        <div class="container-fluid content_part">
            <div class="row">
                <div class="col-md-2 sidebar_part">
                    <div class="user_part">
                        <img class="" src="{{asset('contents/admin')}}/images/avatar.png" alt="avatar">
                        <h5>{{ Auth::user()->name }}</h5>
                        <p><i class="fas fa-circle"></i> Online</p>
                    </div>
                    <div class="menu">
                        <ul>
                            <li><a href="{{ url('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                            <li><a href="{{ url('dashboard/user') }}"><i class="fas fa-user-circle"></i> Users</a></li>
                            @if(Auth::user()->role_id=='1')
                            <li><a href="{{ url('dashboard/income') }}"><i class="fas fa-wallet"></i> Income</a></li>
                            @endif
                            @if(Auth::user()->role_id<='2')
                            <li><a href="{{ url('dashboard/incomeCategory') }}"><i class="fas fa-wallet"></i> IncomeCategory</a></li>
                            @endif
                            <li><a href="{{ url('dashboard/expense') }}"><i class="fas fa-coins"></i> Expense</a></li>
                            <li><a href="{{ url('dashboard/expenseCategory') }}"><i class="fas fa-coins"></i> ExpenseCategory</a></li>
                            <li><a href="{{ url('dashboard/summary') }}"><i class="fas fa-book-open"></i> Summary</a></li>
                            <li><a href="{{ url('dashboard/summary') }}"><i class="fas fa-file-alt"></i> Reports</a></li>
                            <li><a href="{{ url('dashboard/recycle') }}"><i class="fas fa-trash"></i> Recycle Bin</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </div>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                <div class="col-md-10 content">
                    <div class="row">
                        <div class="col-md-12 breadcumb_part">
                            <div class="bread">
                                <ul>
                                    <li><a href=""><i class="fas fa-home"></i>Home</a></li>
                                    <li><a href=""><i class="fas fa-angle-double-right"></i>Dashboard</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container-fluid footer_part">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10 copyright">
                    <p>Copyright &copy; 2023 | All rights reserved by Dashboard | Development By <a href="#">M.H.Arif.</a></p>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </footer>


    <script src="{{asset('contents/admin')}}/js/jquery-3.6.0.min.js"></script>
    <script src="{{asset('contents/admin')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('contents/admin')}}/js/datatables.min.js"></script>
    <script src="{{asset('contents/admin')}}/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('contents/admin')}}/js/sweetalert.min.js"></script>
    <script src="{{asset('contents/admin')}}/js/custom.js"></script>
  </body>
</html>
