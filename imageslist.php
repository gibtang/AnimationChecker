<?php 
$i=0;
$uFolder = 'uploads/';
if (isset($_GET['folder'])) {
    $userdir=$_GET['folder'];
    if(strlen($userdir)>1){
        $uFolder = 'uploads/'.$userdir.'/';}
}
    

foreach (glob($uFolder."*.*") as $filename) {
    $edit_url = "javascript:pixlr.edit({image:'http://www.azukisoft.com/OSC/$filename', title:'Quick edit', service:'editor', target:'http://developer.pixlr.com/save_post.php', exit:'http://www.azukisoft.com/OSC/'});";

    echo '<table border="0" width="100%"><tr>';
    
    echo "<td><img src='images/delete.png' width='12px' height='12px' id=\"left_$i\" class='delete' name='i$i'/></td>";
    echo "<td rowspan='3' align='center'><img src='$filename' width='150px' id=\"right_$i\" onclick='selectToAnimate(\"$filename\");' /></td>";
    
    echo '</tr><tr>';
    echo "<td><a href=\"$edit_url\" target='_blank'><img src='images/edit.png' width='12px' height='12px' /></a></td>";
    
    echo '</tr><tr>';
    echo "<td><a href='$filename' target='_blank'><img src='images/download.png' width='12px' height='12px' /></a></td>";
    
    echo '</tr></table><hr/>';
    $i++;
}
?>
