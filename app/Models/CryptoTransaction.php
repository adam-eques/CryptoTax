<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CryptoCurrency;
use Carbon\Carbon;
/**
 * @property CryptoAccount $cryptoAccount
 * @property CryptoCurrency $cryptoCurrency
 * @property CryptoCurrency $feeCurrency
 * @property CryptoCurrency $priceCurrency
 */
class CryptoTransaction extends Model
{
    // transaction types
    const TRAN_TYPE_SEND =       'G';    // send (trade and blockchain transaction)
    const TRAN_TYPE_RECEIVE =    'R';    // receive ((trade and blockchain transaction))
    const TRAN_TYPE_SELL =       'S';    // sell (trade)
    const TRAN_TYPE_BUY =        'B';    // buy (trade)

    // public static float $total_deposits = 0;
    // public static float $total_proceeds = 0;
    // public static float $net_deposits = 0;
    // public static float $net_proceeds = 0;
    // public static float $fiat_reinvested = 0;
    // public static array $holding = [];

    protected float $gain = 0;
    protected float $fromCostBasis = 0;
    protected float $toCostBasis = 0;

    public function cryptoAccount(): BelongsTo
    {
        return $this->belongsTo(CryptoAccount::class);
    }

    public function costCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class, "cost_currency_id");
    }

    public function cryptoCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class, "currency_id");
    }


    public function feeCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class, 'fee_currency_id');
    }


    public function priceCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class, 'price_currency_id');
    }

    public function deposits($fiat = "USD") : float {
        $deposits = 0;
        if ($this->trade_type == CryptoTransaction::TRAN_TYPE_RECEIVE) {
            $deposits = $this->cryptoCurrency->convertTo($this->cost, $fiat, $this->executed_at);
        }
        echo "\ntime: " . $this->executed_at;
        echo "\ntype: " . $this->trade_type;
        echo "\ndeposits: " . $this->cost . " " . $this->cryptoCurrency->short_name . " = " . $deposits . " " . $fiat . "\n";
        if ($deposits === null) {
            echo "unsupported\n";
            CryptoTransaction::unsupported_CC($this->cryptoCurrency->short_name);
            $deposits = 0;
        }
        // $deposits = $this->cost;
        return $deposits;
    }

    public function proceeds($fiat = "USD") : float {
        $proceeds = 0;
        if ($this->trade_type == CryptoTransaction::TRAN_TYPE_SEND) {
            $proceeds = $this->cryptoCurrency->convertTo($this->cost, $fiat, $this->executed_at);
        }

        // echo "\n " . $this->cryptoCurrency->short_name . " : " . $this->cost . " = " . $proceeds . " " . $fiat . "\n" . $this->executed_at . "\n";
        if ($proceeds === null) {
            CryptoTransaction::unsupported_CC($this->cryptoCurrency->short_name);
            $proceeds = 0;
        }
        // $proceeds = $this->cost;
        return $proceeds;
    }

    public static function getTotal(int|Carbon $since, string $fiat="USD") : array {
        $decimal_number = 12;
        bcscale($decimal_number);
        // https://support.cointracker.io/hc/en-us/articles/4413049704593-Cryptocurrency-Performance-and-Return#:~:text=Definitions,made%20on%20your%20cryptocurrency%20investing.
        $endDate = null;
        if ($since instanceof Carbon) {
            $endDate = $since;
        } else if(is_int($since)) {
            $endDate = Carbon::createFromTimestampMsUTC($since);
        }
        $query = CryptoTransaction::query()
            ->where('executed_at', '<', $endDate)
            ->orderBy("executed_at", "ASC");
        $transactions = $query->get();

        // some important values
        $holding = [];  /**Holding assets */
        $total_deposits = 0;
        $total_proceeds = 0;
        $fiat_reinvested = 0;
        $market_value = 0;
        $total_return = 0;
        $net_proceeds = 0;
        $net_deposits = 0;
        foreach($transactions as $transaction) {
            switch ($transaction->trade_type) {
                case CryptoTransaction::TRAN_TYPE_SEND :
                    $symbol = $transaction->cryptoCurrency->short_name;
                    if (array_key_exists($symbol, $holding)) {
                        $holding[$symbol] = bcsub($holding[$symbol], number_format($transaction->amount, $decimal_number, ".", ''));
                    } else {
                        $holding[$symbol] = number_format(-$transaction->amount , $decimal_number, ".", '');
                    }
                    break;
                case CryptoTransaction::TRAN_TYPE_RECEIVE :
                    $symbol = $transaction->cryptoCurrency->short_name;
                    if (array_key_exists($symbol, $holding)) {
                        $holding[$symbol] = bcadd($holding[$symbol], number_format($transaction->amount, $decimal_number, ".", ''));
                    } else {
                        $holding[$symbol] = number_format($transaction->amount , $decimal_number, ".", '');
                    }
                    break;
                case CryptoTransaction::TRAN_TYPE_SELL :
                    $fromSymbol = $transaction->cryptoCurrency->short_name;
                    $toSymbol = $transaction->priceCurrency->short_name;
                    if (array_key_exists($fromSymbol, $holding)) {
                        $holding[$fromSymbol] = bcsub($holding[$fromSymbol], number_format($transaction->amount, $decimal_number, ".", ''));
                    } else {
                        $holding[$fromSymbol] = number_format(-$transaction->amount , $decimal_number, ".", '');
                    }
                    if (array_key_exists($toSymbol, $holding)) {
                        $holding[$toSymbol] = bcadd($holding[$toSymbol], number_format($transaction->cost, $decimal_number, ".", ''));
                    } else {
                        $holding[$toSymbol] = number_format($transaction->cost, $decimal_number, ".", '');
                    }
                    break;
                case CryptoTransaction::TRAN_TYPE_BUY :
                    $fromSymbol = $transaction->cryptoCurrency->short_name;
                    $toSymbol = $transaction->priceCurrency->short_name;
                    if (array_key_exists($fromSymbol, $holding)) {
                        $holding[$fromSymbol] = bcadd($holding[$fromSymbol], number_format($transaction->amount, $decimal_number, ".", ''));
                    } else {
                        $holding[$fromSymbol] = number_format($transaction->amount, $decimal_number, ".", '');
                    }
                    if (array_key_exists($toSymbol, $holding)) {
                        $holding[$toSymbol] = bcsub($holding[$toSymbol], number_format($transaction->cost, $decimal_number, ".", ''));
                    } else {
                        $holding[$toSymbol] = number_format(-$transaction->cost, $decimal_number, ".", '');
                    }
                    break;
                default:
                    break;
            }
            $feeSymbol = $transaction->feeCurrency->short_name;
            if (array_key_exists($feeSymbol, $holding)) {
                $holding[$feeSymbol] = bcsub($holding[$feeSymbol], number_format($transaction->fee, $decimal_number, ".", ''));
            } else {

                $holding[$feeSymbol] = $transaction->fee == '0' ? '0' : number_format(-$transaction->fee, $decimal_number, ".", '');
            }
            $deposits = $transaction->deposits($fiat);
            $proceeds = $transaction->proceeds($fiat);
            $free_proceeds = bcsub($total_proceeds, $fiat_reinvested);
            if ($deposits > 0 && $free_proceeds > 0) {
                $reinveted = $deposits > $free_proceeds ? $free_proceeds : $deposits;
                $fiat_reinvested = bcadd($fiat_reinvested, $reinveted);
            }
            $total_deposits = bcadd($total_deposits, $deposits);
            $total_proceeds = bcadd($total_proceeds, $proceeds);
        }
        $market_value = 0;
        // echo "\n=====================================\n";
        foreach ($holding as $symbol => $value) {
            $currency = CryptoCurrency::findByShortName($symbol);
            $fiat_value = $currency->convertTo(floatval($value), $fiat, $endDate);
            // echo "\n" . $symbol . " : " . $fiat_value . "\n";
            $market_value = bcadd($market_value, number_format($fiat_value, $decimal_number, ".", ''));
        }
        // echo "\n" . "market value : " . $market_value . "\n";
        // CryptoTransaction::$holding = $holding;
        // CryptoTransaction::$total_deposits = $total_deposits;
        // CryptoTransaction::$total_proceeds = $total_proceeds;
        // CryptoTransaction::$fiat_reinvested = $fiat_reinvested;
        $net_deposits = bcsub($total_deposits, $fiat_reinvested);
        $net_proceeds = bcsub($total_proceeds, $fiat_reinvested);
        $total_return = bcadd($market_value, $net_proceeds);
        $mwr = bcmul(bcsub(bcdiv($total_return, $net_deposits), "1"), "100");
        return [
            'holding' => $holding,
            'total_deposits' => $total_deposits,
            'total_proceeds' => $total_proceeds,
            'reinvested_fiat' => $fiat_reinvested,
            'market_value' => $market_value,
            'net_deposits' => $net_deposits,
            'net_proceeds' => $net_proceeds,
            'total_return' => $total_return,
            'mwr' => $mwr
        ];
    }

    public static function getCurrentTotal($fiat='USD') : array {
        $start_t = microtime(true);
        $current_total = CryptoTransaction::getTotal(Carbon::now(), $fiat);
        $end_t = microtime(true);
        $yesterday_total = CryptoTransaction::getTotal(Carbon::now()->yesterday(), $fiat);
        return [
            "total_return" => $current_total["total_return"],
            "mwr" => $current_total["mwr"],
            "past_day" => $yesterday_total["total_return"],
            "past_mwr" => $yesterday_total["mwr"],
            "net_deposits" => $current_total["net_deposits"],
            "net_proceeds" => $current_total["net_proceeds"],
        ];
        // return $current_total;
    }

    const LINE_CHART_YEAR =     'LINE_CHART_YEAR';
    const LINE_CHART_MONTH =    'LINE_CHART_MONTH';
    const LINE_CHART_WEEK =     'LINE_CHART_WEEK';
    const LINE_CHART_DAY =      'LINE_CHART_DAY';
    public static function getLineChartData($type = CryptoTransaction::LINE_CHART_YEAR, $fiat='USD') {
        $ret = [];
        $startDate = Carbon::create(2000, 1, 1);
        $step_transactions = [];
        switch($type) {
            case CryptoTransaction::LINE_CHART_YEAR:
                $endDate = Carbon::now()->addMonths(-12);
                do {
                    $query = CryptoTransaction::query()
                        ->where('executed_at', '<', $endDate)
                        ->where('executed_at', '>=', $startDate)
                        ->orderBy("executed_at", "ASC");
                    $transactions = $query->get();
                    $step_transactions[$endDate->getTimestampMs()] = $transactions;
                    $startDate = new Carbon($endDate);
                    $endDate->addMonth();
                } while ($endDate->isPast());
                break;
            case CryptoTransaction::LINE_CHART_MONTH:
                $endDate = Carbon::now()->addMonths(-1);
                do {
                    $query = CryptoTransaction::query()
                        ->where('executed_at', '<', $endDate)
                        ->where('executed_at', '>=', $startDate)
                        ->orderBy("executed_at", "ASC");
                    $transactions = $query->get();
                    $step_transactions[$endDate->getTimestampMs()] = $transactions;
                    // array_push($step_transactions, $transactions);
                    $startDate = new Carbon($endDate);
                    $endDate->addDay();
                } while ($endDate->isPast());
                break;
            case CryptoTransaction::LINE_CHART_WEEK:
                $endDate = Carbon::now()->addWeek(-1);
                do {
                    $query = CryptoTransaction::query()
                        ->where('executed_at', '<', $endDate)
                        ->where('executed_at', '>=', $startDate)
                        ->orderBy("executed_at", "ASC");
                    $transactions = $query->get();
                    $step_transactions[$endDate->getTimestampMs()] = $transactions;
                    // array_push($step_transactions, $transactions);
                    $startDate = new Carbon($endDate);
                    $endDate->addDay();
                } while ($endDate->isPast());
                break;
            case CryptoTransaction::LINE_CHART_DAY:
                $endDate = Carbon::now()->addDay(-1);
                do {
                    $query = CryptoTransaction::query()
                        ->where('executed_at', '<', $endDate)
                        ->where('executed_at', '>=', $startDate)
                        ->orderBy("executed_at", "ASC");
                    $transactions = $query->get();
                    $step_transactions[$endDate->getTimestampMs()] = $transactions;
                    // array_push($step_transactions, $transactions);
                    $startDate = new Carbon($endDate);
                    $endDate->addHour();
                } while ($endDate->isPast());
                break;
            default:
                break;
        }
        // https://support.cointracker.io/hc/en-us/articles/4413049704593-Cryptocurrency-Performance-and-Return#:~:text=Definitions,made%20on%20your%20cryptocurrency%20investing.
        // some important values
        $decimal_number = 12;
        bcscale($decimal_number);
        $holding = [];  /**Holding assets */
        $total_deposits = 0;
        $total_proceeds = 0;
        $fiat_reinvested = 0;
        $market_value = 0;
        $total_return = 0;
        $net_proceeds = 0;
        $net_deposits = 0;
        foreach ($step_transactions as $timestamp => $transactions) {
            echo "\ntransactions number: " . count($transactions) . "\n";
            foreach($transactions as $transaction) {
                switch ($transaction->trade_type) {
                    case CryptoTransaction::TRAN_TYPE_SEND :
                        $symbol = $transaction->cryptoCurrency->short_name;
                        if (array_key_exists($symbol, $holding)) {
                            $holding[$symbol] = bcsub($holding[$symbol], number_format($transaction->amount, $decimal_number, ".", ''));
                        } else {
                            $holding[$symbol] = number_format(-$transaction->amount , $decimal_number, ".", '');
                        }
                        break;
                    case CryptoTransaction::TRAN_TYPE_RECEIVE :
                        $symbol = $transaction->cryptoCurrency->short_name;
                        if (array_key_exists($symbol, $holding)) {
                            $holding[$symbol] = bcadd($holding[$symbol], number_format($transaction->amount, $decimal_number, ".", ''));
                        } else {
                            $holding[$symbol] = number_format($transaction->amount , $decimal_number, ".", '');
                        }
                        break;
                    case CryptoTransaction::TRAN_TYPE_SELL :
                        $fromSymbol = $transaction->cryptoCurrency->short_name;
                        $toSymbol = $transaction->priceCurrency->short_name;
                        if (array_key_exists($fromSymbol, $holding)) {
                            $holding[$fromSymbol] = bcsub($holding[$fromSymbol], number_format($transaction->amount, $decimal_number, ".", ''));
                        } else {
                            $holding[$fromSymbol] = number_format(-$transaction->amount , $decimal_number, ".", '');
                        }
                        if (array_key_exists($toSymbol, $holding)) {
                            $holding[$toSymbol] = bcadd($holding[$toSymbol], number_format($transaction->cost, $decimal_number, ".", ''));
                        } else {
                            $holding[$toSymbol] = number_format($transaction->cost, $decimal_number, ".", '');
                        }
                        break;
                    case CryptoTransaction::TRAN_TYPE_BUY :
                        $fromSymbol = $transaction->cryptoCurrency->short_name;
                        $toSymbol = $transaction->priceCurrency->short_name;
                        if (array_key_exists($fromSymbol, $holding)) {
                            $holding[$fromSymbol] = bcadd($holding[$fromSymbol], number_format($transaction->amount, $decimal_number, ".", ''));
                        } else {
                            $holding[$fromSymbol] = number_format($transaction->amount, $decimal_number, ".", '');
                        }
                        if (array_key_exists($toSymbol, $holding)) {
                            $holding[$toSymbol] = bcsub($holding[$toSymbol], number_format($transaction->cost, $decimal_number, ".", ''));
                        } else {
                            $holding[$toSymbol] = number_format(-$transaction->cost, $decimal_number, ".", '');
                        }
                        break;
                    default:
                        break;
                }
                $feeSymbol = $transaction->feeCurrency->short_name;
                if (array_key_exists($feeSymbol, $holding)) {
                    $holding[$feeSymbol] = bcsub($holding[$feeSymbol], number_format($transaction->fee, $decimal_number, ".", ''));
                } else {

                    $holding[$feeSymbol] = $transaction->fee == '0' ? '0' : number_format(-$transaction->fee, $decimal_number, ".", '');
                }
                $deposits = $transaction->deposits($fiat);
                $proceeds = $transaction->proceeds($fiat);
                $free_proceeds = bcsub($total_proceeds, $fiat_reinvested);
                if ($deposits > 0 && $free_proceeds > 0) {
                    $reinveted = $deposits > $free_proceeds ? $free_proceeds : $deposits;
                    $fiat_reinvested = bcadd($fiat_reinvested, $reinveted);
                }
                $total_deposits = bcadd($total_deposits, $deposits);
                $total_proceeds = bcadd($total_proceeds, $proceeds);
            }
            $market_value = 0;
            foreach ($holding as $symbol => $value) {
                $currency = CryptoCurrency::findByShortName($symbol);
                $fiat_value = $currency->convertTo(floatval($value), $fiat, $endDate);
                $market_value = bcadd($market_value, number_format($fiat_value, $decimal_number, ".", ''));
            }
            // CryptoTransaction::$holding = $holding;
            // CryptoTransaction::$total_deposits = $total_deposits;
            // CryptoTransaction::$total_proceeds = $total_proceeds;
            // CryptoTransaction::$fiat_reinvested = $fiat_reinvested;
            $net_deposits = bcsub($total_deposits, $fiat_reinvested);
            $net_proceeds = bcsub($total_proceeds, $fiat_reinvested);
            $total_return = bcadd($market_value, $net_proceeds);
            $mwr = bcmul(bcsub(bcdiv($total_return, $net_deposits), "1"), "100");
            // $ret[$timestamp] = [
            //     // 'holding' => $holding,
            //     'total_deposits' => $total_deposits,
            //     'total_proceeds' => $total_proceeds,
            //     'reinvested_fiat' => $fiat_reinvested,
            //     'market_value' => $market_value,
            //     'net_deposits' => $net_deposits,
            //     'net_proceeds' => $net_proceeds,
            //     'total_return' => $total_return,
            //     // 'mwr' => $mwr
            // ];
            $ret[$timestamp] = $market_value + $net_proceeds;
        }
        return $ret;
        // return $ret;
    }

    public static $unsupported = [];
    public static function unsupported_CC(string $cc) {
        $symbol = $cc;
        if(!in_array($symbol, CryptoTransaction::$unsupported)) {
            array_push(CryptoTransaction::$unsupported, $cc);
        }
    }


    // FIFO model
    public static function processFIFO($account_id, $fiat="USD") {
        $query = CryptoTransaction::query()
            ->where('crypto_account_id', $account_id)
            ->orderBy("executed_at", "ASC");
        $transactions = $query->get();
        $enabled = [];
        foreach ($transactions as $key => $transaction) {
            switch ($transaction->trade_type) {
                case CryptoTransaction::TRAN_TYPE_RECEIVE:
                    $transaction->from_cost_basis = 0;
                    $transaction->gain = 0;
                    $price = $transaction->cryptoCurrency->cosnvertTo(1, $fiat, $transaction->executed_at);
                    if ($price === null) {
                        $price = 0;
                    }
                    // testing acentior

                    $currency = $transaction->cryptoCurrency->short_name;
                    // if (array_key_exists($currency, $enabled)) {

                    // }
                    // array_push($enabled, [
                    //     'amount' => $transaction->cost,
                    //     'price' => $price,
                    //     'currency' => $transaction->cryptoCurrency->short_name
                    // ]);
                    break;
                case CryptoTransaction::TRAN_TYPE_SEND:
                    # code...
                    break;
                case CryptoTransaction::TRAN_TYPE_SELL:
                    # code...
                    break;
                case CryptoTransaction::TRAN_TYPE_BUY:
                    # code...
                    break;
                default:
                    # code...
                    break;
            }
            $transaction->fiat = $fiat;
            $toCostBasis = $transaction->cryptoCurrency->convertTo($transaction->cost, $fiat, $transaction->executed_at);
            if ($toCostBasis === null) {
                $toCostBasis = 0;
            }
            $transaction->to_cost_basis = $toCostBasis;
            $transaction->save();
        }
        // var_dump($enabled);
        return $query->get();
    }
}
