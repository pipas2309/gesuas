<?php

namespace Test;

use App\Util\NisUtil;
use PHPUnit\Framework\TestCase;

class NisUtilTest extends TestCase
{
    public function testGenerateNis()
    {
        $nis = NisUtil::generateNis();
        $this->assertEquals(11, strlen((string)$nis));
    }

    public function testValidateTrueNis()
    {
        $nis = NisUtil::generateNis();
        $this->assertTrue(NisUtil::validateNis((string)$nis));
    }

    public function testValidateFalseNis_CaseLength()
    {
        $nis = NisUtil::generateNis();
        $nis = substr($nis, 0, -1);
        $this->assertFalse(NisUtil::validateNis((string)$nis));
    }

    public function testValidateFalseNis_CaseAlphaDigit()
    {
        $nis = NisUtil::generateNis();
        $nis = substr($nis, 0, -2) . 'MN';
        $this->assertFalse(NisUtil::validateNis($nis));
    }

    public function testValidateFalseNis_CaseCheckDigit()
    {
        $nis = NisUtil::generateNis();
        $digit = substr($nis, -1);
        if($digit <= 4) {
            $digit += 4;
        } else {
            $digit -= 4;
        }
        $nis = substr($nis, 0, -1) . $digit;
        $this->assertFalse(NisUtil::validateNis($nis));
    }
}
