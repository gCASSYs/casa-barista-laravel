      <!--begin::App Main-->
      <section class="admin-list-page">
        <!--begin::App Content Header-->
        <div class="app-content-header admin-page-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Depoimentos</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.depoimento.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Depoimentos</li>
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
                        <h3 class="card-title">Depoimentos cadastrados</h3>
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap justify-content-md-end gap-2">
                          <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">
                              <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input
                              type="search"
                              id="depoimento-search"
                              class="form-control admin-search-input"
                              placeholder="Pesquisar depoimentos"
                              aria-label="Pesquisar depoimentos"
                            />
                          </div>
                          <select
                            id="depoimento-role-filter"
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
                            data-bs-target="#modal-add-depoimento"
                          >
                            <i class="bi bi-plus-lg me-1" aria-hidden="true"> </i>
                            Novo registro
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
                            <th>Descrição</th>
                            <th>Cliente</th>
                            <th>Nota</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                          </tr>
                        </thead>
                        <tbody>

                      {{--CONTEUDO DA TABELA--}}    
                        @forelse ($listaDepoimento as $depoimento)
                          <tr>
                            {{--ID DEPOIMENTO--}}
                            <td>
                              {{ $depoimento->id_depoimento }}
                            </td>
                            
         
                           <td>
                              @if ($depoimento->DepoimentoCliente?->foto_cliente)
                                <img
                                  src="{{ asset('barista/assets/' . $depoimento->DepoimentoCliente->foto_cliente) }}"
                                  alt="{{ $depoimento->DepoimentoCliente->nome_cliente }}"
                                  class="rounded admin-table-thumbnail"
                                />
                              @else
                                <span class="text-muted">Sem Foto</span>
                              @endif
                            </td>


                            {{--TITULO DEPOIMENTO--}}
                            <td>
                              {{ $depoimento->titulo_depoimento }}
                            </td>

                            {{--DESCRIÇÃO DEPOIMENTO--}}
                            <td>
                              {{ $depoimento->descricao_depoimento }}
                            </td>

                            {{--NOTA DEPOIMENTO--}}
                            <td>
                              {{ $depoimento->nota_depoimento }}
                            </td>

                            {{--STATUS DEPOIMENTO--}}
                            <td>
                              @if ($depoimento->status_depoimento == 'APROVADO')
                                <span class="badge text-bg-success">Ativo</span>
                              @else
                                <span class="badge text-bg-warning">Inativo</span>
                              @endif
                            </td>

                            {{--AÇÕES--}}
                            <td class="text-end">
                              <div class="btn-group btn-group-sm">
                                <button
                                  type="button"
                                  class="btn btn-outline-secondary"
                                  aria-label="Editar"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-edit-depoimento"
                                  data-url="{{ route('admin.depoimento.update', $depoimento->id_depoimento) }}"
                                  data-id_cliente="{{ $depoimento->id_cliente }}"
                                  data-titulo_depoimento="{{ $depoimento->titulo_depoimento }}"
                                  data-descricao_depoimento="{{ $depoimento->descricao_depoimento }}"
                                  data-nota_depoimento="{{ $depoimento->nota_depoimento }}"
                                  data-status_depoimento="{{ $depoimento->status_depoimento }}"
                                >
                                  <i class="bi bi-pencil" aria-hidden="true"> </i>
                                </button>
                                <button
                                  type="button"
                                  class="btn btn-outline-danger"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-status-depoimento"
                                  data-status-url="{{ route('admin.depoimento.status', $depoimento->id_depoimento) }}"
                                  aria-label="Deletar"
                                >
                                  <i class="bi bi-trash" aria-hidden="true"> </i>
                                </button>
                              </div>
                            </td>
                          </tr>
                          @empty
                            <tr>
                              <td colspan="6" class="text-center py-4 text-muted">
                                Nenhum depoimento encontrado.
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
                      Total de Depoimentos:
                      <strong>
                        {{ $listaDepoimento->count() }}
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


            {{-- MODAL: CADASTRO DE DEPOIMENTO --}}
            <div class="modal fade" id="modal-add-depoimento" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form action="{{ route('admin.depoimento.store') }}" method="POST">
                  @csrf
                  <div class="modal-header"><h5 class="modal-title">Adicionar Depoimento</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="add-depoimento-id_cliente" class="form-label">Cliente</label>
                        <select id="add-depoimento-id_cliente" class="form-select" name="id_cliente" required>
                          @foreach ($listaClientes as $opcao)
                            <option value="{{ $opcao->id_cliente }}">{{ $opcao->nome_cliente }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="add-depoimento-titulo_depoimento" class="form-label">Título</label>
                        <input id="add-depoimento-titulo_depoimento" type="text" class="form-control" name="titulo_depoimento"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-depoimento-descricao_depoimento" class="form-label">Descrição</label>
                        <textarea id="add-depoimento-descricao_depoimento" class="form-control" name="descricao_depoimento" required></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="add-depoimento-nota_depoimento" class="form-label">Nota</label>
                        <input id="add-depoimento-nota_depoimento" type="number" step="0.01" class="form-control" name="nota_depoimento"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-depoimento-status_depoimento" class="form-label">Status</label>
                        <select id="add-depoimento-status_depoimento" class="form-select" name="status_depoimento">
                          <option value="PENDENTE">PENDENTE</option>
                          <option value="APROVADO">APROVADO</option>
                          <option value="REPROVADO">REPROVADO</option>
                        </select>
                      </div>
                  </div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Salvar</button></div>
                </form>
              </div></div>
            </div>

            {{-- MODAL: EDIÇÃO DE DEPOIMENTO --}}
            <div class="modal fade" id="modal-edit-depoimento" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form id="form-edit-depoimento" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="modal-header"><h5 class="modal-title">Editar Depoimento</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="edit-depoimento-id_cliente" class="form-label">Cliente</label>
                        <select id="edit-depoimento-id_cliente" class="form-select" name="id_cliente" required>
                          @foreach ($listaClientes as $opcao)
                            <option value="{{ $opcao->id_cliente }}">{{ $opcao->nome_cliente }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="edit-depoimento-titulo_depoimento" class="form-label">Título</label>
                        <input id="edit-depoimento-titulo_depoimento" type="text" class="form-control" name="titulo_depoimento"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-depoimento-descricao_depoimento" class="form-label">Descrição</label>
                        <textarea id="edit-depoimento-descricao_depoimento" class="form-control" name="descricao_depoimento" ></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="edit-depoimento-nota_depoimento" class="form-label">Nota</label>
                        <input id="edit-depoimento-nota_depoimento" type="number" step="0.01" class="form-control" name="nota_depoimento"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-depoimento-status_depoimento" class="form-label">Status</label>
                        <select id="edit-depoimento-status_depoimento" class="form-select" name="status_depoimento">
                          <option value="PENDENTE">PENDENTE</option>
                          <option value="APROVADO">APROVADO</option>
                          <option value="REPROVADO">REPROVADO</option>
                        </select>
                      </div>
                  </div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Atualizar</button></div>
                </form>
              </div></div>
            </div>

            {{-- MODAL: CONFIRMAÇÃO DA ALTERAÇÃO DE STATUS --}}
            <div class="modal fade" id="modal-status-depoimento" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form id="form-status-depoimento" method="POST">
                  @csrf
                  @method('PATCH')
                  <div class="modal-header"><h5 class="modal-title">Alterar status</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body"><p class="mb-0">Tem certeza que deseja alterar o status deste registro?</p></div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-danger">Confirmar</button></div>
                </form>
              </div></div>
            </div>

            {{-- JAVASCRIPT: PREENCHIMENTO DO MODAL, PREVIEW E STATUS --}}
            <script>
              const modalEditdepoimento=document.getElementById('modal-edit-depoimento');
              const modalStatusdepoimento=document.getElementById('modal-status-depoimento');
              modalEditdepoimento.addEventListener('show.bs.modal',function(event){
                const botao=event.relatedTarget;
                document.getElementById('form-edit-depoimento').action=botao.getAttribute('data-url');
                document.getElementById('edit-depoimento-id_cliente').value=botao.getAttribute('data-id_cliente');
                document.getElementById('edit-depoimento-titulo_depoimento').value=botao.getAttribute('data-titulo_depoimento');
                document.getElementById('edit-depoimento-descricao_depoimento').value=botao.getAttribute('data-descricao_depoimento');
                document.getElementById('edit-depoimento-nota_depoimento').value=botao.getAttribute('data-nota_depoimento');
                document.getElementById('edit-depoimento-status_depoimento').value=botao.getAttribute('data-status_depoimento');

              });
              modalStatusdepoimento.addEventListener('show.bs.modal',function(event){document.getElementById('form-status-depoimento').action=event.relatedTarget.getAttribute('data-status-url');});

            </script>
      </section>
      <!--end::App Main-->


