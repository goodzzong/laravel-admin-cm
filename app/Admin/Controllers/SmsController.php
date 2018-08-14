<?php

namespace App\Admin\Controllers;

use App\Sms;

use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Request $request)
    {
        $msg = $request->input('msg');
        return view('admin.sms.show',compact('msg'));
    }

    public function store(Request $request)
    {
        $receiveNumber = $request->input('receiveNumber');
        // 받는 사람   - 수신자 전화번호(생략불가)
        //           - 시스메이트 영업담당자 전화번호
        //           - 여러번호일 경우에는 ;으로 구분, 전화번호 구분자 대쉬(-)는 있거나 없거나 상관없음
        $stran_phone = $receiveNumber;
        $stran_callback = '0264124900';                      // 보내는 사람 - 송신자 전화번호(생략가능) - 시스메이트 대표번호
        $stran_date = '';
        $stran_msg = $request->input('messagebox');
        $stran_msg = iconv('utf-8', 'euc-kr', $stran_msg);
        $guest_no = '105246';                                // 고객번호(예.000431)
        $guest_key = '1e5a19f7bc11a407a4921ed8a57791c3';     // 관리자계정과 암호를 이용해 생성한 고객 유일 키 (mydirect.co.kr의 고객정보에서 확인 가능)

        if (isset($stran_phone) && $stran_phone != "") {
            $xml_file = "http://sms.direct.co.kr/link/send.php?stran_phone=" . $stran_phone .
                "&stran_callback=" . $stran_callback .
                "&stran_date=" . urlencode($stran_date) .
                "&stran_msg=" . urlencode($stran_msg) .
                "&guest_no=" . $guest_no .
                "&guest_key=" . $guest_key;
            $rss = new \DOMDocument();
            $dom = $rss->load($xml_file);
            $msg = "전송 되었습니다.";



        }

        return redirect(route('sms.show',compact('msg')));
    }
}
