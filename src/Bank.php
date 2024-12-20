<?php

namespace App;

use App\Exception\AccountException;
use App\Exception\BankException;
use App\Exception\ValidationException;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Bank
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = new \PDO(sprintf('sqlite:%s', __DIR__ . '/../var/data/local.db'));
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function transfer(Account $from, Account $to, int $amount): void
    {
        $date = new \DateTime();
        $log = new Logger('bank');

        // Lov-level debug. Change level for production mode
        $log->pushHandler(new StreamHandler(sprintf('var/log/bank-local-%s.log', $date->format("Y-m-d")), Level::Debug));

        try {
            $log->debug('Data: ', ['amount' => $amount, 'from' => $from->getBalance(), 'to' => $to->getBalance()]);
            $from->withdraw($amount);
            $to->deposit($amount);
        } catch (AccountException $e) {
            $log->error($e->getMessage(), ['amount' => $amount, 'from' => $from, 'to' => $to]);
            $log->alert(sprintf('Withdraw failed: %s', $e->getMessage()));
            throw new BankException('Transfer failed');
        } catch (\Exception $e) {
            $log->emergency($e->getMessage());
            $log->critical(sprintf('Transfer amount %d from %s to %s failed', $amount, $from, $to));
            throw new BankException(sprintf('Transfer amount %d from %s to %s failed', $amount, $from, $to));
        }

        $log->notice('Increased balance');
        $log->info(sprintf('Transferred %d from %s to %s', $amount, $from, $to));
    }

    public function subscribeService(User $user, Service $service): void
    {
        try {
            $order = $service->orderRequest([
                'user_name' => $user->getName(),
                'service_name' => $service->getName(),
                'amount' => 100,
                'currency' => 'USD',
                'capacity' => 1
            ]);
        } catch (ValidationException $e) {
            $log = new Logger('validation');
            // TODO: Log error data $e
            $log->debug($e->getMessage());
            throw new BankException('Service subscription failed');
        }

        $orderRepository = new OrderRepository($this->db, 'app_orders');

        try {
            $orderRepository->insertOrder($order);
        } catch (\Exception $e) {
            $log = new Logger('database');
            $log->debug($e->getMessage());
        }
    }
}
