<section class="cardapio wow animate__animated animate__fadeInUp">
            <header class="parallax-padrao">
            
                <h2>CARDÁPIO | {{ $categoriaSelecionada->nome_categoria }}</h2>
                <nav>
                    <ul>
                        @foreach ($listaCategoria as $linha)
                            <li>
                                
                                <a href="{{ route('cardapio', 'id_categoria', $linha->id_categoria) }}">{{ $linha->nome_categoria }}</a>
                            </li>
                        @endforeach
                    
                    </ul>
                </nav>
            </header>

            <div class="site card-cardapio">
                
                @foreach ($produto as $linha)
                    <div class="card-flip">
                        <article class="card-flip-miolo">
                        <div class="flip1">
                            <h4>{{ $linha->nome_produto }}</h4>
                        </div>
                            <div class="flip2">
                                <h4>{{ $linha->nome_produto }} <span>{{ number_format($linha->valor_produto, 2, ',', '.') }}</span></h4>
                                <h5>{{ $linha->descricao_curta_produto }}</h5>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

           
        </section>
