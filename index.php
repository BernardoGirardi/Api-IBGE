<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Estados e Cidades</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Gerenciamento de Estados e Cidades</h1>
    </header>

    <main>
        <section>
            <h2>Estados</h2>
            <form action="criar_estados.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="nome" placeholder="Nome do Estado" required>
                <input type="text" name="sigla" placeholder="Sigla" maxlength="2" required>
                <input type="file" name="imagem" required>
                <button type="submit" class="btn btn-add">Adicionar Estado</button>
            </form>
            <div class="actions">
                <a href="listar_estados.php" class="btn btn-view">Ver Estados</a>
                <a href="./inserir_estados.php" class="btn btn-edit">Editar Estados</a>
                <a href="./excluir_estados.php" class="btn btn-delete">Excluir Estados</a>
            </div>
        </section>

        <section>
            <h2>Cidades</h2>
            <form action="criar_cidades.php" method="POST">
                <input type="text" name="nome" placeholder="Nome da Cidade" required>
                <input type="number" name="id_estado" placeholder="ID do Estado" required>
                <button type="submit" class="btn btn-add">Adicionar Cidade</button>
            </form>
            <div class="actions">
                <a href="listar_cidades.php" class="btn btn-view">Ver Cidades</a>
                <a href="inserir_cidades.php" class="btn btn-edit">Editar Cidades</a>
                <a href="excluir_cidades.php" class="btn btn-delete">Excluir Cidades</a>
            </div>
        </section>

        <section>
            <h2>Banco de Dados</h2>
            <button id="btn-limpar" class="btn btn-delete">Limpar Banco de Dados</button>
        </section>

        <section>
            <h2>Logs</h2>
            <button id="btn-exibir-logs" class="btn btn-view">Exibir Logs</button>
            <div id="log-content" class="log-content">
            </div>
        </section>
    </main>

    <div id="popup" class="popup">
        <div class="popup-content">
            <p>Você tem certeza de que deseja limpar o banco de dados?</p>
            <form id="form-limpar" method="POST">
                <input type="hidden" name="confirm" value="yes">
                <button type="submit" class="btn btn-yes popup-button">Sim</button>
                <button type="button" id="btn-cancel" class="btn btn-no popup-button">Não</button>
            </form>
        </div>
    </div>

    <div id="popup-success" class="popup">
        <div class="popup-success-content">
            <p>Banco de dados limpo com sucesso!</p>
            <button id="btn-close-success" class="btn popup-button">Fechar</button>
        </div>
    </div>

    <script>
        document.getElementById('btn-limpar').onclick = function() {
            document.getElementById('popup').style.display = 'block';
        }

        document.getElementById('btn-cancel').onclick = function() {
            document.getElementById('popup').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('popup')) {
                document.getElementById('popup').style.display = 'none';
            }
            if (event.target == document.getElementById('popup-success')) {
                document.getElementById('popup-success').style.display = 'none';
            }
        }

        document.getElementById('btn-close-success').onclick = function() {
            document.getElementById('popup-success').style.display = 'none';
        }

        document.getElementById('form-limpar').onsubmit = function(event) {
            event.preventDefault(); 
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'limpar_db.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById('popup').style.display = 'none';
                        document.getElementById('popup-success').style.display = 'block';
                    } else {
                        alert(response.message);
                    }
                }
            };
            var data = new FormData(document.getElementById('form-limpar'));
            var params = new URLSearchParams(data).toString();
            xhr.send(params);
        };

        document.getElementById('btn-exibir-logs').onclick = function() {
            var logContent = document.getElementById('log-content');
            if (logContent.style.display === 'block') {
                logContent.style.display = 'none';
            } else {
                logContent.style.display = 'block';
                logContent.style.display = 'block';
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'exibir_logs.php', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        logContent.innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            }
        }
    </script>
</body>
</html>
