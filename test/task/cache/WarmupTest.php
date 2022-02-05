<?php declare(strict_types=1);

namespace de\codenamephp\deployer\flow\test\task\cache;

use de\codenamephp\deployer\flow\task\cache\Warmup;
use PHPUnit\Framework\TestCase;

final class WarmupTest extends TestCase {

  private Warmup $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = new Warmup();
  }

  public function testGetCommand() : void {
    self::assertSame('cache:warmup', $this->sut->getCommand());
  }

  public function testGetArguments() : void {
    self::assertSame([], $this->sut->getArguments());
  }
}
