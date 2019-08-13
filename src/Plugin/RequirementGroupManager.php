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

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\requirement\Annotation\RequirementGroup;

/**
 * Defines a manager for requirement group plugins.
 */
class RequirementGroupManager extends DefaultPluginManager implements RequirementGroupManagerInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/Requirement/RequirementGroup',
      $namespaces,
      $module_handler,
      RequirementGroupInterface::class,
      RequirementGroup::class
    );
    $this->alterInfo('requirement_group_info');
    $this->setCacheBackend($cache_backend, 'requirement_group_info_info_plugins');
  }

  /**
   * {@inheritdoc}
   */
  public function listRequirementGroups(): array {
    $requirement = [];
    foreach ($this->getDefinitions() as $plugin_id => $definition) {
      /** @var \Drupal\requirement\Plugin\RequirementGroupInterface $instance */
      if ($instance = $this->createInstance($plugin_id)) {
        $requirement[$plugin_id] = $instance;
      }
    }
    return $requirement;
  }

}
