<?php

namespace Drupal\requirement\Plugin;

/**
 * Defines an interface group for the requirement plugin.
 */
interface RequirementGroupInterface {

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
