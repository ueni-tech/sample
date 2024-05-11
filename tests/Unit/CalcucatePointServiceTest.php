<?php

namespace Tests\Unit;

use App\Exceptions\PreconditionException;
use App\Services\CalculatePointService;
use PHPUnit\Framework\TestCase;

class CalcucatePointServiceTest extends TestCase
{

    public static function dataProvider_for_calcPoint(): array
    {
        return [
            '購入金額が0なら0ポイント' => [0, 0],
            '購入金額が999なら0ポイント' => [0, 999],
            '購入金額が1000なら10ポイント' => [10, 1000],
            '購入金額が9999なら99ポイント' => [99, 9999],
            '購入金額が10000なら200ポイント' => [200, 10000],
        ];
    }

    /**
     * @test
     */
    // public function calcPoint_購入金額が0なら0ポイント()
    // {
    //     $result = CalculatePointService::calcPoint(0);

    //     $this->assertEquals(0, $result);
    // }

    /**
     * @test
     */
    // public function calcPoint_購入金額が1000なら10ポイント()
    // {
    //     $result = CalculatePointService::calcPoint(1000);

    //     $this->assertEquals(10, $result);
    // }

    /**
     * @test
     * @dataProvider dataProvider_for_calcPoint
     */
    public function calcPoint(int $expected, int $amount)
    {
        $result = CalculatePointService::calcPoint($amount);

        $this->assertEquals($expected, $result);
    }


    /**
     * @test
     */
    public function calcPoint_購入金額が負の数なら例外()
    {
        $this->expectException(PreconditionException::class);
        $this->expectExceptionMessage('購入金額が負の数');

        CalculatePointService::calcPoint(-1);
    }
}
