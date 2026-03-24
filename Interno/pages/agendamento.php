<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Agenda VET - Pet Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/agendaVT.css">
    <script src="../js/agendaVT.js" defer></script> 
</head>

<body> 
    <header class="cabecario">
        <h1>ZOOKAAAAAAAAAAA</h1>
    </header>

    <div class="container">
        <div class="esquerda">
            <nav class="fixou">
                </nav>
        </div>

        <div class="direita">

            <div class="parte-de-cima">
                <div class="grupo-filtros">
                    
                    <div class="campo">
                        <label>Profissional</label>
                        <select id="selectProfissional">
                            <option>Elen</option>
                            <option>Henrique</option>
                            <option>Vitória</option>
                            <option>Allan</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label>Serviço</label>
                        <select id="selectServico">
                            <option>Banho</option>
                            <option>Tosa</option>
                            <option>Vacina</option>
                            <option>Consulta</option>
                            <option>Emergência</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label>Detalhes do Pet</label>
                        <button type="button" id="btn-abrir-obs" class="btn-obs-form">📝 Ficha do Animal</button>
                    </div>
                    
                    <div class="semanas">
                        <label>Ver por</label>
                        <div class="dias-semanas">
                            <button class="btn-toggle active">Dia</button>
                            <button class="btn-toggle">Semana</button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="agenda-container">
                <div class="agenda-header">
                    <div class="hora-vazia"></div>
                    <div class="dia-col hoje"><span class="nome-dia">SEG</span><strong class="num-dia">23</strong></div>
                    <div class="dia-col"><span class="nome-dia">TER</span><strong class="num-dia">24</strong></div>
                    <div class="dia-col"><span class="nome-dia">QUA</span><strong class="num-dia">25</strong></div>
                    <div class="dia-col"><span class="nome-dia">QUI</span><strong class="num-dia">26</strong></div>
                    <div class="dia-col"><span class="nome-dia">SEX</span><strong class="num-dia">27</strong></div>
                    <div class="dia-col"><span class="nome-dia">SAB</span><strong class="num-dia">28</strong></div>
                </div>

                <div class="agenda-corpo">
                    <div class="coluna-horas">
                        <span>08:00</span><span>09:00</span><span>10:00</span>
                        <span>11:00</span><span>12:00</span><span>13:00</span>
                        <span>14:00</span><span>15:00</span><span>16:00</span>
                        <span>17:00</span><span>18:00</span><span>19:00</span>
                        <span>20:00</span>
                    </div>
                    <div class="grade-slots" id="grade-principal">
                        <div class="slot-hora"></div><div class="slot-hora"></div><div class="slot-hora"></div><div class="slot-hora"></div><div class="slot-hora"></div><div class="slot-hora"></div>
                        <div class="slot-hora"></div><div class="slot-hora"></div><div class="slot-hora"></div><div class="slot-hora"></div><div class="slot-hora"></div><div class="slot-hora"></div>
                        <div class="slot-hora"></div><div class="slot-hora"></div><div class="slot-hora"></div><div class="slot-hora"></div><div class="slot-hora"></div><div class="slot-hora"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Nome da ficha médica  -->
    <div id="modalObs" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Ficha Clínica do Pet</h2>
                <span class="close">&times;</span>
            </div>

            <!-- Nome do animal -->
            <form id="formAnimal">
                <div class="form-row">
                    <div class="campo-modal">
                        <label>Nome do Animal</label>
                        <input type="text" placeholder="Ex: Mel, Rex...">
                    </div>

                    <!-- Raça do animal -->
                    <div class="campo-modal">
                        <label>Raça/Espécie</label>
                        <input type="text" placeholder="Ex: Poodle, Persa...">
                    </div>
                </div>

                <!-- Idade  do animal -->

                <div class="form-row">
                    <div class="campo-modal">
                        <label>Idade (aprox)</label>
                        <input type="text" placeholder="Ex: 3 anos">
                    </div>
                </div>

                <!-- Peso -->
                <div class="form-row">
                    <div class="campo-modal">
                        <label>Peso</label>
                        <input type="text" placeholder="Ex: 8kg">
                    </div>
                </div>

                <!-- <input type="number" id="idade" name="idade" min="0" max="100"> -->


                <!-- ID Cliente nesse caso vai puxar pelo cpf -->
                 <form id="formCpf"></form>
                <div class="form-row">
                    <div class="campo-modal">
                        <label>CPF Cliente</label>
                        
                        <input type="text" inputmode="numeric" pattern="[0-9]*" placeholder="Ex:111.222.333-44">

                    </div>
                </div>

                <!-- Campo de OBS -->

                <div class="campo-modal">
                    <label>Alergias ou Cuidados Especiais</label>
                    <textarea rows="3" placeholder="Ex: Reação a tal shampoo, cardiopata, bravo..."></textarea>
                </div>

                <!-- Botão de salvar -->
                <div class="modal-footer">
                    <button type="button" id="btnSalvarObs" class="btn-salvar">Salvar Dados</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>