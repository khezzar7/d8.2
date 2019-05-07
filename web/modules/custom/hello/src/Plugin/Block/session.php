<?php
namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 *Provides a session block.
 *
 * @Block(
 *  id = "session_block",
 *  admin_label = @Translation("Session!")
 * )
 */
class session extends BlockBase {
 /**
  *Implements Drupal\Core\Block\BlockBase::build()
 */
 public function build() {
  $database= \Drupal::database();
  $build = array (
  '#markup' => $this ->t('They are @session sessions actives ! The time is: @time' ,[
    '@session'=>$database->select('sessions')->countQuery()->execute()->fetchField(),
    '@time'=>\Drupal::service('date.formatter')->format(\Drupal::service('datetime.time')->getCurrentTime(),'custom','H:i s\s')
  ]),
  '#cache'=>[
    'keys'=>['hello:session_block'],
    'max-age'=>'0',
    ],
);
   return $build;
 }

protected function blockAccess(AccountInterface $account) {
  return AccessResult::allowedIfHasPermission($account,'ma permission');

}

}
