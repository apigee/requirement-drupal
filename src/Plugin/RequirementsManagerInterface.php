<?php

namespace Drupal\requirements\Plugin;

use Drupal\Component\Plugin\PluginManagerInterface;

/**
 * Defines an interface for the requirements plugin manager.
 */
interface RequirementsManagerInterface extends PluginManagerInterface {

  /**
   * Returns an array of requirements.
   *
   * @return \Drupal\requirements\Plugin\RequirementsInterface[]
   *   An array of requirements.
   */
  public function listRequirements(): array;

}
