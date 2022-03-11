<?
//đường dẫn thân thiện 
function changeToSlug($slug){
	$str = trim(mb_strtolower($slug));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}


function send_mail($data){
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://timviec365.com/api/mail_subdomain.php',
    CURLOPT_POST => 1,
      CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
      CURLOPT_POSTFIELDS => array(
        'email' => $data['email'],
        'body'  => $data['body'],
        'title' => $data['title'],
        'name' => $data['name']
      )
    ));
  $resp = curl_exec($curl);
  $responsive = json_decode($resp);
  curl_close($curl);
  return $responsive;
}

function makeML($content,$search,$replace,$link){
	if($content != '' ){
		// require_once APPPATH."helpers/simple_html_dom_helper.php";
		// include("simple_html_dom_helper.php");  
		$html = str_get_html($content);
		$h2s = $html->find("h2,h3,h4");
		$patterns = array('/\d+\.\d+\.\d+\.\s/i','/\d+\.\d+\.\s/i','/\d+\.\s/i');
		$ml = "<div class='boxmucluc'><ul>";
		$i=$u=$j = 0;
		foreach($h2s as $h2)
		{
			$text = preg_replace($patterns,'', $h2->plaintext,1);
			$id = replaceTitle($text);
			if ($id == $search) {
				$id = $replace;
			}
			$h2->id = $id;
			if ($h2->tag=='h2') {
				$i++;
				$ml .= "<li><a class='ml_h2' href='".$link."#".$id."'>".$i.".".trim($text)."</a></li>";
				$j=0;
			}
			if ($h2->tag=='h3') {
				$j++;
				$ml .= "<li><a class='ml_h3' href='".$link."#".$id."'>".$i.".".$j.". ".trim($text)."</a></li>";
				$u=0;
			}
			if ($h2->tag=='h4') {
				$u++;
				$ml .= "<li><a class='ml_h4' href='".$link."#".$id."'>".$i.".".$j.".".$u.". ".trim($text)."</a></li>";
			} 
		}
		$ml.='</ul></div>';
		return $ml;
	}
}

function makeML_content($content,$search,$replace){
	if($content != '' ){
		// require_once APPPATH."helpers/simple_html_dom_helper.php";
		// include("simple_html_dom_helper.php"); 
		$html = str_get_html($content);
		$h2s = $html->find("h2,h3,h4");
		$patterns = array('/\d+\.\d+\.\d+\.\s/i','/\d+\.\d+\.\s/i','/\d+\.\s/i');
		foreach($h2s as $h2)
		{
			$text = preg_replace($patterns,'', str_replace('&nbsp;', ' ', $h2->plaintext));
			$id = replaceTitle($text);
			if ($id == $search) {
				$id = $replace;
			} 
			$h2->id = $id;
		}
		$html = $html->save();
		return $html; 
	}
}
function makeXT_content($content,$search=array()){
 	if($content != '' && !empty($search)){
 		$html = str_get_html($content);
 		$h2s = $html->find("h2");
 		$i = 1;
 		foreach($h2s as $h2)
 		{
 			if ($i > 1) {
 				if ($i > 8) {break;}
 				$h2->outertext = array_shift($search).$h2->outertext;
 			}
 			$i++;
 		}
 		$html = $html->save();
 		return $html;
 	}else{
 		return $content;
 	}

 }
 function button_file($mystring){
 	$typefile=array('.docx"','.doc"','.pdf"','.xlsx"','.xls"','.rar"','.zip"');
	
	$replace=array('.docx" class="download"','.doc" class="download"','.pdf" class="download"','.xlsx" class="download"','.xls" class="download"','.rar" class="download"','.zip" class="download"');
	return str_replace($typefile,$replace,$mystring);
}
function replaceTitle($title){
  $title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');
  $title  = remove_accent($title);
  $title = str_replace('/', '',$title);
  $title = preg_replace('/[^\00-\255]+/u', '', $title);

  if (preg_match("/[\p{Han}]/simu", $title)) {
      $title = str_replace(' ', '-', $title);
  }else{
    $arr_str  = array( "&lt;","&gt;","/"," / ","\\","&apos;", "&quot;","&amp;","lt;", "gt;","apos;", "quot;","amp;","&lt", "&gt","&apos", "&quot","&amp","&#34;","&#39;","&#38;","&#60;","&#62;");

    $title  = str_replace($arr_str, " ", $title);
    $title  = preg_replace('/\p{P}|\p{S}/u', ' ', $title);
    $title = preg_replace('/[^0-9a-zA-Z\s]+/', ' ', $title);

    //Remove double space
    $array = array(
      '    ' => ' ',
      '   ' => ' ',
      '  ' => ' ',
    );
    $title = trim(strtr($title, $array));
    $title  = str_replace(" ", "-", $title);
    $title  = urlencode($title);
    // remove cac ky tu dac biet sau khi urlencode
    $array_apter = array("%0D%0A","%","&");
    $title  = str_replace($array_apter,"-",$title);
    $title  = strtolower($title);
  }
  return $title;
}
function remove_accent($mystring){
	$marTViet=array(
	"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
	"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	"ỳ","ý","ỵ","ỷ","ỹ",
	"đ",
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ",
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	"Đ",
	"'");
	
	$marKoDau=array(
	"a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
	"e","e","e","e","e","e","e","e","e","e","e",
	"i","i","i","i","i",
	"o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
	"u","u","u","u","u","u","u","u","u","u","u",
	"y","y","y","y","y",
	"d",
	"A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
	"E","E","E","E","E","E","E","E","E","E","E",
	"I","I","I","I","I",
	"O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
	"U","U","U","U","U","U","U","U","U","U","U",
	"Y","Y","Y","Y","Y",
	"D",
	"");
	
	return str_replace($marTViet,$marKoDau,$mystring);
}
function GetImageOG($content){
	if($content != ''){
		include("simple_html_dom_helper.php"); 
		$html = str_get_html($content);
		$images = $html->find("img");
		if (count($images) > 0) {
			$src = $images[0]->src;
		} else {
			$src = '';
		}
		// $src = "https://nhatro.timviec365.com.vn/".$src;
		return $src;
	}
}
function makeMLNew($content,$search,$replace,$link){
  if($content != '' ){
    include("simple_html_dom_helper.php"); 
    $html = str_get_html($content);
    $h2s = $html->find("h2,h3,h4");
    $patterns = array('/\d+\.\d+\.\d+\.\s/i','/\d+\.\d+\.\s/i','/\d+\.\s/i');
    $ml = "<div class='boxmucluc'><ul>";
    $i=$u=$j = 0;
    foreach($h2s as $h2)
    {
      $text = preg_replace($patterns,'', $h2->plaintext,1);
      $id = replaceTitle($text);
      if ($id == $search) {
        $id = $replace;
      }
      $h2->id = $id;
      if ($h2->tag=='h2') {
        $i++;
        $ml .= "<li><a class='ml_h2' href='".$link."#".$id."'>".$i.". ".$text."</a></li>";
        $j=0;
      }
      if ($h2->tag=='h3') {
        $j++;
        $ml .= "<li><a class='ml_h3' href='".$link."#".$id."'>".$i.".".$j.". ".$text."</a></li>";
        $u=0;
      }
      if ($h2->tag=='h4') {
        $u++;
        $ml .= "<li><a class='ml_h4' href='".$link."#".$id."'>".$i.".".$j.".".$u.". ".$text."</a></li>";
      } 
    }
    $ml.='</ul></div>';
    echo $ml;
  }
}
function format_date($date){
	$date = date("d-m-Y",$date);
	return $date;
}
function object_to_array($data)
{
    if (is_array($data) || is_object($data))
    {
        $result = [];
        foreach ($data as $key => $value)
        {
            $result[$key] = (is_array($data) || is_object($data)) ? object_to_array($value) : $value;
        }
        return $result;
    }
    return $data;
}
?>