<?php
namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
/**
 *Provides a hello block.
 *
 * @Block(
 *  id = "hello_block",
 *  admin_label = @Translation("Hello!")
 * )
 */
class hello extends BlockBase {
 /**
  *Implements Drupal\Core\Block\BlockBase::build()
 */
 public function build() {
  $build = array (
  '#markup' => $this ->t('Welcome  in our site @name ! Is @time.',[
    '@name'=>\Drupal::currentUser()->getDisplayName(),
    '@time'=>\Drupal::service('date.formatter')->format(\Drupal::service('datetime.time')->getCurrentTime(),'custom','H:i s\s')
  ]),
  '#cache'=>[
    'keys'=>['hello:hello_block'],
    'max-age'=>'1000',
    'contexts'=>['user'],
    ],
);
   return $build;
 }
}
