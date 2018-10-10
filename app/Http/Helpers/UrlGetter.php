<?php

use App\Http\Helpers\Languages;
use App\Http\Helpers\UrlBuilder;


// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_home
 */
if (!function_exists('url_home')) {

    /**
     * Get the home page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_home($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::home($language);
    }
}
// ---------------------------------------------------------------------------------------------------------------------

if (!function_exists('url_confirmation'))
{
    function url_confirmation($confirmationToken = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::confirmation($confirmationToken, $language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------

if (!function_exists('url_new_email_confirmation'))
{
    function url_new_email_confirmation($confirmationToken = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::newEmailConfirmation($confirmationToken, $language);
    }
}

if (!function_exists('url_social_email_confirmation'))
{
    function url_social_email_confirmation($confirmationToken = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::socialEmailConfirmation($confirmationToken, $language);
    }
}



// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_current
 */
if (!function_exists('url_current')) {

    /**
     * Get the current page url
     *
     * @param string $language
     * @return string
     */
    function url_current($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::current($language);
    }
}



// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_category
 */
if (!function_exists('url_category')) {

    /**
     * Get the category page url
     *
     * @param null|string $slug
     * @param string $language
     *
     * @return string
     */
    function url_category($slug = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::category($slug, $language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_category_per_page
 */
if (!function_exists('url_category_per_page')) {

    /**
     * Get the category(per page) page url
     *
     * @param null|string $slug
     * @param int $page
     * @param string $language
     *
     * @return string
     */
    function url_category_per_page($slug = null, $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::categoryPerPage($slug, $page, $language);
    }
}


// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_category_filters
 */
if (!function_exists('url_category_filters')) {

    /**
     * Get the category filters page url
     *
     * @param null|string $slug
     * @param null|string $filtersParam
     * @param null|string $filterName
     * @param null|string $filterValue
     * @param string $language
     *
     * @return string
     */
    function url_category_filters(
        $slug = null,
        $filtersParam = null,
        $filterName = null,
        $filterValue = null,
        $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::categoryFilters($slug, $filtersParam, $filterName, $filterValue, $language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_category_filters
 */
if (!function_exists('url_category_filters_per_page')) {

    /**
     * Get the category filters page per page url
     *
     * @param null|string $slug
     * @param null|string $filtersParam
     * @param int $page
     * @param string $language
     *
     * @return string
     */
    function url_category_filters_per_page(
        $slug = null,
        $filtersParam = null,
        $page = 1,
        $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::categoryFiltersPerPage($slug, $filtersParam, $page, $language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_category_filters without param
 */
if (!function_exists('url_category_filters_without_param')) {

    /**
     * @param null $slug
     * @param null $filtersParam
     * @param $filterName
     * @param $filterValue
     * @param $priceMin
     * @param $priceMax
     * @param string $language
     * @return string
     */
    function url_category_filters_without_param(
        $slug = null,
        $filtersParam = null,
        $filterName,
        $filterValue,
        $priceMin,
        $priceMax,
        $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::categoryFiltersWithoutParam($slug, $filtersParam, $filterName, $filterValue, $priceMin, $priceMax, $language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_product
 */
if (!function_exists('url_product')) {

    /**
     * Get the product page url
     *
     * @param null|string $slug
     * @param string $language
     *
     * @return string
     */
    function url_product($slug = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::product($slug, $language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------

/**
 * url order
 */
if (!function_exists('url_order')) {

    /**
     * Get the order page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_order($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::order($language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------

/**
 * url personal_info
 */
if (!function_exists('url_personal_info')) {

    /**
     * Get the personal-info page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_personal_info($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::personalInfo($language);
    }
}

if (!function_exists('url_payment_delivery')) {

    /**
     * Get the personal-info page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_payment_delivery($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::paymentDelivery($language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------

/**
 * url change_password
 */
if (!function_exists('url_change_password')) {

    /**
     * Get the change-password page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_change_password($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::changePassword($language);
    }
}

/**
 * url my_orders
 */
if (!function_exists('url_my_orders')) {

    /**
     * Get the my-orders page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_my_orders($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::myOrders($language);
    }
}

/**
 * url my_orders per page
 */
if (!function_exists('url_my_orders_per_page')) {

    /**
     * Get the my-orders per page page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_my_orders_per_page($page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::ordersPerPage($page, $language);
    }
}

/**
 * url wishListPerPage
 */
if (!function_exists('url_wish_list_per_page')) {

    /**
     * Get the wishListPerPage page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_wish_list_per_page($page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::wishListPerPage($page, $language);
    }
}

/**
 * url wish_list
 */
if (!function_exists('url_wish_list')) {

    /**
     * Get the wish-list page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_wish_list($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::wishlist($language);
    }
}


// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_search
 */
if (!function_exists('url_search')) {

    /**
     * Get the search page url
     *
     * @param null|string $series
     * @param string $language
     *
     * @return null|string
     */
    function url_search($series = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::search($series, $language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_search_per_page
 */
if (!function_exists('url_search_per_page')) {

    /**
     * Get the search(per page) page url
     *
     * @param null|string $series
     * @param int $page
     * @param string $language
     *
     * @return string
     */
    function url_search_per_page($series = null, $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::searchPerPage($series, $page, $language);
    }
}

if (!function_exists('url_sale_per_page')) {
    function url_sale_per_page($sort = 'default', $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::salePerPage($sort, $page, $language);
    }
}

if (!function_exists('url_sale')) {
    function url_sale($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::sale($language);
    }
}

if (!function_exists('url_rent')) {
    function url_rent($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::rent($language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------
/*
 * setting formatted price
 */
if (!function_exists('set_format_price')) {

    function set_format_price($price, $product_count = 1)
    {
        return sprintf('%0.2f', round($price, 2, PHP_ROUND_HALF_UP) * $product_count);
    }
}

if (!function_exists('url_blog_page'))
{
    function url_blog_page($alias = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::blog($alias, $language);
    }
}

if (!function_exists('url_all_blogs'))
{
    function url_all_blogs($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::allBlogs($language);
    }
}

if (!function_exists('url_all_blogs_per_page'))
{
    function url_all_blogs_per_page($page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::allBlogsPerPage($page, $language);
    }
}

if (!function_exists('url_all_lookbook'))
{
    function url_all_lookbook($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::lookbookAllPage($language);
    }
}

if (!function_exists('url_about'))
{
    function url_about($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::about($language);
    }
}

if (!function_exists('url_contact'))
{
    function url_contact($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::contact($language);
    }
}

if (!function_exists('url_cooperation'))
{
    function url_cooperation($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::cooperation($language);
    }
}

if (!function_exists('url_static_payment_delivery'))
{
    function url_static_payment_delivery($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::static_payment_delivery($language);
    }
}

if (!function_exists('url_order_payment_callback'))
{
    function url_order_payment_callback($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::order_payment_callback($language);
    }
}

if (!function_exists('url_order_payment_order'))
{
    function url_order_payment_order($order_number, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::order_payment_order($order_number, $language);
    }
}

if ( ! function_exists('url_property'))
{

    /**
     * Get the property page url
     *
     * @param null|string $alias
     * @param string $language
     *
     * @return string
     */
    function url_property($alias = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::property($alias, $language);
    }
}