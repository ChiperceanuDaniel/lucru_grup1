<?php

class ElevRepository implements ElevRepositoryInterface
{
    private $pdo;

    public function __construct(DatabaseConnectionInterface $databaseConnection)
    {
        $this->pdo = $databaseConnection->connect();
    }

    // Creare elev
    public function createElev($nume, $prenume, $clasa, $data_nasterii, $nr_telefon, $email)
    {
        $sql = 'INSERT INTO elevi (nume, prenume, clasa, data_nasterii, nr_telefon, email, created_at) 
                VALUES (:nume, :prenume, :clasa, :data_nasterii, :nr_telefon, :email, NOW())';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nume' => $nume,
            ':prenume' => $prenume,
            ':clasa' => $clasa,
            ':data_nasterii' => $data_nasterii,
            ':nr_telefon' => $nr_telefon,
            ':email' => $email
        ]);
        $_SESSION['message'] = "Elevul a fost adăugat cu succes!";
    }

    // Citire elevi
    public function readElevi()
    {
        $sql = 'SELECT * FROM elevi';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Citire elev dupa ID
    public function getById($id)
    {
        $sql = 'SELECT * FROM elevi WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Actualizare elev
    public function updateElev($id, $nume, $prenume, $clasa, $data_nasterii, $nr_telefon, $email)
    {
        $sql = 'UPDATE elevi 
                SET nume = :nume, prenume = :prenume, clasa = :clasa, data_nasterii = :data_nasterii, 
                    nr_telefon = :nr_telefon, email = :email, updated_at = NOW() 
                WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':nume' => $nume,
            ':prenume' => $prenume,
            ':clasa' => $clasa,
            ':data_nasterii' => $data_nasterii,
            ':nr_telefon' => $nr_telefon,
            ':email' => $email
        ]);
        $_SESSION['message'] = "Elevul a fost actualizat cu succes!";
    }

    // Ștergere elev
    public function deleteElev($id)
    {
        $sql = 'DELETE FROM elevi WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $_SESSION['message'] = "Elevul a fost șters cu succes!";
    }
}
