<?php
interface ElevRepositoryInterface
{
    public function createElev($nume, $prenume, $clasa, $data_nasterii, $nr_telefon, $email);
    public function readElevi();
    public function updateElev($id, $nume, $prenume, $clasa, $data_nasterii, $nr_telefon, $email);
    public function deleteElev($id);
}
