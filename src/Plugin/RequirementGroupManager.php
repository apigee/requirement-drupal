<?php

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
