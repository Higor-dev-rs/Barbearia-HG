<?php
include_once 'config/conexao.php';

// Verificando se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $servico = $_POST['servico'];
    $data = str_replace('T', ' ', $_POST['data']);

    if (!empty($nome) && !empty($data) && !empty($servico)) {

        try {
            // Prepara o SQL para inserção (usando Prepared Statements para segurança)
            $sql = "INSERT INTO agendamentos (nome, email, telefone, servico, data_agendamento) VALUES (:nome, :email, :telefone, :servico, :data_agendamento)";
            $stmt = $pdo->prepare($sql);

            // Vincula os valores com segurança com bind param e placeholder's
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':servico', $servico);
            $stmt->bindParam(':data_agendamento', $data);

            if ($stmt->execute()) {
                
                header("Location: index.php?sucesso=1");
                exit();
            }
        } catch (PDOException $e) {
            echo "Erro ao agendar: " . $e->getMessage();
        }
    
    } else {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/img/favicon-hg.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Barbearia HG</title>
</head>
<body>
<?php
    if (isset($_GET['sucesso'])) {
        echo "<script>alert('Agendamento realizado com sucesso!');</script>";
    }
?>
    <header class="logo-barber">
        <img src="assets/img/logo.barber.png" alt="Logo Barbearia HG" class="logo-hg">

        <nav class="link_header"> 
            <ul>
                <li><a href="#sobre">Sobre</a></li>
                <li><a href="#servicos">Serviços</a></li>
                <li><a href="#barbeiros">Barbeiros</a></li>
                <li><a href="#contato">Contato</a></li>
            </ul>
        </nav>

    </header>

    <main class="container-conteudo">
        <figure class="banner">
            <img src="assets/img/banner-barber.jpg" alt="imagem da barbearia" class="img-banner">
        </figure>

        <section class="sobre" id="sobre">
            <h1>Conheça a melhor barbearia da região</h1>
            <h2 class="subtitulo-destaque">Venha ficar com seu visual impecável</h2>

            <img src="assets/img/img.barber.checkpoint.jpg" alt="imagem interna da barbearia" class="img-sobre">

            <p class="texto-sobre">
                Bem-vindo à <span class="texto-cor">Barbearia HG</span>, onde a tradição se encontra com o estilo moderno. Com anos de experiência e paixão pela arte de barbear, oferecemos um serviço de <span class="texto-cor">alta qualidade</span> em um ambiente relaxante e confortável.
            
                Nossa missão é mais do que apenas um corte de cabelo ou barba; é proporcionar uma experiência única, onde você pode relaxar, se reconectar com o visual clássico e sair se sentindo renovado. Venha nos visitar e descubra o que faz da <span class="texto-cor">Barbearia HG</span> o seu novo destino de estilo.
            </p>
        </section>

        <section class="servicos" id="servicos">
            <h2 class="subtitulo">Nossos Serviços</h2>
            <p class="texto-sobre">
            Na <span class="texto-cor">Barbearia HG</span>, cada detalhe é pensado para oferecer a você uma experiência completa. Nossos especialistas combinam técnicas clássicas e modernas, garantindo um resultado impecável que reflete seu estilo e personalidade.

            Mais do que serviços, nós proporcionamos um ritual de cuidado, relaxamento e transformação. Descubra a seguir o que temos a oferecer e agende seu momento.</p>

            <ul id="lista-servicos">
                <li>Corte Clássico</li> 

                <li>Corte na Tesoura</li>

                <li>Corte e Barba</li>

                <li>Barba Terapêutica com Toalha Quente</li>

                <li>Design de Barba</li>

                <li>Hidratação Capilar</li>
            </ul>
        </section>

        <section class="barbeiros" id="barbeiros">
            <h2 class="subtitulo">Barbeiros</h2>
            <img src="assets/img/barbeiros.jpg" alt="barbeiros" class="img-barbeiros">
            
            
            <p class="texto-sobre">Na <span class="texto-cor">Barbearia HG</span>, o coração do nosso trabalho são os profissionais que fazem a magia acontecer. Nossa equipe de barbeiros é formada por verdadeiros apaixonados pela arte, dedicados a aprimorar suas habilidades a cada dia.

            Com anos de experiência e um olhar atento às últimas tendências, eles dominam tanto as técnicas clássicas de barbear quanto os cortes mais modernos e elaborados. Mas mais do que a técnica, o que nos move é o cuidado com cada cliente.

            Nossos barbeiros não apenas cortam cabelo ou fazem barba; eles criam um ambiente de confiança e amizade, transformando cada visita em um ritual único e memorável. <a href="mailto:barbeariahg@gmail.com" class="link">Clique Aqui</a> e venha conhecer a equipe que está pronta para cuidar do seu estilo.
            </p>
        </section>

        <section class="contato" id="contato">
            <h2 class="subtitulo">Contato</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4340.703404441696!2d-43.32292452613496!3d-22.82235597126697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x997b462bb5da1f%3A0xb81bcd94a6543688!2sAv.%20Ayrton%20Senna%2C%203000%20-%20Barra%20da%20Tijuca%2C%20Rio%20de%20Janeiro%20-%20RJ%2C%2022775-003!5e1!3m2!1spt-BR!2sbr!4v1758071777539!5m2!1spt-BR!2sbr" width="700" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

            <section class="formulario-contato">
                <h3>Preencha com seus dados, data e horário que deseja agendar seu atendimento</h3>
                <form class="formulario" method="POST" action="index.php">

                    <div class="input">
                        <label for="nome">Preencha seu nome:</label>
                        <input type="text" name="nome" id="nome" placeholder="Nome" required>
                    </div>

                    <div class="input">
                        <label for="email">Preencha seu e-mail:</label>
                        <input type="email" name="email" id="email" placeholder="Email" required>
                    </div>

                    <div class="input">
                        <label for="tel">Digite seu número:</label>
                        <input type="tel" name="telefone" id="tel" placeholder="Telefone" required>
                    </div>

                    <div class="input">
                        <label for="date">Escolha sua data e hora:</label>
                        <input type="datetime-local" name="data" id="date" required>
                    </div>

                    <div class="input">
                        <label for="servico">Escolha o serviço:</label>
                        <select name="servico" id="servico" required>
                            <option value="" disabled selected>Selecione um Serviço</option>
                            <option value="Corte Clássico">Corte Clássico</option>
                            <option value="Corte na Tesoura">Corte na Tesoura</option>
                            <option value="Corte e Barba">Corte e Barba</option>
                            <option value="Barba Terapeutica">Barba Terapêutica</option>
                            <option value="Design de Barba">Design de Barba</option>
                            <option value="hidratacao">Hidratação Capilar</option>
                        </select>
                    </div>

                    <button type="submit" id="btn-agendar">Agendar</button>
                    <div id="feedback-msg"></div>
                </form>
            </section>
        </section>    
    </main>

    <footer class="rodape">
        
        <address>
            Endereço: Rua Exemplo, 123 - Centro, Cidade, Estado<br>
            Telefone: <a href="tel:22912345678">(22) 91234-5678</a><br>
            Email: <a href="mailto:barbeariahg@gmail.com">barbeariahg@gmail.com</a>
        </address>

        <p>© 2025 Barbearia HG. Todos os direitos reservados.</p>
        <p>Desenvolvido por <span class="texto-cor">Higor Rodrigues</span></p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>

