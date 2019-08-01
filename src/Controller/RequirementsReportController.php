<?php

namespace Drupal\requirements\Controller;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\requirements\Plugin\RequirementsManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements a controller for the requirements report page.
 */
class RequirementsReportController implements ContainerInjectionInterface {

  /**
   * The requirements manager.
   *
   * @var \Drupal\requirements\Plugin\RequirementsManagerInterface
   */
  protected $requirementManager;

  /**
   * RequirementsReportController constructor.
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
   * Displays the requirements status report.
   *
   * @return array
   *   A render array containing a list of requirements.
   */
  public function status() {
    return [
      '#type' => 'requirements_report_page',
      '#requirements' => $this->requirementManager->listRequirements(),
    ];
  }

}
