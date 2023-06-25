<?php 

namespace Drupal\helloworld\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class HelloworldSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'helloworld_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['helloworld.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['hello_field'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Hello Field'),
      '#default_value' => $this->config('helloworld.settings')->get('hello_field'),
    ];    

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $user = \Drupal::currentUser();
    // User has permission to edit the configuration page.
    if ($user->hasPermission('administer custom module') || $user->hasPermission('administer site configuration')) {
      $this->config('helloworld.settings')
      ->set('hello_field', $form_state->getValue('hello_field'))
      ->save();
    }

    elseif ($user->hasPermission('view custom module config page')){
      return;

    }
    parent::submitForm($form, $form_state);
  }
  
}