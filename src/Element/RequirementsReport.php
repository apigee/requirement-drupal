<?php

namespace Drupal\requirements\Element;

use Drupal\Core\Render\Element\RenderElement;

/**
 * Creates the requirements report element.
 *
 * @RenderElement("requirements_report")
 */
class RequirementsReport extends RenderElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    return [
      '#theme' => 'requirements_report',
    ];
  }

}
