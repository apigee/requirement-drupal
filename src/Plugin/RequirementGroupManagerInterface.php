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

namespace Drupal\requirement\Plugin;

use Drupal\Component\Plugin\PluginManagerInterface;

/**
 * Defines an interface for the requirement group plugin manager.
 */
interface RequirementGroupManagerInterface extends PluginManagerInterface {

  /**
   * Returns an array of requirement groups keyed by id.
   *
   * @return \Drupal\requirement\Plugin\RequirementInterface[]
   *   An array of requirement groups.
   */
  public function listRequirementGroups(): array;

}
