<?php $admin = auth('admin')->user(); ?>
    <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('admin/dashboard')}}" class="brand-link">
      <img src="@asset("img/AdminLTELogo.png")" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="@asset("img/user2-160x160.jpg")" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{$admin->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
    <?php
        // dd(Modules\Settings\Http\Controllers\SettingsController::get_admin_navigation());
        $nav_array = Modules\Settings\Http\Controllers\SettingsController::get_admin_navigation();
        ?>
        @foreach ($nav_array as $nav)

            <?php
            $is_nested = isset($nav['children']);
            $is_menu_open = $is_nested && in_array(request()->path(),array_column($nav['children'],'uri'));
            ?>

          <li class="nav-item {{ $is_nested ? 'has-treeview':'' }} {{ $is_menu_open ? 'menu-open':''}}">
            <a href="{{ $is_nested ? '#' : url($nav['uri']) }}" class="nav-link {{ (!$is_nested && (request()->path()==$nav['uri'])) || $is_menu_open ? 'active':''}}">
            <i class="nav-icon {{ $nav['icon_class'] }}"></i>
              <p>
                {{$nav['title']}}
                <i class="{{ $is_nested ? 'right fas fa-angle-left':'' }}"></i>
              </p>
            </a>
            @if ($is_nested)

            <ul class="nav nav-treeview">
              @foreach ($nav['children'] as $item)

              <li class="nav-item">
                <a href="{{url($item['uri'])}}" class="nav-link {{ (request()->path()==$item['uri']) ? 'active':''}}">
                  <i class="{{ $item['icon_class'] }} nav-icon"></i>
                  <p>{{$item['title']}}</p>
                </a>
              </li>
              @endforeach
              </ul>
            @endif
          </li>

          @endforeach


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
