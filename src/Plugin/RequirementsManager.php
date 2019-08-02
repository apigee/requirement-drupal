<?php

namespace Drupal\requirements\Plugin;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\requirements\Annotation\Requirements;

/**
 * Defines a manager for requirements plugins.
 */
class RequirementsManager extends DefaultPluginManager implements RequirementsManagerInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/Requirements/Requirements',
      $namespaces,
      $module_handler,
      RequirementsInterface::class,
      Requirements::class
    );
    $this->alterInfo('requirements_info');
    $this->setCacheBackend($cache_backend, 'requirements_info_info_plugins');
  }

  /**
   * {@inheritdoc}
   */
  public function listRequirements(): array {
    $requirements = [];
    foreach ($this->getDefinitions() as $plugin_id => $definition) {
      /** @var \Drupal\requirements\Plugin\RequirementsInterface $instance */
      if (($instance = $this->createInstance($plugin_id)) && ($instance->isApplicable())) {
        $requirements[$plugin_id] = $instance;
      }
    }
    return $requirements;
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
