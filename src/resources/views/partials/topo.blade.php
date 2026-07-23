<header class="topo" id="topoFixo">
        <div class="site">
            <!-- LOGO -->
            <h1>Casa do Barista</h1>

            <button class= "abrir-menu"></button>
            <nav class="menu">
                <button class= "fechar-menu"></button>
            
                <ul>
                    <li><a class="menu-ativo" href="{{ route ('home') }}">Home</a></li>
                    <li><a class="menu-ativo" href="{{ route ('sobre') }}">Sobre</a></li>
                    <li><a class="menu-ativo" href="{{ route ('cardapio') }}">Cardápio</a></li>
                    <li><a class="menu-ativo" href="{{ route ('eventos') }}">Eventos</a></li>
                    <li><a class="menu-ativo" href="{{ route ('contato') }}">Contato</a></li>
                </ul>

                <a href="#" class="login">
                    <img src="{{ asset ('barista/assets/login.png') }}" alt="Login Casa do Barista">
                </a>

                 <ul class="redeSocial">
                    <li><a href="https://www.facebook.com/senacsaomiguelpaulista/?locale=pt_BR" target="_blank"><img src="{{ asset ('barista/assets/facebook-24.png') }}" alt="Logo Facebook - Casa do Barista"></a></li>
                    <li><a href="https://www.instagram.com/senacsaomiguelpaulista/" target="_blank"><img src="{{ asset ('barista/assets/instagram-24.png') }}" alt="Logo Instagram - Casa do Barista"></a></li>
                    <li><a href="https://wa.me/5511999999999" target="_blank"><img src="{{ asset ('barista/assets/whatsapp-24.png') }}" alt="Logo Whatsapp - Casa do Barista"></a></li>
                </ul>
            </nav>
            
            <!-- REDES SOCIAIS = ul>li*3>a>img TAB (foi o atalho utilizado para criar os codigos repetidos) -->
           

            <!-- Botão de Login -->
            
         </div>
    </header>