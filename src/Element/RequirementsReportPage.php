<?php

namespace Drupal\requirements\Element;

use Drupal\Core\Render\Element\RenderElement;

/**
 * Creates the requirements report page element.
 *
 * @RenderElement("requirements_report_page")
 */
class RequirementsReportPage extends RenderElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#theme' => 'requirements_report_page',
      '#pre_render' => [
        [$class, 'preRenderRequirements'],
      ],
    ];
  }

  /**
   * Pre-render callback for requirements.
   */
  public static function preRenderRequirements($element) {
    // Filter only resolvable requirements.
    $requirements = [];
    foreach ($element['#requirements'] as $id => $requirement) {
      if ($requirement->isResolvable()) {
        $requirements[$id] = $requirement;
      }
    }

    // Group the requirement by requirements group.
    $element['#requirements'] = static::buildGroups($requirements);

    /** @var \Drupal\requirements\Plugin\RequirementsInterface $requirement */
    foreach ($requirements as $key => $requirement) {
      $group_id = $requirement->getGroup() ? $requirement->getGroup()->getId() : '_';
      $element['#requirements'][$group_id]['severities'][$requirement->getSeverity()]['requirements'][$key] = [
        '#type' => 'requirements_report',
        '#requirement' => $requirement,
      ];
    }

    return $element;
  }

  /**
   * Returns an array of requirements groups with title and descriptions.
   *
   * @return array
   *   An array of requirements groups.
   */
  protected static function buildGroups(array $requirements = []) {
    /* @var \Drupal\requirements\Plugin\RequirementsInterface[] $requirements */
    $groups = [];
    foreach ($requirements as $requirement) {
      $group = $requirement->getGroup();
      $group_id = $group ? $group->getId() : '_';
      if (!isset($groups[$group_id])) {
        $groups[$group_id] = [
          'title' => $group ? $group->getLabel() : t('Other'),
          'description' =>$group ? $group->getDescription() : '',
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
