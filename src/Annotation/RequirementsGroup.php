<?php

namespace Drupal\requirements\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a requirements group annotation object.
 *
 * @Annotation
 */
class RequirementsGroup extends Plugin {

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
