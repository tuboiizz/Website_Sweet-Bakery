<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php
if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
   
   echo "<script>window.location='inbox.php';</script>";
   
} else {

    $id = $_GET['msgid'];
}


 ?>


        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Xem tin nhắn</h2>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 $to = $fm->validation($_POST['toEmail']);
 $from = $fm->validation($_POST['fromEmail']);
 $Subject = $fm->validation($_POST['subject']);
 $message = $fm->validation($_POST['message']);

 $sendmail = mail($to, $Subject, $message,$from);

 if ($sendmail) {
     echo "<span class='success'>Tin nhắn đã được gửi thành công.</span>";
 }else{
    echo "<span class='error'>Đã xảy ra lỗi!</span>";
 }


}

?>


                <div class="block">               
                 <form action="" method="post" >

             <?php

            $query = "select * from tbl_contact where id='$id'";
            $msg = $db->select($query);
            if ($msg) {

            while ($result = $msg->fetch_assoc()) {

           ?>
                    <table class="form">
                       
              

                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly name="toEmail" value="<?php echo $result['email'];?>" class="medium" />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromEmail" placeholder="Vui lòng nhập vào email của bạn" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Chủ đề</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="Vui lòng nhập chủ đề của bạn" class="medium" />
                            </td>
                        </tr>
                     
                    
                   
                    
                       
                    
                        <tr>
                            <td>
                                <label>Tin nhắn</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message">
                                    

                                </textarea>
                            </td>
                        </tr>

                       
                        

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Gửi" />
                            </td>
                        </tr>
                    </table>

                    <?php } } ?>

                    </form>
                </div>
            </div>
        </div>


 <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>


 <!-- Load TinyMCE -->

 <?php include 'inc/footer.php'; ?>



