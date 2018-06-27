<?php

namespace Statamic\Addons\MiscValidators;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use Statamic\Extend\ServiceProvider;
use Validator;

class MiscValidatorsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend(
            'phone_number ',
            function ($attribute, $value, $parameters, $validator) {
                try {
                    PhoneNumberUtil::getInstance()->parse($value, 'US');
                } catch (NumberParseException $e) {
                    return false;
                }

                return true;
            },
            $this->trans('validation.phone_number')
        );
    }
}
