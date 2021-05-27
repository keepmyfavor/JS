for ( $j = 0 ; $j < $len ; $j++) {

    //各別取出比對專案每一項的值,若等於 1 ,就做測試 , 0 測不做測試
    if (substr($get_line[$i][2],$j,1) == "1") {
        //進行測試,並抑制錯誤訊息輸出
        $test[$j] = @fsockopen($get_line[$i][1],$port[$j],$errno,$errstr,$timeout);
        //顯示測試結果
            if ($test[$j]) {
                echo "<TD BGCOLOR=#77ff00 align=center></FONT></TD>";
                // echo "<TD BGCOLOR=yellow align=center>成功</FONT></TD>";
                } 
            else {
                echo "<TD BGCOLOR=red align=center><FONT COLOR=white></FONT></TD>";
                // echo "<TD BGCOLOR=red align=center><FONT COLOR=white>失敗</FONT></TD>";
                }
                } 
            else {
                echo "<TD BGCOLOR=#FFFFFF align=center><FONT COLOR=blue></FONT></TD>";
                // echo "<TD BGCOLOR=#fed19a align=center><FONT COLOR=blue> N/A </FONT></TD>";
            }
        }
    echo "</TR>";
}