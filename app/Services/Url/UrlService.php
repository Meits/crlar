<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 19-Nov-18
 * Time: 13:06
 */

namespace App\Services\Url;


use Illuminate\Database\Eloquent\Model;

class UrlService
{
    /**
     * @param Model $model
     */
    private $model = null;

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }


    /**
     * UrlService constructor.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * @param $string
     * @return mixed|string
     */
    public function getAlias($string)
    {
        $alias = $this->transliterate($string);
        if($this->checkUniqueAlias($alias)) {
            return $alias;
        }
        else {
            for ( $suffix = 2; !$this->checkUniqueAlias( $newAlias = $alias . '-' . $suffix ); $suffix++ ) {}
            return $newAlias;
        }
    }

    /**
     * Transliterate string
     * @param $string
     * @return mixed|string
     */
    private function transliterate($string) {
        $str = mb_strtolower($string, 'UTF-8');

        $leter_array = array(
            'a' => 'а',
            'b' => 'б',
            'v' => 'в',
            'g' => 'г,ґ',
            'd' => 'д',
            'e' => 'е,є,э',
            'jo' => 'ё',
            'zh' => 'ж',
            'z' => 'з',
            'i' => 'и,і',
            'ji' => 'ї',
            'j' => 'й',
            'k' => 'к',
            'l' => 'л',
            'm' => 'м',
            'n' => 'н',
            'o' => 'о',
            'p' => 'п',
            'r' => 'р',
            's' => 'с',
            't' => 'т',
            'u' => 'у',
            'f' => 'ф',
            'kh' => 'х',
            'ts' => 'ц',
            'ch' => 'ч',
            'sh' => 'ш',
            'shch' => 'щ',
            '' => 'ъ',
            'y' => 'ы',
            '' => 'ь',
            'yu' => 'ю',
            'ya' => 'я',
        );

        foreach($leter_array as $leter => $kyr) {
            $kyr = explode(',',$kyr);

            $str = str_replace($kyr,$leter, $str);

        }

        //  A-Za-z0-9-
        $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/','-',$str);
        $str = preg_replace( '/[^\p{L}\p{Nd}]+/u', '-', $str );
        $str = trim($str,'-');

        return $str;
    }

    private function checkUniqueAlias($alias)
    {
        $result = $this->model->where('alias', $alias)->first();
        if($result) {
            return false;
        }
        return true;
    }
}