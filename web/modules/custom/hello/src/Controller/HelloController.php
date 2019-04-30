<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloController extends ControllerBase {

  public function content($param=''){

    $message= $this->t('Your are in Hello page. Your name is @username! @param',[
      '@username' => $this->currentUser()->getDisplayName(),
      '@param'=>$param,
    ]);

    return['#markup' => $message];
  }
}
