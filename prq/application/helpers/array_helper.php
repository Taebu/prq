<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 2016-04-13 (수)
 * This file is part of the array_column library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey (http://benramsey.com)
 * @license http://opensource.org/licenses/MIT MIT
 */

if (!function_exists('array_column')) {
    /**
     * Returns the values from a single column of the input array, identified by
     * the $columnKey.
     *
     * Optionally, you may provide an $indexKey to index the values in the returned
     * array by the values from the $indexKey column in the input array.
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     *                     a column of values.
     * @param mixed $columnKey The column of values to return. This value may be the
     *                         integer key of the column you wish to retrieve, or it
     *                         may be the string key name for an associative array.
     * @param mixed $indexKey (Optional.) The column to use as the index/keys for
     *                        the returned array. This value may be the integer key
     *                        of the column, or it may be the string key name.
     * @return array
     */
    function array_column($input = null, $columnKey = null, $indexKey = null)
    {
        // Using func_get_args() in order to check for proper number of
        // parameters and trigger errors exactly as the built-in array_column()
        // does in PHP 5.5.
        $argc = func_num_args();
        $params = func_get_args();

        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }

        if (!is_array($params[0])) {
            trigger_error(
                'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
                E_USER_WARNING
            );
            return null;
        }

        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }

        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }

        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;

        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }

        $resultArray = array();

        foreach ($paramsInput as $row) {
            $key = $value = null;
            $keySet = $valueSet = false;

            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }

            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }

            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }

        }

        return $resultArray;
    }

}/* end array_column */

if (!function_exists('get_status')) {
	/* 가맹점 상태 보기 */
	function get_status($k)
	{
		$result=array();
		$array=array();
		/* 알림톡 경우 상태 */
		$array['stop']=array('key'=>'warning','value'=>'중지');
		$array['join']=array('key'=>'success','value'=>'정상');
		$array['terminate']=array('key'=>'danger','value'=>'해지');
		$array['expire']=array('key'=>'danger','value'=>'만료');

		/* 블로그 상태 */
		$array['on']=array('key'=>'success','value'=>'사용');
		$array['off']=array('key'=>'danger','value'=>'해지');
		
		/* 상점 */
		$array['wa']=array('key'=>'default','value'=>'대기');
		$array['pr']=array('key'=>'primary','value'=>'처리중');
		$array['ac']=array('key'=>'success','value'=>'완료');
		$array['ad']=array('key'=>'danger','value'=>'네이버신규등록');
		$array['ec']=array('key'=>'info','value'=>'네이버권한신청');
		$array['ca']=array('key'=>'warning','value'=>'설치실패');
		$array['fr']=array('key'=>'free','value'=>'무료');
		$array['tm']=array('key'=>'danger','value'=>'해지');
		$array['delete']=array('key'=>'danger','value'=>'삭제');
		$array['modify']=array('key'=>'warning','value'=>'수정');
		
		/* ocid */
		$array[0]=array('key'=>'default','value'=>'미발신');
		$array[1]=array('key'=>'success','value'=>'발신');
		$array[2]=array('key'=>'warning','value'=>'일반번호');
		$array[3]=array('key'=>'danger','value'=>'수신거부');
		$array[4]=array('key'=>'info','value'=>'150건초과');
		$array[5]=array('key'=>'warning','value'=>'업소누락');
		$array[6]=array('key'=>'free','value'=>'정보부족');
		$array[7]=array('key'=>'danger','value'=>'해지');
		$array[31]=array('key'=>'default','value'=>'대기');
		$array[32]=array('key'=>'warning','value'=>'설치실패');
		$array[33]=array('key'=>'danger','value'=>'해지');

		/* get_status_blog */
		$array['view']=array('key'=>'default','value'=>'포스팅');
		$array['review']=array('key'=>'default','value'=>'sms_send');
		$array['sms_send']=array('key'=>'success','value'=>'사장 승인');
		$array['ceo_allow']=array('key'=>'success','value'=>'사장 거부');
		$array['ceo_deny']=array('key'=>'danger','value'=>'사장 거부');
		
		$array['co_blog_allow']=array('key'=>'success','value'=>'일반 승인');
		$array['co_blog_deny']=array('key'=>'danger','value'=>'일반 거부');
		$array['po_blog_allow']=array('key'=>'success','value'=>'포인트 승인');
		$array['po_blog_deny']=array('key'=>'danger','value'=>'포인트 거부');
		
		/*비즈톡으로 추가 2018-02-07 (수) 18:05:14  */
		$array['access']=array('key'=>'success','value'=>'정상');
		$result=$array[$k];
		$result=sprintf("<button class='btn btn-xs btn-%s'>%s</button>",$result['key'],$result['value']);
		return $result;
	}
}/* end get_status */


if (!function_exists('get_status2')) {
	/* 가맹점 상태 보기 
	<button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">대기</button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">처리중</button>
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">완료</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">승인거부</button>
<button type="button" class="btn btn-sm btn-info" onclick="chg_list('ec');">1,2개 미흡</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">설치실패</button>
	*/
	function get_status2($code)
	{
		switch ($code) {
		case "wa":
			$result='<button type="button" class="btn btn-default btn-xs">대기</button>';
			break;
		case "pr":
			$result='<button type="button" class="btn btn-primary btn-xs">처리중</button>';
			break;
		case "ac":
			$result='<button type="button" class="btn btn-success btn-xs">완료</button>';
			break;
		case "ad":
			$result='<button type="button" class="btn btn-danger btn-xs">네이버신규등록</button>';
			break;
		case "ec":
			$result='<button type="button" class="btn btn-info btn-xs">네이버권한신청</button>';
			break;
		case "ca":
			$result='<button type="button" class="btn btn-warning btn-xs">설치실패</button>';
			break;
		case "fr":
			$result='<button type="button" class="btn btn-free btn-xs">무료</button>';
			break;
		case "delete":
			$result='<button type="button" class="btn btn-danger btn-xs">삭제</button>';
			break;
		case "modify":
			$result='<button type="button" class="btn btn-warning btn-xs">수정</button>';
			break;

		}
		return $result;
	}
}

if (!function_exists('get_status_blog')) {
	function get_status_blog($code)
	{
		switch ($code) {
		case "view":
			$result='<button type="button" class="btn btn-default btn-xs">포스팅</button>';
			break;
		case "review":
			$result='<button type="button" class="btn btn-default btn-xs">포스팅</button>';
			break;
		case "sms_send":
			$result='<button type="button" class="btn btn-default btn-xs">sms_send</button>';
			break;
		case "ceo_allow":
			$result='<button type="button" class="btn btn-success btn-xs">사장 승인</button>';
			break;
		case "ceo_deny":
			$result='<button type="button" class="btn btn-danger btn-xs">사장 거부</button>';
			break;
		case "co_blog_allow":
			$result='<button type="button" class="btn btn-success btn-xs">일반 승인</button>';
			break;
		case "co_blog_deny":
			$result='<button type="button" class="btn btn-danger btn-xs">일반 거부</button>';
			break;
		case "po_blog_allow":
			$result='<button type="button" class="btn btn-success btn-xs">포인트 승인</button>';
			break;
		case "po_blog_deny":
			$result='<button type="button" class="btn btn-danger btn-xs">포인트 거부</button>';
			break;
		}
		return $result;
	}	
if (!function_exists('get_status3')) {
	/* 가맹점 상태 보기 
<div class="btn_area">
<button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">대기</button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">처리중</button>
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">승인</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">승인거부</button>
<button type="button" class="btn btn-sm btn-info" onclick="chg_list('ec');">연계완료</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">해지</button>
</div>	*/
	function get_status3($code)
	{
		switch ($code) {
		case "wa":
			$result='<button type="button" class="btn btn-xs btn-default">대기</button>';
			break;
		case "pr":
			$result='<button type="button" class="btn btn-xs btn-primary">처리중</button>';
			break;
		case "ac":
			$result='<button type="button" class="btn btn-xs btn-success">승인</button>';
			break;
		case "ad":
			$result='<button type="button" class="btn btn-xs btn-danger">승인거부</button>';
			break;
		case "ec":
			$result='<button type="button" class="btn btn-xs btn-info">연계완료</button>';
			break;
		case "ca":
			$result='<button type="button" class="btn btn-xs btn-warning">해지</button>';
			break;
		case "delete":
			$result='<button type="button" class="btn btn-xs btn-danger">삭제</button>';
			break;
		case "modify":
			$result='<button type="button" class="btn btn-warning btn-xs">수정</button>';
			break;
		}
		return $result;
	}
}
}/* end get_status_blog */
//echo realpath(__FILE__);;
/* End of file */