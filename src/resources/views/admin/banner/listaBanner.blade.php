   <main class="app-main">
    <!--begin::App Main-->
      <section class="admin-list-page">
        <!--begin::App Content Header-->
        <div class="app-content-header admin-page-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Banners</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.banner.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Banners</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-12">
                <!--begin::Card-->
                <div class="card admin-data-card mb-4">
                  <!--begin::Card Header-->
                  <div class="card-header">
                    <div class="row g-2 align-items-center">
                      <div class="col-12 col-md-4">
                        <h3 class="card-title">Banner cadastrados</h3>
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap justify-content-md-end gap-2">
                          <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">
                              <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input
                              type="search"
                              id="banner-search"
                              class="form-control admin-search-input"
                              placeholder="Pesquisar banners"
                              aria-label="Pesquisar banners"
                            />
                          </div>
                          <select
                            id="banner-role-filter"
                            class="form-select form-select-sm w-auto"
                            aria-label="Filtrar por status"
                          >
                            <option value="all" selected>Todos</option>
                            <option value="administrator">Ativos</option>
                            <option value="editor">Inativos</option>
                          </select>
                          <button
                            type="button"
                            class="btn btn-sm btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-add-banner"
                          >
                            <i class="bi bi-plus-lg me-1" aria-hidden="true"> </i>
                            Novo Banner
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end::Card Header-->
                  <!--begin::Card Body-->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-hover align-middle m-0">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Imagem</th>
                            <th>Título</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                          </tr>
                        </thead>
                        <tbody>

                      {{--CONTEUDO DA TABELA--}}    
                        @forelse ($listaBanner as $banner)
                          <tr>
                            {{--ID BANNER--}}
                            <td>
                              {{ $banner->id_banner }}
                            </td>

                            {{--IMAGEM BANNER--}}
                            <td>
                              @if ($banner->imagem_banner)
                                <img
                                  src="{{ asset('barista/assets/' . $banner->imagem_banner) }}"
                                  alt="{{ $banner->titulo_banner }}"
                                  class="rounded admin-table-thumbnail"
                                />
                              @else
                                <span class="text-muted">Sem imagem</span>
                              @endif
                            </td>

                            {{--TITULO BANNER--}}
                            <td>
                              <span class="badge admin-record-label">{{ $banner->titulo_banner }}</span>
                            </td>
                            {{--STATUS DO TITULO--}}
                            <td>
                              @if ($banner->status_banner == 'ATIVO')
                                <span class="badge text-bg-success">Ativo</span>
                              @else
                                <span class="badge text-bg-warning">Inativo</span>
                              @endif
                            </td>

                            {{--STATUS--}}
                            <td class="text-end">
                              <div class="btn-group btn-group-sm">
                                <button
                                  type="button"
                                  class="btn btn-outline-secondary"
                                  aria-label="Editar"
                                  submit="{{ $banner->id_banner }}"
                                >
                                  <i class="bi bi-pencil" aria-hidden="true"> </i>
                                </button>
                                <button
                                  type="button"
                                  class="btn btn-outline-danger"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-delete-banner"
                                  aria-label="Deletar"
                                >
                                  <i class="bi bi-trash" aria-hidden="true"> </i>
                                </button>
                              </div>
                            </td>
                          </tr>
                          @empty
                            <tr>
                              <td colspan="5" class="text-center py-4 text-muted">
                                Nenhum banner encontrado.
                              </td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!--end::Card Body-->
                  <!--begin::Card Footer-->
                  <div class="card-footer clearfix">
                    <div class="float-start pt-1 fs-7 text-body-secondary">
                      Total de banners:
                      <strong>
                        {{ $listaBanner->count() }}
                      </strong>
                    </div>
                    <ul class="pagination pagination-sm m-0 float-end">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous"> &laquo; </a>
                      </li>
                      <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">4</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">5</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next"> &raquo; </a>
                      </li>
                    </ul>
                  </div>
                  <!--end::Card Footer-->
                </div>
                <!--end::Card-->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->

            <!--begin::Add Banner Modal-->
            <div
              class="modal fade"
              id="modal-add-banner"
              tabindex="-1"
              aria-labelledby="modal-add-banner-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  {{-- FORMA DE CADASTRO --}}
                  <form
                  action="{{ route('admin.banner.store') }}"
                  method="POST" 
                  enctype="multipart/form-data">
                  @csrf {{-- o csrf é um chave de acesso para cada vez que for mandar um formulario, é segurança --}}
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-add-banner-label">Adicionar novo Banner</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">

                      {{-- FORM TITULO --}}
                      <div class="mb-3">
                        <label for="new-user-name" class="form-label"> Título Banner </label>
                        <input
                          type="text"
                          class="form-control"
                          id="new-user-name"
                          placeholder="Promoção de Verão"
                          required
                          name="titulo_banner"
                        />
                      </div>

                     {{-- FORM IMAGEM --}}
                      <div class="mb-3">
                        <label for="img-banner" class="form-label"> Selecione uma Imagem </label>
                        
                        <input
                          type="file"
                          class="input-banner"
                          id="img-banner"
                          required
                          name="imagem_banner"
                          accept="image/*"
                        />

                        <label
                          for="img-banner"
                          class="banner-upload"
                          id="banner-upload-trigger"
                          role="button"
                          tabindex="0"
                          aria-label="Selecionar imagem do banner"
                        >
                          <img id="ver-banner" src="{{ asset('barista/assets/admin/sem-banner.svg') }}" alt="Prévia do banner" />
                          <span class="banner-upload-overlay" aria-hidden="true">
                            <i class="bi bi-image"></i>
                            <span class="form-text mb-0">Clique para selecionar o banner</span>
                          </span>
                        </label>


                      </div>

                      {{-- FORM STATUS --}}
                      <div class="mb-3">
                        <label for="new-banner-role" class="form-label"> Status </label>
                        <select id="new-banner-role" class="form-select" name="status_banner">
                          <option value="ATIVO">Ativo</option>
                          <option value="INATIVO">Inativo</option>
                        </select>
                      </div>

                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                      </button>
                      <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                  </form>
                  {{-- FINAL DO FORMA DE CADASTRO --}}
                </div>
              </div>
            </div>
            <!--end::Add Banner Modal-->

            <!--begin::Delete User Modal-->
            <div
              class="modal fade"
              id="modal-delete-user"
              tabindex="-1"
              aria-labelledby="modal-delete-user-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modal-delete-user-label">Delete user</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <div class="modal-body">
                    <p class="mb-0">
                      Are you sure you want to delete this user? All content owned by the account
                      will be reassigned to the site administrator. This action cannot be undone.
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      Cancel
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                      Delete user
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!--end::Delete User Modal-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </section>
      <!--end::App Main-->

    </main>   
      
      <script>
        const inputBanner = document.getElementById('img-banner');
        const previewBanner = document.getElementById('ver-banner');
 
       inputBanner.addEventListener('change', function() {
 
        const arquivo = this.files[0];
 
            if (arquivo) {
    
                previewBanner.src = URL.createObjectURL(arquivo);
    
            }
 
        });
      </script>
