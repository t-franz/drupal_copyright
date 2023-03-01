<?php

namespace Drupal\custom_copyright\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;


/**
 * Provides an copyright block.
 *
 * @Block(
 *   id = "custom_copyright_block",
 *   admin_label = @Translation("Copyright with Year"),
 *   category = @Translation("Custom Copyright")
 * )
 */
class CopyrightBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $textline = $config['block_copyright_settings'];
    $copyright = '<p class="copyright">&copy;&nbsp;'.date("Y").'&nbsp;'.$textline.'</p>';
    $build['content'] = [
      '#markup' => $copyright,
    ];
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();

    $form['block_copyright_settings'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Textline'),
      '#default_value' => isset($config['block_copyright_settings']) ? $config['block_copyright_settings'] : '',
      '#description' => t('© 2022 Textline')
    ];
    return $form;
  }

/**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['block_copyright_settings'] = $values['block_copyright_settings'];
  }

}
