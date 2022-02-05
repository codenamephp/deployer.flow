<?php declare(strict_types=1);

namespace de\codenamephp\deployer\flow\test\task\doctrine;

use de\codenamephp\deployer\flow\task\doctrine\Migrate;
use PHPUnit\Framework\TestCase;

final class MigrateTest extends TestCase {

  private Migrate $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = new Migrate();
  }

  public function testGetCommand() : void {
    self::assertSame('doctrine:migrate', $this->sut->getCommand());
  }

  public function testGetArguments() : void {
    self::assertSame([], $this->sut->getArguments());
  }
}
