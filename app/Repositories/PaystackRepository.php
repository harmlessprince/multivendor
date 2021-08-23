<?php

namespace App\Repositories;;

use App\Exceptions\IsNullException;
use App\Repositories\Contracts\PaystackRepositoryInterface;
use App\Services\TransactionRef;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class PaystackRepository implements PaystackRepositoryInterface
{

    protected $secretKey;
    protected $baseUrl;
    protected $requestOptions;
    protected $response;
    protected $httpClient;
    protected $callback_url;
    public function __construct($secretKey, $baseUrl, $callback_url)
    {
        $this->secretKey = $secretKey;
        $this->baseUrl = $baseUrl;
        $this->setRequestOptions();
        $this->callback_url = $callback_url;
    }


    public function prepareTransaction($data)
    {
        if ($data = null) {

            $quantity = intval(request()->quantity ?? 1);

            $data = array_filter([
                "amount" => intval(request()->amount) * $quantity,
                "reference" => request()->reference,
                "email" => request()->email,
                "plan" => request()->plan,
                "first_name" => request()->first_name,
                "last_name" => request()->last_name,
                "callback_url" => request()->callback_url,
                "currency" => (request()->currency != ""  ? request()->currency : "NGN"),
                'callback_url' => $this->callback_url,

                /*
                    Paystack allows for transactions to be split into a subaccount -
                    The following lines trap the subaccount ID - as well as the ammount to charge the subaccount (if overriden in the form)
                    both values need to be entered within hidden input fields
                */
                "subaccount" => request()->subaccount,
                "transaction_charge" => request()->transaction_charge,

                /**
                 * Paystack allows for transaction to be split into multi accounts(subaccounts)
                 * The following lines trap the split ID handling the split
                 * More details here: https://paystack.com/docs/payments/multi-split-payments/#using-transaction-splits-with-payments
                 */
                "split_code" => request()->split_code,

                /**
                 * Paystack allows transaction to be split into multi account(subaccounts) on the fly without predefined split
                 * form need an input field: <input type="hidden" name="split" value="{{ json_encode($split) }}" >
                 * array must be set up as:
                 *  $split = [
                 *    "type" => "percentage",
                 *     "currency" => "KES",
                 *     "subaccounts" => [
                 *       { "subaccount" => "ACCT_li4p6kte2dolodo", "share" => 10 },
                 *       { "subaccount" => "ACCT_li4p6kte2dolodo", "share" => 30 },
                 *     ],
                 *     "bearer_type" => "all",
                 *     "main_account_share" => 70,
                 * ]
                 * More details here: https://paystack.com/docs/payments/multi-split-payments/#dynamic-splits
                 */
                "split" => request()->split,
                /*
                * to allow use of metadata on Paystack dashboard and a means to return additional data back to redirect url
                * form need an input field: <input type="hidden" name="metadata" value="{{ json_encode($array) }}" >
                * array must be set up as:
                * $array = [ 'custom_fields' => [
                *                   ['display_name' => "Cart Id", "variable_name" => "cart_id", "value" => "2"],
                *                   ['display_name' => "Sex", "variable_name" => "sex", "value" => "female"],
                *                   .
                *                   .
                *                   .
                *                  ]
                *          ]
                */
                'metadata' => request()->metadata
            ]);
        }
        $this->setHttpPostResponse('/transaction/initialize', $data);
        return $this;
    }
    /**
     * Hit Paystack Gateway to Verify that the transaction is valid
     */
    public function verify($refernce)
    {

        $transactionRef = request()->query('trxref');

        $relativeUrl = "/transaction/verify/{$transactionRef}";

        $this->response = $this->setHttpGetResponse($relativeUrl, []);
    }

    /**
     * Set options for making the Client request
     */
    private function setRequestOptions()
    {
        $authBearer = 'Bearer ' .  Config::get('paystack.secretKey');
        return $this->httpClient = Http::baseUrl($this->baseUrl)->withHeaders([
            'Authorization' => $authBearer,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json'
        ]);
    }
    /**
     * @param string $relativeUrl
     * @param string $method
     * @param array $body
     * @return Paystack
     * @throws IsNullException
     */
    private function setHttpPostResponse($relativeUrl, $body = [])
    {
        $this->response = $this->httpClient->post($relativeUrl, $body);
        return $this;
    }

    /**
     * @param string $relativeUrl
     * @param string $method
     * @param array $body
     * @return Paystack
     * @throws IsNullException
     */
    private function setHttpGetResponse($relativeUrl, $body = [])
    {
        $this->response = $this->httpClient->get($relativeUrl);
        return $this;
    }
    /**
     * Get the authorization callback response
     * In situations where Laravel serves as an backend for a detached UI, the api cannot redirect
     * and might need to take different actions based on the success or not of the transaction
     * @return array
     */
    public function getAuthorizationResponse($data)
    {
        $this->prepareTransaction($data);

        $this->authorizationUrl = $this->getResponse()['data']['authorization_url'];

        return $this->getResponse();
    }

    /**
     * Get the whole response from a get operation
     * @return array
     */
    private function getResponse()
    {
        return json_decode($this->response->getBody(), true);
    }
    /**
     * Fluent method to redirect to Paystack Payment Page
     */
    public function redirectNow()
    {
        return redirect($this->url);
    }

    /**
     * Generate a Unique Transaction Reference
     * @return string
     */
    public function genTranxRef()
    {
        return TransactionRef::getHashedToken();
    }
}
