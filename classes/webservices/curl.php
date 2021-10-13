<?php
/**
 * cURL class
 *
 * This is a wrapper class for curl, it is quite easy to use:
 * <code>
 * $c = new curl;
 * // enable cache
 * $c = new curl(array('cache'=>true));
 * // enable cookie
 * $c = new curl(array('cookie'=>true));
 * // enable proxy
 * $c = new curl(array('proxy'=>true));
 *
 * // HTTP GET Method
 * $html = $c->get('http://example.com');
 * // HTTP POST Method
 * $html = $c->post('http://example.com/', array('q'=>'words', 'name'=>'moodle'));
 * // HTTP PUT Method
 * $html = $c->put('http://example.com/', array('file'=>'/var/www/test.txt');
 * </code>
 *
 * @author     Dongsheng Cai <dongsheng@moodle.com> - https://github.com/dongsheng/cURL
 * @license    http://www.gnu.org/copyleft/gpl.html GNU Public License
 */

class MyCurl{
 
    public function post($url, $params){

        $curl_params = $this->format_params($params);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        header('Content-Type: text/plain');
        $response = curl_exec($ch);

        return $response;
    }

    public function format_params($params) {

        $data = array();

        foreach($params as $k => $v) {
            if (is_object($v)) {
                $v = (array) $v;
            }
            if(is_array($v)) {
                $this->format_array_param($v, urlencode($k), $data);
            }
            else {
                $data[] = urlencode($k)."=".urlencode($v);
            }
        }

        return implode("&", $data);
    }

    function format_array_param($arraydata, $currentdata, &$data) {
        foreach ($arraydata as $k=>$v) {
            $newcurrentdata = $currentdata;
            if (is_object($v)) {
                $v = (array) $v;
            }
            if (is_array($v)) { //the value is an array, call the function recursively
                $newcurrentdata = $newcurrentdata.'['.urlencode($k).']';
                $this->format_array_param($v, $newcurrentdata, $data);
            }  else { //add the POST parameter to the $data array
                $data[] = $newcurrentdata.'['.urlencode($k).']='.urlencode($v);
            }
        }
    }
}

