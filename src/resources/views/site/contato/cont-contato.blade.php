<section class="contato">
            <h2 class="contato-titulo">Casa do Barista</h2>
            
            <div class="site">
                
                <!-- texto -->
                <div class="contato-txt">
                    <p>A Casa do Barista nasceu da vontade de unir pessoas através de algo simples e profundo: o ato de compartilhar uma xícara de café.</p>  
                    <p>Acreditamos no poder das histórias que começam no campo, passam pelo barista e chegam até você em forma de aroma, sabor e sentimento.</p>    
                    <p>Valorizamos pequenos produtores, técnicas artesanais e processos manuais que resgatam o verdadeiro significado do café brasileiro: riqueza cultural, dedicação e tradição.</p>

                    <div>
                        <div>
                            <div>
                                <h3>Nosso Endereço</h3>
                                <h4>Av. Marechal Tito, 1500 <br> São Miguel Paulista</h4>
                            </div>
                            <div>
                                <h3>Nossos E-mails</h3>
                                <a href="mailto:contatoemail@email.com.br">contato@email.com.br</a>
                                <a href="mailto:atendimento@email.com.br">atendimento@email.com.br</a>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h3>Nossos Telefones</h3>
                                <a href="tel:+55(11)999-888-888">(11)999-888-888</a>
                                <a href="tel:+55(11)999-888-888">(11)999-888-888</a>
                            </div>
                            <div>
                                <h3>Siga-nos</h3>
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
                        </div>
                    </div>

                </div>

                <!-- form -->
                <div class="contato-form">
                    <h2 class="form-titulo">Formulario de Contato</h2>
                    <form action="#" method="POST">
                        <div class="contato-form-campo contato-form-campo-full">
                            <input type="text" name="nome" placeholder="Nome Completo" required>
                        </div>
                        <div class="contato-form-campo contato-form-campo-full">
                            <input type="email" name="email" placeholder="E-mail" required>
                        </div>

                        <div class="contato-form-linha">
                            <div class="contato-form-campo">
                                <input type="tel" name="fone" placeholder="Telefone">
                            </div>

                            <div class="contato-form-campo">
                                <select name="assunto">
                                    <option value="" disabled selected hidden>Assunto</option>
                                    <option value="Eventos">Eventos</option>
                                    <option value="Cafe">Café</option>
                                </select>
                            </div>
                        </div>

                        <div class="contato-form-campo contato-form-campo-full">
                            <textarea name="mens" cols="30" rows="10" placeholder="Mensagem" required></textarea>
                        </div>

                        <div class="contato-form-acoes">
                            <button type="submit">Enviar Mensagem</button>
                            <button type="reset">Limpar</button>
                        </div>

                    </form>
                </div>

            </div>
         </section>
        
       