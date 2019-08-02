<?php

namespace Drupal\requirement\Controller;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\requirement\Plugin\RequirementManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements a controller for the requirement report page.
 */
class RequirementReportController implements ContainerInjectionInterface {

  /**
   * The requirement manager.
   *
   * @var \Drupal\requirement\Plugin\RequirementManagerInterface
   */
  protected $requirementManager;

  /**
   * RequirementReportController constructor.
   *
   * @param \Drupal\requirement\Plugin\RequirementManagerInterface $requirement_manager
   *   The requirement manager.
   */
  public function __construct(RequirementManagerInterface $requirement_manager) {
    $this->requirementManager = $requirement_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.requirement')
    );
  }

  /**
   * Displays the requirement status report.
   *
   * @return array
   *   A render array containing a list of requirement.
   */
  public function status() {
    return [
      '#type' => 'requirements_report_page',
      '#requirement' => $this->requirementManager->listRequirement(),
    ];
  }

}
