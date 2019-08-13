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

namespace Drupal\requirement\Plugin;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a base form for requirement.
 */
class RequirementFormBase extends FormBase {

  /**
   * The requirement manager.
   *
   * @var \Drupal\requirement\Plugin\RequirementManagerInterface
   */
  protected $requirementManager;

  /**
   * The requirement.
   *
   * @var \Drupal\requirement\Plugin\RequirementInterface|null
   */
  protected $requirement;

  /**
   * RequirementFormBase constructor.
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
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'requirement_base_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $requirement_id = NULL) {
    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#button_type' => 'primary',
        '#value' => $this->t('Submit'),
      ],
      'cancel' => [
        '#type' => 'link',
        '#title' => $this->t('Cancel'),
        '#attributes' => ['class' => ['button']],
        '#url' => Url::fromRoute('requirement.report'),
      ],
    ];

    /** @var \Drupal\requirement\Plugin\RequirementInterface $requirement */
    if ($this->requirement = $this->requirementManager->createInstance($requirement_id)) {
      $form = $this->requirement->buildConfigurationForm($form, $form_state);
      $form['#title'] = $this->requirement->getLabel();
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->requirement->submitConfigurationForm($form, $form_state);
  }

}
