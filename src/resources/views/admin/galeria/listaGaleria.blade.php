      <!--begin::App Main-->
      <section class="admin-list-page">
        <!--begin::App Content Header-->
        <div class="app-content-header admin-page-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Galerias</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.galeria.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Galerias</li>
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
                        <h3 class="card-title">Imagens cadastradas</h3>
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap justify-content-md-end gap-2">
                          <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">
                              <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input
                              type="search"
                              id="Imagens-search"
                              class="form-control admin-search-input"
                              placeholder="Pesquisar imagens"
                              aria-label="Pesquisar imagens"
                            />
                          </div>
                          <select
                            id="galeria-role-filter"
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
                            data-bs-target="#modal-add-galeria"
                          >
                            <i class="bi bi-plus-lg me-1" aria-hidden="true"> </i>
                            Nova Imagem
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
                        @forelse ($listaGaleria as $galeria)
                          <tr>
                            {{--ID GALERIA--}}
                            <td>
                              {{ $galeria->id_galeria }}
                            </td>

                            {{--IMAGEM GALERIA--}}
                            <td>
                              @if ($galeria->imagem_galeria)
                                <img
                                  src="{{ asset('barista/assets/' . $galeria->imagem_galeria) }}"
                                  alt="{{ $galeria->nome_galeria }}"
                                  class="rounded admin-table-thumbnail"
                                />
                              @else
                                <span class="text-muted">Sem imagem</span>
                              @endif
                            </td>

                            {{--NOME GALERIA--}}
                            <td>
                              <span class="badge admin-record-label">{{ $galeria->nome_galeria }}</span>
                            </td>
                            {{--STATUS DO NOME--}}
                            <td>
                              @if ($galeria->status_galeria == 'ATIVO')
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
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-edit-galeria"
                                  data-url="{{ route('admin.galeria.update', $galeria->id_galeria) }}"
                                  data-nome_galeria="{{ $galeria->nome_galeria }}"
                                  data-status_galeria="{{ $galeria->status_galeria }}"
                                  data-imagem_galeria="{{ asset('barista/assets/' . $galeria->imagem_galeria) }}"
                                >
                                  <i class="bi bi-pencil" aria-hidden="true"> </i>
                                </button>
                                <button
                                  type="button"
                                  class="btn {{ $galeria->status_galeria === 'ATIVO' ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-status-galeria"
                                  data-status-url="{{ route('admin.galeria.status', $galeria->id_galeria) }}"
                                  title="{{ $galeria->status_galeria === 'ATIVO' ? 'Desativar imagem' : 'Ativar imagem' }}"
                                  aria-label="{{ $galeria->status_galeria === 'ATIVO' ? 'Desativar imagem' : 'Ativar imagem' }}"
                                >
                                  <i class="bi {{ $galeria->status_galeria === 'ATIVO' ? 'bi-eye-fill' : 'bi-eye-slash-fill' }}" aria-hidden="true"> </i>
                                </button>
                              </div>
                            </td>
                          </tr>
                          @empty
                            <tr>
                              <td colspan="5" class="text-center py-4 text-muted">
                                Nenhum galeria encontrado.
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
                      Total de Imagens:
                      <strong>
                        {{ $listaGaleria->count() }}
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

            <!--begin::Add User Modal-->
            <div
              class="modal fade"
              id="modal-add-user"
              tabindex="-1"
              aria-labelledby="modal-add-user-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <form>
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-add-user-label">Add new user</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="new-user-name" class="form-label"> Full name </label>
                        <input
                          type="text"
                          class="form-control"
                          id="new-user-name"
                          placeholder="e.g. Jane Doe"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <label for="new-user-email" class="form-label"> Email address </label>
                        <input
                          type="email"
                          class="form-control"
                          id="new-user-email"
                          placeholder="name@example.com"
                          required
                        />
                        <div class="form-text">The invitation will be sent to this address.</div>
                      </div>
                      <div class="mb-3">
                        <label for="new-user-role" class="form-label"> Role </label>
                        <select id="new-user-role" class="form-select">
                          <option selected>Subscriber</option>
                          <option>Author</option>
                          <option>Editor</option>
                          <option>Administrator</option>
                        </select>
                      </div>
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          id="new-user-welcome"
                          checked
                        />
                        <label class="form-check-label" for="new-user-welcome">
                          Send a welcome email with login details
                        </label>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                      </button>
                      <button type="submit" class="btn btn-primary">Create user</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--end::Add User Modal-->

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


            {{-- MODAL: CADASTRO DE IMAGEM DA GALERIA --}}
            <div class="modal fade" id="modal-add-galeria" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form action="{{ route('admin.galeria.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-header"><h5 class="modal-title">Adicionar Imagem da Galeria</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="add-galeria-nome_galeria" class="form-label">Nome</label>
                        <input id="add-galeria-nome_galeria" type="text" class="form-control" name="nome_galeria"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-galeria-imagem_galeria" class="form-label">Imagem</label>
                        <input id="add-galeria-imagem_galeria" type="file" class="form-control" name="imagem_galeria" accept="image/*" required />
                        <img id="add-galeria-imagem_galeria-preview" class="img-fluid rounded mt-2" alt="Prévia da imagem" />
                      </div>
                      <div class="mb-3">
                        <label for="add-galeria-status_galeria" class="form-label">Status</label>
                        <select id="add-galeria-status_galeria" class="form-select" name="status_galeria">
                          <option value="ATIVO">ATIVO</option>
                          <option value="INATIVO">INATIVO</option>
                        </select>
                      </div>
                  </div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Salvar</button></div>
                </form>
              </div></div>
            </div>

            {{-- MODAL: EDIÇÃO DE IMAGEM DA GALERIA --}}
            <div class="modal fade" id="modal-edit-galeria" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form id="form-edit-galeria" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="modal-header"><h5 class="modal-title">Editar Imagem da Galeria</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="edit-galeria-nome_galeria" class="form-label">Nome</label>
                        <input id="edit-galeria-nome_galeria" type="text" class="form-control" name="nome_galeria"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-galeria-imagem_galeria" class="form-label">Imagem</label>
                        <input id="edit-galeria-imagem_galeria" type="file" class="form-control" name="imagem_galeria" accept="image/*"  />
                        <img id="edit-galeria-imagem_galeria-preview" class="img-fluid rounded mt-2" alt="Prévia da imagem" />
                      </div>
                      <div class="mb-3">
                        <label for="edit-galeria-status_galeria" class="form-label">Status</label>
                        <select id="edit-galeria-status_galeria" class="form-select" name="status_galeria">
                          <option value="ATIVO">ATIVO</option>
                          <option value="INATIVO">INATIVO</option>
                        </select>
                      </div>
                  </div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Atualizar</button></div>
                </form>
              </div></div>
            </div>

            {{-- MODAL: CONFIRMAÇÃO DA ALTERAÇÃO DE STATUS --}}
            <div class="modal fade" id="modal-status-galeria" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form id="form-status-galeria" method="POST">
                  @csrf
                  @method('PATCH')
                  <div class="modal-header"><h5 class="modal-title">Alterar status</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body"><p class="mb-0">Tem certeza que deseja alterar o status desta imagem?</p></div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-danger">Confirmar</button></div>
                </form>
              </div></div>
            </div>

            {{-- JAVASCRIPT: PREENCHIMENTO DO MODAL, PREVIEW E STATUS --}}
            <script>
              const modalEditgaleria=document.getElementById('modal-edit-galeria');
              const modalStatusgaleria=document.getElementById('modal-status-galeria');
              modalEditgaleria.addEventListener('show.bs.modal',function(event){
                const botao=event.relatedTarget;
                document.getElementById('form-edit-galeria').action=botao.getAttribute('data-url');
                document.getElementById('edit-galeria-nome_galeria').value=botao.getAttribute('data-nome_galeria');
                document.getElementById('edit-galeria-status_galeria').value=botao.getAttribute('data-status_galeria');
                document.getElementById('edit-galeria-imagem_galeria-preview').src=botao.getAttribute('data-imagem_galeria');
              });
              modalStatusgaleria.addEventListener('show.bs.modal',function(event){document.getElementById('form-status-galeria').action=event.relatedTarget.getAttribute('data-status-url');});
              document.getElementById('add-galeria-imagem_galeria').addEventListener('change',function(){if(this.files[0])document.getElementById('add-galeria-imagem_galeria-preview').src=URL.createObjectURL(this.files[0]);});
              document.getElementById('edit-galeria-imagem_galeria').addEventListener('change',function(){if(this.files[0])document.getElementById('edit-galeria-imagem_galeria-preview').src=URL.createObjectURL(this.files[0]);});
            </script>
      </section>
      <!--end::App Main-->

