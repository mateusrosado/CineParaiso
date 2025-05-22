<!DOCTYPE html>
<html>
<head>
    <title>Cancelar Ingresso - <?= htmlspecialchars($filmes[$filme_id-1]->titulo) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body id="cancelar">
    <header>
        <h2><a href="index.php">CineParaiso</a></h2>
    </header>
    <main>
        <div class="container">
            <aside>
                <img src="<?= htmlspecialchars($filmes[$filme_id-1]->capaUrl) ?>" alt="Capa <?= htmlspecialchars($filmes[$filme_id-1]->titulo) ?>">
                <h1><?= htmlspecialchars($filmes[$filme_id-1]->titulo) ?></h1>
                <p><?= htmlspecialchars($filmes[$filme_id-1]->horario) ?></p>
                <p class="descricao"><?= htmlspecialchars($filmes[$filme_id-1]->descricao) ?></p>
            </aside>
            <div class="principal">
                <h2>Cancelar Ingresso</h2>

                <?php if (isset($msg)) echo "<p>" . htmlspecialchars($msg) . "</p>"; ?>

                <form method="POST" onsubmit="return validarFormulario()">
                    <div class="input-group">
                        <input type="text" name="nome" autocomplete="off" class="input cancelar" required>
                        <label class="user-label">Nome</label>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" autocomplete="off" class="input cancelar" required>
                        <label class="user-label">Email</label>
                    </div>

                    <button type="submit" class="cancelar">Cancelar</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        function validarFormulario() {
            const nome = document.querySelector('input[name="nome"]').value.trim();
            const email = document.querySelector('input[name="email"]').value.trim();
            if (nome.length < 3) {
                alert('Nome deve ter pelo menos 3 caracteres.');
                return false;
            }
            if (!email.includes('@') || !email.includes('.')) {
                alert('Email inválido.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
