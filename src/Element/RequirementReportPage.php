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

namespace Drupal\requirement\Element;

use Drupal\Core\Render\Element\RenderElement;

/**
 * Creates the requirement report page element.
 *
 * @RenderElement("requirements_report_page")
 */
class RequirementReportPage extends RenderElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#theme' => 'requirements_report_page',
      '#pre_render' => [
        [$class, 'preRenderRequirement'],
      ],
    ];
  }

  /**
   * Pre-render callback for requirement.
   */
  public static function preRenderRequirement($element) {
    // Filter only resolvable requirement.
    $requirements = [];
    foreach ($element['#requirement'] as $id => $requirement) {
      if ($requirement->isResolvable()) {
        $requirements[$id] = $requirement;
      }
    }

    // Group the requirement by requirement group.
    $element['#requirement'] = static::buildGroups($requirements);

    /** @var \Drupal\requirement\Plugin\RequirementInterface $requirement */
    foreach ($requirements as $key => $requirement) {
      $group_id = $requirement->getGroup() ? $requirement->getGroup()->getId() : '_';
      $element['#requirement'][$group_id]['severities'][$requirement->getSeverity()]['requirement'][$key] = [
        '#type' => 'requirement_report',
        '#requirement' => $requirement,
      ];
    }

    return $element;
  }

  /**
   * Returns an array of requirement groups with title and descriptions.
   *
   * @return array
   *   An array of requirement groups.
   */
  protected static function buildGroups(array $requirements = []) {
    /* @var \Drupal\requirement\Plugin\RequirementInterface[] $requirements */
    $groups = [];
    foreach ($requirements as $requirement) {
      $group = $requirement->getGroup();
      $group_id = $group ? $group->getId() : '_';
      if (!isset($groups[$group_id])) {
        $groups[$group_id] = [
          'title' => $group ? $group->getLabel() : t('Other'),
          'description' => $group ? $group->getDescription() : '',
          'severities' => static::getSeverities(),
        ];
      }
    }
    return $groups;
  }

  /**
   * Returns an array of severities.
   *
   * @return array
   *   An array of severities.
   */
  protected static function getSeverities() {
    return [
      'error' => [
        'title' => t('Errors'),
      ],
      'warning' => [
        'title' => t('Warnings'),
      ],
      'recommendation' => [
        'title' => t('Recommendations'),
      ],
      'completed' => [
        'title' => t('Completed'),
      ],
    ];
  }

}
