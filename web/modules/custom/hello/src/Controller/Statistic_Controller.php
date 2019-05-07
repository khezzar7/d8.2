<?php

namespace Drupal\hello\Controller;
use Drupal\user\UserInterface;

use Drupal\Core\Controller\ControllerBase;

  class Statistic_Controller extends ControllerBase{

    public function content(UserInterface $user){
      $results=\Drupal::database()->select('hello_user_statistics','hus')
        ->fields('hus',['action','time'])
        ->condition('uid', $user->id())
        ->execute();
      $rows = [];
      $count= 0;

      foreach ($results as $record){

        $rows[]= [
          $record -> action =='1' ? $this->t('Login'): $this->t('Logout'),
         \Drupal::service('date.formatter')->format( $record -> time),
          ];
          $count+= $record-> action;

      }




      return[
        'output' => array(
          '#theme'=>'hello_user_connexion',
          '#user'=>$user->label(),
          '#count'=>$count,

        ),
        'table'=> array (
        '#type' => 'table',
        '#header' => [$this->t('Action'),$this->t('Time')],
        '#rows' => $rows,
          ),
      ];

    }


  }