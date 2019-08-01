<?php

namespace Drupal\requirements\Plugin;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a base form for requirements.
 */
class RequirementsFormBase extends FormBase {

  /**
   * The requirements manager.
   *
   * @var \Drupal\requirements\Plugin\RequirementsManagerInterface
   */
  protected $requirementManager;

  /**
   * The requirements.
   *
   * @var \Drupal\requirements\Plugin\RequirementsInterface|null
   */
  protected $requirement;

  /**
   * RequirementsFormBase constructor.
   *
   * @param \Drupal\requirements\Plugin\RequirementsManagerInterface $requirements_manager
   *   The requirements manager.
   */
  public function __construct(RequirementsManagerInterface $requirements_manager) {
    $this->requirementManager = $requirements_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.requirements')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'requirements_base_form';
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
        '#url' => Url::fromRoute('requirements.report'),
      ],
    ];

    /** @var \Drupal\requirements\Plugin\RequirementsInterface $requirement */
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
