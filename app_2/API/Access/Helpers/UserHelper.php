<?php
namespace API\Access\Helpers;

use Illuminate\Support\Str;

class UserHelper{

    public function makeShotName($login): string
    {
        if($login){
            $login = Str::slug($login,' ');
            $split = explode(' ',$login);

            return $this->chankName($split);
        }
        else
            return 'NoName';
    }

    public function FullName($name){
        return $name != "" ? $name: 'No name';
    }

    private function chankName($array): string
    {
        $chank = [];
        foreach ($array as $key => $s){
            if($key ==0 )
                $chank[] = $s;
            else
                $chank[] = $s[0];
        }

        return implode('.',$chank);
    }
}
