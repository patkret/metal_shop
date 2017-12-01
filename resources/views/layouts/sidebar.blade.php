
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Użytkownik Testowy</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Szukaj...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

    @php
       $modules = Auth::user()->getModules();

    @endphp
        <ul class="sidebar-menu">
            <li class="header">MODUŁY</li>

        @foreach($modules as $module)

                <li class="treeview">
                    <a href="{!! route($module->path.'.index') !!}">
                        {{--<i class="fa fa-square"></i>--}}
                        <span>{{ $module->name }}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                        {{--<a href="{!! route($module->path.'.index') !!}">{{ $module->name }}</a></li>--}}
                </li>
        @endforeach
        <!-- Sidebar Menu -->
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>