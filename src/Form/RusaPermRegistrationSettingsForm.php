<?php

namespace Drupal\rusa_perm_reg\Form;

use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for a rusa perm registration entity type.
 */
class RusaPermRegistrationSettingsForm extends ConfigFormBase {

    /**
    * {@inheritdoc}
    */
    public function getFormId() {
        return 'rusa_perm_registration_settings';
    }

    /**
    * {@inheritdoc}
    */
    protected function getEditableConfigNames() {
        return ['rusa_perm_reg.settings'];
    }


    /**
    * {@inheritdoc}
    */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $config = $this->config('rusa_perm_reg.settings');

        // Build the form
                        
        $form['messages']['instructions'] = [
            '#type'      => 'textarea',
            '#title'     => 'Perm Program Registration form instructions',
            '#rows'      => 6,
            '#cols'      => 40,
            '#resizable' => 'both',
            '#default_value' => $config->get('instructions'), 
        ];

        $form['messages']['good_to_go'] = [
            '#type'      => 'textfield',
            '#title'     => 'Ready to ride message',
            '#size'      => 80,
            '#maxlength' => 255,
            '#default_value' => $config->get('good_to_go'),
            '#description'   => $this->t('This is the message they see if their registration is complete.'),
        ];

        $form['messages']['expired'] = [
            '#type'      => 'textfield',
            '#title'     => 'Registration expired message',
            '#size'      => 80,
            '#maxlength' => 255,
            '#default_value' => $config->get('expired'),
            '#description'   => $this->t('This is the message they see if their registration is expired.'),
        ];

        $form['messages']['no_payment'] = [
            '#type'      => 'textfield',
            '#title'     => 'No payment message',
            '#size'      => 80,
            '#maxlength' => 255,
            '#default_value' => $config->get('no_payment'),
            '#description'   => $this->t('This is the message they see if they have not submitted their payment.'),
        ];

        $form['messages']['yes_payment'] = [
            '#type'      => 'textfield',
            '#title'     => 'Payment received message',
            '#size'      => 80,
            '#maxlength' => 255,
            '#default_value' => $config->get('yes_payment'),
            '#description'   => $this->t('This is the message they see if their payment has been received.'),
        ];

      
      $form['actions'] = [
          '#type' => 'actions',
      ];

      $form['actions']['submit'] = [
          '#type' => 'submit',
          '#value' => $this->t('Save'),
      ];

      return $form;
  }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        $values = $form_state->getValues();

        $this->config('rusa_perm_reg.settings')
            ->set('instructions', $values['instructions'])
            ->set('no_payment',   $values['no_payment'])
            ->set('yes_payment',  $values['yes_payment'])
            ->set('expired',      $values['expired'])
            ->set('good_to_go',   $values['good_to_go'])           
            ->save();

        parent::submitForm($form, $form_state);
    }

}
