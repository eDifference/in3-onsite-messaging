<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Test\Unit\Model\Config\Source;

use Edifference\In3OnsiteMessaging\Model\Config\Source\Theme;
use PHPUnit\Framework\TestCase;

/**
 * @copyright (c) eDifference 2022
 */
class ThemeTest extends TestCase
{
    /** @var Theme */
    private Theme $model;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->model = new Theme();
    }

    /**
     * Test result of options array
     * @return void
     */
    public function testToOptionArray(): void
    {
        $expectedResult = [
            ['value' => 'light', 'label' => __('Light Theme')],
            ['value' => 'dark', 'label' => __('Dark Theme')],
        ];
        $this->assertEquals($expectedResult, $this->model->toOptionArray());
    }
}
