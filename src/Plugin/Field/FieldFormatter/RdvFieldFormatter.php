<?php

namespace Drupal\react_doc_viewer\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Render\Element\Html;
use Drupal\file\Entity\File;
use Drupal\file\Plugin\Field\FieldFormatter\FileFormatterBase;

/**
 * Plugin implementation of the 'rdv_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "rdv_field_formatter",
 *   label = @Translation("Rdv field formatter"),
 *   field_types = {
 *     "file"
 *   }
 * )
 */
class RdvFieldFormatter extends FileFormatterBase
{

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode)
  {
    $elements = [];
    foreach ($items as $delta => $item) {
      $file = FILE::load($item->target_id);
      if ($file) {
        $elements[$delta] = [
          '#theme' => 'rdv',
          '#fid' => $item->target_id,
          '#file_name' => $file->getFilename(),
          '#attributes' => [
            'class' => ['file-link'],
          ],
        ];
      } else {
        $elements[$delta] = [
          '#markup' => $this->t('File not found'),
        ];
      }

    }

    return $elements;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  protected function viewValue(FieldItemInterface $item)
  {
    // The text value has no text format assigned to it, so the user input
    // should equal the output, including newlines.
    return nl2br(Html::escape($item->value));
  }

}
