Requirement
-----------

This Drupal module allows other modules to declare configuration requirements and suggestions, and provide solutions to
fix them. The requirements will show up as a summary on Drupal's Status Report page, and details can be found on the
Requirements Report page that lists all of the requirements and actions to solve them.

This module can provide other modules an easy way to setup whatever configuration is required (or suggested), and that
cannot be automated as part of their installation, either because they require user input or some other reason.


## Installation

Install as usual (see https://www.drupal.org/node/1897420 for instructions on how to install a module).
No additional modules or libraries are required.


## Usage

Visit the "Requirements report" page at `/admin/reports/requirements`. There you can verify what requirements on your
site are OK, and which ones need to be setup. A summary of the requirements will also be displayed on Drupal's Status
Report page (`/admin/reports/status`).


## Implementing your own requirements (usage as a module developer)

- A requirement is a configuration that a module needs for it to work as expected, or a suggested configuration.
- Requirements live inside modules as plugins.
- They can have dependencies, that is other requirements that must be completed before they even show up.
- If they are not "applicable", then they are not taken into account. This is useful, for example, if you are suggesting
a configuration only if a module is enabled.
- They should declare their severity (error, warning, or recommendation).
- They can be sorted by their weight in the reports page.
- Requirements can be grouped, and they will show up in the report under the same fieldset. _Requirement groups_ are also
plugins.

The minimal annotation that your requirement class must have is:

```php
/**
 * @Requirement(
 *   id="requirement_a",
 *   label="Requirement A",
 *   description="Lorem ipsum.",
 *   action_button_label="Fix it"
 * )
 */
 ```
An example of the annotation with all of the available options:

```php
/**
 * @Requirement(
 *   id="requirement_a",
 *   group="my_module",
 *   label="Requirement A",
 *   description="Lorem ipsum.",
 *   action_button_label="Fix it"
 *   severity="error",
 *   weight=100,
 *   dependencies={
 *      "prerequirement_1",
 *      "prerequirement_2"
 *   }
 * )
 */
 ```

To create a new requirement, create a new class in your module under `src/Plugin/Requirement/Requirement/`. Example
`src/Plugin/Requirement/Requirement/RequirementA.php`:

```php
<?php

namespace Drupal\my_module\Plugin\Requirement\Requirement;

use Drupal\Core\Form\FormStateInterface;
use Drupal\requirement\Annotation\Requirement;
use Drupal\requirement\Plugin\RequirementBase;

/**
 * @Requirement(
 *   id="requirement_a",
 *   group="my_module",
 *   label="Requirement A",
 *   description="Create and setup the default content type used for MY_MODULE.",
 *   severity="error",
 *   action_button_label="Create content type"
 * )
 */
class RequirementA extends RequirementBase {

  /**
   * Build the configuration form.
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array {
    $form['info'] = [
      '#type' => 'html_tag',
      '#tag' => 'h3',
      '#value' => $this->t('A new content type will be created and used as the default for MY_MODULE.'),
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => t('Name of new content type'),
      '#required' => TRUE,
    ];
    $form['machine_name'] = [
      '#type' => 'machine_name',
      '#title' => t('Machine name of new content type'),
      '#required' => TRUE,
      '#machine_name' => [
        'exists' => ['Drupal\node\Entity\NodeType', 'load'],
        'source' => ['name'],
      ],
    ];

    return $form;
  }

  /**
   * Submit handler - do something that will implement the requirement.
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $content_type = \Drupal\node\Entity\NodeType::create([
      'type' => $form_state->getValue('machine_name'),
      'name' => $form_state->getValue('name'),
    ]);
    $content_type->save();

    $config_factory = \Drupal::configFactory();
    $config_factory->getEditable('mymodule.settings')
      ->set('type', $content_type->id())
      ->save();
  }

  /**
   * Check if this requirement has been completed and can be checked off.
   *
   * @return bool
   */
  public function isCompleted(): bool {
    $config_factory = \Drupal::configFactory();
    $type = $config_factory->get('mymodule.settings')->get('type');
    $types = \Drupal::entityTypeManager()
      ->getStorage('node_type')
      ->loadMultiple();
    return !empty($type) && in_array($type, array_keys($types));
  }

  /**
   * Check if this requirement should only be validated under certain conditions.
   *
   * @return bool
   */
  public function isApplicable(): bool {
    return $this->getModuleHandler()->moduleExists('node');
  }

}

```

To create a new requirement group, create a new class in your module under `src/Plugin/Requirement/RequirementGroup/`.
Example `src/Plugin/Requirement/RequirementGroup/MyModuleGroup.php`:

```php
<?php

namespace Drupal\my_module\Plugin\Requirement\RequirementGroup;

use Drupal\requirement\Plugin\RequirementGroupBase;

/**
 * Requirement group for my_module requirements.
 *
 * @RequirementGroup(
 *   id = "my_module",
 *   label = "My Module",
 *   description = "Review the following configuration.",
 * )
 */
class MyModuleGroup extends RequirementGroupBase {}

```
