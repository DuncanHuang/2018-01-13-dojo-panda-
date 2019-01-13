<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-13
 * Time: 11:26z
 */

namespace Tests;

use App\CardSuit;
use PHPUnit\Framework\TestCase;

class SuitTest extends TestCase
{
    public function test_StraightFlush()
    {
        $cardSuit = new CardSuit('S5,S6,S4,S7,S8');

        $expected = [
            'name'    => 'Straight Flush',
            'element' => [8],
        ];
        $actual   = $cardSuit->getResult();
        $this->assertEquals($expected, $actual);
    }
}