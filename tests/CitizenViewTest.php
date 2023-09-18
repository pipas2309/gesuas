<?php

namespace Test;

use App\Model\Citizen;
use App\View\CitizenView;
use PHPUnit\Framework\TestCase;

class CitizenViewTest extends TestCase
{
    public function testDisplaySuccessMessage()
    {
        $citizen = new Citizen('Test');
        $view = new CitizenView();
        $message = $view->displaySuccessMessage($citizen);
        $this->assertStringContainsString('Cidadao cadastrado com sucesso!', $message);
        $this->assertStringContainsString((string)$citizen->getNis(), $message);

    }

    public function testDisplaySuccessCitizen()
    {
        $citizen = new Citizen('Test');
        $view = new CitizenView();
        $array = [
            'name' => $citizen->getName(),
            'nis' => $citizen->getNis()
        ];
        $message = $view->displayCitizen($array);
        $this->assertStringContainsString($citizen->getName(), $message);
        $this->assertStringContainsString((string)$citizen->getNis(), $message);
    }

    public function testDisplayFailCitizen()
    {
        $citizen = ['name' => "Caju e Castanha"];
        $view = new CitizenView();
        $message = $view->displayCitizen($citizen);
        $this->assertStringContainsString('Cidadao nao encontrado.', $message);
    }

    public function testDisplaySuccessNisVerification()
    {
        $validNis = true;
        $view = new CitizenView();
        $message = $view->displayNisVerification($validNis);
        $this->assertStringContainsString('NIS valido.', $message);
    }

    public function testDisplayFailNisVerification()
    {
        $validNis = false;
        $view = new CitizenView();
        $message = $view->displayNisVerification($validNis);
        $this->assertStringContainsString('NIS invalido.', $message);
    }
}
