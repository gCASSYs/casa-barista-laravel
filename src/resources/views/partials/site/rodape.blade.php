<footer class="rodape">
        <!-- conteudo principal do rodape -->
        <section class="site rodape-grid">
            <div class="coluna-end">
                <h3>Nosso Endereço</h3>
                <address>
                    Av Marechal Tito, 1500<br>
                    São Miguel Paulista
                </address>
                <a href="{{ route ('home')}}">Mapa</a>
            </div>

            <div class="coluna-reserva">
                <div class="box-reserva">
                    <h3>Faça sua Reserva</h3>
                    <div class="linha-box">
                       <hr> 
                        <img src={{ asset ('barista/assets/Grao-Footer.svg') }} alt="Faça sua Reserva">
                        <hr>
                    </div>
                    
                    <ul>
                        <li><span>Segunda - Sexta</span>   <span>09:00 - 00:00</span></li> 
                        <li><span>Sábado</span>   <span>08:00 - 00:00</span></li>
                        <li><span>Domingo</span>   <span>16:00 - 00:00</span></li>
                        <li><span>Feriado</span>   <span>16:00 - 02:00</span></li>
                    </ul> 

                    <a href="{{ route ('home') }}" class="btn"> Reserva</a>  
                </div>

                <div class="box-email">
                    <p>Informe seu email para receber as novidades e promoções da Casa do Barista</p>
                    <form action="{{ route ('home')}}" method="post">
                        <label for="">Inscreva-se</label>
                        <input type="email" name="email" id="email" placeholder="Informe seu email">
                        <button type="submit" aria-label="Enviar">
                            <img src="{{ asset ('barista/assets/arrow.svg')}}" alt="Botão Enviar">
                        </button>
                    </form>
                </div>
            </div>

            <div class="coluna-contato">
                <h3>Contate-nos</h3>
                <a class="link-contato" href="mailto:contato@email.com.br">contato@email.com.br</a>
                <a class="link-contato" href="tel:++5511999999">5511999999</a>

                    <!-- REDES SOCIAIS = ul>li*3>a>img TAB (foi o atalho utilizado para criar os codigos repetidos) -->
                <ul class="redeSocial">
                    <li>
                        <a href="https://www.facebook.com/senacsaomiguelpaulista/?locale=pt_BR" target="_blank">
                            <img src="{{ asset ('barista/assets/facebook-24.png') }}" alt="Logo Facebook - Casa do Barista">
                        </a>
                    </li>
                        
                    <li>
                        <a href="https://www.instagram.com/senacsaomiguelpaulista/" target="_blank">
                            <img src="{{ asset ('barista/assets/instagram-24.png') }}" alt="Logo Instagram - Casa do Barista">
                        </a>
                    </li>
                        
                    <li>
                        <a href="https://www.linkedeen.com/senacsaomiguelpaulista/" target="_blank">
                            <img src="{{ asset ('barista/assets/linkedin-24.png') }}" alt="Logo Instagram - Casa do Barista">
                        </a>
                    </li>
                        
                    <li>
                        <a href="https://wa.me/5511999999999" target="_blank">
                            <img src="{{ asset ('barista/assets/whatsapp-24.png') }}" alt="Logo Whatsapp - Casa do Barista">
                        </a>
                    </li>
                </ul>

            </div>
            
        </section>

        <!-- barra final -->
        <div class="barra-final">
            
            <!-- subistituição da data pelo php, para ele mudar o ano automaticamente para o ano atual -->
            <p> © - Criado e Desenvolvido por TIPI06 - Senac SMP</p>
        </div>
    </footer>