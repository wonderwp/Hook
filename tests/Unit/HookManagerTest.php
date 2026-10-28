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
        $GLOBALS['wwp_test_removed_actions'] = [];
        $GLOBALS['wwp_test_removed_filters'] = [];
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

    public function testRemoveActionDelegatesToWordPressWithPriority(): void
    {
        $manager = new HookManager();
        $cb = static function (): void {
        };

        $this->assertTrue($manager->removeAction('init', $cb, 5));
        $this->assertCount(1, $GLOBALS['wwp_test_removed_actions']);
        $this->assertSame('init', $GLOBALS['wwp_test_removed_actions'][0]['hook']);
        $this->assertSame(5, $GLOBALS['wwp_test_removed_actions'][0]['priority']);
    }

    public function testRemoveFilterAlwaysPassesDefaultPriorityDueToSignatureAssignment(): void
    {
        $manager = new HookManager();
        $cb = static function ($v) {
            return $v;
        };

        $this->assertTrue($manager->removeFilter('the_content', $cb, 5));
        $this->assertCount(1, $GLOBALS['wwp_test_removed_filters']);
        $this->assertSame('the_content', $GLOBALS['wwp_test_removed_filters'][0]['hook']);
        // HookManager::removeFilter uses `$priority = 10` in the remove_filter call.
        $this->assertSame(10, $GLOBALS['wwp_test_removed_filters'][0]['priority']);
    }
}
