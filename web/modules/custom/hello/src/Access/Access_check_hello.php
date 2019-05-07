<?php

namespace Drupal\hello\Access;




use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class Access_check_hello implements AccessCheckInterface {

  public function applies(Route $route) {
    return NULL;
  }

  public function access(Route $route, Request $request = NULL, AccountInterface $account) {

    $nbr_hours = $route->getRequirement('_access_hello');
  if (!$account->isAnonymous() && (\Drupal::time()->getCurrentTime() - $account->getAccount()->created >$nbr_hours * 3600)) {
      return AccessResult::allowed()->cachePerUser();
    }

      return AccessResult::forbidden()->cachePerUser();
  }
}