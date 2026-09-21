      <!--begin::App Main-->
      <section class="admin-list-page">
        <!--begin::App Content Header-->
        <div class="app-content-header admin-page-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Linha do Tempo</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.linhatempo.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Linha do Tempo</li>
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
                        <h3 class="card-title">Linhas do tempo cadastradas</h3>
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap justify-content-md-end gap-2">
                          <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">
                              <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input
                              type="search"
                              id="linha_do_tempo-search"
                              class="form-control admin-search-input"
                              placeholder="Pesquisar linha do tempo"
                              aria-label="Pesquisar linha do tempo"
                            />
                          </div>
                          <select
                            id="linha do tempo-role-filter"
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
                            data-bs-target="#modal-add-linhatempo"
                          >
                            <i class="bi bi-plus-lg me-1" aria-hidden="true"> </i>
                            Nova linha do tempo
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
                            <th>Titulo</th>
                            <th>Ano</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                          </tr>
                        </thead>
                        <tbody>

                      {{--CONTEUDO DA TABELA--}}    
                        @forelse ($listaLinhaTempo as $linha_tempo)
                          <tr>
                            {{--ID LInha do tempo--}}
                            <td>
                              {{ $linha_tempo->id_linha_tempo }}
                            </td>

                            {{--Titulo--}}
                            <td>
                              {{ $linha_tempo->titulo_linha_tempo}}
                            </td>
                            {{--Ano--}}
                            <td>
                            {{ date('Y', strtotime($linha_tempo->ano_linha_tempo)) }}
                            </td>
                            {{--Descrição--}}
                            <td>
                              {{ $linha_tempo->descricao_linha_tempo }}
                            </td>
                             {{--STATUS Linha do Tempo--}}
                            <td>
                              @if ($linha_tempo->status_linha_tempo == 'ATIVO')
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
                                  data-bs-target="#modal-edit-linhatempo"
                                  data-url="{{ route('admin.linhatempo.update', $linha_tempo->id_linha_tempo) }}"
                                  data-titulo_linha_tempo="{{ $linha_tempo->titulo_linha_tempo }}"
                                  data-ano_linha_tempo="{{ $linha_tempo->ano_linha_tempo }}"
                                  data-descricao_linha_tempo="{{ $linha_tempo->descricao_linha_tempo }}"
                                  data-status_linha_tempo="{{ $linha_tempo->status_linha_tempo }}"
                                >
                                  <i class="bi bi-pencil" aria-hidden="true"> </i>
                                </button>
                                <button
                                  type="button"
                                  class="btn {{ $linha_tempo->status_linha_tempo === 'ATIVO' ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-status-linhatempo"
                                  data-status-url="{{ route('admin.linhatempo.status', $linha_tempo->id_linha_tempo) }}"
                                  title="{{ $linha_tempo->status_linha_tempo === 'ATIVO' ? 'Desativar item' : 'Ativar item' }}"
                                  aria-label="{{ $linha_tempo->status_linha_tempo === 'ATIVO' ? 'Desativar item' : 'Ativar item' }}"
                                >
                                  <i class="bi {{ $linha_tempo->status_linha_tempo === 'ATIVO' ? 'bi-eye-fill' : 'bi-eye-slash-fill' }}" aria-hidden="true"> </i>
                                </button>
                              </div>
                            </td>
                          </tr>
                          @empty
                            <tr>
                              <td colspan="8" class="text-center py-4 text-muted">
                                Nenhuma linha do tempo encontrada.
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
                      Total de linhas do tempo:
                      <strong>
                        {{ $listaLinhaTempo->count() }}
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


            {{-- MODAL: CADASTRO DE LINHA DO TEMPO --}}
            <div class="modal fade" id="modal-add-linhatempo" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form action="{{ route('admin.linhatempo.store') }}" method="POST">
                  @csrf
                  <div class="modal-header"><h5 class="modal-title">Adicionar Linha do Tempo</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="add-linhatempo-titulo_linha_tempo" class="form-label">Título</label>
                        <input id="add-linhatempo-titulo_linha_tempo" type="text" class="form-control" name="titulo_linha_tempo"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-linhatempo-ano_linha_tempo" class="form-label">Data</label>
                        <input id="add-linhatempo-ano_linha_tempo" type="date" class="form-control" name="ano_linha_tempo"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-linhatempo-descricao_linha_tempo" class="form-label">Descrição</label>
                        <textarea id="add-linhatempo-descricao_linha_tempo" class="form-control" name="descricao_linha_tempo" required></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="add-linhatempo-status_linha_tempo" class="form-label">Status</label>
                        <select id="add-linhatempo-status_linha_tempo" class="form-select" name="status_linha_tempo">
                          <option value="ATIVO">ATIVO</option>
                          <option value="INATIVO">INATIVO</option>
                        </select>
                      </div>
                  </div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Salvar</button></div>
                </form>
              </div></div>
            </div>

            {{-- MODAL: EDIÇÃO DE LINHA DO TEMPO --}}
            <div class="modal fade" id="modal-edit-linhatempo" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form id="form-edit-linhatempo" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="modal-header"><h5 class="modal-title">Editar Linha do Tempo</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="edit-linhatempo-titulo_linha_tempo" class="form-label">Título</label>
                        <input id="edit-linhatempo-titulo_linha_tempo" type="text" class="form-control" name="titulo_linha_tempo"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-linhatempo-ano_linha_tempo" class="form-label">Data</label>
                        <input id="edit-linhatempo-ano_linha_tempo" type="date" class="form-control" name="ano_linha_tempo"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-linhatempo-descricao_linha_tempo" class="form-label">Descrição</label>
                        <textarea id="edit-linhatempo-descricao_linha_tempo" class="form-control" name="descricao_linha_tempo" ></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="edit-linhatempo-status_linha_tempo" class="form-label">Status</label>
                        <select id="edit-linhatempo-status_linha_tempo" class="form-select" name="status_linha_tempo">
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
            <div class="modal fade" id="modal-status-linhatempo" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form id="form-status-linhatempo" method="POST">
                  @csrf
                  @method('PATCH')
                  <div class="modal-header"><h5 class="modal-title">Alterar status</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body"><p class="mb-0">Tem certeza que deseja alterar o status desta linha do tempo?</p></div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-danger">Confirmar</button></div>
                </form>
              </div></div>
            </div>

            {{-- JAVASCRIPT: PREENCHIMENTO DO MODAL, PREVIEW E STATUS --}}
            <script>
              const modalEditlinhatempo=document.getElementById('modal-edit-linhatempo');
              const modalStatuslinhatempo=document.getElementById('modal-status-linhatempo');
              modalEditlinhatempo.addEventListener('show.bs.modal',function(event){
                const botao=event.relatedTarget;
                document.getElementById('form-edit-linhatempo').action=botao.getAttribute('data-url');
                document.getElementById('edit-linhatempo-titulo_linha_tempo').value=botao.getAttribute('data-titulo_linha_tempo');
                document.getElementById('edit-linhatempo-ano_linha_tempo').value=botao.getAttribute('data-ano_linha_tempo');
                document.getElementById('edit-linhatempo-descricao_linha_tempo').value=botao.getAttribute('data-descricao_linha_tempo');
                document.getElementById('edit-linhatempo-status_linha_tempo').value=botao.getAttribute('data-status_linha_tempo');

              });
              modalStatuslinhatempo.addEventListener('show.bs.modal',function(event){document.getElementById('form-status-linhatempo').action=event.relatedTarget.getAttribute('data-status-url');});

            </script>
      </section>
      <!--end::App Main-->

