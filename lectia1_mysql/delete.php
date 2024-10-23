<?php
require_once './bootstrap.php';
$elevRepository = new ElevRepository($databaseConnection);
$elevi = $elevRepository->readElevi();

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    // Adăugăm confirmare înainte de ștergere
    if (isset($_POST['confirm'])) {
        $elevRepository->deleteElev($id);
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Șterge Elev</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Șterge Elev</h2>
        <?php if (isset($id)): ?>
            <div class="alert alert-warning">
                <p>Sunteți sigur că doriți să ștergeți elevul cu ID-ul <?php echo $id; ?>?</p>
                <form method="POST">
                    <button type="submit" name="confirm" class="btn btn-danger">Confirmă Ștergerea</button>
                    <a href="index.php" class="btn btn-secondary">Anulează</a>
                </form>
            </div>
        <?php else: ?>
            <p>Niciun elev selectat pentru ștergere.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
