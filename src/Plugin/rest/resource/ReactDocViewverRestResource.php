<?php

namespace Drupal\react_doc_viewer\Plugin\rest\resource;

use Drupal;
use Drupal\rest\ModifiedResourceResponse;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "react_doc_viewver_rest_resource",
 *   label = @Translation("React doc viewver rest resource"),
 *   uri_paths = {
 *     "canonical" = "/react-doc-viewver/{fid}"
 *   }
 * )
 */
class ReactDocViewverRestResource extends ResourceBase
{

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
  {
    $instance = parent::create($container, $configuration, $plugin_id, $plugin_definition);
    $instance->logger = $container->get('logger.factory')->get('react_doc_viewer');
    $instance->currentUser = $container->get('current_user');
    return $instance;
  }

  /**
   * Responds to GET requests.
   *
   * @param string $fid
   *
   * @return \Drupal\rest\ResourceResponse
   *   The HTTP response object.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get($fid)
  {

        if (!$this->currentUser->hasPermission('access page file viewe')) {
            throw new AccessDeniedHttpException();
        }

    $file = Drupal::entityTypeManager()->getStorage('file')->load($fid);
    if ($file) {
      $base_url = Drupal::request()->getSchemeAndHttpHost();
      $getUrl = $file->createFileUrl();
      $fileName = $file->getFilename();
      $type = explode('.', $fileName)[1];
     $outPut = [
       'url' =>  $base_url.$getUrl,
       'type' => $type,
      ];
      return new ModifiedResourceResponse($outPut, 200);
    } else {
      return new ResourceResponse(['message' => 'File not found'] , 404);
    }

  }

}
