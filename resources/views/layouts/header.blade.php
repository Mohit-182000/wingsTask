<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">       
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <span class="d-none d-md-inline">Logout</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-primary"> <p>Admin</p></li>
                
                <li class="user-footer">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right"> 
                        Logout
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
      </li>
    </ul>
</nav>