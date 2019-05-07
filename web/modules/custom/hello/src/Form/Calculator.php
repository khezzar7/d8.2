<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

  /**
   * Implements a hello form.
   */

class Calculator extends FormBase{

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

    $result= $form_state->getRebuildInfo();
    if(isset($result['result'])){
      $form['result']=array(
        '#type'=> 'html_tag',
        '#tag'=> 'h2',
        '#value'=> 'Result:'.$result['result']

      );
    }

    $form['value1']= array(
      '#type'=> 'textfield',
      '#title' => $this ->t('First value'),
      '#required'=> 'TRUE',
    );

    $form ['operator']= array(
      '#type'=> 'radios',
      '#options' => array(
        '+'=> $this->t('Add'),
        '-'=> $this->t('Substract'),
        '*'=> $this->t('Multiply'),
        '/'=> $this->t('Divide'),
      ),
      '#title' => $this ->t('Operator'),
      '#required'=> 'TRUE',
      '#description'=>$this->t('choose operation for processing'),
    );

    $form['value2']= array(
      '#type'=> 'textfield',
      '#title' => $this ->t('Second value'),
      '#required'=> 'TRUE',
      '#description'=>$this->t('enter second value.'),

    );


    $form['operation']=array(
      '#type'=> 'submit',
      '#value'=> $this->t('Calculate'),
    );




    return $form;
  }

    /**
     * {@inheritdoc}.
     */
  public function submitForm(array &$form, FormStateInterface $form_state){

    $value_1 = $form_state -> getValue('value1');
    $value_2 = $form_state -> getValue('value2');
    $operator = $form_state->getValue('operator');
    $operation = $form_state->getValue('operation');
    if($operator == '+'){

     $result=$value_1 + $value_2;
    }
    elseif($operator == '-'){

      $result= $value_1 - $value_2;
    }
    elseif($operator == '*'){

      $result=$value_1 * $value_2;
    }
    else($operator == '/'){

      $result=$value_1 / $value_2
    };

   $form_state->addRebuildInfo('result',$result);
   $form_state->setRebuild('hello.page');

   //Enregistrement de l'heure de soumission avec state API
   $state = \Drupal::state();
    $state->set('hello_last_use_calculator', \Drupal::service('datetime.time')->getCurrentTime());

  }
    /**
     * {@inheritdoc}.
     */
  public function validateForm(array &$form, FormStateInterface $form_state) {

   $value_1 = $form_state -> getValue('value1');
   $value_2 = $form_state -> getValue('value2');
   $operator = $form_state -> getValue('operator');

   if(!is_numeric($value_1)){
      $form_state->setErrorByName('value1', $this->t('Value 1 must be numeric!'));

   }
    if(!is_numeric($value_2)){
      $form_state->setErrorByName('value2', $this->t('Value  2 must be numeric!'));

    }
   if($operator=='/' && $value_2 == 0){
     $form_state->setErrorByName('value2', $this->t('The value 2 must be different of 0 for the divide!'));

   }
   if(isset($form['result'])){
     unset($form['result']);
   }
  }

}