<?php

namespace App;

class CountSeats
{
    protected $totalSeats;
    protected $result;
    protected $partyVotes = [];

    public function __construct($votes, $seats)
    {
        if(is_array($votes)) {
            $this->partyVotes = $votes;
        } else {
            throw new \Exception('Votes must be an array type!');
        }

        if(is_int($seats)) {
            $this->totalSeats = $seats;
        } else {
            throw new \Exception('Seats must be an integer type!');
        }
    }

    public function countResult()
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

        $theLargest = array_slice($secondStep, -$remainingSeats, $remainingSeats, true);

        $parties = [];
        foreach ($theLargest as $key => $val) {
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

    //getters
    public function getPartyVotes()
    {
        return $this->partyVotes;
    }

    public function getSeats()
    {
        return $this->totalSeats;
    }
}

try {
    $test = new CountSeats(['B' => 5400, 'A' => 15000, 'C' => 5500, 'D' => 5550], 15);
    print_r($test->countResult());
} catch (\Exception $e) {
    echo $e->getMessage();
}