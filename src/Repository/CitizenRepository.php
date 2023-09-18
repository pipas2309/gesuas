<?php

namespace App\Repository;

use App\Model\Citizen;
use App\config\Database;
use Exception;
use SQLite3;

class CitizenRepository
{
    private SQLite3 $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /**
     * @throws Exception
     */
    public function addCitizen(Citizen $citizen): bool
    {
        $nis = $citizen->getNis();
        $name = $citizen->getName();

        try {
            $sql = 'INSERT INTO citizens (nis, name, created_at) VALUES (:nis, :name, :created_at)';

            $stmt = $this->conn->prepare($sql);
            $timeNow = date("d-m-Y H:i:s", time());

            $stmt->bindValue(':nis', $nis);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':created_at', $timeNow);

            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }

        } catch (Exception $exception) {
            if ($exception->getCode() == 23000) {
                throw new Exception("NIS already exist");
            } else {
                throw new Exception("Add to Database error");

            }
        }
    }

    /**
     * @throws Exception
     */
    public function getCitizenByNis($nis)
    {
        try {
            $sql = "SELECT * FROM citizens WHERE nis = ? LIMIT 1";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $nis);
            $result = $stmt->execute();

            if ($result) {
                return $result->fetchArray(SQLITE3_ASSOC);
            } else {
                throw new Exception("NIS not found");
            }
        } catch (Exception $exception) {
            throw new Exception("Get from Database error");
        }
    }
}
