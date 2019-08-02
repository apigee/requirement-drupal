<?php

namespace Drupal\requirements\Plugin;

/**
 * Defines an interface group for the requirements plugin.
 */
interface RequirementsGroupInterface {

  /**
   * Returns the ID of the plugin.
   *
   * @return string
   *   The plugin ID.
   */
  public function getId(): string;

  /**
   * Returns the label for the requirement.
   *
   * @return string
   *   The requirement label.
   */
  public function getLabel(): string;

  /**
   * Returns the description for the requirement.
   *
   * @return string
   *   The requirement description.
   */
  public function getDescription(): string;

}
