<?php

namespace Drupal\requirement\Plugin;

use Drupal\Core\Plugin\PluginBase;

/**
 * Defines a base class for requirement group plugins.
 */
abstract class RequirementGroupBase extends PluginBase implements RequirementGroupInterface {

  /**
   * {@inheritdoc}
   */
  public function getId(): string {
    return $this->pluginDefinition['id'];
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel(): String {
    return $this->pluginDefinition['label'];
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription(): String {
    return $this->pluginDefinition['description'];
  }

}
