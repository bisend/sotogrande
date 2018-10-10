<?php

namespace App\Http\Helpers;

class UrlBuilder
{
    /**
     * Constants
     */

    /**
     * Url root sign
     *
     * @var string
     */
    const URL_ROOT = '/';

    /**
     * Home page
     *
     * @var string
     */
    const HOME_PAGE = 'home';

    /**
     * Category page
     *
     * @var string
     */
    const CATEGORY_PAGE = 'category';

    /**
     * Product page
     *
     * @var string
     */
    const PRODUCT_PAGE = 'product';

    /**
     * Contacts page
     *
     * @var string
     */
    const CONTACTS_PAGE = 'contact';

    /**
     * About page
     *
     * @var string
     */
    const ABOUT_PAGE = 'about';

    /**
     * Search page
     *
     * @var string
     */
    const SEARCH_PAGE = 'search';

    /**
     * Search page
     *
     * @var string
     */
    const SALE_PAGE = 'sale';

    const RENT_PAGE = 'rent';

    /**
     * confirm page
     * @var string
     */
    const CONFIRMATION_PAGE = 'confirm';

    /**
     * new email confirm page
     * @var string
     */
    const NEW_EMAIL_CONFIRMATION_PAGE = 'confirm-new-email';

    const SOCIAL_EMAIL_CONFIRMATION_PAGE = 'confirm-social-email';

    /**
     * Search async method name
     *
     * @var string
     */
    const SEARCH_ASYNC_METHOD = 'async';

    /**
     * Errors page
     *
     * @var string
     */
    const ERROR_PAGE = 'errors';

    /**
     * Url parts separator
     *
     * @var string
     */
    const URL_PARTS_SEPARATOR = '/';

    /**
     * Default url query series param
     *
     * @var string
     */
    const SERIES_PARAM = '_SERIES_';

    /**
     * Url query series separator(?param1=arg1+arg2&param2=...)
     *
     * @var string
     */
    const SERIES_SEPARATOR = '+';

    /**
     * Undefined url(null)
     *
     * @var string
     */
    const UNDEFINED_URL = '#header';

    /**
     * Undefined url part
     *
     * @var string
     */
    const UNDEFINED_URL_PART = '';

    /**
     * Undefined error url(null)
     *
     * @var string
     */
    const UNDEFINED_ERROR_URL = '404';

    /**
     * Url param values pair separator
     *
     * @var string
     */
    const PARAM_VALUES_PAIR_SEPARATOR = '=';

    /**
     * Url params separator
     *
     * @var string
     */
    const PARAMS_SEPARATOR = ';';

    /**
     * Url param values separator
     *
     * @var string
     */
    const PARAM_VALUES_SEPARATOR = ',';


    /*
     * Personal info page
     * @var string
     */
    const PERSONAL_INFO_PAGE = 'profile/personal-info';
    
    /*
     * Change password page
     * @var string
     */
    const CHANGE_PASSWORD_PAGE = 'profile/change-password';
    
    /*
     * My orders page
     * @var string
     */
    const MY_ORDERS_PAGE = 'profile/my-orders';

    /*
     * Wishlist page
     * @var string
     */
    const WISHLIST_PAGE = 'profile/wish-list';


    /*
     * Payment Delivery page
     * @var string
     */
    const PAYMENT_DELIVERY_PAGE = 'profile/payment-delivery';

    /*
     * Compare page
     * @var string
     */
    const COMPARE_PAGE = 'compare';
    
    /*
    * Order page
    * @var string
    */
    const ORDER = 'order/confirm';

    const BLOG_PAGE = 'blog/post';

    const BLOG_ALL_PAGE = 'blog';
    
    const LOOKBOOK_PAGE = 'lookbook';

    const LOOKBOOK_ALL_PAGE = 'lookbook/all';

    const COOPERATION_PAGE = 'cooperation';

    const STATIC_PAYMENT_DELIVERY_PAGE = 'payment-delivery';

    const ORDER_PAYMENT_CALLBACK = 'order/payment/callback';

    const ORDER_PAYMENT_ORDER = 'order/payment';

    const PROPERTY_PAGE = 'property';



    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build home page url
     *
     * @param string $language
     *
     * @return string
     */
    public static function home($language = Languages::DEFAULT_LANGUAGE)
    {
        return self::localize(url(self::URL_ROOT), $language);
    }

    public static function about($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::ABOUT_PAGE
        ]);

        return self::localize($url, $language);
    }

    public static function contact($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::CONTACTS_PAGE
        ]);

        return self::localize($url, $language);
    }

    public static function cooperation($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::COOPERATION_PAGE
        ]);

        return self::localize($url, $language);
    }

    public static function static_payment_delivery($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::STATIC_PAYMENT_DELIVERY_PAGE
        ]);

        return self::localize($url, $language);
    }

    public static function order_payment_callback($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::ORDER_PAYMENT_CALLBACK
        ]);

        return self::localize($url, $language);
    }

    public static function order_payment_order($order_number, $language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::ORDER_PAYMENT_ORDER,
            $order_number
        ]);

        return self::localize($url, $language);
    }
    
    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build current page url
     *
     * @param string $language
     *
     * @return string
     */
    public static function current($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::clearLanguage(url()->current());

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build category page url
     *
     * @param null|string $slug
     * @param string $language
     *
     * @return null|string
     */
    public static function category($slug = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$slug)
        {
            return self::UNDEFINED_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::CATEGORY_PAGE,
            $slug
        ]);

        return self::localize($url, $language);
    }

    /**
     * confirmation email url
     * @param null $confirmationToken
     * @param string $language
     * @return string
     */
    public static function confirmation($confirmationToken = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$confirmationToken)
        {
            return self::UNDEFINED_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::CONFIRMATION_PAGE,
            $confirmationToken
        ]);

        return self::localize($url, $language);
    }

    /**
     * confirmation new email url
     * @param null $confirmationToken
     * @param string $language
     * @return string
     */
    public static function newEmailConfirmation($confirmationToken = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$confirmationToken)
        {
            return self::UNDEFINED_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::NEW_EMAIL_CONFIRMATION_PAGE,
            $confirmationToken
        ]);

        return self::localize($url, $language);
    }

    public static function socialEmailConfirmation($confirmationToken = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$confirmationToken)
        {
            return self::UNDEFINED_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::SOCIAL_EMAIL_CONFIRMATION_PAGE,
            $confirmationToken
        ]);

        return self::localize($url, $language);
    }

    /**
     * Build category page url
     *
     * @param null|string $slug
     * @param int $page
     * @param string $language
     *
     * @return null|string
     */
    public static function categoryPerPage($slug = null, $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$slug) {
            return self::UNDEFINED_URL;
        }

        if ($page < 1)
        {
            $page = 1;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::CATEGORY_PAGE,
            $slug
        ]);
        
        if ($page > 1) {
            $url = self::concatParts([$url, $page]);
        }

        return self::localize($url, $language);
    }

    /**
     * Build orders per page page url
     *
     * 
     * @param int $page
     * @param string $language
     *
     * @return null|string
     */
    public static function ordersPerPage($page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        if ($page < 1)
        {
            $page = 1;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::MY_ORDERS_PAGE
        ]);

        if ($page > 1) {
            $url = self::concatParts([$url, $page]);
        }

        return self::localize($url, $language);
    }

    /**
     * Build wish_list_per_page page url
     *
     *
     * @param int $page
     * @param string $language
     *
     * @return null|string
     */
    public static function wishListPerPage($page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        if ($page < 1)
        {
            $page = 1;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::WISHLIST_PAGE
        ]);

        if ($page > 1) {
            $url = self::concatParts([$url, $page]);
        }

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build product page url
     *
     * @param null|string $slug
     * @param string $language
     *
     * @return null|string
     */
    public static function product($slug = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$slug) {
            return self::UNDEFINED_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::PRODUCT_PAGE,
            $slug
        ]);

        return self::localize($url, $language);
    }
    
    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build order page url
     *
     * @param string $language
     *
     * @return null|string
     */
    public static function order($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::ORDER
        ]);

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build personal-info page url
     *
     * @param string $language
     *
     * @return null|string
     */
    public static function personalInfo($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::PERSONAL_INFO_PAGE
        ]);

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build change-password page url
     *
     * @param string $language
     *
     * @return null|string
     */
    public static function changePassword($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::CHANGE_PASSWORD_PAGE
        ]);

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build my-orders page url
     *
     * @param string $language
     *
     * @return null|string
     */
    public static function myOrders($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::MY_ORDERS_PAGE
        ]);

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build wish-list page url
     *
     * @param string $language
     *
     * @return null|string
     */
    public static function wishlist($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::WISHLIST_PAGE
        ]);

        return self::localize($url, $language);
    }
    
    
    public static function paymentDelivery($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::PAYMENT_DELIVERY_PAGE
        ]);

        return self::localize($url, $language);
    }
    
    
    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build search page url
     *
     * @param null|string $series
     * @param string $language
     *
     * @return null|string
     */
    public static function search($series = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$series) {
            $series = self::SERIES_PARAM;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::SEARCH_PAGE,
            $series
        ]);

        return self::localize($url, $language);
    }

    /**
     * Build search(per page) page url
     *
     * @param null|string $series
     * @param int $page
     * @param string $language
     *
     * @return null|string
     */
    public static function searchPerPage($series = null, $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$series) {
            $series = self::SERIES_PARAM;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::SEARCH_PAGE,
            $series
        ]);

        if ($page > 1) {
            $url = self::concatParts([$url, $page]);
        }

        return self::localize($url, $language);
    }

    public static function sale($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::SALE_PAGE
        ]);

        return self::localize($url, $language);
    }
    
    public static function rent($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::RENT_PAGE
        ]);

        return self::localize($url, $language);
    }

    public static function salePerPage($sort = 'default', $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        if ($sort == 'default')
        {
            $url = self::concatParts([
                url(self::URL_ROOT),
                self::SALE_PAGE
            ]);
        }
        else
        {
            $url = self::concatParts([
                url(self::URL_ROOT),
                self::SALE_PAGE,
                $sort
            ]);
        }

        if ($page > 1) {
            $url = self::concatParts([$url, $page]);
        }

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Clear language param in the given url
     *
     * @param null|string $url
     *
     * @return string
     */
    public static function clearLanguage($url = null)
    {
        if (!$url) {
            return self::UNDEFINED_URL;
        }

        $url = preg_replace(Languages::SUPPORTED_LANGUAGES_REGULAR, self::UNDEFINED_URL_PART, $url);

        return trim($url, self::URL_ROOT);
    }


    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Localize given url with a given language
     *
     * @param null|string $url
     * @param string $language
     *
     * @return string
     */
    public static function localize($url = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$url) {
            return self::UNDEFINED_URL;
        }
        if (!$language) {
            $language = Languages::DEFAULT_LANGUAGE;
        }

        if ($language == Languages::DEFAULT_LANGUAGE) {
            return $url;
        }

        return self::concatParts([$url, $language]);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build error page url
     *
     * @param null $code
     * @param string $language
     *
     * @return null|string
     */
    public static function error($code = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$code) {
            $code = self::UNDEFINED_ERROR_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::ERROR_PAGE,
            $code
        ]);

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Category filters
     */

    /**
     * Build category filters page url
     *
     * @param null|string $slug
     * @param null|string $filtersParam
     * @param null|string $filterName
     * @param $filterValue
     * @param string $language
     *
     * @return string
     */
    public static function categoryFilters(
        $slug = null,
        $filtersParam = null,
        $filterName = null,
        $filterValue = null,
        $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$slug || !$filterName || !$filterValue) {
            return self::UNDEFINED_URL;
        }

        if (!$filtersParam) {
            $param = self::stringPairToParam($filterName, $filterValue);
        } else {
            $filtersParam = trim(trim($filtersParam, self::PARAMS_SEPARATOR));
            if (str_contains($filtersParam, $filterName) && str_contains($filtersParam, $filterValue)) {
                $param = $filtersParam;
            } else {
                $param = self::concatParamsWithStringPair($filtersParam, $filterName, $filterValue);
                $param = self::paramsToPairs($param);
                $param = self::pairsToParams($param);
            }
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::CATEGORY_PAGE,
            $slug,
            $param
        ]);

        return self::localize($url, $language);
    }
    
    public static function categoryFiltersWithoutParam(
        $slug = null,
        $filtersParam = null,
        $filterName = null,
        $filterValue = null,
        $priceMin = null,
        $priceMax = null,
        $language = Languages::DEFAULT_LANGUAGE)
    {
        $param = '';

        $nameWithValues = explode(';', $filtersParam);

        $parsedFilters = [];

        foreach ($nameWithValues as $item)
        {
            $pairNameValues = explode('=', $item);
                $parsedFilters[$pairNameValues[0]] = explode(',', $pairNameValues[1]);
        }

        $newParsedFilters = [];

        foreach ($parsedFilters as $key => $value)
        {
            foreach ($value as $fValue)
            {
                if ($fValue != $filterValue)
                {
                    $newParsedFilters[$key][] = $fValue;
                }
            }
        }


        $pairs = [];

        foreach ($newParsedFilters as $name => $values)
        {
            if ($priceMin && $priceMax)
            {
                $str = $name . '=' . implode(',', $values);
                if (!str_contains($str, 'price-range'))
                {
                    $pairs[] = $str;
                }
            }
            else
            {
                $str = $name . '=' . implode(',', $values);
                $pairs[] = $str;
            }

        }

        $param = implode(';', $pairs);

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::CATEGORY_PAGE,
            $slug,
            $param
        ]);
        
        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build category filters page per page url
     *
     * @param null|string $slug
     * @param null|string $filtersParam
     * @param int $page
     * @param string $language
     *
     * @return string
     */
    public static function categoryFiltersPerPage(
        $slug = null,
        $filtersParam = null,
        $page = 1,
        $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$slug || !$filtersParam) {
            return self::UNDEFINED_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::CATEGORY_PAGE,
            $slug,
            $filtersParam
        ]);

        if ($page > 1) {
            $url = self::concatParts([$url, $page]);
        }

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Helpers
     */

    /**
     * Convert url query string series to the string
     *
     * @param null|string $series
     *
     * @return string
     */
    public static function seriesToString($series = null)
    {
        if (!$series) {
            return self::UNDEFINED_URL_PART;
        }

        $separator = '\\' . self::SERIES_SEPARATOR;

        return preg_replace("/$separator+/i", ' ', $series);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Convert string key/value to the url param string
     *
     * @param null|string $key
     * @param null|string $value
     * @param bool $isLastParam
     *
     * @return string
     */
    public static function stringPairToParam($key = null, $value = null, $isLastParam = true)
    {
        if (!$key || !$value) {
            return self::UNDEFINED_URL_PART;
        }

        $paramValue = $key . self::PARAM_VALUES_PAIR_SEPARATOR . $value;

        if (!$isLastParam) {
            $paramValue .= self::PARAMS_SEPARATOR;
        }

        return $paramValue;
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Convert url param string to string array pair
     *
     * @param null|string $param
     *
     * @return array|string
     */
    public static function paramToPair($param = null)
    {
        $pair = [];

        if (!$param) {
            return $pair;
        }

        $param = trim($param);

        $keys = explode(self::PARAM_VALUES_PAIR_SEPARATOR, $param);
        if (!$keys || count($keys) <= 1) {
            return $pair;
        }

        $values = explode(self::PARAM_VALUES_SEPARATOR, $keys[1]);
        if (!$values || ($valuesCount = count($values)) == 0) {
            return $pair;
        }

        for ($i = 0; $i < 1; $i++) {
            for ($j = 0; $j < $valuesCount; $j++) {
                $pair[$keys[$i]][$values[$j]] = $values[$j];
            }
        }

        return $pair;
    }

    /**
     * Convert url params string to string array pairs
     *
     * @param null|string $params
     *
     * @return array|string
     */
    public static function paramsToPairs($params = null)
    {
        $pairs = [];

        if (!$params) {
            return $pairs;
        }

        $params = trim(trim($params, self::PARAMS_SEPARATOR));
        if (!$params) {
            return $pairs;
        }

        $params = explode(self::PARAMS_SEPARATOR, $params);
        if (!$params || count($params) == 0) {
            return $pairs;
        }

        foreach ($params as $param) {
            $pair = self::paramToPair($param);
            if (!$pair) {
                continue;
            }

            $pairs = array_merge_recursive($pairs, $pair);
        }

        return array_sort_recursive($pairs);
    }

    // -----------------------------------------------------------------------------------------------------------------
    public static function pairsToParams($pairs = null)
    {
        $params = '';

        if (!$pairs) {
            return self::UNDEFINED_URL;
        }

        foreach ($pairs as $key => $values) {
            $paramName = $key . self::PARAM_VALUES_PAIR_SEPARATOR;
            $paramValue = '';
            foreach ($values as $value) {
                $paramValue .= $value . self::PARAM_VALUES_SEPARATOR;
            }
            $paramValue = trim(trim($paramValue, self::PARAM_VALUES_SEPARATOR));
            $paramName .= $paramValue . self::PARAMS_SEPARATOR;

            $params .= $paramName;
        }

        $params = trim(trim($params, self::PARAMS_SEPARATOR));

        if (!$params) {
            return self::UNDEFINED_URL;
        }

        return $params;
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Concat url parts
     *
     * @param null|array $parts
     * @param string $separator
     *
     * @return string
     */
    public static function concatParts($parts = null, $separator = self::URL_PARTS_SEPARATOR)
    {
        if (!$parts || !$separator) {
            return self::UNDEFINED_URL_PART;
        }

        $result = '';

        foreach ($parts as $part) {
            if (preg_match('/^http:|https:/i', $part)) {
                $result .= trim($part, $separator);
            } else {
                $result .= $separator . trim($part, $separator);
            }
        }

        return $result;
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Concat url params with a string pair
     *
     * @param null|string $params
     * @param null|string $pairName
     * @param null|string $pairValue
     * @param string $separator
     * @param bool $isLastParam
     *
     * @return string
     */
    public static function concatParamsWithStringPair(
        $params = null,
        $pairName = null,
        $pairValue = null,
        $separator = self::PARAMS_SEPARATOR,
        $isLastParam = true)
    {
        if (!$params || !$pairName || !$pairValue || !$separator) {
            return self::UNDEFINED_URL_PART;
        }

        $result = $params . $separator . self::stringPairToParam($pairName, $pairValue, $isLastParam);

        return $result;
    }
    
    public static function blog($alias = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if ( ! $alias)
        {
            return self::UNDEFINED_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::BLOG_PAGE,
            $alias
        ]);

        return self::localize($url, $language);
    }
    
    public static function allBlogs($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::BLOG_ALL_PAGE
        ]);

        return self::localize($url, $language);
    }
    
    public static function allBlogsPerPage($page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        if ($page < 1)
        {
            $page = 1;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::BLOG_ALL_PAGE,
        ]);

        if ($page > 1) {
            $url = self::concatParts([$url, $page]);
        }

        return self::localize($url, $language);
    }
    
    public static function lookbookPage()
    {
        
    }
    
    public static function lookbookAllPage($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::LOOKBOOK_ALL_PAGE
        ]);

        return self::localize($url, $language);
    }

    public static function property($alias = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if ( ! $alias)
        {
            return self::UNDEFINED_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::PROPERTY_PAGE,
            $alias
        ]);

        return self::localize($url, $language);
    }
}