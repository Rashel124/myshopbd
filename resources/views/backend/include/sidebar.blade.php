  <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{url('/admin/dashboard')}}" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{asset('backend/dist/assets/img/AdminLTELogo.png')}}"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Admin Dashboard</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false">
              @if (Auth::user()->role == 'admin')
                <li class="nav-item menu">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Category
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/admin/category/list')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/category/create')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add New</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
              @if (Auth::user()->role == 'admin')
                <li class="nav-item menu">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    SubCategory
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/admin/sub-category/list')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/sub-category/create')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add New</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
              <li class="nav-item menu">
                <a href="#" class="nav-link">
                  <i class="fa-brands fa-product-hunt"></i>
                  <p>
                    Product
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/admin/product/list')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/product/create')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add New</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item menu">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Orders
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/admin/order/all')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>All Orders</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/order/pending')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Pending Orders</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/order/confirmed')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Confirmed Orders</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/order/delivered')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Delivered Orders</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/order/cancelled')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Cancelled Orders</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/order/returned')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Returned Orders</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item menu">
                <a href="#" class="nav-link">
                  <i class="fa-solid fa-id-badge"></i>
                  <p>
                    Contact Massege
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/admin/contact-message/list')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>List</p>
                    </a>
                  </li>
                </ul>
              </li>
                <li class="nav-item menu">
                <a href="#" class="nav-link">
                  <i class="fa-solid fa-gear"></i>
                  <p>
                    Settings 
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   @if(Auth::user()->role == 'admin')
                  <li class="nav-item">
                    <a href="{{url('/admin/change-credentials')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Change Credentials</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/general-settings')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Site Settings</p>
                    </a>
                  </li>
                  @endif
                  @if(Auth::user()->role == 'admin'| Auth::user()->role == 'manager')
                  <li class="nav-item">
                    <a href="{{url('/admin/policies')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Policies & About Us</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/show-banner')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Banners</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->