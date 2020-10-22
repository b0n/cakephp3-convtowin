<?php

namespace ConvToWin\Test\TestCase\Utility;

use ConvToWin\Utility\ConvToWin;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * Class ConvToWinTest
 * @package App\Test\TestCase\Controller
 */
class ConvToWinTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var ConvToWin
     */
    public $convToWin;

    /**
     *
     */
    public function testConvArrayToWin()
    {
        $this->expectException('Exception');
        $this->expectExceptionCode('0');
        $this->expectExceptionMessage('Cannot convert value to Win');
        $this->convToWin = new ConvToWin([]);
    }

    /**
     *
     */
    public function testConvNullToWin()
    {
        $this->expectException('Exception');
        $this->expectExceptionCode('0');
        $this->expectExceptionMessage('Cannot convert value to Win');
        $this->convToWin = new ConvToWin(null);
    }

    /**
     *
     */
    public function testConvEmptyToWin()
    {
        $this->convToWin = new ConvToWin(0);
        $this->convToWin->convToWin();
        $this->assertSame('0', $this->convToWin->converted, '0で渡しても0のまま');

        $this->convToWin = new ConvToWin('');
        $this->convToWin->convToWin();
        $this->assertSame('', $this->convToWin->converted, '空で渡しても空のまま');
    }

    /**
     *
     */
    public function testConvToWin()
    {
        $this->convToWin = new ConvToWin('‖');
        $this->convToWin->convToWin();
        $this->assertSame('∥', $this->convToWin->converted, '‖ を渡すと ∥ に変わる');

        $this->convToWin = new ConvToWin('﨑');
        $this->convToWin->convToWin();
        $this->assertSame('﨑', $this->convToWin->converted, '﨑 を渡しても 﨑 のまま');

        $this->convToWin = new ConvToWin('‖﨑');
        $this->convToWin->convToWin();
        $this->assertSame('∥﨑', $this->convToWin->converted, '‖﨑 を渡すと ∥﨑 に変わる');

        $this->convToWin = new ConvToWin('〜‖−¢£¬—');
        $this->convToWin->convToWin();
        $this->assertSame('～∥－￠￡￢―', $this->convToWin->converted,'〜‖−¢£¬— を渡すと ～∥－￠￡￢― に変わる');

        $this->convToWin = new ConvToWin('アイウエ オ2,㈱,㌔,①,﨑,¢,￠');
        $this->convToWin->convToWin();
        $this->assertSame('アイウエ オ2,㈱,㌔,①,﨑,￠,￠', $this->convToWin->converted);
    }

}
