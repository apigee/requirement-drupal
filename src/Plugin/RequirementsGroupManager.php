<?php

namespace Drupal\requirements\Plugin;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\requirements\Annotation\RequirementsGroup;

/**
 * Defines a manager for requirements group plugins.
 */
class RequirementsGroupManager extends DefaultPluginManager implements RequirementsGroupManagerInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/Requirements/RequirementsGroup',
      $namespaces,
      $module_handler,
      RequirementsGroupInterface::class,
      RequirementsGroup::class
    );
    $this->alterInfo('requirements_group_info');
    $this->setCacheBackend($cache_backend, 'requirements_group_info_info_plugins');
  }

  /**
   * {@inheritdoc}
   */
  public function listRequirementsGroups(): array {
    $requirements = [];
    foreach ($this->getDefinitions() as $plugin_id => $definition) {
      /** @var \Drupal\requirements\Plugin\RequirementsGroupInterface $instance */
      if ($instance = $this->createInstance($plugin_id)) {
        $requirements[$plugin_id] = $instance;
      }
    }
    return $requirements;
  }

}
