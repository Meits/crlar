<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 25.10.2019
 * Time: 22:31
 */

namespace App\Modules\Admin\User\Models\Filters;


use App\Modules\Common\Filters\Classes\Filter;
use Illuminate\Database\Eloquent\Builder;

class Search implements Filter
{

    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->where(function ($query) use ($value) {
            $query->where('firstname', 'like', '%' . $value . '%')
                ->orWhere('email', 'like', '%' . $value . '%')
                ->orWhere('lastname', 'like', '%' . $value . '%')
                ->orWhere('phone', 'like', '%' . $value . '%');
        });
    }
}