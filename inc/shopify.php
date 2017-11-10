<?php

require 'shopify/vendor/autoload.php';
use PHPShopify\ShopifySDK;

function sendShopifyOrder($amb, $productID) {
  $config = array(
    'ShopUrl' => SHOPIFY_URL,
    'ApiKey' => SHOPIFY_API_KEY,
    'Password' => SHOPIFY_API_PW,
  );
  $shopify = new PHPShopify\ShopifySDK($config);

  if ($amb['sid'] == 4) {
    $shirt['size'] = $amb['shirt_size'];
    $shirt['type'] = $amb['shirt_type'];
  } else {
    $shirt = null;
  }

  $varientID = getProductVarient($productID, $shirt);

  $lineItem[] = array(
    "variant_id" => $varientID,
    "quantity" => 1,
  );

  $shopifyID = getShopifyCustomerID($amb['email']);

  if (!$shopifyID) {
    $address = array(
      'address1' => $amb['address'],
      'city' => $amb['city'],
      'state' => $amb['state'],
      'zip' => $amb['zip'],
      'first_name' => $amb['fname'],
      'last_name' => $amb['lname'],
      'country' => 'US',
    );
    $customer = array(
      'first_name' => $amb['fname'],
      'last_name' => $amb['lname'],
      'email' => $amb['email'],
      'tags' => 'Ambassador',
    );
    $order['customer'] = $customer;
    $order['billing_address'] = $address;
    $order['shipping_address'] = $address;
    $order['email'] = $amb['email'];
  } else {
    $customer = array(
      'id' => $shopifyID,
      'tags' => 'Ambassador',
    );
    $order['customer'] = $customer;
  }

  $order['line_items'] = $lineItem;
  $order['financial_status'] = 'paid';
  $order['tags'] = 'Ambassadors';

  $r = $shopify->Order->post($order);

}

function getShopifyCustomerID($email) {
  $config = array(
    'ShopUrl' => SHOPIFY_URL,
    'ApiKey' => SHOPIFY_API_KEY,
    'Password' => SHOPIFY_API_PW,
  );
  $shopify = new PHPShopify\ShopifySDK($config);

  $r = $shopify->Customer->search("email:" . $email);
  
  if ($r) {
    return $r[0]['id'];
  }
  return false;
}

function getProductVarient($productID, $shirt = null) {
  $config = array(
    'ShopUrl' => SHOPIFY_URL,
    'ApiKey' => SHOPIFY_API_KEY,
    'Password' => SHOPIFY_API_PW,
  );
  $shopify = new PHPShopify\ShopifySDK($config);

  $r = $shopify->Product($productID)->get();

  if ($productID != '375697342492') {
    return $r['variants'][0]['id'];
  } else {
    foreach ($r['variants'] as $variant) {
      if ($variant['option1'] == $shirt['size']) {
        if ($variant['option2'] == $shirt['type']) {
          return $variant['id'];
        }
      }
    }
  }
  return false;
}


