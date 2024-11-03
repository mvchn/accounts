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
    public function transfer(Account $from, Account $to, int $amount): void
    {
        $log = new Logger('bank');

        // Lov-level debug. Change level for production mode
        $log->pushHandler(new StreamHandler('var/log/bank-warning.log', Level::Debug));

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
        $log->info(sprintf('Transfered %d from %s to %s', $amount, $from, $to));
    }


}