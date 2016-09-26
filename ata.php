<?php
exec('/home/biztalk/ATA/atasvc status',$output);
print_r($output);
if($output[0]=="The daemon is running."){
echo "비즈톡이 실행 중입니다.";
}else{
echo "비즈톡이 종료 중입니다.";
};

?>