<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Helper\Constants;

class RoleName implements CastsAttributes
{
    const ADMIN = 'ADMIN';
    const USER = 'USER';

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if ($value === Constants::ADMIN_ROLE) {
            return "ADMIN";
        } else if ($value === Constants::USER_ROLE) {
            return "USER";
        }
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if ($value === self::ADMIN) {
            return Constants::ADMIN_ROLE;
        } else if ($value === self::USER) {
            return Constants::USER_ROLE;
        }
    }
}
