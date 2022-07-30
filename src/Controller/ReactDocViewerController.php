<?php

namespace Drupal\react_doc_viewer\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for react doc viewer routes.
 */
class ReactDocViewerController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
    return [
      '#markup' => '<div id="rdv-main__react"></div>',
      '#attached' => [
        'library' => 'react_doc_viewer/react_doc_viewer'
      ]
    ];
  }

  public function getTitle()
  {
    $fid = \Drupal::routeMatch()->getParameter('fid');
    $file = \Drupal\file\Entity\File::load($fid);
    return $file->getFilename();
  }

}
