<?php declare(strict_types=1);

namespace de\codenamephp\deployer\flow\test\task\node;

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\flow\command\factory\iFlowCommandFactory;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;
use de\codenamephp\deployer\flow\task\node\Repair;
use PHPUnit\Framework\TestCase;

final class RepairTest extends TestCase {

  private Repair $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = new Repair();
  }

  public function testGetArguments() : void {
    self::assertEquals([], $this->sut->getArguments());
  }

  public function testGetArguments_withNonDefaultValues() : void {
    $this->sut->nodeType = 'some node type';
    $this->sut->workspace = 'some workspace';
    $this->sut->dryRun = true;
    $this->sut->skipCleanup = true;
    $this->sut->skipChecks = ['check1', 'check2'];
    $this->sut->onlyChecks = ['check3', 'check4'];

    self::assertEquals([
      '--node-type some node type',
      '--workspace some workspace',
      '--dry-run',
      '--cleanup',
      '--skip check1,check2',
      '--only check3,check4',
    ], $this->sut->getArguments());
  }

  public function testGetCommand() : void {
    self::assertEquals('node:repair', $this->sut->getCommand());
  }

  public function testGetName() : void {
    self::assertEquals(Repair::NAME, $this->sut->getName());
  }

  public function test__construct() : void {
    $this->sut = new Repair();

    self::assertSame('', $this->sut->nodeType);
    self::assertSame('', $this->sut->workspace);
    self::assertFalse($this->sut->dryRun);
    self::assertFalse($this->sut->skipCleanup);
    self::assertSame([], $this->sut->skipChecks);
    self::assertSame([], $this->sut->onlyChecks);
    self::assertInstanceOf(WithBinaryFromDeployer::class, $this->sut->commandFactory);
    self::assertInstanceOf(WithDeployerFunctions::class, $this->sut->commandRunner);
  }

  public function test__construct_withoutOptionalArguments() : void {
    $commandFactory = $this->createMock(iFlowCommandFactory::class);
    $commandRunner = $this->createMock(iRunner::class);

    $this->sut = new Repair('some node type', 'some workspace', true, true, ['check1', 'check2'], ['check3', 'check4'], $commandFactory, $commandRunner);

    self::assertSame('some node type', $this->sut->nodeType);
    self::assertSame('some workspace', $this->sut->workspace);
    self::assertTrue($this->sut->dryRun);
    self::assertTrue($this->sut->skipCleanup);
    self::assertSame(['check1', 'check2'], $this->sut->skipChecks);
    self::assertSame(['check3', 'check4'], $this->sut->onlyChecks);
    self::assertSame($commandFactory, $this->sut->commandFactory);
    self::assertSame($commandRunner, $this->sut->commandRunner);
  }

  public function testGetDescription() : void {
    self::assertSame('Repair inconsistent nodes', $this->sut->getDescription());
  }
}
