<?php

namespace Drupal\perf\Service;

use Drupal\Core\Session\AccountProxy;

/**
 * Class PerfLazyBuilder.
 */
class PerfLazyBuilder {
  protected $current_user;

  /**
   * Constructs a new PerfLazyBuilder object.
   */
  public function __construct(AccountProxy $current_user) {
    $this->current_user=$current_user;

  }
  public function render(){
    return ['#markup' =>t( 'Welcolme on the block perf'),];
  }

}
