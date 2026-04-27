  <link rel="stylesheet" href="css/carrinho.css">
   <script src="js/carrinho.js" defer></script>

<main class="checkout-container">
    <div class="checkout-content">
       
        <section class="payment-methods">
            <h1 class="page-title">Pagamento</h1>
           
            
 
            <div class="card-white">
                <h3>Formas de pagamento</h3>
                <ul class="payment-list">
                    <li class="active"><span>💳 Cartão de crédito</span> <i class="arrow">›</i></li>
                    <li><span>pix <small class="tag-green">Aprovação imediata</small></span> <i class="arrow">›</i></li>
                    <li><span>Boleto</span> <i class="arrow">›</i></li>
                </ul>
 
                <div class="card-form">
                    <div class="input-group">
                        <label>Número do cartão</label>
                        <input type="text" placeholder="0000 0000 0000 0000">
                    </div>
                    <div class="input-group">
                        <label>Nome do titular</label>
                        <input type="text" placeholder="Como está no cartão">
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label>Validade</label>
                            <input type="text" placeholder="MM/AA">
                        </div>
                        <div class="input-group">
                            <label>CVV</label>
                            <input type="text" placeholder="000">
                        </div>
                    </div>
                </div>
            </div>
        </section>
 
        <aside class="checkout-sidebar">
            <div class="card-white address-box">
                <div class="address-header">
                    <span>🚚 Prazo de entrega: <strong>Até 27/04/2026</strong></span>
                </div>
                <div class="address-details">
                    <p><strong>minha casa</strong></p>
                    <p class="small-text">Avenida Três, 417 - Guarulhos/SP</p>
                    <button class="blue-link btn-clear" onclick="openAddressModal()">Alterar forma de entrega ou endereço</button>
                </div>
                <div id="modalContainer" class="modal-overlay">
  <div class="modal-content">
    <span id="fecharModal" class="close-btn">&times;</span>
    <h2>Olá! Eu sou um Modal</h2>
    <p>Este é um exemplo simples de janela sobreposta.</p>
  </div>
</div>
            </div>
 
            <div class="card-white summary-box">
                
               
                <button class="btn-pay">Pagar agora</button>
            </div>
        </aside>
    </div>
</main>
 
<div id="modal-endereco" class="modal-overlay-address">
    <div class="modal-card-address">
        <button class="close-modal" onclick="closeAddressModal()">&times;</button>
        <h2>Cadastrar novo endereço</h2>
        <div class="address-form">
            <input type="text" placeholder="CEP (00000-000)">
            <input type="text" placeholder="Rua / Logradouro">
            <div class="row">
                <input type="text" placeholder="Número">
                <input type="text" placeholder="Complemento">
            </div>
            <input type="text" placeholder="Bairro">
            <button class="btn-primary-modal" onclick="closeAddressModal()">Salvar Endereço</button>
        </div>
    </div>
</div>