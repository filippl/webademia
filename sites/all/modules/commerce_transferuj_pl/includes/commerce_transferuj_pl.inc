<?php
/**
 * @file
 * Implements transferuj.pl Payments in Drupal Commerce checkout.
 */

function commerce_transferuj_pl_verify() {
  if (!empty($_POST)) {
    $order_id = explode(':', $_POST['tr_crc']);
    $order_id = intval($order_id[0]);
    $order = commerce_order_load($order_id);
    $payment_method_instance_id = $order->data['payment_method'];
    $payment_method = commerce_payment_method_instance_load($payment_method_instance_id);

    $sid = $payment_method['settings']['sid'];
    $tr_id = intval($_POST['tr_id']);
    $tr_amount = floatval($_POST['tr_amount']);
    $tr_crc = $_POST['tr_crc'];
    $kod = $payment_method['settings']['cod'];
    $tr_paid = $_POST['tr_paid'];
    $status_transakcji = $_POST['tr_status'];

    if ($sid != $payment_method['settings']['sid']) {
      $watchdog_variables['@pos_id'] = $sid;
      watchdog('commerce_transferuj_pl', 'ERROR bad pos_id: @pos_id.', $watchdog_variables, WATCHDOG_WARNING);
      print t('ERROR BAD pos_id: @pos_id.', $watchdog_variables);
      exit();
    }

    if (in_array($_SERVER['REMOTE_ADDR'], explode(',', $payment_method['settings']['ip']))) {
      if (md5($sid . $tr_id . $tr_amount . $tr_crc . $kod) == $_POST['md5sum']) {
        $watchdog_variables = array('@session_id' => $session_id);
        $watchdog_urls = '';

        if (empty($transaction)) {
          $transaction = commerce_payment_transaction_new('transferuj_pl', $order_id);
          $transaction->created = time();
        }
        $transaction->instance_id = $payment_method['instance_id'];

        $transaction->remote_id = $tr_id;
        $transaction->amount = $tr_amount;
        $transaction->currency_code = 'PL';
        $transaction->payload[REQUEST_TIME] = $_POST;

        $transaction->changed = time();

        $transaction->message = 'Status płatności: ' . $status_transakcji;

        switch ($_POST['tr_error']) {
          case 'overpay': // nadpłatata
          case 'surcharge': // niedopłata
            $transaction->status = COMMERCE_PAYMENT_STATUS_FAILURE;
            break;
          case 'none':
            if ($status_transakcji == 'TRUE') {
              $transaction->status = COMMERCE_PAYMENT_STATUS_SUCCESS;
              $order->status = 'completed';
            }
            break;
        }
        $transaction->remote_status = $transaction->status;
        commerce_payment_transaction_save($transaction);
      }
      ob_get_clean();
      echo "TRUE";
    }
  }
}