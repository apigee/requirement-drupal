<?php

namespace Drupal\requirements\Routing;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\requirements\Plugin\RequirementsManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Route;

/**
 * Provides routes for requirements.
 */
class RequirementsRoutes implements ContainerInjectionInterface {

  /**
   * The requirements manager.
   *
   * @var \Drupal\requirements\Plugin\RequirementsManagerInterface
   */
  protected $requirementManager;

  /**
   * RequirementsRoutes constructor.
   *
   * @param \Drupal\requirements\Plugin\RequirementsManagerInterface $requirements_manager
   *   The requirements manager.
   */
  public function __construct(RequirementsManagerInterface $requirements_manager) {
    $this->requirementManager = $requirements_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.requirements')
    );
  }

  /**
   * Returns an array of route objects.
   *
   * @return \Symfony\Component\Routing\Route[]
   *   An array of route objects.
   */
  public function routes() {
    $routes = [];

    foreach ($this->requirementManager->listRequirements() as $requirement) {
      if ($form = $requirement->getForm()) {
        $routes["requirements.{$requirement->getId()}"] = new Route(
          "/admin/reports/requirements/{$requirement->getId()}",
          [
            '_form' => $form,
            '_title' => $requirement->getLabel(),
            'requirement_id' => $requirement->getId(),
          ],
          [
            '_permission' => 'administer site configuration',
          ]
        );
      }
    }

    return $routes;
  }

}
