<!DOCTYPE html>
<html>
<head>
    <title>Alterar Ingresso - <?= htmlspecialchars($filmes[$filme_id-1]->titulo) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body id="alterar">
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
                <h2>Alterar Ingresso</h2>
                
                <?php if (isset($msg)) echo "<p>" . htmlspecialchars($msg) . "</p>"; ?>
                <form method="POST" onsubmit="return validarFormulario()">
                    <?php
                        $cadeirasReservadas = [];
                        foreach ($reservas as $r) {
                            $cadeirasReservadas[] = $r['cadeira_id'];
                        }
                    ?>
                    <div class="cadeiras">
                        <?php foreach ($cadeiras as $c):
                            if($c->id%3 == 1):?>
                                <div class="fileira">
                            <?php endif; ?>
                            <div class="assento">
                                <input type="checkbox" name="cadeira_id[]" value="<?= $c->id ?>" <?= in_array($c->id, $cadeirasReservadas) ? 'class="reservado"' : '' ?>/>
                                <svg viewBox="0 0 35.6 35.6">
                                    <circle cx="17.8" cy="17.8" r="17.8"></circle>
                                    <text x="50%" y="50%" text-anchor="middle" dominant-baseline="central"><?= htmlspecialchars($c->codigo) ?></text>
                                </svg>
                            </div>
                            <?php if($c->id%3 == 0):?>
                                </div>
                            <?php endif;
                        endforeach; ?>
                    </div>

                    <div class="input-group">
                        <input type="text" name="nome" autocomplete="off" class="input alterar" required>
                        <label class="user-label">Nome</label>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" autocomplete="off" class="input alterar" required>
                        <label class="user-label">Email</label>
                    </div>

                    <button type="submit" id="btn-reservar" class="alterar" disabled>Reservar</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        function validarFormulario() {
            const nome = document.querySelector('input[name="nome"]').value.trim();
            const email = document.querySelector('input[name="email"]').value.trim();
            const assentos = document.querySelectorAll('input[name="cadeira_id[]"]:not(:disabled)');
            const algumSelecionado = Array.from(assentos).some(cb => cb.checked);

            if (nome.length < 3) {
                alert('Nome deve ter pelo menos 3 caracteres.');
                return false;
            }
            if (!email.includes('@') || !email.includes('.')) {
                alert('Email inválido.');
                return false;
            }
            if (!algumSelecionado) {
                alert('Selecione pelo menos um assento.');
                return false;
            }
            return true;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const checkboxes = document.querySelectorAll('input[name="cadeira_id[]"]:not(:disabled)');
            const botao = document.getElementById('btn-reservar');

            function atualizarBotao() {
                const algumSelecionado = Array.from(checkboxes).some(cb => cb.checked);
                botao.disabled = !algumSelecionado;
            }

            checkboxes.forEach(cb => cb.addEventListener('change', atualizarBotao));

            atualizarBotao();
        });
    </script>
</body>
</html>
