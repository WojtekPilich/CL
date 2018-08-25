<?php

class myTestCountSeats extends PHPUnit\Framework\TestCase
{
    public function testCountSeats()
    {
        $example1 = new \App\CountSeats(['A' => 30000, 'B' => 45000, 'C' => 8000], 35);

        $this->assertEquals($example1->countResult(), ['A' => 13, 'B' => 19, 'C' => 3 ]);
        $this->assertNotEquals($example1->countResult(), ['A' => 11, 'B' => 17, 'C' => 22 ]);

        $this->assertInternalType('integer', $example1->getSeats());
        $this->assertInternalType('array', $example1->getPartyVotes());

        $this->assertInstanceOf('\App\CountSeats', $example1);

        $this->assertArrayHasKey('C', $example1->getPartyVotes());
    }
}