<?php

namespace Drupal\password_policy\Wizard;


use Drupal\ctools\Wizard\EntityFormWizardBase;

class PasswordPolicyWizard extends EntityFormWizardBase {
  /**
   * The machine name of the entity type.
   *
   * @return string
   */
  public function getEntityType() {
    return 'password_policy';
  }

  /**
   * A method for determining if this entity already exists.
   *
   * @return callable
   *   The callable to pass the id to via typical machine_name form element.
   */
  public function exists() {
    return '\Drupal\password_policy\Entity\PasswordPolicy::load';
  }

  /**
   * The fieldset #title for your label & machine name elements.
   *
   * @return string
   */
  public function getWizardLabel() {
    return $this->t('Password Policy');
  }

  /**
   * The form element #title for your unique identifier label.
   *
   * @return string
   */
  public function getMachineLabel() {
    return $this->t('Policy Name');
  }

  /**
   * {@inheritdoc}
   */
  public function getOperations($cached_values) {
    return [
      'general' => [
        'title' => $this->t('General Info'),
        'form' => 'Drupal\password_policy\Form\PasswordPolicyGeneralForm',
      ],
      'constraint' => [
        'title' => $this->t('Configure Constraints'),
        'form' => 'Drupal\password_policy\Form\PasswordPolicyConstraintForm',
      ],
      'roles' => [
        'title' => $this->t('Apply to Roles'),
        'form' => 'Drupal\password_policy\Form\PasswordPolicyRolesForm',
      ],
    ];
  }

  /**
   * The name of the route to which forward or backwards steps redirect.
   *
   * @return string
   */
  public function getRouteName() {
    return 'entity.password_policy.wizard.edit';
  }

}
