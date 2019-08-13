<?php

/**
 * Copyright 2019 Google LLC
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2 as published by the
 * Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public
 * License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 */

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
