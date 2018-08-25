<?php

class myTestCountSeats extends PHPUnit\Framework\TestCase
{
    public function testCountSeats()
    {
        $example1 = new \App\CountSeats(['A' => 30000, 'B' => 45000, 'C' => 8000], 35);
        $this->assertEquals($example1->countResult(), ['A' => 13, 'B' => 19, 'C' => 3 ]);
    }

}