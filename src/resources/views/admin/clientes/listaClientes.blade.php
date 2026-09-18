      <!--begin::App Main-->
      <section class="admin-list-page">
        <!--begin::App Content Header-->
        <div class="app-content-header admin-page-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Clientes</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.clientes.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
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
                        <h3 class="card-title">Clientes cadastrados</h3>
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap justify-content-md-end gap-2">
                          <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">
                              <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input
                              type="search"
                              id="clientes-search"
                              class="form-control admin-search-input"
                              placeholder="Pesquisar clientes"
                              aria-label="Pesquisar clientes"
                            />
                          </div>
                          <select
                            id="clientes-role-filter"
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
                            data-bs-target="#modal-add-clientes"
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
                            <th>Email</th>
                            <th>Senha</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                          </tr>
                        </thead>
                        <tbody>

                      {{--CONTEUDO DA TABELA--}}    
                        @forelse ($listaClientes as $cliente)
                          <tr>
                            {{--ID CLIENTE--}}
                            <td>
                              {{ $cliente->id_cliente }}
                            </td>

                            {{--NOME CLIENTE--}}
                            <td>
                              {{ $cliente->nome_cliente }}
                            </td>

                            {{--EMAIL CLIENTE--}}
                            <td>
                              {{ $cliente->email_cliente }}
                            </td>

                            {{--SENHA CLIENTE--}}
                            <td>
                              {{ $cliente->senha_cliente }}
                            </td>

                            {{--FOTO CLIENTE--}}
                             <td>
                              @if ($cliente->foto_cliente)
                                <img
                                  src="{{ asset('barista/assets/' . $cliente->foto_cliente) }}"
                                  alt="{{ $cliente->nome_cliente }}"
                                  class="rounded admin-table-thumbnail"
                                />
                              @else
                                <span class="text-muted">Sem Foto</span>
                              @endif
                            </td>

                            {{--STATUS CLIENTE--}}
                            <td>
                              @if ($cliente->status_cliente == 'ATIVO')
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
                                  data-bs-target="#modal-edit-clientes"
                                  data-url="{{ route('admin.clientes.update', $cliente->id_cliente) }}"
                                  data-nome_cliente="{{ $cliente->nome_cliente }}"
                                  data-email_cliente="{{ $cliente->email_cliente }}"
                                  data-status_cliente="{{ $cliente->status_cliente }}"
                                  data-foto_cliente="{{ asset('barista/assets/' . $cliente->foto_cliente) }}"
                                >
                                  <i class="bi bi-pencil" aria-hidden="true"> </i>
                                </button>
                                <button
                                  type="button"
                                  class="btn btn-outline-danger"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-status-clientes"
                                  data-status-url="{{ route('admin.clientes.status', $cliente->id_cliente) }}"
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
                                Nenhum cliente encontrado.
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
                      Total de Clientes:
                      <strong>
                        {{ $listaClientes->count() }}
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


            {{-- MODAL: CADASTRO DE CLIENTE --}}
            <div class="modal fade" id="modal-add-clientes" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form action="{{ route('admin.clientes.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-header"><h5 class="modal-title">Adicionar Cliente</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="add-clientes-nome_cliente" class="form-label">Nome</label>
                        <input id="add-clientes-nome_cliente" type="text" class="form-control" name="nome_cliente"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-clientes-email_cliente" class="form-label">E-mail</label>
                        <input id="add-clientes-email_cliente" type="email" class="form-control" name="email_cliente"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-clientes-senha_cliente" class="form-label">Senha</label>
                        <input id="add-clientes-senha_cliente" type="password" class="form-control" name="senha_cliente"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-clientes-foto_cliente" class="form-label">Foto</label>
                        <input id="add-clientes-foto_cliente" type="file" class="form-control" name="foto_cliente" accept="image/*" required />
                        <img id="add-clientes-foto_cliente-preview" class="img-fluid rounded mt-2" alt="Prévia da imagem" />
                      </div>
                      <div class="mb-3">
                        <label for="add-clientes-status_cliente" class="form-label">Status</label>
                        <select id="add-clientes-status_cliente" class="form-select" name="status_cliente">
                          <option value="ATIVO">ATIVO</option>
                          <option value="INATIVO">INATIVO</option>
                        </select>
                      </div>
                  </div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Salvar</button></div>
                </form>
              </div></div>
            </div>

            {{-- MODAL: EDIÇÃO DE CLIENTE --}}
            <div class="modal fade" id="modal-edit-clientes" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form id="form-edit-clientes" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="modal-header"><h5 class="modal-title">Editar Cliente</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="edit-clientes-nome_cliente" class="form-label">Nome</label>
                        <input id="edit-clientes-nome_cliente" type="text" class="form-control" name="nome_cliente"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-clientes-email_cliente" class="form-label">E-mail</label>
                        <input id="edit-clientes-email_cliente" type="email" class="form-control" name="email_cliente"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-clientes-senha_cliente" class="form-label">Senha</label>
                        <input id="edit-clientes-senha_cliente" type="password" class="form-control" name="senha_cliente" placeholder="Deixe vazio para manter a senha"  />
                      </div>
                      <div class="mb-3">
                        <label for="edit-clientes-foto_cliente" class="form-label">Foto</label>
                        <input id="edit-clientes-foto_cliente" type="file" class="form-control" name="foto_cliente" accept="image/*"  />
                        <img id="edit-clientes-foto_cliente-preview" class="img-fluid rounded mt-2" alt="Prévia da imagem" />
                      </div>
                      <div class="mb-3">
                        <label for="edit-clientes-status_cliente" class="form-label">Status</label>
                        <select id="edit-clientes-status_cliente" class="form-select" name="status_cliente">
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
            <div class="modal fade" id="modal-status-clientes" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form id="form-status-clientes" method="POST">
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
              const modalEditclientes=document.getElementById('modal-edit-clientes');
              const modalStatusclientes=document.getElementById('modal-status-clientes');
              modalEditclientes.addEventListener('show.bs.modal',function(event){
                const botao=event.relatedTarget;
                document.getElementById('form-edit-clientes').action=botao.getAttribute('data-url');
                document.getElementById('edit-clientes-nome_cliente').value=botao.getAttribute('data-nome_cliente');
                document.getElementById('edit-clientes-email_cliente').value=botao.getAttribute('data-email_cliente');
                document.getElementById('edit-clientes-status_cliente').value=botao.getAttribute('data-status_cliente');
                document.getElementById('edit-clientes-foto_cliente-preview').src=botao.getAttribute('data-foto_cliente');
              });
              modalStatusclientes.addEventListener('show.bs.modal',function(event){document.getElementById('form-status-clientes').action=event.relatedTarget.getAttribute('data-status-url');});
              document.getElementById('add-clientes-foto_cliente').addEventListener('change',function(){if(this.files[0])document.getElementById('add-clientes-foto_cliente-preview').src=URL.createObjectURL(this.files[0]);});
              document.getElementById('edit-clientes-foto_cliente').addEventListener('change',function(){if(this.files[0])document.getElementById('edit-clientes-foto_cliente-preview').src=URL.createObjectURL(this.files[0]);});
            </script>
      </section>
      <!--end::App Main-->

