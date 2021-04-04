<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConnectionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class PaymentController extends Controller
{
    private $apiContext;
    private $purchase;

    public function __construct()
    {
        $this->purchase['userId'] = '';
        $this->purchase['courseId'] = '';
        // Nos conectamos con la API de paypal
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);
    }

    public function payWithPayPal(Request $r)
    {
        $this->purchase['userId'] = Auth::user()->id;
        $this->purchase['courseId'] = $r->get('courseId');
        $course = Course::find($this->purchase['courseId']);
        
        session_start();
        $_SESSION['purchase'] = $this->purchase;
       

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($course->price);
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        // $transaction->setDescription('See');

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            /** Redireccionar al usuario e informar el error */
           echo $ex->getData();
        }
        
    }

    public function payPalStatus(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            
            return redirect('/home');
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {
            return $this->addStudent();
        }
     
        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect('/myCourses')->with(compact('status'));
    }

    private function addStudent()
    {
        session_start();
        $this->purchase = $_SESSION['purchase'];

        $userId = $this->purchase['userId'];
        $courseId = $this->purchase['courseId'];

        $course = DB::table('coursesXusers')->get()->where("userId", $userId)->where("courseId", $courseId)->first();

        if (!$course) {
            DB::table('coursesXusers')->insert(
                array(
                    'userId'     =>   "$userId",
                    'courseId'   =>   "$courseId"
                )
            );
        }

        session_destroy();

        return redirect("/myCourses");
    }

}
