<?php

namespace Drupal\requirements\Plugin;

/**
 * Provides a trait for the requirements plugins.
 */
trait RequirementsTrait {

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
   * The requirements manager.
   *
   * @var \Drupal\requirements\Plugin\RequirementsManagerInterface
   */
  protected $requirementManager;

  /**
   * The Apigee Edge SDK connector.
   *
   * @var \Drupal\apigee_edge\SDKConnectorInterface
   */
  protected $apigeeEdgeSdkConnector;

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
   * Gets the requirements manager.
   *
   * @return \Drupal\requirements\Plugin\RequirementsManagerInterface|mixed
   *   The requirements manager.
   */
  public function getRequirementsManager() {
    if (!$this->requirementManager) {
      $this->requirementManager = \Drupal::service('plugin.manager.requirements');
    }

    return $this->requirementManager;
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

  /**
   * Gets the Apigee Edge SDK connector.
   *
   * @return \Drupal\apigee_edge\SDKConnectorInterface|mixed
   *   The Apigee Edge SDK connector.
   */
  public function getApigeeEdgeSdkConnector() {
    if (!$this->apigeeEdgeSdkConnector) {
      $this->apigeeEdgeSdkConnector = \Drupal::service('apigee_edge.sdk_connector');
    }

    return $this->apigeeEdgeSdkConnector;
  }

}
