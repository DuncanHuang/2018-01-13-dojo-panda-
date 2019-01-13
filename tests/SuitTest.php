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

    /**
     * 同花順
     */
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

    /**
     * 同花順
     */
    public function test_StraightFlush78910J()
    {
        $cardSuit = new CardSuit('S7,S8,S9,S10,SJ');

        $expected = [
            'name'    => 'Straight Flush',
            'element' => [11],
        ];
        $actual   = $cardSuit->getResult();
        $this->assertEquals($expected, $actual);
    }

    /**
     * 同花順 10,11,12,13,A
     */
    public function test_StraightFlush10JQKA()
    {
        $cardSuit = new CardSuit('S10,SJ,SQ,SK,SA');

        $expected = [
            'name'    => 'Straight Flush',
            'element' => ['A'],
        ];
        $actual   = $cardSuit->getResult();
        $this->assertEquals($expected, $actual);
    }

}
