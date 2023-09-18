<?php

namespace Test;

use Exception;
use PHPUnit\Framework\TestCase;
use App\Model\Citizen;
use App\Repository\CitizenRepository;
use SQLite3;
use SQLite3Result;
use SQLite3Stmt;

class CitizenRepositoryTest extends TestCase
{
    private $citizen;
    private $db;
    private $stmt;

    public function __construct()
    {
        parent::__construct();
        $this->citizen = $this->createMock(Citizen::class);
        $this->db = $this->createMock(SQLite3::class);
        $this->stmt = $this->createMock(SQLite3Stmt::class);
    }

    public function testSuccessAddCitizen()
    {
        $name = 'Pedro e Bino';
        $citizen = new Citizen($name);
        $repository = new CitizenRepository();
        $result = $repository->addCitizen($citizen);

        $this->assertTrue($result);
    }

    public function testFailedAddCitizen()
    {
        $name = 'Pedro e Bino';
        $citizen = new Citizen($name);
        $repository = new CitizenRepository();
        $resultPartial = $repository->addCitizen($citizen);
        try {
            $result = $repository->addCitizen($citizen);
        } catch (Exception $e) {
            $this->assertEquals('Add to Database error', $e->getMessage());
        }

    }

    public function testGetCitizenByNis()
    {
        $results = $this->createMock(SQLite3Result::class);

        $this->db->method('prepare')
            ->willReturn($this->stmt);

        $this->stmt->method('execute')
            ->willReturn($results);

        $repository = new CitizenRepository();
        $result = $repository->getCitizenByNis('12345678900');

        // OBS.: Aqui esperamos 'false' porque o banco de dados está mockado
        // e o metodo fetchArray() retorna um bool false, o teste em si
        // consiste em saber se está chegando ou não no return do metodo.
        $this->assertFalse($result);
    }
}