<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 25.10.2019
 * Time: 22:19
 */

namespace App\Modules\Admin\User\Models\Filters;



//use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\User\Models\User;
use App\Modules\Common\Filters\Classes\BaseSearch;
use App\Modules\Common\Filters\Classes\Searchable;

class UserSearch implements Searchable
{
    const MODEL = User::class;

    use BaseSearch;
}