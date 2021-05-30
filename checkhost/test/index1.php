<?php
echo "<TABLE BORDER=20 WIDTH=1100 ALIGN=CENTER BGCOLOR=#FFFFFF>";

$timeout = 5;
$test = fsockopen("www.pesi.com.tw",80,$errno,$errstr,$timeout);
//顯示測試結果

if ($test) {
echo "<TD BGCOLOR=#77ff00 align=center>成功</FONT></TD>";
// echo "<TD BGCOLOR=yellow align=center>成功</FONT></TD>";
} else {
echo "<TD BGCOLOR=red align=center><FONT COLOR=white>失敗</FONT></TD>";
// echo "<TD BGCOLOR=red align=center><FONT COLOR=white>失敗</FONT></TD>";
}

$test = fsockopen("192.168.2.53:139",139,$errno,$errstr,$timeout);
//顯示測試結果

if ($test) {
echo "<TD BGCOLOR=#77ff00 align=center>成功</FONT></TD>";
// echo "<TD BGCOLOR=yellow align=center>成功</FONT></TD>";
} else {
echo "<TD BGCOLOR=red align=center><FONT COLOR=white>失敗</FONT></TD>";
// echo "<TD BGCOLOR=red align=center><FONT COLOR=white>失敗</FONT></TD>";
}




?>
