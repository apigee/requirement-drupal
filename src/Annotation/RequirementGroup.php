<?php

namespace Drupal\requirement\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a requirement group annotation object.
 *
 * @Annotation
 */
class RequirementGroup extends Plugin {

  /**
   * The ID of the plugin.
   *
   * @var string
   */
  public $id;

  /**
   * The label for the plugin.
   *
   * @var string
   */
  public $label;

  /**
   * The description for the plugin.
   *
   * @var string
   */
  public $description;

}
