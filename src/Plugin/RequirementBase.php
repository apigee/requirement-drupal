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

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Logger\LoggerChannelTrait;
use Drupal\Core\Messenger\MessengerTrait;
use Drupal\Core\Plugin\PluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a base class for requirement plugins.
 */
abstract class RequirementBase extends PluginBase implements RequirementInterface {

  use RequirementTrait;
  use LoggerChannelTrait;
  use MessengerTrait;

  /**
   * The requirement group this belongs to.
   *
   * @var \Drupal\requirement\Plugin\RequirementGroupInterface
   */
  protected $requirement_group;

  /**
   * {@inheritdoc}
   */
  public function getId(): string {
    return $this->pluginDefinition['id'];
  }

  /**
   * {@inheritdoc}
   */
  public function getGroup():? RequirementGroupInterface {
    if (empty($this->requirement_group) && !empty($this->pluginDefinition['group'])) {
      $groups = $this->getRequirementGroupManager()->listRequirementGroups();
      $group_id = $this->pluginDefinition['group'];
      $this->requirement_group = isset($groups[$group_id]) ? $groups[$group_id] : NULL;
    }

    return $this->requirement_group;
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel(): String {
    return $this->pluginDefinition['label'];
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription(): String {
    return $this->pluginDefinition['description'];
  }

  /**
   * {@inheritdoc}
   */
  public function getForm(): ?String {
    return $this->pluginDefinition['form'] ?? RequirementFormBase::class;
  }

  /**
   * {@inheritdoc}
   */
  public function getActionButtonLabel(): ?String {
    return $this->pluginDefinition['action_button_label'] ?? NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function getSeverity(): String {
    return $this->isCompleted() ? 'completed' : ($this->pluginDefinition['severity'] ?? 'warning');
  }

  /**
   * {@inheritdoc}
   */
  public function getDependencies(): array {
    return $this->pluginDefinition['dependencies'] ?? [];
  }

  /**
   * {@inheritdoc}
   */
  public function getActionButton(): array {
    if (!$this->getActionButtonLabel()) {
      return [];
    }

    return Link::createFromRoute($this->getActionButtonLabel(), "requirement.{$this->getId()}", [
      \Drupal::destination()->getAsArray(),
    ], [
      'attributes' => [
        'data-dialog-type' => 'modal',
        'data-dialog-options' => json_encode([
          'width' => 600,
          'height' => 450,
          'draggable' => FALSE,
          'autoResize' => FALSE,
        ]),
        'class' => [
          'use-ajax',
          'button',
        ],
      ],
    ])->toRenderable();
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function isResolvable(): bool {
    // TODO: Implement a dependency tree so we can avoid circular dependencies.
    foreach ($this->getDependencies() as $dependency) {
      if (!$this->getRequirementManager()->createInstance($dependency)->isCompleted()) {
        return FALSE;
      }
    }

    return TRUE;
  }

}
