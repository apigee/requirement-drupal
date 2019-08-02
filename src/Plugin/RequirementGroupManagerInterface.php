<?php

namespace Drupal\requirement\Plugin;

use Drupal\Component\Plugin\PluginManagerInterface;

/**
 * Defines an interface for the requirement group plugin manager.
 */
interface RequirementGroupManagerInterface extends PluginManagerInterface {

  /**
   * Returns an array of requirement groups keyed by id.
   *
   * @return \Drupal\requirement\Plugin\RequirementInterface[]
   *   An array of requirement groups.
   */
  public function listRequirementGroups(): array;

}
