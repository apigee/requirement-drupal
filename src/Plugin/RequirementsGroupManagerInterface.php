<?php

namespace Drupal\requirements\Plugin;

use Drupal\Component\Plugin\PluginManagerInterface;

/**
 * Defines an interface for the requirements group plugin manager.
 */
interface RequirementsGroupManagerInterface extends PluginManagerInterface {

  /**
   * Returns an array of requirements groups keyed by id.
   *
   * @return \Drupal\requirements\Plugin\RequirementsInterface[]
   *   An array of requirements groups.
   */
  public function listRequirementsGroups(): array;

}
