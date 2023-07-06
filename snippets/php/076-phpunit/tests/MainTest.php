<?php

namespace Tests;

use PHPUnit\Framework\TestCase ;

class MainTest extends TestCase
{
	public function setUp(): void
	{
		parent::setUp();
	}

	public function testMain()
	{
		$this->assertEquals(true, true);
	}
}
