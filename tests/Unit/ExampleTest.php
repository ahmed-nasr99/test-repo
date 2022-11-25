<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Post;

class ExampleTest extends TestCase
{

    /**
     * @param float $num1
     * @param float $num2
     * This function summ two number and return its result
     */
    public function sumTwoNumbers($num1 , $num2)
    {
        return $num1 + $num2;
    }


    public function testSumTwoNumbersFunction()
    {
        $result = $this->sumTwoNumbers(1,2);

        $this->assertEquals(3, $result);
        $this->assertGreaterThanOrEqual(5, $result);
    }


    public function testSumTwoNumbersFunction2()
    {
        $result = $this->sumTwoNumbers(1,2);

        $this->assertEquals(3, $result);
        $this->assertGreaterThanOrEqual(5, $result);
    }
}
