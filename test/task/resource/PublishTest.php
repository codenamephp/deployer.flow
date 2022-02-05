<?php declare(strict_types=1);

namespace de\codenamephp\deployer\flow\test\task\resource;

use de\codenamephp\deployer\flow\task\resource\Publish;
use PHPUnit\Framework\TestCase;

final class PublishTest extends TestCase {

  private Publish $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = new Publish();
  }

  public function testGetCommand() : void {
    self::assertSame('resource:publish', $this->sut->getCommand());
  }

  public function testGetArguments() : void {
    self::assertSame([], $this->sut->getArguments());
  }
}
