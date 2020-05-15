<?php

namespace Bitskins;

class BitskinsApi
{
    protected $apiKey;
    protected $client;

    protected $entryPoint = "https://bitskins.com/api/v1/";

    public function __construct($client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    /**
     * Get Account balance
     *
     * @see https://bitskins.com/api#get_account_balance
     * @param string $code
     * @return mixed
     */
    public function getAccountBalance(string $code)
    {
        $method = 'get_account_balance';

        return $this->request(
            $this->buildEndpoint($method, compact('code'))
        );
    }

    /**
     * Get All item Prices
     *
     * @see https://bitskins.com/api#get_all_item_prices
     * @param string $code
     * @param int $app_id
     * @return mixed
     */
    public function getAllItemPrices(string $code, int $app_id = 730)
    {
        $method = 'get_all_item_prices';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id'))
        );
    }

    /**
     * Get Market Data
     *
     * @see https://bitskins.com/api#get_price_data_for_items_on_sale
     * @param string $code
     * @param int $app_id
     * @return mixed
     */
    public function getMarketData(string $code, int $app_id = 730)
    {
        $method = 'get_price_data_for_items_on_sale';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id'))
        );
    }

    /**
     * Get Account Inventory
     *
     * @see https://bitskins.com/api#get_my_inventory
     * @param string $code
     * @param int $app_id
     * @param int|null $page
     * @return mixed
     */
    public function getAccountInventory(string $code, int $app_id = 730, int $page = null)
    {
        $method = 'get_my_inventory';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'page'))
        );
    }

    /**
     * Get Inventory on sale
     *
     * @see https://bitskins.com/api#get_inventory_on_sale
     * @param string $code
     * @param int $app_id
     * @param array $options
     * @param int|null $page
     * @return mixed
     */
    public function getInventoryOnSale(string $code, int $app_id = 730, array $options = [], int $page = null)
    {
        $method = 'get_inventory_on_sale';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'options', 'page'))
        );
    }

    /**
     * Get Specific Items on Sale
     *
     * @see https://bitskins.com/api#get_specific_items_on_sale
     * @param string $code
     * @param array $item_ids
     * @param int $app_id
     * @return mixed
     */
    public function getSpecificItemsOnSale(string $code, array $item_ids, int $app_id = 730)
    {
        $method = 'get_specific_items_on_sale';

        $item_ids = implode(',', $item_ids);

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'item_ids'))
        );
    }

    /**
     * Get Reset price items
     *
     * @see https://bitskins.com/api#get_reset_price_items
     * @param string $code
     * @param int $app_id
     * @param int|null $page
     * @return mixed
     */
    public function getResetPriceItems(string $code, int $app_id = 730, int $page = null)
    {
        $method = 'get_reset_price_items';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'page'))
        );
    }

    /**
     * Get Money Events
     *
     * @see https://bitskins.com/api#get_money_events
     * @param string $code
     * @param int|null $page
     * @return mixed
     */
    public function getMoneyEvents(string $code, int $page = null)
    {
        $method = 'get_money_events';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'page'))
        );
    }

    /**
     * Money Withdrawal
     *
     * @see https://bitskins.com/api#request_withdrawal
     * @param string $code
     * @param int $amount
     * @param string $withdrawal_method
     * @return mixed
     */
    public function moneyWithdrawal(string $code, int $amount, string $withdrawal_method)
    {
        $method = 'request_withdrawal';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'amount', 'withdrawal_method'))
        );
    }

    /**
     * Buy item
     *
     * @see https://bitskins.com/api#buy_item
     * @param string $code
     * @param int $app_id
     * @param array $item_ids
     * @param array $prices
     * @param bool $auto_trade
     * @param bool $allow_trade_delayed_purchases
     * @return mixed
     */
    public function buyItem(string $code, array $item_ids, array $prices, int $app_id = 730, bool $auto_trade = true, bool $allow_trade_delayed_purchases = false)
    {
        $method = 'buy_item';

        $item_ids = implode(',', $item_ids);
        $prices = implode(',', $prices);

        return $this->request(
            $this->buildEndpoint($method, compact(
                    'code',
                    'app_id',
                    'item_ids',
                    'prices',
                    'allow_trade_delayed_purchases'
                )
            )
        );
    }

    /**
     * Sell item
     *
     * @see https://bitskins.com/api#list_item_for_sale
     * @param string $code
     * @param int $app_id
     * @param array $item_ids
     * @param array $prices
     * @return mixed
     */
    public function sellItem(string $code, array $item_ids, array $prices, int $app_id = 730)
    {
        $method = 'list_item_for_sale';

        $item_ids = implode(',', $item_ids);
        $prices = implode(',', $prices);

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'item_ids', 'prices'))
        );
    }

    /**
     * Change the price on an item currently on sale
     *
     * @see https://bitskins.com/api#modify_sale_item
     * @param string $code
     * @param array $item_ids
     * @param array $prices
     * @param int $app_id
     * @return mixed
     */
    public function modifySale(string $code, array $item_ids, array $prices, int $app_id = 730)
    {
        $method = 'modify_sale_item';

        $item_ids = implode(',', $item_ids);
        $prices = implode(',', $prices);

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'item_ids', 'prices'))
        );
    }

    /**
     * Delist an active sale item.
     *
     * @see https://bitskins.com/api#delist_item
     * @param string $code
     * @param array $item_ids
     * @param int $app_id
     * @return mixed
     */
    public function delistItem(string $code, array $item_ids, int $app_id = 730)
    {
        $method = 'delist_item';

        $item_ids = implode(',', $item_ids);

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'item_ids'))
        );
    }

    /**
     * Re-list a delisted/purchased item for sale.
     * Re-listed items can be sold instantly, where applicable.
     *
     * @see https://bitskins.com/api#relist_item
     * @param string $code
     * @param array $item_ids
     * @param array $prices Use 'instant' if selling instantly.
     * @param int $app_id
     * @return mixed
     */
    public function relistItem(string $code, array $item_ids, array $prices, int $app_id = 730)
    {
        $method = 'delist_item';

        $item_ids = implode(',', $item_ids);
        $prices = implode(',', $prices);

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'item_ids', 'prices'))
        );
    }

    /**
     * Withdraw Item. Allows you to delist an active sale item and/or re-attempt an item pending withdrawal.
     *
     * @see https://bitskins.com/api#withdraw_item
     * @param string $code
     * @param array $item_ids
     * @param int $app_id
     * @return mixed
     */
    public function withdrawItem(string $code, array $item_ids, int $app_id = 730)
    {
        $method = 'withdraw_item';

        $item_ids = implode(',', $item_ids);

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'item_ids'))
        );
    }

    /**
     * Bump items higher for $0.75. Must have 2FA enabled if not logged in.
     *
     * @see https://bitskins.com/api#bump_item
     * @param string $code
     * @param array $item_ids
     * @param int $app_id
     * @return mixed
     */
    public function bumpItem(string $code, array $item_ids, int $app_id = 730)
    {
        $method = 'bump_item';

        $item_ids = implode(',', $item_ids);

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'item_ids'))
        );
    }

    /**
     * Retrieve your history of bought items on BitSkins.
     * Defaults to 30 items per page, with most recent appearing first.
     *
     * @see https://bitskins.com/api#get_buy_history
     * @param string $code
     * @param int $app_id
     * @param int|null $page
     * @return mixed
     */
    public function getBuyHistory(string $code, int $app_id = 730, int $page = null)
    {
        $method = 'get_buy_history';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'page'))
        );
    }

    /**
     * Retrieve your history of sold items on BitSkins.
     * Defaults to 30 items per page, with most recent appearing first.
     *
     * @see https://bitskins.com/api#get_sell_history
     * @param string $code
     * @param int $app_id
     * @param int|null $page
     * @return mixed
     */
    public function getSellHistory(string $code, int $app_id = 730, int $page = null)
    {
        $method = 'get_sell_history';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'page'))
        );
    }

    /**
     * Allows you to retrieve bought/sold/listed item history.
     * By default, upto 30 items per page, and optionally up to 480 items per page.
     *
     * @see https://bitskins.com/api#get_sell_history
     * @param string $code
     * @param int $app_id
     * @param int|null $page
     * @param array $names
     * @param string $delimiter
     * @param int $per_page
     * @return mixed
     */
    public function getItemHistory(string $code, int $app_id = 730, int $page = null, array $names = [], string $delimiter = ",", int $per_page = 30)
    {
        $method = 'get_item_history';

        $names = implode($delimiter, $names);

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'page', 'names', 'delimiter', 'per_page'))
        );
    }

    /**
     * Allows you to retrieve information about items requested/sent in a given trade from BitSkins.
     * Trade details will be unretrievable 7 days after the initiation of the trade.
     *
     * @see https://bitskins.com/api#get_trade_details
     * @param string $code
     * @param string $trade_token
     * @param int $trade_id
     * @return mixed
     */
    public function getTradeDetails(string $code, string $trade_token, int $trade_id)
    {
        $method = 'get_trade_details';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'trade_token', 'trade_id'))
        );
    }

    /**
     * Allows you to retrieve information about 50 most recent trade offers sent by BitSkins.
     * Response contains 'steam_trade_offer_state,' which is '2' if the only is currently active.
     *
     * @see https://bitskins.com/api#get_recent_trade_offers
     * @param string $code
     * @param bool $active_only
     * @return mixed
     */
    public function getRecentTradeOffers(string $code, bool $active_only = false)
    {
        $method = 'get_recent_trade_offers';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'active_only'))
        );
    }

    /**
     * Retrieve upto 5 pages worth of recent sale data for a given item name.
     * These are the recent sales for the given item at BitSkins, in descending order.
     *
     * @see https://bitskins.com/api#get_sales_info
     * @param string $code
     * @param string $market_hash_name
     * @param int $app_id
     * @param int|null $page
     * @return mixed
     */
    public function getSalesInfo(string $code, string $market_hash_name, int $app_id = 730, int $page = null)
    {
        $method = 'get_sales_info';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'app_id', 'market_hash_name', 'page'))
        );
    }

    /**
     * Allows you to retrieve raw Steam Community Market price data for a given item.
     * You can use this data to create your own pricing algorithm if you need it.
     *
     * @see https://bitskins.com/api#get_steam_price_data
     * @param string $code
     * @param string $market_hash_name
     * @param int $app_id
     * @return mixed
     */
    public function getSteamPriceData(string $code, string $market_hash_name, int $app_id = 730)
    {
        $method = 'get_steam_price_data';

        return $this->request(
            $this->buildEndpoint($method, compact('code', 'market_hash_name', 'app_id'))
        );
    }

    public function request(string $endpoint)
    {
        $response = $this->client->request('GET', $endpoint);

        return json_decode($response->getBody(), true);
    }

    protected function buildEndpoint(string $method, array $parameters) : string
    {
        $parameters['api_key'] = $this->apiKey;
        $options = "";

        if (array_key_exists('options', $parameters) && $parameters['options']) {
            $options = '&' . http_build_query($parameters['options']);
            unset($parameters['options']);
        }

        $query = http_build_query($parameters) . $options;

        return $this->entrypoint . $method . '/?' . $query;
    }
}