<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Get a setting value by key
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        return Setting::get($key, $default);
    }
}

if (!function_exists('format_price')) {
    /**
     * Format price to Indonesian Rupiah format
     * 
     * @param float $price
     * @return string
     */
    function format_price($price)
    {
        if ($price == 0) {
            return 'GRATIS';
        }
        return 'Rp ' . number_format($price, 0, ',', '.');
    }
}

if (!function_exists('truncate_html')) {
    /**
     * Truncate HTML string while preserving tags
     * 
     * @param string $html
     * @param int $length
     * @param string $ending
     * @return string
     */
    function truncate_html($html, $length = 100, $ending = '...')
    {
        $text = strip_tags($html);
        if (strlen($text) > $length) {
            return substr($text, 0, $length) . $ending;
        }
        return $text;
    }
}

if (!function_exists('get_social_links')) {
    /**
     * Get all social media links
     * 
     * @return array
     */
    function get_social_links()
    {
        return [
            'facebook' => setting('social_facebook'),
            'instagram' => setting('social_instagram'),
            'twitter' => setting('social_twitter'),
            'youtube' => setting('social_youtube'),
            'tiktok' => setting('social_tiktok'),
        ];
    }
}

if (!function_exists('get_contact_info')) {
    /**
     * Get contact information
     * 
     * @return array
     */
    function get_contact_info()
    {
        return [
            'phone' => setting('contact_phone'),
            'email' => setting('contact_email'),
            'whatsapp' => setting('contact_whatsapp'),
            'address' => setting('contact_address'),
        ];
    }
}

if (!function_exists('whatsapp_url')) {
    /**
     * Generate WhatsApp URL with pre-filled message
     * 
     * @param string $message
     * @return string
     */
    function whatsapp_url($message = '')
    {
        $whatsapp = setting('contact_whatsapp', '6281234567890');
        $encodedMessage = urlencode($message);
        return "https://wa.me/{$whatsapp}" . ($message ? "?text={$encodedMessage}" : '');
    }
}
