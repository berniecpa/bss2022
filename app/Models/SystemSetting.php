<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'option',
        'value'
    ];

    /**
     * Default Company Settings
     *
     * @var array
     */
    public static $defaultSettings = [
        'application_name' => 'Foxtrot',
        'application_logo' => '/assets/images/foxtrot-black.png',
        'application_favicon' => '/assets/images/fox-logo-black.svg',
        'application_currency' => 'USD',
        'meta_description' => 'Foxtrot - Customer, Invoice and Expense Management System',
        'meta_keywords' => 'accounting, billing, business management, client management',
        'theme' => 'bikin',
        'paypal_username' => '',
        'paypal_password' => '',
        'paypal_signature' => '',
        'paypal_test_mode' => false,
        'paypal_active' => false,
        'stripe_public_key' => '',
        'stripe_secret_key' => '',
        'stripe_test_mode' => false,
        'stripe_active' => false,
        'razorpay_id' => '',
        'razorpay_secret_key' => '',
        'razorpay_test_mode' => false,
        'razorpay_active' => false,
        'version' => '1.0.0',
        'mollie_api_key' => '',
        'mollie_test_mode' => false,
        'mollie_active' => false,
        'google_recapthca_key' => '',
        'recurring_invoice_cycle' => 13,
        'expiring_subscription_overdue_mail_subject' => 'Your subscription is expired!',
        'expiring_subscription_overdue_mail_content' => '<p>Please update your payment settings in order to continue our platform.</p><br><br>',
        'expiring_subscription_overdue_after_x_days' => 3,
        'expiring_subscription_due_mail_subject' => 'Your subscription is expiring!',
        'expiring_subscription_due_mail_content' => '<p>Please update your payment settings in order to continue our platform.</p><br><br>',
        'expiring_subscription_due_before_x_days' => 2, 
        'custom_css' => '',
        'custom_js' => '',
        'recurring_expense_cycle' => 13,
        'verify_user_email_address' => false,
    ];

    /**
     * Set new or update existing System Settings.
     *
     * @param string $key
     * @param string $setting
     *
     * @return void
     */
    public static function setSetting($key, $setting)
    {
        $old = self::whereOption($key)->first();

        if ($old) {
            $old->value = $setting;
            $old->save();
            return;
        }

        $set = new SystemSetting();
        $set->option = $key;
        $set->value = $setting;
        $set->save();
    }
 
    /**
     * Get Default Company Setting.
     *
     * @param string $key
     *
     * @return string|null
     */
    public static function getDefaultSetting($key)
    {
        $setting = self::$defaultSettings[$key];

        if ($setting) {
            return $setting;
        } else {
            return null;
        }
    }

    /**
     * Get System Setting.
     *
     * @param string $key
     *
     * @return string|null
     */
    public static function getSetting($key)
    {
        $setting = static::whereOption($key)->first();

        if ($setting) {
            return $setting->value;
        } else {
            return self::getDefaultSetting($key);
        }
    }

    /**
     * Check if Paypal Gateway is Active
     *
     * @return boolean
     */
    public static function isPaypalActive()
    {
        if (
            static::getSetting('paypal_active')
            && static::getSetting('paypal_username') != ''
            && static::getSetting('paypal_password') != ''
            && static::getSetting('paypal_signature') != ''
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if Stripe Gateway is Active
     *
     * @return boolean
     */
    public static function isStripeActive()
    {
        if (
            static::getSetting('stripe_active')
            && static::getSetting('stripe_secret_key') != ''
            && static::getSetting('stripe_public_key') != ''
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
    * Check if Razorpay Gateway is Active
    *
    * @return boolean
    */
    public static function isRazorpayActive()
    {
        if (
            static::getSetting('razorpay_active')
            && static::getSetting('razorpay_id') != ''
            && static::getSetting('razorpay_secret_key') != ''
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if Mollie Gateway is Active
     * 
     * @return boolean
     */
    public static function isMollieActive()
    {
        if (
            static::getSetting('mollie_active') 
            && static::getSetting('mollie_api_key') != ''
        ) 
            return true;
        else 
            return false;
    }

    /**
     * Check if Mollie Gateway is Active
     * 
     * @return boolean
     */
    public static function isTermsActive()
    {
        $terms = Page::findBySlug('terms');
        $privacy = Page::findBySlug('privacy');

        if (!$terms || !$privacy)
            return false;

        if ($terms->is_active && $privacy->is_active) 
            return true;
        else 
            return false;
    }

    // Save Settings on .env file
    public static function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str     = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $keyPosition       = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine           = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}='{$envValue}'\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        $str .= "\n";

        if (!file_put_contents($envFile, $str)) {
            return false;
        }

        return true;
    }
}
