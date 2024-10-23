<?php
// Include interfețele și clasele necesare
require_once "./app/DatabaseConnectionInterface.php";
require_once "./app/ElevRepositoryInterface.php";
require_once "./app/DatabaseConnection.php";
require_once "./app/ElevRepository.php";

// Încarcă configurația pentru conexiunea la baza de date
$config = require_once './config.php';

// Asigură-te că configurația este validă
if (!isset($config['dsn'], $config['username'], $config['password'])) {
    die('Configurația bazei de date nu este validă.');
}

// Extrage valorile din configurație
[$dsn, $username, $password] = $config;

// Creează o instanță a conexiunii la baza de date
$databaseConnection = new DatabaseConnection($dsn, $username, $password);

// Creează un repository pentru elevi
$elevRepository = new ElevRepository($databaseConnection);

// Aici poți adăuga logica pentru a folosi $elevRepository, cum ar fi crearea, actualizarea, citirea sau ștergerea elevilor
// Exemplu: $elevRepository->createElev('Ion', 'Popescu', '10A', '2005-06-15', '0712345678', 'ion.popescu@example.com');

// ...

