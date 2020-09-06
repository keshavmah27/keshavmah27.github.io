<?php

/*
 * CKEditor helper for CodeIgniter
 * 
 * 
 * @package API CodeIgniter
 * 
 */

/**
 * This function adds once the CKEditor's config vars
 * @author Hardik Patel
 * @access private
 * @param array $data (default: array())
 * @return string
 */
    function createStripeAccount($dataArray = []) {
        require_once(APPPATH . 'libraries/Stripe/init.php');
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);


        try {
            $stripeCustomers = \Stripe\Customer::create([
                        "email" => $dataArray['email'],
                        "description" => "Customer: " . $dataArray['vanueName'],
            ]);
            $accountId = $stripeCustomers['id'];

            return array("status" => true, "accountId" => $accountId);
        } catch (Exception $e) {
            return array("status" => false, "stripeError" => $e->getMessage());
        }
    }
    
    function saveCard($dataArray = []) {
        require_once(APPPATH . 'libraries/Stripe/init.php');
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);


        try {
            $stripeCardToken = \Stripe\Token::create([
                'card' => [
                    'number' => trim($dataArray['cardNumber']),
                    'exp_month' => $dataArray['cardExpMonth'],
                    'exp_year' => $dataArray['cardExpYear'],
                    'cvc' => $dataArray['cardCvv']
                ]
            ]);
            
            $cardToken = $stripeCardToken['id'];
            //echo $dataArray['stripeCustomerId']; die;
            $customer = \Stripe\Customer::retrieve($dataArray['stripeCustomerId']);
            $stripeCard = $customer->sources->create(
                [
                  'source' => $cardToken,
                ]
            );
            
            if(isset($dataArray['isDefault']) && $dataArray['isDefault'] == 1){
                /*$stripeCardToken = \Stripe\Token::create([
                    'card' => [
                        'number' => trim($dataArray['cardNumber']),
                        'exp_month' => $dataArray['cardExpMonth'],
                        'exp_year' => $dataArray['cardExpYear'],
                        'cvc' => $dataArray['cardCvv']
                    ]
                ]);*/
                \Stripe\Customer::update($dataArray['stripeCustomerId'], [
                    'default_source' => $stripeCard['id'],
                ]);
            }
            
            //echo $stripeCard['id']; die;
            return array("status" => true, "cardId" => $stripeCard['id']);
        } catch (Exception $e) {
            //echo $e->getMessage(); die;
            return array("status" => false, "stripeError" => $e->getMessage());
        }
    }
    
    function getCardDetails($customerId, $cardId) {
        require_once(APPPATH . 'libraries/Stripe/init.php');
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);


        try {
            $customer = \Stripe\Customer::retrieve($customerId);
            $card = $customer->sources->retrieve($cardId);
            
            $responseArray = [];
            $responseArray['cardNumber'] = $card['last4'];
            $responseArray['brand'] = $card['brand'];
            $responseArray['expMonth'] = $card['exp_month'];
            $responseArray['expYear'] = $card['exp_year'];
            //echo $stripeCard['id']; die;
            return array("status" => true, "cardDetails" => $responseArray);
        } catch (Exception $e) {
            //echo $e->getMessage(); die;
            return array("status" => false, "stripeError" => $e->getMessage());
        }
    }
    
    function removeCardDetails($customerId, $cardId) {
        require_once(APPPATH . 'libraries/Stripe/init.php');
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);


        try {
            \Stripe\Customer::deleteSource(
                $customerId,
                $cardId
              );
            //echo $stripeCard['id']; die;
            return array("status" => true, "cardDetails" => $responseArray);
        } catch (Exception $e) {
            //echo $e->getMessage(); die;
            return array("status" => false, "stripeError" => $e->getMessage());
        }
    }
    
    function purchaseSubscription($requestArray = []){
        require_once(APPPATH . 'libraries/Stripe/init.php');
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

        try {
            $stripeParentCharge = \Stripe\Charge::create([
                "amount" => (int)$requestArray['amount'] * 100,
                "currency" => "aud",
                "customer" => $requestArray['customerId'],
                "source" => $requestArray['cardId'], //$stripeToken, // obtained with Stripe.js
                "description" => $requestArray['description'],
                //"capture" => true
            ]);

            $transactionId = $stripeParentCharge['id'];
            
            //echo $stripeCard['id']; die;
            return array("status" => true, "transactionId" => $transactionId);
        } catch (Exception $e) {
            //echo $e->getMessage(); die;
            return array("status" => false, "stripeError" => $e->getMessage());
        }
    }

    function create_token($cardnumber, $month, $year, $cvv) {
        require_once(APPPATH . 'libraries/Stripe/init.php');
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);


        try {
            $result = \Stripe\Token::create(array("card" => array("number" => $cardnumber, "exp_month" => $month, "exp_year" => $year, "cvc" => $cvv)));

            return array("status" => true, "token" => $result->id);
        } catch (Exception $e) {
            return array("status" => false, "stripeError" => $e->getMessage());
        }
    }

    function create_charge($token, $price, $description) {
        require_once(APPPATH . 'libraries/Stripe/init.php');
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);


        try {
            $charge = \Stripe\Charge::create(array(
                        "amount" => ($price * 100),
                        "currency" => STRIPE_CURRENCY,
                        "source" => $token,
                        "description" => $description
            ));

            if ($charge->status == "succeeded") {
                return array("status" => true, "chargeData" => $charge);
            } else {
                return array("status" => false, "stripeError" => STRIPE_PAYMENT_ISSUE);
            }
        } catch (Stripe_CardError $e) {
            return array("message" => STRIPE_PAYMENT_FAILED, "status" => false, "stripeError" => $e->getMessage());
        } catch (Stripe_InvalidRequestError $e) {
            return array("message" => STRIPE_WRONG_PARAMETER, "status" => false, "stripeError" => $e->getMessage()); // Invalid parameters were supplied to Stripe's API
        } catch (Stripe_AuthenticationError $e) {
            return array("message" => STRIPE_WRONG_TOKEN, "status" => false, "stripeError" => $e->getMessage()); // Authentication with Stripe's API failed // (maybe you changed API keys recently)
        } catch (Stripe_ApiConnectionError $e) {
            return array("message" => STRIPE_WRONG_SERVER, "status" => false, "stripeError" => $e->getMessage()); // Network communication with Stripe failed
        } catch (Stripe_Error $e) {
            return array("message" => STRIPE_WRONG_CONTACT, "status" => false, "stripeError" => $e->getMessage()); // Display a very generic error to the user, and maybe send // yourself an email
        } catch (Exception $e) {
            return array("message" => STRIPE_WRONG_CONTACT, "status" => false, "stripeError" => $e->getMessage()); // Something else happened, completely unrelated to Stripe
        }
    }

    function refund($stripeToken) {
        try {
            require_once(APPPATH . 'libraries/Stripe/init.php');
            \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
            $charge = \Stripe\Refund::create(array(
                        "charge" => $stripeToken,
                        "reverse_transfer" => true,
            ));
            return array("status" => true, "chargeData" => $charge);
        } catch (Stripe_CardError $e) {
            return array("message" => STRIPE_PAYMENT_FAILED, "status" => false, "stripeError" => $e->getMessage());
        } catch (Stripe_InvalidRequestError $e) {
            return array("message" => STRIPE_WRONG_PARAMETER, "status" => false, "stripeError" => $e->getMessage());
        } catch (Stripe_AuthenticationError $e) {
            return array("message" => STRIPE_WRONG_TOKEN, "status" => false, "stripeError" => $e->getMessage());
        } catch (Stripe_ApiConnectionError $e) {
            return array("message" => STRIPE_WRONG_SERVER, "status" => false, "stripeError" => $e->getMessage());
        } catch (Stripe_Error $e) {
            return array("message" => STRIPE_WRONG_CONTACT, "status" => false, "stripeError" => $e->getMessage());
        } catch (Exception $e) {
            return array("message" => STRIPE_WRONG_CONTACT, "status" => false, "stripeError" => $e->getMessage());
        }
    }
