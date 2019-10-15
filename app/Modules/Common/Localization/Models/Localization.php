<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 19-Sep-19
 * Time: 12:33
 */

namespace App\Modules\Common\Localization\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait Localization
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function localization()
    {
        return $this->hasOne(
            $this->getLocalizationModelName()
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function localizations()
    {
        return $this->hasMany(
            $this->getLocalizationModelName()
        );
    }

    /**
     * @param Builder $query
     * @param string $locale
     */
    public function scopeWithLocalization(Builder $query,$id)
    {
        $filter = function($query) use($id)  {
            /** @var Builder $query */
            $query->where('language_id', $id);
        };

        $query
            ->whereHas('localization', $filter)
            ->with([
                'localization' => $filter
            ]);
    }

    /**
     * @return string
     */
    private function getLocalizationModelName()
    {
        return get_class($this).'Content';
    }
}
