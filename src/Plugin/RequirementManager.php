<?php

namespace Drupal\requirement\Plugin;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\requirement\Annotation\Requirement;

/**
 * Defines a manager for requirement plugins.
 */
class RequirementManager extends DefaultPluginManager implements RequirementManagerInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/Requirement/Requirement',
      $namespaces,
      $module_handler,
      RequirementInterface::class,
      Requirement::class
    );
    $this->alterInfo('requirement_info');
    $this->setCacheBackend($cache_backend, 'requirement_info_info_plugins');
  }

  /**
   * {@inheritdoc}
   */
  public function listRequirement(): array {
    $requirement = [];
    foreach ($this->getDefinitions() as $plugin_id => $definition) {
      /** @var \Drupal\requirement\Plugin\RequirementInterface $instance */
      if (($instance = $this->createInstance($plugin_id)) && ($instance->isApplicable())) {
        $requirement[$plugin_id] = $instance;
      }
    }
    return $requirement;
  }

  /**
   * {@inheritdoc}
   */
  protected function findDefinitions() {
    $definitions = parent::findDefinitions();

    // Sort by weight.
    uasort($definitions, function ($a, $b) {
      return ($a['weight'] ?? 0) <=> ($b['weight'] ?? 0);
    });

    return $definitions;
  }

}
