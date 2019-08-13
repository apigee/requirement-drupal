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
