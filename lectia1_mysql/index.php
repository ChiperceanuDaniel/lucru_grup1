<?php
    session_start();
    require_once './bootstrap.php';
    $elevRepository = new ElevRepository($databaseConnection);
    $elevi = $elevRepository->readElevi();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Elevi Management</title>
</head>

<body>
<div class="container mt-5">
        <h2>Adaugă Elev</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nume" class="form-label">Nume</label>
                <input type="text" class="form-control" id="nume" name="nume" required>
            </div>
            <div class="mb-3">
                <label for="prenume" class="form-label">Prenume</label>
                <input type="text" class="form-control" id="prenume" name="prenume" required>
            </div>
            <div class="mb-3">
                <label for="clasa" class="form-label">Clasă</label>
                <input type="text" class="form-control" id="clasa" name="clasa" required>
            </div>
            <div class="mb-3">
                <label for="data_nasterii" class="form-label">Data Nașterii</label>
                <input type="date" class="form-control" id="data_nasterii" name="data_nasterii" required>
            </div>
            <div class="mb-3">
                <label for="nr_telefon" class="form-label">Număr de Telefon</label>
                <input type="text" class="form-control" id="nr_telefon" name="nr_telefon" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Adaugă Elev</button>
        </form>
    </div>
    
    <div class="container mt-5">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>
        
        <h2 class="mb-4">Lista Elevilor</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nume</th>
                    <th>Prenume</th>
                    <th>Clasă</th>
                    <th>Data Nașterii</th>
                    <th>Număr de Telefon</th>
                    <th>Email</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($elevi as $elev): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($elev['id']); ?></td>
                        <td><?php echo htmlspecialchars($elev['nume']); ?></td>
                        <td><?php echo htmlspecialchars($elev['prenume']); ?></td>
                        <td><?php echo htmlspecialchars($elev['clasa']); ?></td>
                        <td><?php echo htmlspecialchars($elev['data_nasterii']); ?></td>
                        <td><?php echo htmlspecialchars($elev['nr_telefon']); ?></td>
                        <td><?php echo htmlspecialchars($elev['email']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $elev['id']; ?>"
                                class="btn btn-warning btn-sm">Actualizează</a>
                            <a href="delete.php?id=<?php echo $elev['id']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Ești sigur că vrei să ștergi acest elev?');">Șterge</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// create_elev.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $clasa = $_POST['clasa'];
    $data_nasterii = $_POST['data_nasterii'];
    $nr_telefon = $_POST['nr_telefon'];
    $email = $_POST['email'];
    $elevRepository->createElev($nume, $prenume, $clasa, $data_nasterii, $nr_telefon, $email);
    header('Location: index.php');
    exit;
}
?>
