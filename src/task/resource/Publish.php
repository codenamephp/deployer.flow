<?php declare(strict_types=1);

namespace de\codenamephp\deployer\flow\task\resource;

use de\codenamephp\deployer\flow\task\AbstractFlowTask;

/**
 * Task to publish the resources to the public directory
 *
 * @see https://neos.readthedocs.io/en/stable/References/CommandReference.html#neos-flow-resource-publish
 */
final class Publish extends AbstractFlowTask {

  public const NAME = 'flow:resource:publish';

  public function getCommand() : string {
    return 'resource:publish';
  }

  public function getArguments() : array {
    return [];
  }

  public function getDescription() : string {
    return 'Publish the resources to the public directory.';
  }

  public function getName() : string {
    return self::NAME;
  }
}