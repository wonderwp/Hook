<?php

declare(strict_types=1);

namespace WonderWp\Component\Hook\Tests\Unit;

use PHPUnit\Framework\TestCase;
use WonderWp\Component\Hook\HookManager;

final class HookManagerTest extends TestCase
{
    protected function setUp(): void
    {
        $GLOBALS['wwp_test_actions'] = [];
        $GLOBALS['wwp_test_filters'] = [];
    }

    public function testAddActionDelegatesToWordPress(): void
    {
        $manager = new HookManager();
        $cb = static function (): void {
        };

        $this->assertTrue($manager->addAction('init', $cb, 20, 2));
        $this->assertCount(1, $GLOBALS['wwp_test_actions']['init']);
        $this->assertSame(20, $GLOBALS['wwp_test_actions']['init'][0]['priority']);
        $this->assertSame(2, $GLOBALS['wwp_test_actions']['init'][0]['accepted_args']);
    }

    public function testAddFilterDelegatesToWordPress(): void
    {
        $manager = new HookManager();
        $cb = static function ($v) {
            return $v;
        };

        $this->assertTrue($manager->addFilter('the_title', $cb));
        $this->assertArrayHasKey('the_title', $GLOBALS['wwp_test_filters']);
    }
}
