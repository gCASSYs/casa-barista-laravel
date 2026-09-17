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
           {{-- Exibe a confirmação enviada pelo controller após cadastrar um banner. --}}
            @if (session('sucesso'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                {{ session('sucesso') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
              </div>
            @endif
            {{-- Exibe uma mensagem simples quando o cadastro não puder ser concluído. --}}
            @if (session('erro'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                {{ session('erro') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
              </div>
            @endif
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
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-edit-banner"
                                  data-id="{{ $banner->id_banner }}"
                                  data-titulo="{{ $banner->titulo_banner }}"
                                  data-status="{{ $banner->status_banner }}"
                                  data-image="{{ asset('barista/assets/' . $banner->imagem_banner) }}"
                                  data-url="{{ route('admin.banner.status', $banner->id_banner) }}"
                                  aria-label="Editar"
                                  {{-- submit="{{ $banner->id_banner }}"  --}}
                                >
                                  <i class="bi bi-pencil" aria-hidden="true"> </i>
                                </button>



                                {{-- ATIVAR / DESATIVAR --}}
                                <form action="{{ route('admin.banner.status', $banner->id_banner) }}" method="POST" class="d-inline">
                                  @csrf
                                  @method('PATCH') {{-- PATH - Não atualiza tudo --}}

                                  @if($banner->status_banner === 'ATIVO')
                                    <button
                                      type="submit"
                                      class="btn btn-outline-danger"
                                      data-bs-toggle="modal"
                                      data-bs-target="#modal-status-banner"
                                      title="Desativar banner"
                                      data-url="{{ route('admin.banner.status', $banner->id_banner) }}"
                                      data-titulo="{{ $banner->id_banner }}"
                                      data-status="ATIVO"
                                      aria-label="Deletar">
                                      <i class="bi bi-eye-fill" aria-hidden="true"> </i>
                                    </button>
                                      @else
                                        <button
                                          type="submit"
                                          class="btn btn-outline-success"
                                          data-bs-toggle="modal"
                                          data-bs-target="#modal-status-banner"
                                          title="Ativar banner"
                                          data-url="{{ route('admin.banner.status', $banner->id_banner) }}"
                                          data-titulo="{{ $banner->id_banner }}"
                                          data-status="INATIVO"
                                          aria-label="Deletar">
                                          <i class="bi bi-eye-slash-fill" aria-hidden="true"> </i>
                                        </button> 

                                  @endif
                                </form>
                                {{-- FIM - ATIVAR / DESATIVAR --}}

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
                          class="form-control @error('titulo_banner') is-invalid @enderror"
                          id="new-user-name"
                          placeholder="Promoção de Verão"
                          required
                          name="titulo_banner"
                          value="{{ old('titulo_banner') }}"
                        />
                        @error('titulo_banner')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                        {{-- Mostra a mensagem se o envio da imagem falhar. --}}
                        @error('imagem_banner')
                          <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
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

            {{-- INICIO MODAL EDITAR BANNER --}}
            <div
              class="modal fade"
              id="modal-edit-banner"
              tabindex="-1"
              aria-labelledby="modal-add-banner-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  {{-- FORM DE ATUALIZAÇÃO --}}
                  <form
                  id = 'form-edit-banner'
                  method="POST" 
                  enctype="multipart/form-data">
                  @csrf {{-- o csrf é um chave de acesso para cada vez que for mandar um formulario, é segurança --}}
                  @method('PUT') {{-- o method put é para atualizar o registro --}}
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-add-banner-label">Editar novo banner</h5>
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
                        <label for="edit-banner-titulo" class="form-label"> Título Banner </label>
                        <input
                          type="text"
                          class="form-control @error('titulo_banner') is-invalid @enderror"
                          id="edit-banner-titulo"
                          required
                          name="titulo_banner"
                        />
                        @error('titulo_banner')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>

                     {{-- FORM IMAGEM --}}
                      <div class="mb-3">
                        <label for="edit-banner-imagem" class="form-label"> Selecione uma Imagem </label>

                        
                        
                        <input
                          type="file"
                          class="input-banner"
                          id="edit-banner-imagem"
                          name="imagem_banner"
                          accept="image/*"
                        />

                    <label
                          for="edit-banner-imagem"
                          class="banner-upload"
                          id="edit-banner-upload-trigger"
                          role="button"
                          tabindex="0"
                          aria-label="Selecionar imagem do banner"
                        >
                      <span class="banner-upload-overlay" aria-hidden="true">
                        <div class="mb-3">
                          <img id="edit-banner-mostrar" src="" alt="" />
                        </div>
                            
                            <span class="form-text mb-0">Deixe vazio para manter a imagem atual</span>
                      </span>
                    </label>
                        {{-- Mostra a mensagem se o envio da imagem falhar. --}}
                        @error('imagem_banner')
                          <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                      </div>

                      {{-- FORM STATUS --}}
                      <div class="mb-3">
                        <label for="edit-banner-status" class="form-label"> Status </label>
                        <select id="edit-banner-status" class="form-select" name="status_banner">
                          <option value="ATIVO">Ativo</option>
                          <option value="INATIVO">Inativo</option>
                        </select>
                      </div>

                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                      </button>
                      <button type="submit" class="btn btn-primary">Atualizar Banner</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            {{-- FINAL - EDITAL MODAL BANNER --}}

            {{-- INICIO DO MODAL ATIVAR/DESATIVAR BANNER --}}
            <div
              class="modal fade"
              id="modal-status-banner"
              tabindex="-1"
              aria-labelledby="modal-status-banner-titulo"
              aria-hidden="true"
            >
              <div class="modal-dialog">

                  <form id="form-status-banner" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modal-status-banner-titulo">Alterar Status do banner</h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body">
                        <p class="mb-0" id="modal-status-banner-text"></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                          Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger" id="btn-status-banner">
                          Confirmar
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            {{-- FIM DO MODAL ATIVAR E DESATIVAR BANNER --}}

          </div>
        </div>
      </section>


    </main>   
      
      {{-- CARREGANDO IMG BANNER --}}
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


      <script>
        const modalEditarBanner = document.getElementById('modal-edit-banner');
        const formEditBanner = document.getElementById('form-edit-banner');
        const editId = document.getElementById('edit-banner-id');
        const editTitulo = document.getElementById('edit-banner-titulo');
        const editStatus = document.getElementById('edit-banner-status');
        const editImagem = document.getElementById('edit-banner-imagem');
        const editMostrar = document.getElementById('edit-banner-mostrar');


        //CARREGAR AS INFORMAÇÕES NO MODAL
        modalEditarBanner.addEventListener('show.bs.modal', function (event) {

          const botao = event.relatedTarget;

          const id = botao.getAttribute('data-id');
          const titulo = botao.getAttribute('data-titulo');
          const status = botao.getAttribute('data-status');
          const image = botao.getAttribute('data-image');
          const url = botao.getAttribute('data-url');

          //form Action para enviar o formulario para a rota correta
          formEditBanner.action = url;

          //Preencher os campos
          editTitulo.value = titulo;
          editStatus.value = status;
          editMostrar.src = image;

          console.log(editMostrar)

          editImagem.value = '';

        });

        //VER FOTO PARA EDITAR
        editImagem.addEventListener('change', function() {
 
        const arquivo = this.files[0];
 
            if (arquivo) {
    
                editMostrar.src = URL.createObjectURL(arquivo);
    
            }
 
        });

      </script>

      
      <script>
        //ATIVAR E DESATIVAR STATUS DO BANNER

        //MAPEAR OS CAMPOS DO MODAL
        const modalStatusBanner = document.getElementById('modal-status-banner');
        const formStatusBanner  = document.getElementById('form-status-banner');
        const tituloStatusBanner = document.getElementById('modal-status-banner-titulo');
        const txtStatusBanner = document.getElementById('modal-status-banner-text');
        const btnStatusBanner = document.getElementById('btn-status-banner');

        
        modalStatusBanner.addEventListener('show.bs.modal', function(event){

          const botao = event.relatedTarget;

          const url = botao.getAttribute('data-url');
          const status = botao.getAttribute('data-status');
          

          formStatusBanner.action = url;

          if(status === 'ATIVO'){

            tituloStatusBanner.textContent = 'Desativar Status Banner';
            txtStatusBanner.textContent = 'Tem certeza que deseja desativar o status do banner?';
            btnStatusBanner.textContent = 'Desativar';

            //mudar a cor do botão
            btnStatusBanner.className = 'btn btn-danger';
          }else{


            tituloStatusBanner.textContent = 'Ativar Status Banner';
            txtStatusBanner.textContent = 'Tem certeza que deseja ativar o status do banner?';
            btnStatusBanner.textContent = 'Ativar';

            //mudar a cor do botão
            btnStatusBanner.className = 'btn btn-success';
          }

        });
      </script>

      <script>
        //TIME PARA O ALERTA 

        document.addEventListener('DOMContentLoaded', function () {
          setTimeout(() => {
            const alertas = document.querySelectorAll('.alert');

            alertas.forEach(function (alerta) {
              alerta.remove();
            });
          }, 2000);
        });
      </script>
