<?php 

namespace Drupal\helloworld\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class for handling the routes of helloworld module.
 */
class HelloController extends ControllerBase {
    /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */
  public function content() {
    $user = \Drupal::currentUser()->getAccountName();
    if (\Drupal::currentUser()->hasPermission('view custom module config page')) {
      return [
        '#type' => 'markup',
        '#markup' => $this->t('Hello,' . $user . '!'),
      ];
    }
    else {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('You do not have access to view Hello World page.'),
    ];
    }
  }

}
