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

      foreach ($results as $record){
        $rows[]= [
          $record -> action =='1' ? $this->t('Login'): $this->t('Logout'),
         \Drupal::service('date.formatter')->format( $record -> time),
          ];
      }


      return [
        '#type' => 'table',
        '#header' => [$this->t('Action'),$this->t('Time')],
        '#rows' => $rows,
      ];

    }

  }