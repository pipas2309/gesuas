<?php

namespace App\Model;

use App\Util\NisUtil;

class Citizen
{
    private string $name;
    private int $nis;

    public function __construct($name)
    {
        $this->name = $name;
        $this->nis = NisUtil::generateNis();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNis(): int
    {
        return $this->nis;
    }
}
