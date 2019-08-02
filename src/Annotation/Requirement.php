<?php

namespace Drupal\requirement\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a requirement annotation object.
 *
 * @Annotation
 */
class Requirement extends Plugin {

  /**
   * The ID of the plugin.
   *
   * @var string
   */
  public $id;

  /**
   * The ID of the requirement group plugin it belongs to.
   *
   * @var string
   */
  public $group;

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

  /**
   * The form for the plugin.
   *
   * @var string
   */
  public $form;

  /**
   * The label for the form button.
   *
   * @var string
   */
  public $action_button_label;

  /**
   * The severity of the requirement.
   *
   * @var string
   */
  public $severity;

  /**
   * The weight of the plugin for sorting.
   *
   * @var int
   */
  public $weight;

  /**
   * An array of dependent requirement Ids.
   *
   * @var array
   */
  public $dependencies;

}
