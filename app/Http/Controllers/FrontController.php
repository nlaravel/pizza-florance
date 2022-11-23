<?php

namespace App\Http\Controllers;

use App\CalzoneCategry;
use App\CalzoneSize;
use App\Category;
use App\City;
use App\ContactUs;
use App\Invoice;
use App\Notifications\AddOrder;
use App\Order;
use App\OrderPizzaExtras;
use App\OrderPizzaSize;
use App\OrderSpecialPizzaSize;
use App\OrderSpecialPizzaTypes;
use App\PaymentMethods;
use App\Person;
use App\PizzaCategory;
use App\PizzaSize;
use App\Product;
use App\Setting;
use App\State;
use App\Term;
use App\Topping;
use App\User;
use App\ZipCode;
use App\Mail\VerifyOrder;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
class FrontController extends Controller
{

    public function index()
    {
        //dd(\Cart::content());
        $setting=Setting::first();
        $categories=Category::with('products')->get();
        $categories_mobile=Category::with('products')
            ->where('id','!=',18)
            ->where('id','!=',19)
            ->get();
        return view('front.index',compact('setting','categories','categories_mobile'));
    }

    public function contact_us()
    {
        $setting=Setting::first();

        return view('front.contact_us',compact('setting'));
    }

    public function storeContactUs(Request $request){

        $this->validate($request, [
            'email'      => 'required|email',
            'message'      => 'required',
        ]);

        $create = ContactUs::create([
            'email'=>$request->email,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ]);

        $message = 'تمت الاضافة بنجاح';
        $title = 'New Message From Contact Us';

        return response()->json(compact('message'));
    }

    public function terms_conditions()
    {
        $terms=Term::first();

        return view('front.terms_conditions',compact('terms'));
    }

    public function build_your_pizza()
    {
        $sizes=PizzaSize::all();
        $toppings=Topping::all();
        $types=PizzaCategory::where('parent_id',0)->orderby('id','desc')->with('childs')->get();
       // dd($type);

        return view('front.build_your_pizza',compact('types','sizes','toppings'));
    }

    public function build_your_calzone()
    {
        $sizes=CalzoneSize::all();
        $toppings=Topping::all();
        $types=CalzoneCategry::where('parent_id',0)->with('childs')->get();
        // dd($types);

        return view('front.build_your_calzone',compact('types','sizes','toppings'));
    }

    public function order_build_your_pizza(Request $request)
    {
        $this->validate($request, [
            'size'      => 'required',
        ],[],[
            'size'      => 'Please Choose size of pizza you want',
        ]);

        // dd($request->all());
    }

    public function product_category($id){
        $category=Category::where('id',$id)->first();
        $products=Product::where('is_special',0)->with('ingredients')->with('categories')->where('category_id',$id)->get();
        return view('front.product_category',compact('products','category'));
    }

    public function checkout()
    {

     $tips=session()->get('UserDetails')['tips_takeaway'];
        $states=State::all();
        $cities=City::with('states')->get();
        $payments=PaymentMethods::get();
        $setting=Setting::first();
        return view('front.checkouts',compact('payments','states','cities','setting','tips'));
    }
    public function pickup(Request $request)
    {
        $setting=Setting::first();

            $this->validate($request, [
                'email_1' => 'required',
                'first_name_1' => 'required',
                'last_name_1' => 'required',
                'phone_1' => 'required',
            ], [], [
                'email_1' => 'email',
                'first_name_1' => 'First Name',
                'last_name_1' => 'Last Name',
                'phone_1' => 'Phone',

            ]);
            if ($request->tips_takeaway) {
                $tips_takeaway = $request->tips_takeaway . '$' ?? 0 .'$';
                if (session()->get('couponAmount')) {
                    $cart_total=session()->get('couponAmount')+(session()->get('couponAmount')*($setting->tax /100));

                    $total=number_format((float)$cart_total + $request->tips_takeaway, 2, '.','');

                } else {
                    $cart_total=\Cart::total()+(\Cart::total()*($setting->tax /100));

                    $total=number_format((float)$cart_total + $request->tips_takeaway, 2, '.','');


                }
            } else {
                $tips_takeaway = $request->tips_1 . '%'?? 0 .'%';
                if (session()->get('couponAmount')) {
                    $sub_total =session()->get('couponAmount')+(session()->get('couponAmount')*($setting->tax /100));

                    $tips_value = session()->get('couponAmount') * ($request->tips_1 / 100);
                    $total=number_format((float) $sub_total + $tips_value, 2, '.','');

                } else {
                    $sub_total =\Cart::total()+(\Cart::total()*($setting->tax /100));
                    $tips_value = \Cart::total() * ($request->tips_1 / 100);
                    $total=number_format((float) $sub_total + $tips_value, 2, '.','');

                }
            }
            $user = [
                'first_name' => $request->first_name_1,
                'last_name' => $request->last_name_1,
                'phone' => $request->phone_1,
                'email' => $request->email_1,
                'tips' => $tips_takeaway,
                'is_delivery' => $request->is_delivery,
                'coupon_price' => session()->get('couponAmount'),
                'coupon_code' => session()->get('couponCode'),
                'delivery_cost' => 0 .'$',
                'tax' => $setting->tax .'%',
                'total' => $total,
            ];
        if($request->ajax()) {
            return ['data' => $user];
        }else{
            return $user;
        }

    }

    public function delivery(Request $request)
    {
        $setting=Setting::first();

        $this->validate($request, [
            'email'      => 'required',
            'first_name'      => 'required',
            'last_name'      => 'required',
            'address_1'      => 'required',
            'phone'      => 'required',
            'city_id'      => 'required',
            'zip_code'      => 'required',
        ],[],[
            'email'      => 'email',
            'first_name'      => 'First Name',
            'last_name'      => 'Last Name',
            'address_1'      => 'Address',
            'phone'      => 'Phone',
            'city_id'      => 'City',
            'zip_code'      => 'Zip Code',
        ]);
        if($request->tips_delivery){
            $tips_delivery=$request->tips_delivery. '$' ?? 0 .'$';
            if(session()->get('couponAmount')){
                $cart_total=session()->get('couponAmount')+(session()->get('couponAmount')*($setting->tax /100));
                $total=number_format((float)$setting->delivery_cost+$cart_total+$request->tips_delivery, 2, '.','');


            }else{
                $cart_total=\Cart::total()+(\Cart::total()*($setting->tax /100));

                $total=number_format((float)$setting->delivery_cost+$cart_total+$request->tips_delivery, 2, '.','');

            }
        }else{
            $tips_delivery=$request->tips. '%' ?? 0 .'%';
            if(session()->get('couponAmount')){
                $cart_total=session()->get('couponAmount')+(session()->get('couponAmount')*($setting->tax /100));

                $sub_total = session()->get('couponAmount');
                $tips_value = $sub_total * ($request->tips / 100);
                $total=number_format((float)$cart_total + $tips_value+ $setting->delivery_cost, 2, '.','');

            }else {
                $cart_total=\Cart::total()+(\Cart::total()*($setting->tax /100));

                $sub_total = \Cart::total();
                $tips_value = $sub_total * ($request->tips / 100);

                $total=number_format((float) $cart_total + $tips_value+$setting->delivery_cost, 2, '.','');

            }
        }
        $user =[
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city_id' => $request->city_id,
            'zip_code' => $request->zip_code,
            'tips' => $tips_delivery,
            'is_delivery' => $request->is_delivery,
            'delivery_cost' => $setting->delivery_cost.'$',
            'tax' => $setting->tax.'%',
            'coupon_price' => session()->get('couponAmount'),
            'coupon_code' => session()->get('couponCode'),
            'total' => $total,
        ];
        if($request->ajax()) {
            return ['data' => $user];
        }else{
            return $user;
        }

    }

    public function save_order(Request $request){
        //dd($request->all());
            if ($request->is_delivery != 1) {
                $pickup_data = $this->pickup($request);

                $user = Person::create([
                    'first_name' => $pickup_data['first_name'],
                    'last_name' => $pickup_data['last_name'],
                    'email' => $pickup_data['email'],
                    'phone' => $pickup_data['phone'],
                ]);
                // dd($user);
                foreach (\Cart::content() as $item) {

                    $create = Order::create([
                        'product_id' => $item->id['id'],
                        'quantity' => $item->qty,
                        'order_price' => $item->price,
                        'instructions' =>$item->options->toArray()['instructions'],
                        'person_id' => $user->id,
                    ]);
                    if (isset($item->options->toArray()['size'])) {
                        OrderPizzaSize::create([
                            'product_id' => $item->id['id'],
                            'order_id' => $create->id,
                            'size' => $item->options->toArray()['size'],
                            'price' => $item->options->toArray()['price_size'],
                        ]);
                    }

                    if (isset($item->options->toArray()['extras'])) {
                        foreach ($item->options->toArray()['extras'] as $extras) {
                            OrderPizzaExtras::create([
                                'product_id' => $item->id['id'],
                                'order_id' => $create->id,
                                'name' => $extras['name'],
                                'price' => $extras['price'],
                            ]);

                        }
                    }
                    if ( isset($item->options->toArray()['pizza_size'][0])) {
                       // dd($item->id['id']);
                        OrderSpecialPizzaSize::create([
                            'product_id' => $item->id['id'],
                            'order_id' => $create->id,
                            'size' =>$item->options->toArray()['pizza_size'][0]['name'],
                            'price' => $item->options->toArray()['pizza_size'][0]['price'],
                        ]);

                    }
                    if (isset($item->options->toArray()['types'])) {
                        foreach ($item->options->toArray()['types'] as $extras) {
                            OrderSpecialPizzaTypes::create([
                                'product_id' => $item->id['id'],
                                'order_id' => $create->id,
                                'name' => $extras['name'],
                                'price' => $extras['price'],
                            ]);

                        }
                    }
                }
                $user_invoice = Invoice::create([
                    'is_delivery' => $pickup_data['is_delivery'],
                    'person_id' => $user->id,
                    'order_price' => \Cart::total(),
                    'coupon_code' => $pickup_data['coupon_code'],
                    'coupon_price' => $pickup_data['coupon_price'],
                    'tips' => $pickup_data['tips'],
                    'total' => $pickup_data['total'],

                ]);
            } else {
                $delivery_data = $this->delivery($request);
                //  dd($delivery_data);
                $user = Person::create([
                    'first_name' => $delivery_data['first_name'],
                    'last_name' => $delivery_data['last_name'],
                    'email' => $delivery_data['email'],
                    'phone' => $delivery_data['phone'],
                    'address_1' => $delivery_data['address_1'],
                    'address_2' => $delivery_data['address_2'],
                    'city_id' => $delivery_data['city_id'],
                    'zip_code' => $delivery_data['zip_code'],
                ]);
                foreach (\Cart::content() as $item) {
                    $create = Order::create([
                        'product_id' => $item->id['id'],
                        'quantity' => $item->qty,
                        'order_price' => $item->price,
                        'person_id' => $user->id,
                        'instructions' =>$item->options->toArray()['instructions'],
                    ]);
                    if (isset($item->options->toArray()['size'])) {
                        OrderPizzaSize::create([
                            'product_id' => $item->id['id'],
                            'order_id' => $create->id,
                            'size' => $item->options->toArray()['size'],
                            'price' => $item->options->toArray()['price_size'],
                        ]);
                    }
                    if (isset($item->options->toArray()['extras'])) {
                        foreach ($item->options->toArray()['extras'] as $extras) {
                            OrderPizzaExtras::create([
                                'product_id' => $item->id['id'],
                                'order_id' => $create->id,
                                'name' => $extras['name'],
                                'price' => $extras['price'],
                            ]);

                        }
                    }
                    if ( isset($item->options->toArray()['pizza_size'][0])) {
                        OrderSpecialPizzaSize::create([
                            'product_id' => $item->id['id'],
                            'order_id' => $create->id,
                            'size' =>$item->options->toArray()['pizza_size'][0]['name'],
                            'price' => $item->options->toArray()['pizza_size'][0]['price'],
                        ]);

                    }
                    if (isset($item->options->toArray()['types'])) {
                        foreach ($item->options->toArray()['types'] as $extras) {
                            OrderSpecialPizzaTypes::create([
                                'product_id' => $item->id['id'],
                                'order_id' => $create->id,
                                'name' => $extras['name'],
                                'price' => $extras['price'],
                            ]);

                        }
                    }
                }
                $user_invoice = Invoice::create([
                    'is_delivery' => $delivery_data['is_delivery'],
                    'person_id' => $user->id,
                    'order_price' => \Cart::total(),
                    'coupon_code' => $delivery_data['coupon_code'],
                    'coupon_price' => $delivery_data['coupon_price'],
                    'tips' => $delivery_data['tips'],
                    'total' => $delivery_data['total'],

                ]);


            }
            $city=$user->cities->name ?? null;
        /* Create a merchantAuthenticationType object with authentication details
     retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName('');
        //$merchantAuthentication->setName('723LvNwLrP');
      //  $merchantAuthentication->setTransactionKey('76WsJ9vTv3T2t82e');
        $merchantAuthentication->setTransactionKey('');

        // Set the transaction's refId
        $refId = 'ref' . time();
        $cardNumber = preg_replace('/\s+/', '', $request->card_number);

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($request->expired_date);
        $creditCard->setCardCode($request->security_card);
        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName($user->first_name);
        $customerAddress->setLastName($user->last_name);
        $customerAddress->setAddress($user->address_1);
     $customerAddress->setCity($city);
      //  $customerAddress->setState("TX");
        $customerAddress->setZip($request->zip_code);
       // $customerAddress->setCountry("USA");

        // Set the customer's identifying information
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setType("individual");
        $customerData->setId("99999456654");
        $customerData->setEmail($user->email);
        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

// Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($user_invoice->total);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setshipTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);
        // Assemble the complete transaction request
        $requests = new AnetAPI\CreateTransactionRequest();
        $requests->setMerchantAuthentication($merchantAuthentication);
        $requests->setRefId($refId);
        $requests->setTransactionRequest($transactionRequestType);
        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($requests);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
     //dd($response);
        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {
//                    echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
//                    echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
//                    echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
//                    echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
//                    echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
                    $message_text = $tresponse->getMessages()[0]->getDescription().", Transaction ID: " . $tresponse->getTransId();
                    $msg_type = "success_msg";

                    \App\PaymentLogs::create([
                        'amount' => $user_invoice->total,
                        'response_code' => $tresponse->getResponseCode(),
                        'transaction_id' => $tresponse->getTransId(),
                        'auth_id' => $tresponse->getAuthCode(),
                        'message_code' => $tresponse->getMessages()[0]->getCode(),
                        'name_on_card' => trim($user->first_name),
                        'quantity'=>1
                    ]);
                    $user_invoice->order_status='active';
                   if($user_invoice->save()){
                       $admin=User::first();
                       \Notification::send($admin,new AddOrder($user_invoice,$user));
                   }
                    $user->status='active';
                    $user->save();

                    Mail::to($user->email)->send(new VerifyOrder($user));
                    \Cart::destroy();
                } else {
                    $message_text = 'There were some issue with the payment. Please try again later.';
                    $msg_type = "error_msg";

                    if ($tresponse->getErrors() != null) {
                        $message_text = $tresponse->getErrors()[0]->getErrorText();
                        $msg_type = "error_msg";
                    }
                }
                // Or, print errors if the API request wasn't successful
            } else {
                $message_text = 'There were some issue with the payment. Please try again later.';
                $msg_type = "error_msg";

                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $message_text = $tresponse->getErrors()[0]->getErrorText();
                    $msg_type = "error_msg";
                } else {
                    $message_text = $response->getMessages()->getMessage()[0]->getText();
                    $msg_type = "error_msg";
                }
            }
        } else {
            $message_text = "No response returned";
            $msg_type = "error_msg";
        }

        return back()->with($msg_type, $message_text);




         }
    public function ss(Request $request)
    {

        $total_amount = \Cart::total();
        $setting = Setting::first();
        $coupon_code = session()->get('couponCode');
        $coupon_price = session()->get('couponAmount');
        $tips=$request->tips ??0;
        $tip=$request->tip ??0;
        //dd($tips);
        // dd($request->all());
        if ($request->is_delivery ==1 && $coupon_price != null) {
            $user = Person::create([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'phone' => $request->phones,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'zip_code' => $request->zip_code,
            ]);
            foreach (\Cart::getContent() as $item) {
                $create = Order::create([
                    'product_id' => $item->id,
                    'quantity' => $item->quantity,
                    'order_price' => $item->price,
                    'person_id' => $user->id,
                ]);
                if ($item->attributes->size) {
                    OrderPizzaSize::create([
                        'product_id' => $item->id,
                        'order_id' => $create->id,
                        'size' => $item->attributes->size,
                        'price' => $item->attributes->price_size,
                    ]);
                }
                if ($item->attributes->extras) {
                    foreach ($item->attributes->extras as $extras) {
                        OrderPizzaExtras::create([
                            'product_id' => $item->id,
                            'order_id' => $create->id,
                            'name' => $extras->name,
                            'price' => $extras->price,
                        ]);

                    }
                }
                if ($item->attributes->pizza_size) {
                    OrderSpecialPizzaSize::create([
                        'product_id' => $item->id,
                        'order_id' => $create->id,
                        'size' => $item->attributes->pizza_size[0]->name,
                        'price' => $item->attributes->pizza_size[0]->price,
                    ]);

                }
                if ($item->attributes->types) {
                    foreach ($item->attributes->types as $extras) {
                        OrderSpecialPizzaTypes::create([
                            'product_id' => $item->id,
                            'order_id' => $create->id,
                            'name' => $extras->name,
                            'price' => $extras->price,
                        ]);

                    }
                }

            }
            $user_invoice = Invoice::create([
                'is_delivery' => 1,
                'person_id' => $user->id,
                'order_price' => $total_amount,
                'coupon_code' => $coupon_code,
                'coupon_price' => $coupon_price,
                'tips' => $tip,
                'total' => $coupon_price + $setting->delivery_cost +$tip,
            ]);
        }
        elseif ($request->is_delivery ==1&& $coupon_price == null) {
            $user = Person::create([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'phone' => $request->phones,
                'address_1' => $request->address_1,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'zip_code' => $request->zip_code,
            ]);
            foreach (\Cart::getContent() as $item) {
                $create = Order::create([
                    'product_id' => $item->id,
                    'quantity' => $item->quantity,
                    'order_price' => $item->price,
                    'person_id' => $user->id,
                ]);
                if ($item->attributes->size) {
                    OrderPizzaSize::create([
                        'product_id' => $item->id,
                        'order_id' => $create->id,
                        'size' => $item->attributes->size,
                        'price' => $item->attributes->price_size,
                    ]);
                }
                if ($item->attributes->extras) {
                    foreach ($item->attributes->extras as $extras) {
                        OrderPizzaExtras::create([
                            'product_id' => $item->id,
                            'order_id' => $create->id,
                            'name' => $extras->name,
                            'price' => $extras->price,
                        ]);

                    }
                }
                if ($item->attributes->pizza_size) {
                    OrderSpecialPizzaSize::create([
                        'product_id' => $item->id,
                        'order_id' => $create->id,
                        'size' => $item->attributes->pizza_size[0]->name,
                        'price' => $item->attributes->pizza_size[0]->price,
                    ]);

                }
                if ($item->attributes->types) {
                    foreach ($item->attributes->types as $extras) {
                        OrderSpecialPizzaTypes::create([
                            'product_id' => $item->id,
                            'order_id' => $create->id,
                            'name' => $extras->name,
                            'price' => $extras->price,
                        ]);

                    }
                }

            }
            $user_invoice = Invoice::create([
                'is_delivery' => 1,
                'person_id' => $user->id,
                'order_price' => $total_amount,
                'coupon_code' => $coupon_code,
                'coupon_price' => $coupon_price,
                'tips' => $tip,
                'total' => $total_amount + $setting->delivery_cost+$tip,
            ]);
        }


        if($request->is_delivery!=1 && $coupon_price != null){
           $user= Person::create([
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'phone' => $request->phone,

           ]);
            foreach (\Cart::getContent() as $item) {
                $create = Order::create([

                    'product_id' => $item->id,
                    'quantity' => $item->quantity,
                    'order_price' => $item->price,
                    'person_id' => $user->id,
                ]);
                if( $item->attributes->size){
                    OrderPizzaSize::create([
                        'product_id' => $item->id,
                        'order_id' => $create->id,
                        'size' => $item->attributes->size,
                        'price' => $item->attributes->price_size,
                    ]);
                }
                if($item->attributes->extras){
                    foreach($item->attributes->extras as $extras){
                        OrderPizzaExtras::create([
                            'product_id' => $item->id,
                            'order_id' => $create->id,
                            'name' => $extras->name,
                            'price' => $extras->price,
                        ]);

                    }
                }
                if($item->attributes->pizza_size){
                    OrderSpecialPizzaSize::create([
                        'product_id' => $item->id,
                        'order_id' => $create->id,
                        'size' => $item->attributes->pizza_size[0]->name,
                        'price' => $item->attributes->pizza_size[0]->price,
                    ]);

                }
                if($item->attributes->types){
                    foreach($item->attributes->types as $extras){
                        OrderSpecialPizzaTypes::create([
                            'product_id' => $item->id,
                            'order_id' => $create->id,
                            'name' => $extras->name,
                            'price' => $extras->price,
                        ]);

                    }
                }
            }
            $user_invoice= Invoice::create([
                'is_takeaway' => 1,
                'person_id' => $user->id,
                'order_price' => $total_amount,
                'coupon_code' => $coupon_code,
                'coupon_price' => $coupon_price,
                'tips' => $tips,
                'total' => $total_amount +$tips,

            ]);
        }
        elseif($request->is_delivery !=1 && $coupon_price == null){
            $user= Person::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,


            ]);
            foreach (\Cart::getContent() as $item) {
                $create = Order::create([

                    'product_id' => $item->id,
                    'quantity' => $item->quantity,
                    'order_price' => $item->price,
                    'person_id' => $user->id,
                ]);
                if( $item->attributes->size){
                    OrderPizzaSize::create([
                        'product_id' => $item->id,
                        'order_id' => $create->id,
                        'size' => $item->attributes->size,
                        'price' => $item->attributes->price_size,
                    ]);
                }
                if($item->attributes->extras){
                    foreach($item->attributes->extras as $extras){
                        OrderPizzaExtras::create([
                            'product_id' => $item->id,
                            'order_id' => $create->id,
                            'name' => $extras->name,
                            'price' => $extras->price,
                        ]);

                    }
                }
                if($item->attributes->pizza_size){
                    OrderSpecialPizzaSize::create([
                        'product_id' => $item->id,
                        'order_id' => $create->id,
                        'size' => $item->attributes->pizza_size[0]->name,
                        'price' => $item->attributes->pizza_size[0]->price,
                    ]);

                }
                if($item->attributes->types){
                    foreach($item->attributes->types as $extras){
                        OrderSpecialPizzaTypes::create([
                            'product_id' => $item->id,
                            'order_id' => $create->id,
                            'name' => $extras->name,
                            'price' => $extras->price,
                        ]);

                    }
                }
            }
            $user_invoice= Invoice::create([
                'is_takeaway' => 1,
                'person_id' => $user->id,
                'order_price' => $total_amount,
                'coupon_code' => $coupon_code,
                'coupon_price' => $coupon_price,
                'tips' => $tips,
                'total' => $total_amount +$tips,
            ]);
        }

        \Cart::clear();

        $message = 'تمت الاضافة بنجاح';

        return response()->json(compact('message'));
    }

    public function getAllCityForZipCode(City $city){


            $getAllZipCode = ZipCode::where('city_id',$city->id)->pluck('zip_code')->toArray();
         //   dd($getAllZipCode);
            return response()->json([
                'status'=>true,
                'code'=>200,
                'data'=>$getAllZipCode,
            ]);

    }
}
