<?php 

namespace Aqayepardakht\PhpSdk\Strategy;

use Aqayepardakht\PhpSdk\Helper;
use Aqayepardakht\PhpSdk\Interfaces\PaymentStrategy;

class StartPaymentStrategy implements PaymentStrategy {
    /**
     * Payment Trace Code
     *
     * @var String
    */
    protected $traceCode;

    public function __construct($traceCode) {
        $this->traceCode  = $traceCode;
    }

    public function process() {
        $result = [
            'url' => $this->getStartPayUrl()
        ];
    
        $output = json_encode($result);
        if (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
            header('Content-Type: application/json');
        } else {
            header('Content-Type: text/html');
            $output = "<script>window.location.href='{$result['url']}'</script>";
        }
    
        echo $output;
        exit;
    }

    public function getStartPayUrl() {
        $url = Helper::getBaseUrl();

        return $url . 'pay/startpay/'.$this->traceCode;
    }

    public function getAction(): string {
        return 'start';
    }
}