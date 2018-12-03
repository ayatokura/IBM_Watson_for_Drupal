<?php

namespace Drupal\ibm_watson\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure site information settings for this site.
 */
class IbmWatsonSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ibm_watson_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'ibm_watson.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ibm_watson.settings');

    $form['ibm_watson_api_endpoint'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Endpoint'),
      '#default_value' => $config->get('ibm_watson_api_endpoint'),
    ];
    $form['apikey'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Key'),
      '#default_value' => $config->get('ibm_watson_apikey'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $config = $this->config('ibm_watson.settings');
    $config->set('ibm_watson_api_endpoint', $values['ibm_watson_api_endpoint'])
      ->set('ibm_watson_apikey', $values['apikey'])
      ->save();

    parent::submitForm($form, $form_state);
  }

}
