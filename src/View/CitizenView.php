<?php

namespace App\View;

use App\Model\Citizen;

class CitizenView
{
    public function displaySuccessMessage(Citizen $citizen)
    {
        return json_encode([
            'message' => 'Cidadao cadastrado com sucesso!',
            'nis' => (string) $citizen->getNis()
        ]);
    }

    public function displayCitizen($citizen)
    {
        if (array_key_exists('name', $citizen) && array_key_exists('nis', $citizen)) {
            return json_encode([
                'name' => $citizen['name'],
                'nis' => $citizen['nis'],
            ]);
        } else {
            return json_encode(['message' => 'Cidadao nao encontrado.']);
        }
    }

    public function displayNisVerification($validNis)
    {
        if ($validNis) {
            return json_encode(['message' => 'NIS valido.']);
        } else {
            return json_encode(['message' => 'NIS invalido.']);
        }
    }
}
