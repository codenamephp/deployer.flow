<?php declare(strict_types=1);

namespace de\codenamephp\deployer\flow\task\cache;

use de\codenamephp\deployer\flow\task\AbstractFlowTask;

/**
 * Flow command to warmup caches
 *
 * @see https://neos.readthedocs.io/en/stable/References/CommandReference.html#neos-flow-cache-warmup
 */
final class Warmup extends AbstractFlowTask {

  public const NAME = 'flow:cache:warmup';

  public function getCommand() : string {
    return 'cache:warmup';
  }

  public function getArguments() : array {
    return [];
  }

  public function getDescription() : string {
    return 'Fills caches for the next request.';
  }

  public function getName() : string {
    return self::NAME;
  }
}