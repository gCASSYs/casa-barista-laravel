<aside class="app-sidebar barista-sidebar" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ route('dashboard') }}" class="brand-link" aria-label="Ir para o dashboard">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('barista/assets/logo.png') }}"
              alt="Logo Casa do Barista"
              class="brand-image"
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
          <label for="sidebar-search-input" class="visually-hidden">Filtrar menu</label>
          <input
            type="search"
            id="sidebar-search-input"
            class="form-control form-control-sm"
            placeholder="Filtrar menu…"
            autocomplete="off"
            data-lte-toggle="sidebar-search"
            data-lte-target="#navigation"
          />
          <p class="fs-7 text-secondary mt-2 mb-0" data-lte-search-empty role="status" hidden>
            Nenhuma página encontrada.
          </p>
        </div>
        <!--end::Sidebar Search-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2" aria-label="Navegação principal">
            <!--begin::Sidebar Menu-->
            
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" @if(request()->routeIs('dashboard')) aria-current="page" @endif>
                  <i class="nav-icon bi bi-house-gear-fill"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
                
              </li>
              <li class="nav-header">PRODUTOS</li>
              <li class="nav-item">
                <a href="{{ route('admin.produto.index') }}" class="nav-link {{ request()->routeIs('admin.produto.*') ? 'active' : '' }}" @if(request()->routeIs('admin.produto.*')) aria-current="page" @endif>
                  <i class="nav-icon bi bi-basket2-fill"></i>
                  <p>Produtos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.categoria.index')}}" class="nav-link {{ request()->routeIs('admin.categoria.*') ? 'active' : '' }}" @if(request()->routeIs('admin.categoria.*')) aria-current="page" @endif>
                  <i class="nav-icon bi bi-boxes"></i>
                  <p>Categorias</p>
                </a>
              </li>

              <li class="nav-header">VENDAS</li>
              <li class="nav-item">
                <a href="{{ route('admin.venda.index') }}" class="nav-link {{ request()->routeIs('admin.venda.*') ? 'active' : '' }}" @if(request()->routeIs('admin.venda.*')) aria-current="page" @endif>
                  <i class="nav-icon bi bi-currency-dollar"></i>
                  <p>
                    Vendas
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.clientes.index') }}" class="nav-link {{ request()->routeIs('admin.clientes.*') ? 'active' : '' }}" @if(request()->routeIs('admin.clientes.*')) aria-current="page" @endif>
                  <i class="nav-icon bi bi-person-fill"></i>
                  <p>Cliente</p>
                </a>
              </li>

              <li class="nav-header">SITE</li>
              
              <li class="nav-item">
                <a href="{{ route('admin.banner.index') }}" class="nav-link {{ request()->routeIs('admin.banner.*') ? 'active' : '' }}" @if(request()->routeIs('admin.banner.*')) aria-current="page" @endif>
                  <i class="nav-icon bi bi-image-fill"></i>
                  <p>Banner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.galeria.index') }}" class="nav-link {{ request()->routeIs('admin.galeria.*') ? 'active' : '' }}" @if(request()->routeIs('admin.galeria.*')) aria-current="page" @endif>
                  <i class="nav-icon bi bi-image"></i>
                  <p>
                    Galeria
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.depoimento.index') }}" class="nav-link {{ request()->routeIs('admin.depoimento.*') ? 'active' : '' }}" @if(request()->routeIs('admin.depoimento.*')) aria-current="page" @endif>
                  <i class="nav-icon bi bi-envelope-paper"></i>
                  <p>Depoimento</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.linhatempo.index')}}" class="nav-link {{ request()->routeIs('admin.linhatempo.*') ? 'active' : '' }}" @if(request()->routeIs('admin.linhatempo.*')) aria-current="page" @endif>
                  <i class="nav-icon bi bi-hourglass-split"></i>
                  <p>Linha do Tempo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.news.index')}}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}" @if(request()->routeIs('admin.news.*')) aria-current="page" @endif>
                  <i class="nav-icon bi bi-newspaper"></i>
                  <p>Newsletter</p>
                </a>
              </li>
            </ul>
            <!--end::Sidebar Menu-->

            <!-- Docs CTA (bottom of sidebar) -->
            <div class="p-3 mt-3 border-top border-secondary border-opacity-25">
              <a
                href="{{ route('home') }}"
                class="btn btn-sm btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2"
              >
                <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                Ver site
              </a>
            </div>
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
