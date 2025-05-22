<!DOCTYPE html>
<html>
<head>
    <title>CineParaiso</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body id="home">
    <header>
        <h1><a href="#">CineParaiso</a></h1>
    </header>
    <main>
        <div class="container">
            <h2>Filmes em Cartaz</h2>
            <div class="filmes">
                <?php foreach ($filmes as $filme): ?>
                    <article>
                        <a href="index.php?controller=Reserva&action=reservar&filme_id=<?= $filme->id ?>">
                        <img src="<?= htmlspecialchars($filme->capaUrl) ?>" alt="Capa <?= htmlspecialchars($filme->titulo) ?>">
                        <h3><?= htmlspecialchars($filme->titulo) ?></h3>
                        <p><?= htmlspecialchars($filme->horario) ?></p>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</body>
</html>
