<?php

  namespace Drupal\hello\Form;

  use Drupal\Core\FormBase;
  use Drupal\Core\Form\FormStateInterface;

  /**
   * Implements a hello form.
   */

  class CalculatorForm extends FormBase{

    /**
     * {@inheritdoc}.
     */
  public function getFormId(){
    return 'hello_form';
  }

    /**
     * {@inheritdoc}.
     */
  public function buildForm(array $form, FormStateInterface $form_state){
    return $form;
  }

    /**
     * {@inheritdoc}.
     */
  public function submitForm(array &$form, FormStateInterface $form_State){

  }
  }