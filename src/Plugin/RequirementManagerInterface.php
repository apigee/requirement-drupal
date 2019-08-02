<?php

namespace Drupal\requirement\Plugin;

use Drupal\Component\Plugin\PluginManagerInterface;

/**
 * Defines an interface for the requirement plugin manager.
 */
interface RequirementManagerInterface extends PluginManagerInterface {

  /**
   * Returns an array of requirement.
   *
   * @return \Drupal\requirement\Plugin\RequirementInterface[]
   *   An array of requirement.
   */
  public function listRequirement(): array;

}
