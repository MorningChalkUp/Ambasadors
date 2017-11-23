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
    $amb['full_state'] = getStateName($amb['state']);
    $address = array(
      'address1' => $amb['address'],
      'city' => $amb['city'],
      'province' => $amb['full_state'],
      'zip' => $amb['zip'],
      'first_name' => $amb['fname'],
      'last_name' => $amb['lname'],
      'country_code' => 'US',
      'country_name'  => 'United States',
      'country' =>  'united states',
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

function getStateName($state) {
  $states_array = array(
    'AL'=>'Alabama',
    'AK'=>'Alaska',
    'AZ'=>'Arizona',
    'AR'=>'Arkansas',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DE'=>'Delaware',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'IA'=>'Iowa',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'ME'=>'Maine',
    'MD'=>'Maryland',
    'MA'=>'Massachusetts',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MS'=>'Mississippi',
    'MO'=>'Missouri',
    'MT'=>'Montana',
    'NE'=>'Nebraska',
    'NV'=>'Nevada',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NY'=>'New York',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VT'=>'Vermont',
    'VA'=>'Virginia',
    'WA'=>'Washington',
    'WV'=>'West Virginia',
    'WI'=>'Wisconsin',
    'WY'=>'Wyoming',
    'AS'=>'American Samoa',
    'DC'=>'District of Columbia',
    'FM'=>'Federated States of Micronesia',
    'GU'=>'Guam',
    'MH'=>'Marshall Islands',
    'MP'=>'Northern Mariana Islands',
    'PW'=>'Palau',
    'PR'=>'Puerto Rico',
    'VI'=>'Virgin Islands',
    'AA'=>'U.S. Armed Forces – Americas',
    'AE'=>'U.S. Armed Forces – Europe',
    'AP'=>'U.S. Armed Forces – Pacific',
  );

  return $states_array[$state];
}
