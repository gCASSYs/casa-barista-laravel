      <!--begin::App Main-->
      <section class="admin-list-page">
        <!--begin::App Content Header-->
        <div class="app-content-header admin-page-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Vendas</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.venda.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Vendas</li>
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
                        <h3 class="card-title">Vendas cadastradas</h3>
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap justify-content-md-end gap-2">
                          <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">
                              <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input
                              type="search"
                              id="venda-search"
                              class="form-control admin-search-input"
                              placeholder="Pesquisar vendas"
                              aria-label="Pesquisar vendas"
                            />
                          </div>
                          <select
                            id="venda-role-filter"
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
                            data-bs-target="#modal-add-venda"
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
                            <th>Nome</th>
                            <th>Valor Total</th>
                            <th>Forma de Pagamento</th>
                            <th>Observação</th>
                            <th>Data | Hora</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                          </tr>
                        </thead>
                        <tbody>

                      {{--CONTEUDO DA TABELA--}}    
                        @forelse ($listaVenda as $venda)
                          <tr>
                            {{--ID VENDA--}}
                            <td>
                              {{ $venda->id_venda }}
                            </td>

                            {{--Nome Cliente--}}
                            <td>
                              {{ $venda->cliente?->nome_cliente ?? 'Cliente não encontrado' }}
                            </td>
                            {{--Valor Total--}}
                            <td>
                              R$ {{ number_format($venda->valor_total_venda, 2, ',', '.') }}
                            </td>
                            {{--Forma de Pagamento--}}
                            <td>
                              {{ $venda->forma_pagamento_venda }}
                            </td>
                            {{--Observação--}}
                            <td>
                              {{ $venda->observacao_venda }}
                            </td>
                            {{--Data | Hora--}}
                            <td>
                              {{ date('d/m/Y H:i', strtotime($venda->data_hora_venda)) }}
                            </td>
                            {{--Status--}}
                            <td>
                              @switch($venda->status_venda)
                                @case('FINALIZADA')
                                  <span class="badge text-bg-success">Finalizada</span>
                                  @break
                                @case('CANCELADA')
                                  <span class="badge text-bg-danger">Cancelada</span>
                                  @break
                                @case('EM ANDAMENTO')
                                  <span class="badge text-bg-warning">Em andamento</span>
                                  @break
                                @default
                                  <span class="badge text-bg-secondary">{{ $venda->status_venda }}</span>
                              @endswitch
                            </td>  

                            {{--STATUS--}}
                            <td class="text-end">
                              <div class="btn-group btn-group-sm">
                                <button
                                  type="button"
                                  class="btn btn-outline-secondary"
                                  aria-label="Editar"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-edit-venda"
                                  data-url="{{ route('admin.venda.update', $venda->id_venda) }}"
                                  data-id_cliente="{{ $venda->id_cliente }}"
                                  data-data_hora_venda="{{ $venda->data_hora_venda }}"
                                  data-valor_total_venda="{{ $venda->valor_total_venda }}"
                                  data-forma_pagamento_venda="{{ $venda->forma_pagamento_venda }}"
                                  data-observacao_venda="{{ $venda->observacao_venda }}"
                                  data-status_venda="{{ $venda->status_venda }}"
                                >
                                  <i class="bi bi-pencil" aria-hidden="true"> </i>
                                </button>
                                <button
                                  type="button"
                                  class="btn btn-outline-danger"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-status-venda"
                                  data-status-url="{{ route('admin.venda.status', $venda->id_venda) }}"
                                  aria-label="Deletar"
                                >
                                  <i class="bi bi-trash" aria-hidden="true"> </i>
                                </button>
                              </div>
                            </td>
                          </tr>
                          @empty
                            <tr>
                              <td colspan="8" class="text-center py-4 text-muted">
                                Nenhuma venda encontrada.
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
                      Total de vendas:
                      <strong>
                        {{ $listaVenda->count() }}
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


            {{-- MODAL: CADASTRO DE VENDA --}}
            <div class="modal fade" id="modal-add-venda" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form action="{{ route('admin.venda.store') }}" method="POST">
                  @csrf
                  <div class="modal-header"><h5 class="modal-title">Adicionar Venda</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="add-venda-id_cliente" class="form-label">Cliente</label>
                        <select id="add-venda-id_cliente" class="form-select" name="id_cliente" required>
                          @foreach ($listaClientes as $opcao)
                            <option value="{{ $opcao->id_cliente }}">{{ $opcao->nome_cliente }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="add-venda-data_hora_venda" class="form-label">Data e hora</label>
                        <input id="add-venda-data_hora_venda" type="datetime-local" class="form-control" name="data_hora_venda"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-venda-valor_total_venda" class="form-label">Valor total</label>
                        <input id="add-venda-valor_total_venda" type="number" step="0.01" class="form-control" name="valor_total_venda"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-venda-forma_pagamento_venda" class="form-label">Forma de pagamento</label>
                        <input id="add-venda-forma_pagamento_venda" type="text" class="form-control" name="forma_pagamento_venda"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-venda-observacao_venda" class="form-label">Observação</label>
                        <input id="add-venda-observacao_venda" type="text" class="form-control" name="observacao_venda"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-venda-status_venda" class="form-label">Status</label>
                        <select id="add-venda-status_venda" class="form-select" name="status_venda">
                          <option value="EM ANDAMENTO">EM ANDAMENTO</option>
                          <option value="FINALIZADA">FINALIZADA</option>
                          <option value="CANCELADA">CANCELADA</option>
                        </select>
                      </div>
                  </div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Salvar</button></div>
                </form>
              </div></div>
            </div>

            {{-- MODAL: EDIÇÃO DE VENDA --}}
            <div class="modal fade" id="modal-edit-venda" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form id="form-edit-venda" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="modal-header"><h5 class="modal-title">Editar Venda</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="edit-venda-id_cliente" class="form-label">Cliente</label>
                        <select id="edit-venda-id_cliente" class="form-select" name="id_cliente" required>
                          @foreach ($listaClientes as $opcao)
                            <option value="{{ $opcao->id_cliente }}">{{ $opcao->nome_cliente }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="edit-venda-data_hora_venda" class="form-label">Data e hora</label>
                        <input id="edit-venda-data_hora_venda" type="datetime-local" class="form-control" name="data_hora_venda"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-venda-valor_total_venda" class="form-label">Valor total</label>
                        <input id="edit-venda-valor_total_venda" type="number" step="0.01" class="form-control" name="valor_total_venda"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-venda-forma_pagamento_venda" class="form-label">Forma de pagamento</label>
                        <input id="edit-venda-forma_pagamento_venda" type="text" class="form-control" name="forma_pagamento_venda"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-venda-observacao_venda" class="form-label">Observação</label>
                        <input id="edit-venda-observacao_venda" type="text" class="form-control" name="observacao_venda"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-venda-status_venda" class="form-label">Status</label>
                        <select id="edit-venda-status_venda" class="form-select" name="status_venda">
                          <option value="EM ANDAMENTO">EM ANDAMENTO</option>
                          <option value="FINALIZADA">FINALIZADA</option>
                          <option value="CANCELADA">CANCELADA</option>
                        </select>
                      </div>
                  </div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Atualizar</button></div>
                </form>
              </div></div>
            </div>

            {{-- MODAL: CONFIRMAÇÃO DA ALTERAÇÃO DE STATUS --}}
            <div class="modal fade" id="modal-status-venda" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form id="form-status-venda" method="POST">
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
              const modalEditvenda=document.getElementById('modal-edit-venda');
              const modalStatusvenda=document.getElementById('modal-status-venda');
              modalEditvenda.addEventListener('show.bs.modal',function(event){
                const botao=event.relatedTarget;
                document.getElementById('form-edit-venda').action=botao.getAttribute('data-url');
                document.getElementById('edit-venda-id_cliente').value=botao.getAttribute('data-id_cliente');
                document.getElementById('edit-venda-data_hora_venda').value=botao.getAttribute('data-data_hora_venda');
                document.getElementById('edit-venda-valor_total_venda').value=botao.getAttribute('data-valor_total_venda');
                document.getElementById('edit-venda-forma_pagamento_venda').value=botao.getAttribute('data-forma_pagamento_venda');
                document.getElementById('edit-venda-observacao_venda').value=botao.getAttribute('data-observacao_venda');
                document.getElementById('edit-venda-status_venda').value=botao.getAttribute('data-status_venda');

              });
              modalStatusvenda.addEventListener('show.bs.modal',function(event){document.getElementById('form-status-venda').action=event.relatedTarget.getAttribute('data-status-url');});

            </script>
      </section>
      <!--end::App Main-->


