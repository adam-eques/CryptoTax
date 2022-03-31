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
    // Decimal number
    const DECIMAL_NUMBER = 12;

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
        // echo "\ntime: " . $this->executed_at;
        // echo "\ntype: " . $this->trade_type;
        // echo "\ndeposits: " . $this->cost . " " . $this->cryptoCurrency->short_name . " = " . $deposits . " " . $fiat . "\n";
        if ($deposits === null) {
            // echo "unsupported\n";
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

    public static function getTotal(array $accountIds, int|Carbon $since, string $fiat="USD") : array {
        // some important values
        $holding = [];  /**Holding assets */
        $total_deposits = 0;
        $total_proceeds = 0;
        $fiat_reinvested = 0;
        $market_value = 0;
        $total_return = 0;
        $net_proceeds = 0;
        $net_deposits = 0;
        $mwr = 0;

        if (count($accountIds) === 0) {
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

        $decimal_number = CryptoTransaction::DECIMAL_NUMBER;
        bcscale($decimal_number);
        // https://support.cointracker.io/hc/en-us/articles/4413049704593-Cryptocurrency-Performance-and-Return#:~:text=Definitions,made%20on%20your%20cryptocurrency%20investing.
        $endDate = null;
        if ($since instanceof Carbon) {
            $endDate = $since;
        } else if(is_int($since)) {
            $endDate = Carbon::createFromTimestampMsUTC($since);
        }
        $query = CryptoTransaction::query();
        foreach ($accountIds as $accountId) {
            $query->orWhere('crypto_account_id', $accountId);
        }
        $query->where('executed_at', '<', $endDate)
            ->orderBy("executed_at", "ASC");
        $transactions = $query->get();

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

        $net_deposits = bcsub($total_deposits, $fiat_reinvested);
        $net_proceeds = bcsub($total_proceeds, $fiat_reinvested);
        $total_return = $query->sum('gain');

        $startDate = null;
        if ($since instanceof Carbon) {
            $startDate = Carbon::createFromTimestampMsUTC($since->getTimestampMs())->addDays(-1);
        } else if(is_int($since)) {
            $startDate = Carbon::createFromTimestampMsUTC($since - 24 * 3600000);
        }
        $query->where('executed_at', '>', $startDate);

        $day_return = $query->sum('gain');

        $total_mwr = bcmul(bcdiv(number_format($total_return, $decimal_number, '.', ''), $net_deposits), "100");
        $day_mwr = bcmul(bcdiv(number_format($day_return, $decimal_number, '.', ''), $net_deposits), "100");

        $total_income = 0;
        return [
            'holding' => $holding,
            'total_deposits' => $total_deposits,
            'total_proceeds' => $total_proceeds,
            'reinvested_fiat' => $fiat_reinvested,
            'market_value' => $market_value,
            'net_deposits' => $net_deposits,
            'net_proceeds' => $net_proceeds,
            'total_return' => $total_return,
            'total_mwr' => $total_mwr,
            'day_return' => $day_return,
            'day_mwr' => $day_mwr,
            'total_income' => $total_income,
        ];
    }

    // public static function getCurrentTotal($accountIds, $fiat='USD') : array {
    //     return CryptoTransaction::getTotal($accountIds, Carbon::now(), $fiat);
    // }

    const LINE_CHART_YEAR =     'LINE_CHART_YEAR';
    const LINE_CHART_MONTH =    'LINE_CHART_MONTH';
    const LINE_CHART_WEEK =     'LINE_CHART_WEEK';
    const LINE_CHART_DAY =      'LINE_CHART_DAY';
    public static function getLineChartData(array $accountIds, $type = CryptoTransaction::LINE_CHART_YEAR, $fiat='USD') {
        $ret = [];
        $startDate = Carbon::create(2000, 1, 1);
        $endDate = null;
        $step_transactions = [];
        switch($type) {
            case CryptoTransaction::LINE_CHART_YEAR:
                $endDate = Carbon::now()->addMonths(-12)->addDays(-1);
                break;
            case CryptoTransaction::LINE_CHART_MONTH:
                $endDate = Carbon::now()->addDays(-31);
                break;
            case CryptoTransaction::LINE_CHART_WEEK:
                $endDate = Carbon::now()->addDays(-7);
                break;
            case CryptoTransaction::LINE_CHART_DAY:
                $endDate = Carbon::now()->addHours(-24);
                break;
            default:
                break;
        }
        do {
            $endDate->addDays(1);
            $query = CryptoTransaction::query();
            foreach ($accountIds as $accountId) {
                $query->orWhere('crypto_account_id', $accountId);
            }
            $query->where('executed_at', '<', $endDate)
                ->where('executed_at', '>=', $startDate)
                ->orderBy("executed_at", "ASC");
            $transactions = $query->get();
            $step_transactions[$endDate->getTimestampMs()] = $transactions;
            $startDate = new Carbon($endDate);
            switch($type) {
                case CryptoTransaction::LINE_CHART_YEAR:
                    $endDate->addMonths(1);
                    break;
                case CryptoTransaction::LINE_CHART_MONTH:
                    $endDate->addDays(1);
                    break;
                case CryptoTransaction::LINE_CHART_WEEK:
                    $endDate->addDays(1);
                    break;
                case CryptoTransaction::LINE_CHART_DAY:
                    $endDate->addHours(1);
                    break;
                default:
                    break;
            }
            $endDate->addDays(-1);
        } while ($endDate->isPast());
        // https://support.cointracker.io/hc/en-us/articles/4413049704593-Cryptocurrency-Performance-and-Return#:~:text=Definitions,made%20on%20your%20cryptocurrency%20investing.
        // some important values.
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
            // echo "\ntransactions number: " . count($transactions) . "\n";
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
                $fiat_value = $currency->convertTo(floatval($value), $fiat, Carbon::createFromTimestampMsUTC($timestamp));
                $market_value = bcadd($market_value, number_format($fiat_value, $decimal_number, ".", ''));
            }
            // CryptoTransaction::$holding = $holding;
            // CryptoTransaction::$total_deposits = $total_deposits;
            // CryptoTransaction::$total_proceeds = $total_proceeds;
            // CryptoTransaction::$fiat_reinvested = $fiat_reinvested;
            $net_deposits = bcsub($total_deposits, $fiat_reinvested);
            $net_proceeds = bcsub($total_proceeds, $fiat_reinvested);
            // $total_return = bcadd($market_value, $net_proceeds);
            // $mwr = bcmul(bcsub(bcdiv($total_return, $net_deposits), "1"), "100");
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
            // $ret[$timestamp] = $market_value;
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
        bcscale(CryptoTransaction::DECIMAL_NUMBER);

        $query = CryptoTransaction::query()
            ->where('crypto_account_id', $account_id)
            ->orderBy("executed_at", "ASC");
        $transactions = $query->get();
        $enabled = [];

        function addToEnabled($symbol, $amount, $cost, $executed_at, $fiat, &$enabled, $decimal_number=CryptoTransaction::DECIMAL_NUMBER) {
            if (array_key_exists($symbol, $enabled)) {
                array_push($enabled[$symbol] ,[
                    'amount' => number_format($amount, $decimal_number, ".", ''),
                    'cost' => number_format($cost, $decimal_number, ".", ''),
                    'executed_at' => $executed_at,
                    'fiat' => $fiat,
                ]);
            } else {
                $enabled[$symbol] = [
                    [
                        'amount' => number_format($amount, $decimal_number, ".", ''),
                        'cost' => number_format($cost, $decimal_number, ".", ''),
                        'executed_at' => $executed_at,
                        'fiat' => $fiat,
                    ]
                ];
            }
        }

        function removeFromEnabled($symbol, $amount, &$enabled, $decimal_number=CryptoTransaction::DECIMAL_NUMBER) {
            // $amount_str = number_format($amount, $decimal_number, ".", '');
            $total_cost = '0';
            $rest_amount = number_format($amount, $decimal_number, ".", '');
            $assets = &$enabled[$symbol];
            foreach ($assets as $key => $asset) {
                if (bccomp($rest_amount, $asset['amount']) === 1) {
                    $rest_amount = bcsub($rest_amount, $asset['amount']);
                    $total_cost = bcadd($total_cost, $asset['cost']);
                    unset($assets[$key]);
                    // array_splice($assets, $key, 1);
                } else {
                    // $rest_cost = bcmul($asset['price'], $rest_amount);

                    $fiat_value = CryptoCurrency::findByShortName($symbol)->convertTo($rest_amount, $asset['fiat'], $asset['executed_at']);
                    $rest_cost = number_format($fiat_value, $decimal_number, ".", '');
                    $assets[$key]['amount'] = bcsub($asset['amount'], $rest_amount);
                    $assets[$key]['cost'] = bcsub($asset['cost'], $rest_cost);
                    // $assets[$key]['cost'] = bcmul($asset['cost'], $rest_cost);
                    $total_cost = bcadd($total_cost, $rest_cost);
                    $rest_amount = '0';
                    break;
                }
            }
            $assets = array_values($assets);
            return $total_cost;
        }

        $total_gain = 0;
        foreach ($transactions as $key => $transaction) {
            // toCostbasis
            $transaction->fiat = $fiat;
            $toCostBasis = $transaction->costCurrency->convertTo($transaction->cost, $fiat, $transaction->executed_at);
            if ($toCostBasis === null) {
                $toCostBasis = 0;
            }
            $fee = $transaction->feeCurrency->convertTo($transaction->fee, $fiat, $transaction->executed_at);
            $transaction->to_cost_basis = bcsub(
                number_format($toCostBasis, CryptoTransaction::DECIMAL_NUMBER, ".", ''),
                number_format($fee, CryptoTransaction::DECIMAL_NUMBER, ".", '')
            );
            switch ($transaction->trade_type) {
                case CryptoTransaction::TRAN_TYPE_RECEIVE:
                    $transaction->from_cost_basis = 0;
                    $transaction->gain = 0;
                    $price = $transaction->cryptoCurrency->convertTo(1, $fiat, $transaction->executed_at);
                    if ($price === null) {
                        $price = 0;
                    }

                    if ($price > 0) {
                        $currency = $transaction->cryptoCurrency->short_name;
                        addToEnabled($currency, $transaction->cost, $toCostBasis, $transaction->executed_at, $fiat, $enabled);
                    }

                    break;
                case CryptoTransaction::TRAN_TYPE_SEND:
                    $symbol = $transaction->cryptoCurrency->short_name;
                    $amount = $transaction->amount;
                    $transaction->from_cost_basis = removeFromEnabled($symbol, $amount, $enabled);
                    break;
                case CryptoTransaction::TRAN_TYPE_SELL:
                    $fromSymbol = $transaction->cryptoCurrency->short_name;
                    $fromAmount = $transaction->amount;
                    $toSymbol = $transaction->priceCurrency->short_name;
                    $toAmount = $transaction->cost;
                    $transaction->from_cost_basis = removeFromEnabled($fromSymbol, $fromAmount, $enabled);
                    $toCost = $transaction->priceCurrency->convertTo($toAmount, $fiat, $transaction->executed_at);
                    addToEnabled($toSymbol, $toAmount, $toCost, $transaction->executed_at, $fiat, $enabled);
                    break;
                case CryptoTransaction::TRAN_TYPE_BUY:
                    $fromSymbol = $transaction->priceCurrency->short_name;
                    $fromAmount = $transaction->cost;
                    $toSymbol = $transaction->cryptoCurrency->short_name;
                    $toAmount = $transaction->amount;
                    $transaction->from_cost_basis = removeFromEnabled($fromSymbol, $fromAmount, $enabled);
                    $toCost = $transaction->cryptoCurrency->convertTo($toAmount, $fiat, $transaction->executed_at);
                    addToEnabled($toSymbol, $toAmount, $toCost, $transaction->executed_at, $fiat, $enabled);
                    break;
                default:
                    # code...
                    break;
            }
            removeFromEnabled(
                $transaction->feeCurrency->short_name,
                $transaction->fee,
                $enabled
            );
            // $transaction->gain = 0;
            if ($transaction->trade_type != CryptoTransaction::TRAN_TYPE_RECEIVE) {
                $transaction->gain = bcsub($transaction->to_cost_basis, $transaction->from_cost_basis);
                $total_gain = bcadd($total_gain, number_format($transaction->gain, CryptoTransaction::DECIMAL_NUMBER, '.', ''));
            }
            $transaction->update([
                'to_cost_basis' => $transaction->to_cost_basis,
                'from_cost_basis' => $transaction->from_cost_basis,
                'gain' => $transaction->gain,
                'fiat' => $transaction->fiat,
            ]);
        }

        // var_dump($account_id);
        $cryptoAccount = CryptoAccount::find($account_id);
        $assets = $cryptoAccount->cryptoAssets;
        foreach ($assets as $asset) {
            $symbol = $asset->cryptoCurrency->short_name;
            if (array_key_exists($symbol, $enabled)) {
                $cost_basis = '0';
                foreach ($enabled[$symbol] as $cost) {
                    var_dump($cost['cost']);
                    var_dump($cost['amount']);
                    $cost_basis = bcadd(
                        $cost_basis,
                        $asset->cryptoCurrency->convertTo($cost['amount'], $fiat, floatval($cost['executed_at']) * 0.001)
                    );
                }
                $asset->update([
                    'cost_basis' => $cost_basis
                ]);
            }
            // var_dump($asset->cryptoCurrency->short_name);
        }
        // var_dump($cryptoAccount->cryptoAssets);
        return $enabled;
    }
}
