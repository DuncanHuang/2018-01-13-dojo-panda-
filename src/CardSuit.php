<?php
/**
 * Created by PhpStorm.
 * User: duncan
 * Date: 2019-01-13
 * Time: 11:26
 */

namespace App;

class CardSuit
{
    private $cardList;

    /**
     * CardSuit constructor.
     *
     * @param string $cardString
     */
    public function __construct($cardString)
    {
        $cardList       = explode(',', $cardString);
        $this->cardList = array_map(function ($card) {
            return $card = [
                $this->getNumber(substr($card, 1)),
                substr($card, 0, 1),
            ];
        }, $cardList);
        $this->suitSort();
        $this->exchangeNumberA();
    }

    public function getResult()
    {
        $result        = [
            'name'    => '',
            'element' => [],
        ];
        $uniqueNumbers = $this->uniqueNumbers();
        $suitType = '';
        if (count($uniqueNumbers) == 5) {
            $suitType = $this->isFlushStraight();
        }
        $result['name'] = $suitType;
        $result['element'] = [$this->getElements($uniqueNumbers)];

        return $result;
    }

    private function suitSort(): void
    {
        usort($this->cardList, function ($a, $b) {
            
            if ($a[0] == $b[0]) {
                return 0;
            }

            return ($a[0] < $b[0]) ? -1 : 1;
        });
    }

    private function uniqueNumbers()
    {
        return array_count_values(array_column($this->cardList, '0'));
    }

    private function isStraight()
    {

        $uniqueT = (($this->cardList[0][0] + $this->cardList[4][0]) * 5) / 2;

        $uniqueSum = 0;
        foreach ($this->cardList as $number) {
            $uniqueSum += $number[0];
        }

        if ($uniqueT == $uniqueSum) {
            return true;
        }

        return false;
    }

    private function isFlush()
    {
        $flush = array_count_values(array_column($this->cardList, '1'));
        if (count($flush) == 1) {
            return true;
        }

        return false;
    }

    private function getNumber($substr)
    {
        $suit = [
            'J' => '11',
            'Q' => '12',
            'K' => '13',
            'A' => '1',
        ];

        if (array_key_exists($substr, $suit)) {
            return $suit[$substr];
        }

        return $substr;
    }

    private function exchangeNumberA()
    {

        if($this->cardList[0][0] == 1 && $this->cardList[4][0] == 13){
            $this->cardList[0][0] = 14;
        }
        $this->suitSort();
    }

    private function getElements($uniqueNumbers)
    {
        $maxNumber = max(array_keys($uniqueNumbers));

        if($maxNumber == 14){
            return 'A';
        }
        return $maxNumber;
    }

    /**
     * @return string
     */
    private function isFlushStraight(): string
    {
        $isStraight = $this->isStraight();
        $isFlush    = $this->isFlush();

        $suitType = '';
        if ($isStraight == true && $isFlush == true) {
            $suitType = 'Straight Flush';
        } else if ($isStraight) {
            $suitType = 'Straight';
        }

        return $suitType;
    }
}
