<?php
/**
 * This file is part of msajko/money-formatter package
 *
 * @author msajko <msajko@gmail.com>
 * @copyright Msajko
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Msajko;

/**
 * @moneyToText(
 *   country_code = 'hr',
 *   amount = "12.345,92"
 * )
 */
class MoneySpellOut {

  /**
   * lowercase [$country_code ISO 3166-1 alpha-2]
   * @var string
   */
	private $country_code;

  private $amount;

	public function __construct($country_code = 'hr', $amount=false){
    $this->country_code = $country_code;
    if($amount!==false){
      $this->setAmount($amount, $this->country_code);
    }
	}

  public function setAmountDirect($amount){
    $this->amount = $amount;
  }

  public function setAmount($amount, $country_format=false){
    switch ($country_format) {
      case false:
        if(preg_match('/^-?([0-9]{1,30}))\.(\d{1,2})$/', $amount)){
          $this->amount = $amount;
        }
        break;
      case 'at':
      case 'bg':
      case 'de':
      case 'ee':
      case 'es':
      case 'eu':
      case 'fi':
      case 'it':
      case 'si':
      case 'vn':
        if(preg_match('/^(([A-Z]{3})|([$€£¥]{1}))? ?(?<prefix>-)?(?<mouny>[0-9\. ]{1,35}),(?<penny>\d{2}) ?(([A-Z]{3})|([$€£¥₫]{1}))?$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace(array('.',' '),'',$mach['mouny']).'.'.$mach['penny'];
          $this->amount = (double)$amount;
        }
        break;
      case 'au':
      case 'ca':
      case 'cf':
      case 'gb':
      case 'ie':
      case 'mx':
      case 'th':
      case 'us':
      case 'za':
        if(preg_match('/^(([A-Z]{3})|([$€£¥R฿]{1}))? ?(?<prefix>-)?(?<mouny>[0-9,]{1,35})\.(?<penny>\d{2})?$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace(',','',$mach['mouny']).'.'.$mach['penny'];
          $this->amount = (double)$amount;
        }
        break;
      case 'bg':
        if(preg_match('/^(([A-Z]{3})|([$€£¥]{1}))? ?(?<prefix>-)?(?<mouny>[0-9 ]{1,35}),(?<penny>\d{2}) ?(([лвЛВ]{2})\.?)?$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace(' ','',$mach['mouny']).'.'.$mach['penny'];
          $this->amount = (double)$amount;
        }
        break;
      case 'cn':
        if(preg_match('/^(NT\$)? ?(?<prefix>-)?(?<mouny>[0-9,]{1,35})\.(?<penny>\d{2})?$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace(',','',$mach['mouny']).'.'.$mach['penny'];
          $this->amount = (double)$amount;
        }
        break;
      case 'by':
      case 'lt':
      case 'lv':
        if(preg_match('/^(([A-Z]{3})|([$€£¥]{1})|([lsLS]{2}))? ?(?<prefix>-)?(?<mouny>[0-9\. ]{1,35}),(?<penny>\d{2}) ?((p\.)|([ltLT]{2}))?$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace(array('.',' '),'',$mach['mouny']).'.'.$mach['penny'];
          $this->amount = (double)$amount;
        }
        break;
      case 'ch':
        if(preg_match('/^((fr\.)|([A-Z]{3})|([$€£¥]{1}))? ?(?<prefix>-)?(?<mouny>[0-9\']{1,35})\.(?<penny>\d{2}) ?(([A-Z]{3})|([$€£¥]{1}))?$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace("'",'',$mach['mouny']).'.'.$mach['penny'];
          $this->amount = (double)$amount;
        }
        break;
      case 'da':
        if(preg_match('/^((kr\.)|([A-Z]{3})|([$€£¥]{1}))? ?(?<prefix>-)?(?<mouny>[0-9.]{1,35}),(?<penny>\d{2}) ?(([A-Z]{3})|([$€£¥]{1}))?$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace(".",'',$mach['mouny']).'.'.$mach['penny'];
          $this->amount = (double)$amount;
        }
        break;
      case 'dz':
      case 'eg':
      case 'iq':
      case 'sa':
        if(preg_match('/^((د.ج.‏)|(ج.م.‏)|(د.ع.‏)|(ر.س.‏))? ?(?<prefix>-)?(?<mouny>[0-9,]{1,30})\.(?<penny>\d{2,3})? ?((د.ج.‏)|(ج.م.‏)|(د.ع.‏)|(ر.س.‏))?$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace(',','',$mach['mouny']).'.'.$mach['penny'];
          $this->amount = (double)$amount;
        }
        break;
      case 'fr':
        if(preg_match('/^(([A-Z]{3})|([$€£¥]{1}))? ?(?<prefix>-)?(?<mouny>[0-9 ]{1,30})\.(?<penny>\d{2}) ?(([A-Z]{3})|([$€£¥]{1}))?$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace(' ','',$mach['mouny']).'.'.$mach['penny'];
          $this->amount = (double)$amount;
        }
      case 'hr':
      case 'pl':
      case 'ro':
      case 'se':
      case 'tr':
      case 'ua':
        if(preg_match('/^(([A-Z]{3}))? ?(?<prefix>-)?(?<mouny>[0-9\.]{1,35}),(?<penny>\d{2}) ?(([A-Z]{3})|([knKN]{2})|([złZŁ]{2})|([leiL]{3})|([krKR]{2})|₺|₴)?$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace('.','',$mach['mouny']).'.'.$mach['penny'];
          $this->amount = (double)$amount;
        }
        break;
      case 'id':
        if(preg_match('/^(Rp)?(?<prefix>-)?(?<mouny>[0-9.]{1,30})$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace('.','',$mach['mouny']);
          $this->amount = (double)$amount;
        }
        break;
      case 'il':
        if(preg_match('/^(₪|([A-Z]{3}))? ?(?<prefix>-)?(?<mouny>[0-9,]{1,30})\.(?<penny>\d{2}) ?(₪|([A-Z]{3}))?$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace(',','',$mach['mouny']).'.'.$mach['penny'];
          $this->amount = (double)$amount;
        }
        break;
      case 'jp':
      case 'kr':
        if(preg_match('/^(¥|₩)?(?<prefix>-)?(?<mouny>[0-9,]{1,30})$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace(',','',$mach['mouny']);
          $this->amount = (double)$amount;
        }
        break;
      case 'rs':
        if(preg_match('/^(([A-Z]{3}))? ?(?<prefix>-)?(?<mouny>[0-9\.]{1,35}),(?<penny>\d{2}) ?(([A-Z]{3})|((Din)|(Дин)\.?))?$/', $amount, $mach)){
          $amount = @$mach['prefix'].str_replace('.','',$mach['mouny']).'.'.$mach['penny'];
          $this->amount = (double)$amount;
        }
        break;
      case 'double':
        if(is_numeric($amount)){
          $this->amount = (double)$amount;
        }
        break;
      default:
        return false;
        break;
     }
     return true;
  }

  public function setCountrycode($country_code){
    if(preg_match('/^([a-z]{2})$/', $country_code)){
      $this->country_code = $country_code;
      return true;
    }
    return false;
  }

	private function hr($int,$stup='',$pred='',$hekto=''){

    switch($stup){
      case 'milijarda':
        if($int==1){
          if($pred=='i' || $hekto)
            return 'jednamilijarda';
          else
            return 'milijarda';
        }
        elseif($int>=2 && $int<=4)  $stup='milijarde';
        else  $stup='milijardi';
        //if($int==2) return 'dvije'.$stup;
        break;
      case 'milijuna':
        if($int==1)
          if($pred=='i' || $hekto)
            return 'jedanmilijunu';
          else
            return 'milijun';
        break;
      case 'tisuća':
        if($int==1)
          if($pred=='i' || $hekto)
            return 'jednatisuća';
          else
            return 'tisuću';
        elseif($int>=2 && $int<=4)  $stup='tisuće';
        //if($int==2) return 'dvije'.$stup;
        break;
    }

		if($stup=='sto')
			if($int==1)	return $stup;

		switch($int){
			case 1:
				return $pred.(!$stup?'jedna':'jedan').($stup=='naest'?'aest':$stup);
			case 2:
				return $pred.(!$stup || $stup=='sto' || $stup=='tisuće' || $stup=='milijare'?'dvije':'dva').$stup;
			case 3:
				return $pred.'tri'.$stup;
			case 4:
				return $pred.($stup=='naest' || $stup=='deset'?'četr':'četiri').$stup;
			case 5:
				return $pred.($stup=='deset'?'pe':'pet').$stup;
			case 6:
				return $pred.($stup=='deset'?'šes':'šest').$stup;
			case 7:
				return $pred.'sedam'.$stup;
			case 8:
				return $pred.'osam'.$stup;
			case 9:
				return $pred.($stup=='deset'?'deve':'devet').$stup;
		}
	}

  public function get($money='', $penny='', $separator=''){

    /**
     * if there is intl php extension enabled we can use NumberFormatter
     */
    if(class_exists('NumberFormatter')){

      $nFormat = new \NumberFormatter($this->country_code, \NumberFormatter::SPELLOUT);
      $nFormat->setTextAttribute(\NumberFormatter::DEFAULT_RULESET, "%spellout-cardinal-feminine");

      //if not numeric
      if(!is_numeric($this->amount)){
        return false;
      }
      $fh=explode('.',number_format($this->amount,2,'.',''));
      $kr = $nFormat->format($fh[0]);
      if(isset($fh[1]) && $fh[1]>0){
        $l = $nFormat->format($fh[1]);
      }

    } else {
      error_log('Enable intl php extension ('.__FILE__.' line:'.__LINE__.')', 0);
      return 'Error: enable intl php extension!';
    }

    return ($kr?$kr.($money?' '.$money:''):'').(isset($l) && $l?($money?$separator:'').' '.$l.($penny?' '.$penny:''):'');
  }

	public function getHr($money='kuna', $penny='lipa', $separator=' i'){

		//if not numeric
    if(!is_numeric($this->amount)){
      return false;
    }

    $fh=explode('.',number_format($this->amount,2,'.',''));

    /**
     * if there is intl php extension enabled we can use NumberFormatter
     */
    if(class_exists('NumberFormatter')){
      $nFormat = new \NumberFormatter('hr', \NumberFormatter::SPELLOUT);
      $nFormat->setTextAttribute(\NumberFormatter::DEFAULT_RULESET, "%spellout-cardinal-feminine");
      $kr = str_replace(' ','',$nFormat->format($fh[0]));
      if(isset($fh[1]) && $fh[1]>0){
        $l = str_replace(' ','',$nFormat->format($fh[1]));
      }

      if(strlen($fh[1])>1) $pennyValue=(int)substr($fh[1],-2); else $pennyValue=(int)$fh[1];
      if(strlen($fh[0])>1) $moneyValue=(int)substr($fh[0],-2); else $moneyValue=(int)$fh[0];
    } else {

  		//penny part
  		if(strlen($fh[1])>1) $pennyValue=$desetice=(int)substr($fh[1],-2);	else $pennyValue=$desetice=(int)$fh[1];

  			if($desetice==10)
  				$l='deset';
  			elseif($desetice<10)
  				$l=$this->hr($desetice);
  			elseif($desetice>19)
  				$l=$this->hr(substr($desetice,0,1),'deset').$this->hr(substr($desetice,-1),'','i');
  			else
  				$l=$this->hr(substr($desetice,-1),'naest');

  		//money part
  		if(strlen($fh[0])>1) $moneyValue=$desetice=(int)substr($fh[0],-2);	else $moneyValue=$desetice=(int)$fh[0];
  		$stotice=(int)substr($fh[0],-3,-2);

  			if($desetice==10)
  				$iz='deset';
  			elseif($desetice<10)
  				$iz=$this->hr($desetice);
  			elseif($desetice>19)
  				$iz=$this->hr(substr($desetice,0,1),'deset').$this->hr(substr($desetice,-1),'','i');
  			else
  				$iz=$this->hr(substr($desetice,-1),'naest');

  			if($stotice)
  				$iz=$this->hr($stotice,'sto').$iz;

  		$tisucice=floor($fh[0]/1000);
  		$milijun=floor($tisucice/1000);
  		$milijarda=floor($milijun/1000);
  		//tisuću (hiljadu) 10^3;milijun (mono tj. jedan milijun) 10^6;milijarda (milijun puta tisuću) 10^9;bilijun (bi tj. dva, milijun na drugu) 10^12;bilijarda (bilijun puta tisuću) 10^15;trilijun (tri, milijun na treću) 10^18;trilijarda 10^21;kvadrilijun (kvadro, tj. četiri, milijun na četvrtu) 10^24;kvadrilijarda 10^27;pentilijun (milijun na petu) 10^30;pentilijarda 10^33;heksilijun;heksilijarda;septilijun;septilijarda;oktilijun;oktilijarda;nonilijun;nonilijarda;dekalijun 10^60;dekalijarda 10^63

  		if($tisucice){
  			unset($jedinice);
  			if(strlen($tisucice)>1) $desetice=(int)substr($tisucice,-2);	else $desetice=(int)$tisucice;
  			$stotice=(int)substr($tisucice,-3,-2);

  				if($desetice==10)
  					$t='deset'.'tisuća';
  				elseif($desetice<10)
  					$t=$this->hr($desetice,'tisuća','',$stotice);
  				elseif($desetice>19){
  					$t=$this->hr(substr($desetice,0,1),'deset');
  					$jedinice=$this->hr(substr($desetice,-1),'tisuća','i');
  					if($jedinice) $t.=$jedinice;
  					else		  $t.='tisuća';
  				}
  				else
  					$t=$this->hr(substr($desetice,-1),'naest').'tisuća';
  				if($stotice)
  					$t=$this->hr($stotice,'sto').($t?$t:'tisuća');
  		}

  		if($milijun){
  			unset($jedinice);
  			if(strlen($milijun)>1) $desetice=(int)substr($milijun,-2);	else $desetice=(int)$milijun;
  			$stotice=(int)substr($milijun,-3,-2);

  				if($desetice==10)
  					$m='deset'.'milijuna';
  				elseif($desetice<10)
  					$m=$this->hr($desetice,'milijuna','',$stotice);
  				elseif($desetice>19){
  					$m=$this->hr(substr($desetice,0,1),'deset');
  					$jedinice=$this->hr(substr($desetice,-1),'milijuna','i');
  					if($jedinice) $m.=$jedinice;
  					else		  $m.='milijuna';
  				}
  				else
  					$m=$this->hr(substr($desetice,-1),'naest').'milijuna';
  				if($stotice)
  					$m=$this->hr($stotice,'sto').($m?$m:'milijuna');
  		}

  		if($milijarda){
  			unset($jedinice);
  			if(strlen($milijarda)>1) $desetice=(int)substr($milijarda,-2);	else $desetice=(int)$milijarda;
  			$stotice=(int)substr($milijarda,-3,-2);

  				if($desetice==10)
  					$b='deset'.'milijarda';
  				elseif($desetice<10)
  					$b=$this->hr($desetice,'milijarda','',$stotice);
  				elseif($desetice>19){
  					$b=$this->hr(substr($desetice,0,1),'deset');
  					$jedinice=$this->hr(substr($desetice,-1),'milijarda','i');
  					if($jedinice) $b.=$jedinice;
  					else		  $b.='milijardi';
  				}
  				else
  					$b=$this->hr(substr($desetice,-1),'naest').'milijardi';
  				if($stotice)
  					$b=$this->hr($stotice,'sto').($b?$b:'milijarda');
  		}

  		$kr=$b.$m.$t.$iz;
    }

    if($moneyValue>20)  $moneyValue=substr($moneyValue,-1);
    if(strtolower($money)=='kuna' && $moneyValue<=4 && $moneyValue>=2)  $money='kune';
    if($pennyValue>20)  $pennyValue=substr($pennyValue,-1);
    if(strtolower($penny)=='lipa'  && $pennyValue<=4 && $pennyValue>=2) $penny='lipe';

		return ($kr?$kr.($money?' '.$money:''):'').(isset($l) && $l?($money?$separator:'').' '.$l.($penny?' '.$penny:''):'');
	}
}
