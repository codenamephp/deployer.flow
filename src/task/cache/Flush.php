<?php declare(strict_types=1);

namespace de\codenamephp\deployer\flow\task\cache;

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\flow\command\factory\iFlowCommandFactory;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;
use de\codenamephp\deployer\flow\task\AbstractFlowTask;

/**
 * Task to flush the cache
 *
 * @see https://neos.readthedocs.io/en/stable/References/CommandReference.html#neos-flow-cache-flush
 * @psalm-api
 */
final class Flush extends AbstractFlowTask {

  public const NAME = 'flow:cache:flush';

  public function __construct(public bool         $force = false,
                              iFlowCommandFactory $commandFactory = new WithBinaryFromDeployer(),
                              iRunner             $commandRunner = new WithDeployerFunctions()) {
    parent::__construct($commandFactory, $commandRunner);
  }

  public function getCommand() : string {
    return 'flow:cache:flush';
  }

  public function getArguments() : array {
    return $this->force ? ['--force'] : [];
  }

  public function getDescription() : string {
    return 'Flushes all configured caches.';
  }

  public function getName() : string {
    return self::NAME;
  }
}