
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

    @php
       $modules = Auth::user()->getModules();

    @endphp
        <ul class="sidebar-menu">
            <li class="header">MODUŁY</li>

        @foreach($modules as $module)

                <li class="treeview">
                    <a href="{!! route($module->path.'.index') !!}">
                        <i class="fa fa-link"></i>
                        <span>{{ $module->name }}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                </li>
        @endforeach
        <!-- Sidebar Menu -->
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>