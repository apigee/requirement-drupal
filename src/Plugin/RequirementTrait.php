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

/**
 * Provides a trait for the requirement plugins.
 */
trait RequirementTrait {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The module handler service.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * The module installer service.
   *
   * @var \Drupal\Core\Extension\ModuleInstallerInterface
   */
  protected $moduleInstaller;

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The config storage.
   *
   * @var \Drupal\Core\Config\StorageInterface
   */
  protected $configStorage;

  /**
   * The config manager.
   *
   * @var \Drupal\Core\Config\ConfigManagerInterface
   */
  protected $configManager;

  /**
   * The requirement manager.
   *
   * @var \Drupal\requirement\Plugin\RequirementManagerInterface
   */
  protected $requirementManager;

  /**
   * The requirement group manager.
   *
   * @var \Drupal\requirement\Plugin\RequirementGroupManagerInterface
   */
  protected $requirementGroupManager;

  /**
   * Gets the entity type manager.
   *
   * @return \Drupal\Core\Entity\EntityTypeManagerInterface
   *   The entity type manager.
   */
  public function getEntityTypeManager() {
    if (!$this->entityTypeManager) {
      $this->entityTypeManager = \Drupal::entityTypeManager();
    }

    return $this->entityTypeManager;
  }

  /**
   * Gets the module handler.
   *
   * @return \Drupal\Core\Extension\ModuleHandlerInterface
   *   The module handler.
   */
  public function getModuleHandler() {
    if (!$this->moduleHandler) {
      $this->moduleHandler = \Drupal::moduleHandler();
    }

    return $this->moduleHandler;
  }

  /**
   * Gets the module installer.
   *
   * @return \Drupal\Core\Extension\ModuleInstallerInterface|mixed
   *   The module installer.
   */
  public function getModuleInstaller() {
    if (!$this->moduleInstaller) {
      $this->moduleInstaller = \Drupal::service('module_installer');
    }

    return $this->moduleInstaller;
  }

  /**
   * Gets the requirement manager.
   *
   * @return \Drupal\requirement\Plugin\RequirementManagerInterface|mixed
   *   The requirement manager.
   */
  public function getRequirementManager() {
    if (!$this->requirementManager) {
      $this->requirementManager = \Drupal::service('plugin.manager.requirement');
    }

    return $this->requirementManager;
  }

  /**
   * Gets the requirement group manager.
   *
   * @return \Drupal\requirement\Plugin\RequirementGroupManagerInterface|mixed
   *   The requirement group manager.
   */
  public function getRequirementGroupManager() {
    if (!$this->requirementGroupManager) {
      $this->requirementGroupManager = \Drupal::service('plugin.manager.requirement_group');
    }

    return $this->requirementGroupManager;
  }

  /**
   * Gets the config factory.
   *
   * @return \Drupal\Core\Config\ConfigFactoryInterface
   *   The config factory.
   */
  public function getConfigFactory() {
    if (!$this->configFactory) {
      $this->configFactory = \Drupal::configFactory();
    }

    return $this->configFactory;
  }

  /**
   * Gets the config storage.
   *
   * @return \Drupal\Core\Config\StorageInterface
   *   The config storage.
   */
  public function getConfigStorage() {
    if (!$this->configStorage) {
      $this->configStorage = \Drupal::service('config.storage');
    }

    return $this->configStorage;
  }

  /**
   * Gets the config manager.
   *
   * @return \Drupal\Core\Config\ConfigManagerInterface|mixed
   *   The config manager.
   */
  public function getConfigManager() {
    if (!$this->configManager) {
      $this->configManager = \Drupal::service('config.manager');
    }

    return $this->configManager;
  }

}
