 <!-- <?php
      session_start();
      //require('../admincp/modules/thongke.php');
      if(!isset($_SESSION['dangnhap'])){
          header('Location:login.php');
      }
      //echo json_last_error_msg();
 
 ?> -->
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css"  href="css/styleadmincp.css">
     <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
     <title>Admincp</title>
 </head>
 <body>
    <!--  <h1 class="title_admin">Chào mừng đến trang quản trị của TĐT MOBILE</h1> -->
     <div class="wrapper">
        <?php
            include("config/config.php");
            include("modules/header.php");
            include("modules/menu.php");
            include("modules/main.php");
            include("modules/footer.php");
         ?>
    </div> 
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
   <!--  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
           CKEDITOR.replace( 'tomtat' );
           CKEDITOR.replace( 'noidung' );
    </script>  -->
    <!-- Bootstrap core JavaScript-->
    <script src="jquery/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function(){
            thongke();
            var char = new Morris.Area({

            element: 'chart',

            xkey: 'date',
           
            ykeys: ['date','order','sales','quantity'],
        
            labels: ['Đơn hàng','Doanh thu','Số lượng bán']
            });

        $('.select-date').change(function(){
                var thoigian = $(this).val();
               //alert($('.select-date').val());
                //var thoigian=$('.select-date').text();
                if(thoigian =='7ngay'){
                    var text = '7 ngày qua'; 
                }else if(thoigian=='28ngay'){
                    var text = '28 ngày qua';
                }else if(thoigian=='90ngay'){
                    var text = '90 ngày qua';
                }else{
                    var text = '365 ngày qua';
                }
                //$('#text-date'.text(text));
                $.ajax({
                    url:"modules/thongke.php",
                    type:"POST",
                    dataType:"JSON",
                    data:{thoigian:thoigian},
                    success:function(data)
                        {
                            char.setData(data);
                            $('#text-date'.text(text));
                        }
                });
            })

            function thongke(){
                var text ='365 ngày qua';
                $.ajax({
                    url:"modules/thongke.php",
                    type:"POST",
                    dataType:"JSON",
                    //data: {thoigian:thoigian} + text,
                    success: function(data)
                    {
                        char.setData(data);
                        $('#text-date').text(text);
                        //alert(textchange);
                    }
                });
            }
        });
    </script>
 </body>
 </html>   