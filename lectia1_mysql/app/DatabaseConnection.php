<?php

class DatabaseConnection implements DatabaseConnectionInterface
{
    private $dsn;
    private $username;
    private $password;
    private $pdo;

    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->pdo = $this->connect();
    }

    public function connect()
    {
        try {
            $pdo = new PDO($this->dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die('Conexiunea la baza de date a eșuat: ' . $e->getMessage());
        }
    }

    // Create (C) - Adaugă un nou elev
    public function createElev($nume, $prenume, $clasa, $data_nasterii, $nr_telefon, $email)
    {
        $sql = "INSERT INTO elevi (nume, prenume, clasa, data_nasterii, nr_telefon, email, created_at) 
                VALUES (:nume, :prenume, :clasa, :data_nasterii, :nr_telefon, :email, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nume', $nume);
        $stmt->bindParam(':prenume', $prenume);
        $stmt->bindParam(':clasa', $clasa);
        $stmt->bindParam(':data_nasterii', $data_nasterii);
        $stmt->bindParam(':nr_telefon', $nr_telefon);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    // Read (R) - Obține lista de elevi sau caută după nume/clasă
    public function getElevi($nume = '', $clasa = '')
    {
        $sql = "SELECT * FROM elevi WHERE 1=1";
        
        if (!empty($nume)) {
            $sql .= " AND nume LIKE :nume";
        }

        if (!empty($clasa)) {
            $sql .= " AND clasa = :clasa";
        }

        $stmt = $this->pdo->prepare($sql);
        
        if (!empty($nume)) {
            $stmt->bindValue(':nume', '%' . $nume . '%');
        }

        if (!empty($clasa)) {
            $stmt->bindValue(':clasa', $clasa);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update (U) - Actualizează informațiile unui elev
    public function updateElev($id, $nume, $prenume, $clasa, $data_nasterii, $nr_telefon, $email)
    {
        $sql = "UPDATE elevi 
                SET nume = :nume, prenume = :prenume, clasa = :clasa, data_nasterii = :data_nasterii, 
                    nr_telefon = :nr_telefon, email = :email, updated_at = NOW() 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nume', $nume);
        $stmt->bindParam(':prenume', $prenume);
        $stmt->bindParam(':clasa', $clasa);
        $stmt->bindParam(':data_nasterii', $data_nasterii);
        $stmt->bindParam(':nr_telefon', $nr_telefon);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    // Delete (D) - Șterge un elev cu confirmare
    public function deleteElev($id)
    {
        // În realitate, ar trebui să implementezi o confirmare înainte de ștergere în interfață
        $sql = "DELETE FROM elevi WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
