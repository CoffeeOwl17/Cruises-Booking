<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use Config;
use URL;

session_start();

class book_controller extends Controller
{
	private $_api_context;

    public function __construct()
    {
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig(
        		array(
			        /**
			         * Available option 'sandbox' or 'live'
			         */
			        'mode' => 'sandbox',

			        /**
			         * Specify the max request time in seconds
			         */
			        'http.ConnectionTimeOut' => 30,

			        /**
			         * Whether want to log to a file
			         */
			        'log.LogEnabled' => true,

			        /**
			         * Specify the file that want to write on
			         */
			        'log.FileName' => storage_path() . '/logs/paypal.log',

			        /**
			         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
			         *
			         * Logging is most verbose in the 'FINE' level and decreases as you
			         * proceed towards ERROR
			         */
			        'log.LogLevel' => 'FINE'
			    )
        	);
    }

    public function index(){
    	$_SESSION['cruise_select'] = $_POST['cruiseOption'];
    	return view('Book.book_cruise');
    }

    public function setInfo(){
    	$cruise = App\cruise::where('cruise_id', $_SESSION['cruise_select'])->first();
    	$stateroom = App\stateroom::where('stateroom_id', $_POST['stateroomOption'])->first();
    	$num_stateroom = $_POST['numStateroomOption'];
    	$num_guest = $_POST['guestOption'];
    	$total = $cruise->price + ($stateroom->price * $num_stateroom) + ($num_guest * 100);
    	$gst = round($total*0.06,2);
    	$grand_total = $total + $gst;
    	$data = array(
    		"cruise" 		=> $cruise,
    		"stateroom"		=> $stateroom,
    		"num_stateroom" => $num_stateroom,
    		"num_guest"		=> $num_guest,
    		"total"			=> $total,
    		"gst"			=> $gst,
    		"grand_total"	=> $grand_total
    		);

    	$_SESSION['cruise']			= $cruise->cruise;
    	$_SESSION['cruise_price']	= $cruise->price;
    	$_SESSION['stateroom'] 		= $stateroom->stateroom;
    	$_SESSION['stateroom_id'] 	= $stateroom->stateroom_id;
    	$_SESSION['stateroom_price']= $stateroom->price;
    	$_SESSION['num_stateroom'] 	= $num_stateroom;
    	$_SESSION['num_guest'] 		= $num_guest;
    	$_SESSION['total']			= $total; 
    	$_SESSION['grand_total']	= $grand_total; 
    	return view('Book.payment', $data);
    }

    public function makePayment(){
    	$record = new App\user_cruise;
    	$record->oauthID = $_SESSION['user_id'];
    	$record->cruise_id = $_SESSION['cruise_select'];
    	$record->stateroom_id = $_SESSION['stateroom_id'];
    	$record->num_guest = $_SESSION['num_guest'];
    	$record->num_stateroom = $_SESSION['num_stateroom'];

    	$saved = $record->save();
    	if($saved){
    		return redirect('/');
    	}
    	else{
    		return ('booking fail');
    	}

  //   	$payer = new Payer();
		// $payer->setPaymentMethod("paypal");


		// $guest = new Item();
		// $guest->setName('Guests')
		//     ->setCurrency('RM')
		//     ->setQuantity($_SESSION['num_guest'])
		//     ->setSku("") // Similar to `item_number` in Classic API
		//     ->setPrice(100);

		// $cruise = new Item();
		// $cruise->setName($_SESSION['cruise'])
		//     ->setCurrency('RM')
		//     ->setQuantity(1)
		//     ->setSku($_SESSION['cruise_select']) // Similar to `item_number` in Classic API
		//     ->setPrice($_SESSION['cruise_price']);

		// $stateroom = new Item();
		// $stateroom->setName($_SESSION['stateroom'])
		//     ->setCurrency('RM')
		//     ->setQuantity($_SESSION['num_stateroom'])
		//     ->setSku($_SESSION['stateroom_id']) // Similar to `item_number` in Classic API
		//     ->setPrice($_SESSION['stateroom_price']);

		// $itemList = new ItemList();
		// $itemList->setItems(array($cruise, $stateroom, $guest));

		// $details = new Details();
		// $details->setTax(0.06)
		//     ->setSubtotal($_SESSION['total']);

		// $amount = new Amount();
		// $amount->setCurrency("RM")
		//     ->setTotal($_SESSION['grand_total'])
		//     ->setDetails($details);

		// $transaction = new Transaction();
		// $transaction->setAmount($amount)
		//     ->setItemList($itemList)
		//     ->setDescription("Payment description")
		//     ->setInvoiceNumber(uniqid());

		// $redirect_urls = new RedirectUrls();
  //   	$redirect_urls->setReturnUrl(URL::route('payment.status'))
  //       	->setCancelUrl(URL::route('payment.status'));
		
		// $payment = new Payment();
	 //    $payment->setIntent('Sale')
	 //        ->setPayer($payer)
	 //        ->setRedirectUrls($redirect_urls)
	 //        ->setTransactions(array($transaction));

		// try {
	 //        $payment->create($this->_api_context);
	 //    } catch (\PayPal\Exception\PPConnectionException $ex) {
	 //        if (\Config::get('app.debug')) {
	 //            echo "Exception: " . $ex->getMessage() . PHP_EOL;
	 //            $err_data = json_decode($ex->getData(), true);
	 //            exit;
	 //        } else {
	 //            die('Some error occur, sorry for inconvenient');
	 //        }
	 //    }

	 //    foreach($payment->getLinks() as $link) {
	 //        if($link->getRel() == 'approval_url') {
	 //            $redirect_url = $link->getHref();
	 //            break;
	 //        }
	 //    }

	 //    // add payment ID to session
	 //    $_SESSION['paypal_payment_id'] = $payment->getId();

	 //    // return ($redirect_url);
	 //    if(isset($redirect_url)) {
	 //        // redirect to paypal
	 //        return redirect($redirect_url);
	 //    }

	 //    return Redirect::route('original.route')
	 //        ->with('error', 'Unknown error occurred');
    }

}
