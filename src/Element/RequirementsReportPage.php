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
    $requirements = $element['#requirements'];
    // Group the requirement by severities.
    $element['#requirements'] = static::getSeverities();

    /** @var \Drupal\requirements\Plugin\RequirementsInterface $requirement */
    foreach ($requirements as $key => $requirement) {
      if ($requirement->isResolvable()) {
        $element['#requirements'][$requirement->getSeverity()]['requirements'][$key] = [
          '#type' => 'requirements_report',
          '#requirement' => $requirement,
        ];
      }
    }

    return $element;
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
