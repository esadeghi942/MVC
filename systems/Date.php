<?php
namespace Systems;
class Date
{
	public static function get($date=null, $mod='-')
	{
		// Todo
		// $local = Localization::get();
		$local['code'] = 'en';
		if(strtolower($local['code']) == 'en'){
			if($date){
				$da = explode(' ', $date);
				$d  = $da[0];
				$t  = '';
				if(isset($da[1])){
					$t = ' '.$da[1];
				}
				if(strpos($d, '-') !== false){
					$ce = '-';
				}else if(strpos($d, '/') !== false){
					$ce = '/';
				}

				$de = explode($ce, $d);
				$d = implode($mod, $de);

				return $d.$t;
			}else{
				return date('Y'.$mod.'m'.$mod.'d H:i:s');
			}
		}
		else if(strtolower($local['code']) == 'fa'){
			if($date){
				$da = explode(' ', $date);
				$d  = $da[0];
				$t  = '';
				if(isset($da[1])){
					$t = ' '.$da[1];
				}
				if(strpos($d, '-') !== false){
					$ce = '-';
				}else if(strpos($d, '/') !== false){
					$ce = '/';
				}

				$de = explode($ce, $d);
				$d = gregorian_to_jalali($de[0], $de[1], $de[2], $mod);
				// $d = implode($mod, $de);

				return $d.$t;
			}else{
				$a = gregorian_to_jalali(date('Y'),date('m'),date('d'), $mod);
				// $a = implode('-', $a);
				$a = $a.' '.date('H:i:s');
				return $a;
			}
		}
	}

	public static function now($mod='-'){
        return date('Y'.$mod.'m'.$mod.'d H:i:s');
    }
}