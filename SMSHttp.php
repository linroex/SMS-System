<?php
class SMSHttp{
	var $smsHost;
	var $sendSMSUrl;
	var $getCreditUrl;
	var $batchID;
	var $credit;
	var $processMsg;
	
	function SMSHttp(){
		$this->smsHost = "api.every8d.com";
		$this->sendSMSUrl = "http://".$this->smsHost."/API21/HTTP/sendSMS.ashx";
		$this->getCreditUrl = "http://".$this->smsHost."/API21/HTTP/getCredit.ashx";
		$this->batchID = "";
		$this->credit = 0.0;
		$this->processMsg = "";
	}

	/// <summary>
	/// 取得帳號餘額
	/// </summary>
	/// <param name="userID">帳號</param>
	/// <param name="password">密碼</param>
	/// <returns>true:取得成功；false:取得失敗</returns>
	function getCredit($userID, $password){
		$success = false;
		$postDataString = "UID=" . $userID . "&PWD=" . $password;
		$resultString = $this->httpPost($this->getCreditUrl, $postDataString);
		if(substr($resultString,0,1) == "-"){
			$this->processMsg = $resultString;
		} else {
			$success = true;
			$this->credit = $resultString;
		}
		return $success;
	}
	
	/// <summary>
	/// 傳送簡訊
	/// </summary>
	/// <param name="userID">帳號</param>
	/// <param name="password">密碼</param>
	/// <param name="subject">簡訊主旨，主旨不會隨著簡訊內容發送出去。用以註記本次發送之用途。可傳入空字串。</param>
	/// <param name="content">簡訊發送內容</param>
	/// <param name="mobile">接收人之手機號碼。格式為: +886912345678或09123456789。多筆接收人時，請以半形逗點隔開( , )，如0912345678,0922333444。</param>
	/// <param name="sendTime">簡訊預定發送時間。-立即發送：請傳入空字串。-預約發送：請傳入預計發送時間，若傳送時間小於系統接單時間，將不予傳送。格式為YYYYMMDDhhmnss；例如:預約2009/01/31 15:30:00發送，則傳入20090131153000。若傳遞時間已逾現在之時間，將立即發送。</param>
	/// <returns>true:傳送成功；false:傳送失敗</returns>
	function sendSMS($userID, $password, $subject, $content, $mobile, $sendTime){
		$success = false;
		$postDataString = "UID=" . $userID;
		$postDataString .= "&PWD=" . $password;
		$postDataString .= "&SB=" . $subject;
		$postDataString .= "&MSG=" . $content;
		$postDataString .= "&DEST=" . $mobile;
		$postDataString .= "&ST=" . $sendTime;
		$resultString = $this->httpPost($this->sendSMSUrl, $postDataString);
		if(substr($resultString,0,1) == "-"){
			$this->processMsg = $resultString;
		} else {
			$success = true;
			$strArray = split(",", $resultString);
			$this->credit = $strArray[0];
			$this->batchID = $strArray[4];
		}
		return $success;
	}
	
	function httpPost($url, $postData){
        	$result = "";
		$length = strlen($postData);
		$fp = fsockopen($this->smsHost, 80, $errno, $errstr);
		$header = "POST " . $url . " HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded; charset=utf-8\r\n"; 
		$header .= "Content-Length: " . $length . "\r\n\r\n";
		$header .= $postData . "\r\n";
		
		fputs($fp, $header, strlen($header));
		while (!feof($fp)) {
			$res .= fgets($fp, 1024);
		}
		fclose($fp);
		$strArray = split("\r\n\r\n", $res);
		$result = $strArray[1];
        	return $result;
	}
}
?>