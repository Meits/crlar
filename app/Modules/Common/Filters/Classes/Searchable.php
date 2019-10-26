<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 25.10.2019
 * Time: 22:49
 */

namespace App\Modules\Common\Filters\Classes;


use Illuminate\Http\Request;

interface Searchable
{
    public function apply(Request $filters);
}