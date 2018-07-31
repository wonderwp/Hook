<?php

namespace WonderWp\Component\Hook;

use PHPUnit\Framework\TestCase;

class AbstractHookServiceTest extends TestCase
{
    /** @var  AbstractHookService */
    private $hookService;

    public function setUp()
    {
        $this->hookService = new FakeHookService();
    }

    public function testLoadTextDomainWithValues()
    {
        $this->assertEquals(false, $this->hookService->loadTextdomain('fakeDomain', 'fr_FR', '/fake/folder/path'));
    }
}

class FakeHookService extends AbstractHookService
{
    public function run()
    {
    }
}
