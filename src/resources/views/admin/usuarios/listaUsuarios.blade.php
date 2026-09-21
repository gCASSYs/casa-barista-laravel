      <!--begin::App Main-->
      <section class="admin-list-page">
        <!--begin::App Content Header-->
        <div class="app-content-header admin-page-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Usuários</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.usuarios.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Usuários</li>
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
                        <h3 class="card-title">Usuários cadastrados</h3>
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap justify-content-md-end gap-2">
                          <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">
                              <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input
                              type="search"
                              id="usuarios-search"
                              class="form-control admin-search-input"
                              placeholder="Pesquisar usuários"
                              aria-label="Pesquisar usuários"
                            />
                          </div>
                          <select
                            id="usuarios-role-filter"
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
                            data-bs-target="#modal-add-usuarios"
                          >
                            <i class="bi bi-plus-lg me-1" aria-hidden="true"> </i>
                            Novo usuario
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
                            <th>Nível</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                          </tr>
                        </thead>
                        <tbody>

                      {{--CONTEUDO DA TABELA--}}    
                        @forelse ($listaUsuarios as $usuarios)
                          <tr>
                            {{--ID USUÁRIO--}}
                            <td>
                              {{ $usuarios->id_usuarios }}
                            </td>

                            {{--NOME USUÁRIO--}}
                            <td>
                              {{ $usuarios->nome_usuarios }}
                            </td>

                            {{--EMAIL USUÁRIO--}}
                            <td>
                              {{ $usuarios->email_usuarios }}
                            </td>

                            {{--SENHA USUÁRIO--}}
                            <td>
                              {{ $usuarios->senha_usuarios }}
                            </td>

                            {{--FOTO USUÁRIO--}}
                             <td>
                              @if ($usuarios->foto_usuarios)
                                <img
                                  src="{{ asset('barista/assets/' . $usuarios->foto_usuarios) }}"
                                  alt="{{ $usuarios->nome_usuarios }}"
                                  class="rounded admin-table-thumbnail"
                                />
                              @else
                                <span class="text-muted">Sem Foto</span>
                              @endif
                            </td>
                            
                            {{--NÍVEL USUÁRIO--}}
                            <td>
                              @if ($usuarios->nivel_usuarios == 'ADMINISTRADOR')
                                <span class="badge text-bg-primary">Administrador</span>
                              @else
                                <span class="badge text-bg-secondary">Usuário</span>
                              @endif
                            </td>

                            {{--STATUS USUÁRIO--}}
                            <td>
                              @if ($usuarios->status_usuarios == 'ATIVO')
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
                                  data-bs-target="#modal-edit-usuarios"
                                  data-url="{{ route('admin.usuarios.update', $usuarios->id_usuarios) }}"
                                  data-nome_usuarios="{{ $usuarios->nome_usuarios }}"
                                  data-email_usuarios="{{ $usuarios->email_usuarios }}"
                                  data-nivel_usuarios="{{ $usuarios->nivel_usuarios }}"
                                  data-status_usuarios="{{ $usuarios->status_usuarios }}"
                                  data-foto_usuarios="{{ asset('barista/assets/' . $usuarios->foto_usuarios) }}"
                                >
                                  <i class="bi bi-pencil" aria-hidden="true"> </i>
                                </button>
                                <button
                                  type="button"
                                  class="btn {{ $usuarios->status_usuarios === 'ATIVO' ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-status-usuarios"
                                  data-status-url="{{ route('admin.usuarios.status', $usuarios->id_usuarios) }}"
                                  title="{{ $usuarios->status_usuarios === 'ATIVO' ? 'Desativar usuário' : 'Ativar usuário' }}"
                                  aria-label="{{ $usuarios->status_usuarios === 'ATIVO' ? 'Desativar usuário' : 'Ativar usuário' }}"
                                >
                                  <i class="bi {{ $usuarios->status_usuarios === 'ATIVO' ? 'bi-eye-fill' : 'bi-eye-slash-fill' }}" aria-hidden="true"> </i>
                                </button>
                              </div>
                            </td>
                          </tr>
                          @empty
                            <tr>
                              <td colspan="7" class="text-center py-4 text-muted">
                                Nenhum usuário encontrado.
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
                      Total de Usuários:
                      <strong>
                        {{ $listaUsuarios->count() }}
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


            {{-- MODAL: CADASTRO DE USUÁRIO --}}
            <div class="modal fade" id="modal-add-usuarios" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form action="{{ route('admin.usuarios.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-header"><h5 class="modal-title">Adicionar Usuário</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="add-usuarios-nome_usuarios" class="form-label">Nome</label>
                        <input id="add-usuarios-nome_usuarios" type="text" class="form-control" name="nome_usuarios"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-usuarios-email_usuarios" class="form-label">E-mail</label>
                        <input id="add-usuarios-email_usuarios" type="email" class="form-control" name="email_usuarios"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-usuarios-senha_usuarios" class="form-label">Senha</label>
                        <input id="add-usuarios-senha_usuarios" type="password" class="form-control" name="senha_usuarios"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-usuarios-foto_usuarios" class="form-label">Foto</label>
                        <input id="add-usuarios-foto_usuarios" type="file" class="form-control" name="foto_usuarios" accept="image/*" required />
                        <img id="add-usuarios-foto_usuarios-preview" class="img-fluid rounded mt-2" alt="Prévia da imagem" />
                      </div>
                      <div class="mb-3">
                        <label for="add-usuarios-nivel_usuarios" class="form-label">Nível</label>
                        <input id="add-usuarios-nivel_usuarios" type="text" class="form-control" name="nivel_usuarios"  required />
                      </div>
                      <div class="mb-3">
                        <label for="add-usuarios-status_usuarios" class="form-label">Status</label>
                        <select id="add-usuarios-status_usuarios" class="form-select" name="status_usuarios">
                          <option value="ATIVO">ATIVO</option>
                          <option value="INATIVO">INATIVO</option>
                        </select>
                      </div>
                  </div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Salvar</button></div>
                </form>
              </div></div>
            </div>

            {{-- MODAL: EDIÇÃO DE USUÁRIO --}}
            <div class="modal fade" id="modal-edit-usuarios" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form id="form-edit-usuarios" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="modal-header"><h5 class="modal-title">Editar Usuário</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="edit-usuarios-nome_usuarios" class="form-label">Nome</label>
                        <input id="edit-usuarios-nome_usuarios" type="text" class="form-control" name="nome_usuarios"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-usuarios-email_usuarios" class="form-label">E-mail</label>
                        <input id="edit-usuarios-email_usuarios" type="email" class="form-control" name="email_usuarios"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-usuarios-senha_usuarios" class="form-label">Senha</label>
                        <input id="edit-usuarios-senha_usuarios" type="password" class="form-control" name="senha_usuarios" placeholder="Deixe vazio para manter a senha"  />
                      </div>
                      <div class="mb-3">
                        <label for="edit-usuarios-foto_usuarios" class="form-label">Foto</label>
                        <input id="edit-usuarios-foto_usuarios" type="file" class="form-control" name="foto_usuarios" accept="image/*"  />
                        <img id="edit-usuarios-foto_usuarios-preview" class="img-fluid rounded mt-2" alt="Prévia da imagem" />
                      </div>
                      <div class="mb-3">
                        <label for="edit-usuarios-nivel_usuarios" class="form-label">Nível</label>
                        <input id="edit-usuarios-nivel_usuarios" type="text" class="form-control" name="nivel_usuarios"  required />
                      </div>
                      <div class="mb-3">
                        <label for="edit-usuarios-status_usuarios" class="form-label">Status</label>
                        <select id="edit-usuarios-status_usuarios" class="form-select" name="status_usuarios">
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
            <div class="modal fade" id="modal-status-usuarios" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog"><div class="modal-content">
                <form id="form-status-usuarios" method="POST">
                  @csrf
                  @method('PATCH')
                  <div class="modal-header"><h5 class="modal-title">Alterar status</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                  <div class="modal-body"><p class="mb-0">Tem certeza que deseja alterar o status deste usuario?</p></div>
                  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-danger">Confirmar</button></div>
                </form>
              </div></div>
            </div>

            {{-- JAVASCRIPT: PREENCHIMENTO DO MODAL, PREVIEW E STATUS --}}
            <script>
              const modalEditusuarios=document.getElementById('modal-edit-usuarios');
              const modalStatususuarios=document.getElementById('modal-status-usuarios');
              modalEditusuarios.addEventListener('show.bs.modal',function(event){
                const botao=event.relatedTarget;
                document.getElementById('form-edit-usuarios').action=botao.getAttribute('data-url');
                document.getElementById('edit-usuarios-nome_usuarios').value=botao.getAttribute('data-nome_usuarios');
                document.getElementById('edit-usuarios-email_usuarios').value=botao.getAttribute('data-email_usuarios');
                document.getElementById('edit-usuarios-nivel_usuarios').value=botao.getAttribute('data-nivel_usuarios');
                document.getElementById('edit-usuarios-status_usuarios').value=botao.getAttribute('data-status_usuarios');
                document.getElementById('edit-usuarios-foto_usuarios-preview').src=botao.getAttribute('data-foto_usuarios');
              });
              modalStatususuarios.addEventListener('show.bs.modal',function(event){document.getElementById('form-status-usuarios').action=event.relatedTarget.getAttribute('data-status-url');});
              document.getElementById('add-usuarios-foto_usuarios').addEventListener('change',function(){if(this.files[0])document.getElementById('add-usuarios-foto_usuarios-preview').src=URL.createObjectURL(this.files[0]);});
              document.getElementById('edit-usuarios-foto_usuarios').addEventListener('change',function(){if(this.files[0])document.getElementById('edit-usuarios-foto_usuarios-preview').src=URL.createObjectURL(this.files[0]);});
            </script>
      </section>
      <!--end::App Main-->
