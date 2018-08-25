<?php

namespace App;

class CountSeats
{
    protected $totalSeats;
    protected $result;
    protected $partyVotes = [];
    protected $data = [];

    public function __construct($votes, $seats)
    {
        $this->partyVotes = $votes;
        $this->totalSeats = $seats;
    }

    public function countFraction()
    {
        $sum = 0;
        foreach ($this->partyVotes as $party => $votes) {
            $sum += $votes;
        }

        $firstStep = [];
        foreach ($this->partyVotes as $party => $votes) {
            $firstStep[$party] = round(($votes * $this->totalSeats) / $sum, 4);
        }
        //fraction
        $secondStep = [];
        foreach ($firstStep as $first => $num) {
            $secondStep[$first] = $num - floor($num);
        }
        asort($secondStep);
        //int
        $thirdStep = [];
        foreach ($firstStep as $first => $num) {
            $thirdStep[$first] = floor($num);
        }

        $sumSeats = array_sum($thirdStep);
        $remainingSeats = $this->totalSeats - $sumSeats;

        $testTest = array_slice($secondStep, -$remainingSeats, $remainingSeats, true);

        $parties = [];
        foreach ($testTest as $key => $val) {
            $parties[] = $key;
        }

        foreach ($thirdStep as $key => $val) {
            foreach ($parties as $key1 => $val1) {
                if ($key == $val1) {
                    $thirdStep[$key] += 1;
                }
            }
        }
        $this->result = $thirdStep;
        return $this->result;
    }

    public function getPartyVotes()
    {
        return $this->partyVotes;
    }

    public function getSeats()
    {
        return $this->totalSeats;
    }

}

$test = new CountSeats(['B' => 5400, 'A' => 15000, 'C' => 5500, 'D' => 5550], 15);
print_r($test->countFraction());

