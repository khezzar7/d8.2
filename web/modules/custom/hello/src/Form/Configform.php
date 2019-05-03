<?php

namespace Drupal\hello\form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Implements an config form.
 */

class Configform extends ConfigFormBase{


  /**
   * {@inheritedoc}.
   */
  public function getFormId() {
    return 'config_form';
  }

  /**
   * {@inheritedoc}.
   */
  public function getEditableConfigNames() {

    \Drupal::configFactory()->getEditable('hello.settings')->save();
    return ['hello.settings'];
  }

  /**
   * {@inheritedoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {



    $form ['period']= array(
      '#title'=>$this->t('How long to keep user activity statictis'),
      '#default_value'=> $this->config('hello.settings')->get('purge_days_number'),
      '#type'=> 'select',
      '#options' => array(
        '0'=> $this->t('never purge'),
        '1'=> $this->t('1 day'),
        '2'=> $this->t('2 days'),
        '7'=> $this->t('7 days'),
        '14'=> $this->t('14 days'),
        '30'=> $this->t('30 days'),
      ),
  );
    return parent::buildForm($form,$form_state);
  }

  /**
   * {@inheritedoc}.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $value= $form_state->getValue('period');
    $this->config('hello.settings')->set('purge_days_number',$value)->save();

     parent::submitForm($form,$form_state);
  }
}