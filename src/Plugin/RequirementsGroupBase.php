<?php

namespace Drupal\requirements\Plugin;

use Drupal\Core\Plugin\PluginBase;

/**
 * Defines a base class for requirements group plugins.
 */
abstract class RequirementsGroupBase extends PluginBase implements RequirementsGroupInterface {

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
