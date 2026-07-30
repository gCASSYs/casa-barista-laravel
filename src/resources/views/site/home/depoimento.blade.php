<section class="depoimento wow animate__animated animate__fadeInUp">
            <header class="parallax-padrao">
                <h2>Depoimento</h2>
                <h3>Nada nos inspira mais do que ouvir a experiência de quem passa por aqui</h3>
            </header>

            <div class="Itens-Depoimento">

                @foreach ($listaDepo as $linha)

                    @php

                        //garantir que as estrelas fique entre 0 a 5
                        $estrela = max(0, min(5, (int) $linha->nota_depoimento));

                        //Cliente relacionado com o depoimento
                        $cliente = $linha->DepoimentoCliente;
                        
                    @endphp
                    
                    <article>
                        <div class="estrelas">
                            <ul>
                                @for ($i = 1; $i <= 5; $i++)
                                    <li class="{{ $i <= $estrela ? 'estrela-ativa' : 'estrela-inativa' }}">
                                        <img
                                            src="{{ asset('barista/assets/estrela.png') }}"
                                            alt="{{ $i <= $estrela ? 'Estrela preenchida' : 'Estrela não preenchida' }}">
                                    </li>
                                @endfor
                            </ul>
                        </div>
                        <div class="dados-Depoimento">
                            <p>{{ $linha->descricao_depoimento }}</p>
                            
                            <img src="{{ asset('barista/assets/clientes/' . basename($cliente->foto_cliente)) }}" alt= "{{ $cliente->nome_cliente }}">
                            <h4>{{ $cliente->nome_cliente }}</h4>
                            <div class="data-evento">
                                <h5>Data: {{ $linha->data_criacao_depoimento ? $linha->data_criacao_depoimento->format('d/m/Y') : 'Data não disponível' }}</h5>
                                <h5>{{ $linha->titulo_depoimento }}</h5>
                            </div>
                        </div>

                    </article>

                @endforeach
            </div>
        </section>