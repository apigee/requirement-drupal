<?php

namespace Drupal\requirement\Element;

use Drupal\Core\Render\Element\RenderElement;

/**
 * Creates the requirement report element.
 *
 * @RenderElement("requirement_report")
 */
class RequirementReport extends RenderElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    return [
      '#theme' => 'requirement_report',
    ];
  }

}
