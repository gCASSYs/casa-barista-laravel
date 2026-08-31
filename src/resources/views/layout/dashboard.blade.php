<!doctype html>
<html lang="pt-BR">
  <!--begin::Head-->
    <head>
        @include('partials.admin.head-admin')
    </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg barista-admin">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
        @include('partials.admin.topo')
      <!--end::Header-->
      <!--begin::Sidebar-->
        @include('partials.admin.menu-lateral')
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        {{--
          Permite esconder este cabeçalho em uma página específica.
          Por padrão ele aparece; a página pode usar:
          @section('show-page-header', 'false')
        --}}
        @if (trim($__env->yieldContent('show-page-header', 'true')) !== 'false')
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">dashboard</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Menu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dasboard</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        @endif
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="admin-content-slot">
              @yield('content')
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            
            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
        @include('partials.admin.rodape')
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
      @include('partials.admin.script')
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
