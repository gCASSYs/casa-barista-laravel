<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('barista/assets/logo.png') }}"
              alt="Logo Casa do Barista"-
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Search-->
        <div class="sidebar-search" role="search">
          <label for="sidebar-search-input" class="visually-hidden">Filter menu</label>
          <input
            type="search"
            id="sidebar-search-input"
            class="form-control form-control-sm"
            placeholder="Filter menu…"
            autocomplete="off"
            data-lte-toggle="sidebar-search"
            data-lte-target="#navigation"
          />
          <p class="fs-7 text-secondary mt-2 mb-0" data-lte-search-empty role="status" hidden>
            No matching pages.
          </p>
        </div>
        <!--end::Sidebar Search-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2" aria-label="Main navigation">
            <!--begin::Sidebar Menu-->
            
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item menu-open">
                <a href="{{ route('dashboard') }}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
                
              </li>
              <li class="nav-header">PRODUTOS</li>
              <li class="nav-item">
                <a href="./starter.html" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill"></i>
                  <p>Produtos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./generate/theme.html" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill"></i>
                  <p>Categorias</p>
                </a>
              </li>

              <li class="nav-header">VENDAS</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-currency-dollar"></i>
                  <p>
                    Vendas
                  </p>
                </a>
              <li class="nav-item">
                <a href="./users.html" class="nav-link">
                  <i class="nav-icon bi bi-person-fill"></i>
                  <p>Cliente</p>
                </a>
              </li>

              <li class="nav-header">SITE</li>
              
              <li class="nav-item">
                <a href="{{ route('admin.banner.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-image-fill"></i>
                  <p>Banner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-image"></i>
                  <p>
                    Galeria
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-envelope-paper"></i>
                  <p>Depoimento</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-hourglass-split"></i>
                  <p>Linha do Tempo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-newspaper"></i>
                  <p>Newsletter</p>
                </a>
              </li>

              
            <!--end::Sidebar Menu-->

            <!-- Docs CTA (bottom of sidebar) -->
            <div class="p-3 mt-3 border-top border-secondary border-opacity-25">
              <a
                href="./docs/introduction.html"
                class="btn btn-sm btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2"
              >
                <i class="bi bi-book" aria-hidden="true"></i>
                Ver Documentação
              </a>
            </div>
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>