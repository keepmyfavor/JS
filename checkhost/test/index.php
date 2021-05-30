<?php
//設定更新時間
header("Refresh:300");
//標題
//$title = "";
//$title = "伺服器狀態監測系統";
//取得現在的日期時間,並轉換成 'YYYY 年 M 月 D 日' 的格式
$date = date("Y 年 m 月 j 日 G:i:s A",time());
//取得今天的星期, 0 為 '星期天' , 1 為 '星期一' , ... , 6 為 '星期六'
$week = date("w",time());
//陣列查表,將數字的星期,轉換成中文
$weekday = array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
//顯示表格
echo "<TABLE BORDER=20 WIDTH=1100 ALIGN=CENTER BGCOLOR=#FFFFFF>";
//echo "<TABLE BORDER=20 WIDTH=1100 ALIGN=CENTER BGCOLOR=#00ff00>";
//顯示標題
echo "<TR><TD ALIGN=CENTER COLSPAN=20 BGCOLOR=#FFFFFF><FONTSIZE=5> $date " .$weekday[$week] . "</FONT></TD></TR>";
// echo"<TR><TD ALIGN=CENTER COLSPAN=15 BGCOLOR=#cc44ff><FONTSIZE=5><B> $title </B><BR> $date " .$weekday[$week] . "</FONT></TD></TR>";
//顯示檢測專案
echo "<TRBGCOLOR=#ccddee><TH>主機名稱</TH><TH>HTTP</TH><TH>HTTPS</TH><TH>POP3</TH><TH>SMTP</TH><TH>FTP</TH><TH>SAMBA</TH><TH>SAP</TH><TH>鼎新</TH><TH>鼎新</TH><TH>8088</TH></TR>";
// echo"<TRBGCOLOR=#ccddee><TH>主機名稱</TH><TH>偵測時間</TH><TH>FTP</TH><TH>SSH</TH><TH>TELNET</TH><TH>SMTP</TH><TH>DNS</TH><TH>DHCP</TH><TH>HTTP</TH><TH>POP3</TH><TH>SAMBA</TH><TH>IMAP</TH><TH>SNMP</TH><TH>HTTPS</TH><TH>PROXY</TH><TH>MySQL</TH></TR>";
//檢測檔案名稱,檔案內容的格式如下所示,以 @ 符號分隔,一列表示一個監測主機,監測專案共有 13 項, 1 代表要監測 ,
// 0 代表不監測, 13 個專案分別表示 FTP、SSH、TELNET、SMTP、DNS、DHCP、HTTP、POP3、SAMBA、IMAP、SNMP、PROXY、MySQL
//
//格式:
//主機名稱@IP 位址或主機名稱@監測專案
//範例:
//百一網站@www.pesi.com.tw@111100001000

$file = "host.txt";
//取得檔案內容存入陣列,一個元素代表一列
$get = file("$file");

//取得測試主機數量,計算 $get 陣列的元素數目即可得知
$host_count = count($get);

//定義測試 port 清單
$port = array(80,443,110,25,21,139,3200,211,6666,8088);
// $port = array(21,22,23,25,53,67,80,110,139,143,161,443,3128,3306);

for ( $i = 0 ; $i < $host_count ; $i++ ) {
//切割每一列的資料存入陣列,以 @ 為分割符號, $get_line[$i][0] 為主機名稱 , $get_line[$i][1] 為測試的 IP 或主機名稱
//$get_line[$i][2] 為測試專案,共有 13 項
$get_line[$i] = explode("@",$get[$i]);
//$get_line[$i] = split("@",$get[$i]);

//顯示欄位名稱
echo "<TR><TD BGCOLOR=#62defe>" . $get_line[$i][0] ."</TD>";
// echo "<TR><TD BGCOLOR=#62defe>" . $get_line[$i][0] ."</TD><TD BGCOLOR=#77ff00 ALIGN=CENTER>" .date("H:i:s",time()) . "</TD>";

//取得測試專案的長度,並去除頭尾的空白字元
$len = strlen(trim($get_line[$i][2]));

//測試 timeout 時間
$timeout = 1;

for ( $j = 0 ; $j < $len ; $j++) {

//各別取出比對專案每一項的值,若等於 1 ,就做測試 , 0 測不做測試
if (substr($get_line[$i][2],$j,1) == "1") {
//進行測試,並抑制錯誤訊息輸出
$test[$j] = fsockopen($get_line[$i][1],$port[$j],$errno,$errstr,$timeout);
//顯示測試結果

if ($test[$j]) {
echo "<TD BGCOLOR=#77ff00 align=center></FONT></TD>";
// echo "<TD BGCOLOR=yellow align=center>成功</FONT></TD>";
} else {
echo "<TD BGCOLOR=red align=center><FONT COLOR=white></FONT></TD>";
// echo "<TD BGCOLOR=red align=center><FONT COLOR=white>失敗</FONT></TD>";
}
} else {
echo "<TD BGCOLOR=#FFFFFF align=center><FONT COLOR=blue></FONT></TD>";
// echo "<TD BGCOLOR=#fed19a align=center><FONT COLOR=blue> N/A </FONT></TD>";
}
}
echo "</TR>";
}
//備註
$message = "<B>每 5 分鐘更新一次";
// $message = "<B>備註:</B><BR> 1.N/A 表示未測試 <BR> 2.測試結果僅供參考,無法確定伺服器是否能正常運作<BR> 3.本監測畫面每 10 分鐘更新一次";
echo "<TR><TD COLSPAN=20 BGCOLOR=#FFFFFF> $message </TD><TR>";
// echo "<TR><TD COLSPAN=15 BGCOLOR=#f77dfd> $message </TD><TR>";
echo "</TABLE>";
?>