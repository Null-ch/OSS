<?php

namespace App\Infrastructure\Services;

use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Factories\PaymentFactory;
use App\Models\Order;

class PaymentService
{
    /**
     * LogInterface implementation
     *
     * @var object
     */
    protected $logger;

    /**
     * paymentFactory
     *
     * @var object
     */
    protected $paymentFactory;

    /**
     * __construct
     *
     * @param PaymentFactory $paymentFactory
     * @param LogInterface $logger
     * 
     */
    public function __construct(
        PaymentFactory $paymentFactory,
        LogInterface $logger
    ) {
        $this->logger = $logger;
        $this->paymentFactory = $paymentFactory;
    }
    
    /**
     * Method pay
     *
     * @param Order $data
     * @param string $type
     *
     * @return string
     */
    public function pay(Order $data, string $type = 'yoo_kassa'): ?string
    {
        try {
            $paymentService = $this->paymentFactory::create($type);
            return $paymentService->pay($data);
        } catch (\Exception $e) {
            $this->logger->error('Error when generate message: ' . $e->getMessage());
            return null;
        }
    }
}
