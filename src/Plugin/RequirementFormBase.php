<?php

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
