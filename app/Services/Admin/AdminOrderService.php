<?php

namespace App\Services\Admin;

use App\Models\Order;
use App\Helpers\Helpers;
use App\Infrastructure\Services\CartService;
use App\Infrastructure\Services\UserService;
use App\Infrastructure\Services\OrderService;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Services\UserDetailsService;
use App\Infrastructure\Services\UserShippingInformationService;

class AdminOrderService extends OrderService
{
  /**
     * Model: Order
     *
     * @var object
     */
    protected $order;

    /**
     * LogInterface implementation
     *
     * @var object
     */
    protected $logger;

    /**
     * messageFactory
     *
     * @var object
     */
    protected $messageService;

    /**
     * userService
     *
     * @var object
     */
    protected $userService;

    /**
     * userShippingInformationService
     *
     * @var object
     */
    protected $userShippingInformationService;

    /**
     * userDetailsService
     *
     * @var object
     */
    protected $userDetailsService;

    /**
     * helpers
     *
     * @var object
     */
    protected $helpers;
    protected $cartService;

    /**
     * __construct
     *
     * @param Order $order
     * @param LogInterface $logger
     * @param MessageService $messageService
     * @param UserService $userService
     * @param UserShippingInformationService $userShippingInformationService
     * @param UserDetailsService $userDetailsService
     * @param Helpers $helpers
     * @param CartService $cartService
     */
    public function __construct(
        Order $order,
        LogInterface $logger,
        MessageService $messageService,
        UserService $userService,
        UserShippingInformationService $userShippingInformationService,
        UserDetailsService $userDetailsService,
        Helpers $helpers,
        CartService $cartService
    ) {
        parent::__construct(
            $order,
            $logger,
            $messageService,
            $userService,
            $userShippingInformationService,
            $userDetailsService,
            $helpers,
            $cartService
        );
    }

   public function getOrders(int $count): ?object
   {
       if (!$count) {
           $this->logger->error('The quantity has not been transferred.');
           return null;
       }

       try {
           $orders = $this->order::paginate($count);
       } catch (\Exception $e) {
           $this->logger->error("{$e->getMessage()}" . $e->getTrace());
           return null;
       }

       return $orders;
   }

   /**
    * Get order
    *
    * @param int $id
    * 
    * @return object
    * 
    */
   public function getOrder(int $id): ?object
   {
       if (!$id) {
           $this->logger->error('The id has not been transferred.');
           return null;
       }

       try {
           $order = $this->order::findOrFail($id);
       } catch (\Exception $e) {
           $this->logger->error('Error when receiving the order: ' . $e->getMessage());
           return null;
       }

       return $order;
   }

    /**
    * Get order
    *
    * @param int $id
    * 
    * @return object
    * 
    */
    public function getOrderProducts(int $id): ?object
    {
        if (!$id) {
            $this->logger->error('The id has not been transferred.');
            return null;
        }
 
        try {
            $order = $this->order::findOrFail($id);
            $products = $order->cart->cart_products;
        } catch (\Exception $e) {
            $this->logger->error('Error when receiving the order products: ' . $e->getMessage());
            return null;
        }
 
        return $products;
    }
}
