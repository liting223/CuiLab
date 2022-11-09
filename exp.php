<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>BarleyExpDB: The Barley Expression Database</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS here -->
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/animate.min.css">
    <link rel="stylesheet" href="static/css/custom-animation.css">
    <link rel="stylesheet" href="static/css/fontawesome.min.css">
    <link rel="stylesheet" href="static/css/meanmenu.css">
    <link rel="stylesheet" href="static/css/magnific-popup.css">
    <link rel="stylesheet" href="static/css/flaticon.css">
    <link rel="stylesheet" href="static/css/venobox.min.css">
    <link rel="stylesheet" href="static/css/backToTop.css">
    <link rel="stylesheet" href="static/css/swiper-bundle.css">
    <link rel="stylesheet" href="static/css/default.css">
    <link rel="stylesheet" href="static/css/main.css">
    <script src="static/js/plotly.min.js"></script>
</head>

<body>
    <header>
        <div class="tp-header-area">
            <div class="tp-header-top theme-dark-bg pt-50 pb-50 d-none d-xl-block">
                <div class="tp-custom-container">
                    <div class="row align-items-center">
                        <div class="col-xxl-2 col-xl-2">
                            
                        </div>
                        <div class="col-xxl-8 col-xl-8">
                            <div class="header-logo text-center">
                                <a href=""><img src="static/picture/logo-white.png" class="img-fluid" alt="logo not found"></a>
                            </div>
                           
                        </div>
                        <div class="col-xxl-2 col-xl-2">
                            
                            
                        </div>
                    </div>
                    <div style="height:20px"></div>
                </div>
            </div>

            <div class="tp-header-menu-area tp-transparent-header-menu header-sticky">
                <div class="container">
                    <div class="row justify-content-xl-center align-items-center">
                        <div class="col-xl-4 col-8 tp-sticky-column">
                            <div class="tp-sticky-logo">
                                <a href=""><img src="static/picture/logo-blue.png" class="img-fluid" alt="logo not found"></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-4">
                            <div class="tp-main-menu-bg">
                                <div class="tp-main-menu">
                                    <nav id="tp-mobile-menu">
                                        <ul class="text-center">
                                            <li class="menu-item-has-children"><a href="index.html" class="active">Home</a></li>
                                            <li class="menu-item-has-children"><a href="./blast/viroblast.php">Blast</a></li>
                                            <li class="menu-item-has-children"><a href="introduction.html">Introduction</a></li>
                                            <li class="menu-item-has-children"><a href="download.html">Download</a> </li>
                                            <li class="menu-item-has-children"><a href="about.html">About</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- mobile menu activation -->
                                <div class="side-menu-icon d-xl-none text-end">
                                    <button class="side-toggle"><i class="far fa-bars"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 tp-sticky-column-btn">
                            <div class="tp-sticky-btn text-end">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- mobile menu info -->
    <div class="fix">
        <div class="side-info">
            <button class="side-info-close"><i class="fal fa-times"></i></button>
            <div class="side-info-content">
                <div class="tp-mobile-menu"></div>
                <div class="contact-infos mb-30">
                    <div class="contact-list mb-30">
                        <h4>Contact Info</h4>
                        <ul>
                            <li><i class="flaticon-pin"></i>Nanchang, Jiangxi</li>
                            <li><i class="flaticon-email"></i>cuilicao@jxau.edu.cn</li>
                            <li><i class="flaticon-phone-call"></i>0791-83813459</li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-overlay"></div>
    <!-- mobile menu info -->
    <main>
        <div class="exp_t">
<?php
    echo "</br>";
    echo "</br>";
    echo "</br>";
    $morex = $_REQUEST['Morex'];
    $querySeq = $_REQUEST['querySeq'];
    $file = $_FILES['queryfileid'];
    $fileName=$file['name']; 
    
    //判断是否以换行符分割
    /*if (strpos($querySeq,'\n') !== true and strlen($querySeq)>30){
        die("<p style='font-size:30px;margin-top:180px;margin-left:150px;color:#ae3606'>Please check if the entered gene ID is split by  line breaks!</p>");
    }*/
    
    //判断输入文件或输入框
    
    if ($querySeq == '' and $_FILES["queryfileid"]["name"] == '') {
        die("<p style='font-size:30px;margin-top:180px;margin-left:150px;color:#ae3606'>Please select at least one gene!</p>");
    }
    elseif ($querySeq != '' and $_FILES["queryfileid"]["name"] == ''){
        $queryID = explode("\n",$querySeq);
    }
    elseif ($querySeq == '' and $_FILES["queryfileid"]["name"] != ''){
        if ($_FILES["queryfileid"]["type"] != "text/plain"){
            die("<p style='font-size:30px;margin-top:180px;margin-left:150px;color:#ae3606'>Please input TXT file !</p>");
        }
        else {
            $type=strrchr($_FILES["file"]["name"],".");
            $filename = time().$type;
            move_uploaded_file($_FILES["queryfileid"]["tmp_name"],"upload/" . $filename);
            $myfile = fopen("upload/".$filename, "r") or die("Unable to open file!");
            
            $queryID = explode("\n",fread($myfile , "14000"));
        }
        
    }
    elseif ($querySeq != '' and $_FILES["queryfileid"]["name"] != ''){
        if ($_FILES["queryfileid"]["type"] != "text/plain"){
            die("<p style='font-size:30px;margin-top:180px;margin-left:150px;color:#ae3606'>Please input TXT file !</p>");
        }
        else {
        $type=strrchr($_FILES["file"]["name"],".");
        $filename = time().$type;
        move_uploaded_file($_FILES["queryfileid"]["tmp_name"],"upload/" . $filename);
        $myfile = fopen("upload/".$filename, "r") or die("Unable to open file!");
      
        $queryID = explode("\n",fread($myfile , "14000"));
        }
    }
    $project = @$_REQUEST['project'];
    if (!$project) {
        die("<p style='font-size:30px;margin-top:180px;margin-left:150px;color:#ae3606'>Please select at least one project!</p>");
    }
    if (in_array('PRJEB39672',$project)==ture and count($project) ==1){
        $fig_width = 2800;
    }
    elseif (in_array('PRJEB39672',$project)==false and count($project) >= 10) {
        $fig_width = 7000;
    }
    elseif (in_array('PRJEB39672',$project)==false and count($project) >= 5 and count($project) < 10) {
        $fig_width = 5000;
    }
    elseif (in_array('PRJEB39672',$project)==false and count($project) >= 3 and count($project) < 5) {
        $fig_width = 2000;
    }
    elseif (in_array('PRJEB39672',$project)==false and count($project) > 1 and count($project) < 3) {
        $fig_width = 1200;
    }
    elseif (in_array('PRJEB39672',$project)==false and in_array('PRJNA378723',$project)==false and in_array('PRJNA430281',$project)==false and in_array('PRJNA378582',$project)==false and in_array('PRJNA744021',$project)==false and count($project) ==1) {
        $fig_width = 1200;
    }
    elseif (in_array('PRJEB39672',$project)==false and ( in_array('PRJNA378723',$project)==true or in_array('PRJNA378582',$project)==true or in_array('PRJNA430281',$project)==true or in_array('PRJNA744021',$project)==true) and count($project) ==1) {
        $fig_width = 1700;
    }

    
    if($morex=='V2'){
        echo "<h2 class='text-center' style='margin-top:20px'>Morex V2 Gene Expression</h2>";
    }
    else{
        echo "<h2 class='text-center' style='margin-top:20px'>Morex V3 Gene Expression</h2>";
    }
    $servername = "localhost";
    $username = "barleyexp_com";
    $password = "8DZHEXnCeziXyN5m";
    $conn = mysqli_connect($servername, $username, $password);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_query($conn, "set name utf8");
    $select_db = mysqli_select_db($conn, 'barleyexp_com');
    $title = array();
    $value = array();
    

    echo "</br>";
    echo "<p style='margin-left:8%;font-size:18px'><b>Gene:</b> ";
    echo "</br>";

    $id_temp = array();//为了去掉每个元素后面的空格，不然下面的mysql不执行
    for($r=0;$r<count($queryID);$r++){
        $qqq = $queryID[$r];
        $ttemp = rtrim($qqq);
        array_push($id_temp,$ttemp);
        echo $ttemp .' ; ';
    }
    echo "</p><p style='margin-left:8%;font-size:18px'><b>Project:</b> ";
    for($i=0;$i<count($project);$i++)
        {
            $ids_heat = array();
            $pro = $project[$i];
            echo $pro .' ; ';
            $query = "SELECT * FROM ".$morex."_".$pro." LIMIT 1";
            $result = mysqli_query($conn,$query);
            $fields = mysqli_num_fields($result);

            for($count=0;$count<$fields;$count++)
            {
                $field = mysqli_fetch_field($result);
                if($field->name != 'id'){
                    array_push($title,$field->name);
                }
            }
            
            for($l=0;$l<count($id_temp);$l++){
                $sql = "SELECT * FROM `".$morex."_".$pro."` WHERE `id` = '".$id_temp[$l]."'";
                $res = mysqli_query($conn,$sql);
                $number = mysqli_num_fields($res);
                $row = mysqli_fetch_array($res, MYSQLI_NUM);
                if($id_temp[$l] != '' and $row == ''){
                    echo " <p style='font-size:22px;margin-top:10px;margin-left:120px;color:#053b20>'".$id_temp[$l].' was not found in '.$pro.'.</p>';
                }
                else{
                    $lens = count($ids_heat);
                    
                    
                    for($count2=1;$count2<$number;$count2++){
                        if ($id_temp[$l] == $row[0]){
                            $value[$lens][] = $row[$count2];      
                        }
                    } 
                    if (in_array($id_temp[$l],$ids_heat) == FALSE){
                        array_push($ids_heat,$id_temp[$l]);
                        
                    }
                }
                
            }
            
        }
        echo "</p>";
        $jsonstr = json_encode($value);
        if (count($ids_heat)>=1 and count($ids_heat) < 25){
            $fig_height = 700;
        }
        elseif (count($ids_heat)>=25 and count($ids_heat) < 50){
            $fig_height = 1000;
        }
        elseif (count($ids_heat)>=50 and count($ids_heat) < 80){
            $fig_height = 1400;
        }
        elseif (count($ids_heat)>=80 and count($ids_heat) < 120){
            $fig_height = 2000;
        }
        elseif (count($ids_heat)>=120 and count($ids_heat) < 170){
            $fig_height = 2700;
        }
        elseif (count($ids_heat)>=170 and count($ids_heat) < 230){
            $fig_height = 3400;
        }
        elseif (count($ids_heat)>=230 and count($ids_heat) < 280){
            $fig_height = 4300;
        }
        elseif (count($ids_heat)>=280 and count($ids_heat) < 320){
            $fig_height = 4800;
        }
        elseif (count($ids_heat)>=320 and count($ids_heat) < 400){
            $fig_height = 6000;
        }
        elseif (count($ids_heat)>=400 and count($ids_heat) < 500){
            $fig_height = 7500;
        }
        elseif (count($ids_heat)>500){
            die("<p style='font-size:30px;margin-top:160px;margin-left:150px;color:#ae3606'>Please select less than 500 genes!</p>");
        }
        echo "<p style='margin-left:8%;font-size:18px'><b>Gene ID not found:</b> ";
        for($o=0;$o<count($id_temp);$o++){
            if (in_array($id_temp[$o],$ids_heat)==false){
                echo $id_temp[$o] .' ; ';
            }
        }
        //下载查询值
        $downname = time().".txt";
        $downfile = fopen("download/".$downname, "w") or die("Unable to open file!");
        fwrite($downfile, "id");
        for($k=0;$k<count($title);$k++) {
            fwrite($downfile, "\t".$title[$k]);
        }
        fwrite($downfile, "\n");
        for($a=0;$a<count($ids_heat);$a++) {
            fwrite($downfile, $ids_heat[$a]);
            for($b=0;$b<count($value[$a]);$b++) {
                fwrite($downfile, "\t".$value[$a][$b]);
            }
            fwrite($downfile, "\n");
        }
        echo "<p style='margin-left:8%;font-size:18px'><b>Export expression data:</b> <a href='download/".$downname."' download='expression_data.txt' class='exp_down'>Download</a></p>";
    echo "</p><p style='margin-left:8%;font-size:18px'><b>Export sample information:</b> ";
    for($v=0;$v<count($project);$v++) {
        $pro2 = $project[$v];
        echo "<a href='data/srr_info/".$pro2 .".txt' download='".$pro2."_sample_name_info.txt'  class='exp_down'>".$pro2."</a> ; ";
    }
    echo "</p>";
?>
    </div>
    
    
    <div id="myDiv" class="myDiv">
        <!-- Plotly chart will be drawn inside this DIV -->
    </div>
<script>
    var title = eval(<?php echo json_encode($title) ; ?>);
    var id_temp = eval(<?php echo json_encode($ids_heat) ; ?>);
    var value = eval(<?php echo $jsonstr; ?>);
    var colorscaleValue = [
    ['0.0', 'rgb(49,54,149)'],
    ['0.111111111111', 'rgb(69,117,180)'],
    ['0.222222222222', 'rgb(116,173,209)'],
    ['0.333333333333', 'rgb(171,217,233)'],
    ['0.444444444444', 'rgb(224,243,248)'],
    ['0.555555555556', 'rgb(254,224,144)'],
    ['0.666666666667', 'rgb(253,174,97)'],
    ['0.777777777778', 'rgb(244,109,67)'],
    ['0.888888888889', 'rgb(215,48,39)'],
    ['1.0', 'rgb(165,0,38)']
    ];
    
    var data = [{
    x: title,
    y: id_temp,
    z: value,
    type: 'heatmap',
    colorscale: colorscaleValue,
    showscale: false,
    automargin: true
    }];

    var layout = {
    width: <?php echo ($fig_width) ; ?>,
    height: <?php echo ($fig_height) ; ?>,
    
    annotations: [],
    margin: {"t": 200, "b": 20, "l": 200, "r": 100},
    xaxis: {
        ticks: '',
        side: 'top',
        tickangle: -37
    },
    yaxis: {
        ticks: '',
        ticksuffix: ' ',
        width: 500,
        height: 500,
        autosize: false
    }
    };

    for ( var i = 0; i < id_temp.length; i++ ) {
    for ( var j = 0; j < title.length; j++ ) {
        var currentValue = value[i][j];
        if (currentValue > 1.0) {
        var textColor = 'black';
        }else{
        var textColor = 'white';
        }
        var result = {
        xref: 'x1',
        yref: 'y1',
        x: title[j],
        y: id_temp[i],
        text: value[i][j],
        font: {
            family: 'Arial',
            size: 12,
            color: 'rgb(50, 171, 96)'
        },
        showarrow: false,
        font: {
            color: textColor
        }
        };
        layout.annotations.push(result);
    }
    }
    var config = {responsive: true}
    Plotly.newPlot('myDiv', data, layout, config );
</script> 
    <?php
        @fclose($myfile);
        @fclose($downfile);
    ?>
    </main>

    <footer class="theme-dark-bg">

        <div class="tp-copyright-area bg-green-light z-index pt-45 pb-35">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tp-copyright text-center">
                            <p>Copyright &copy; 2021 Jiangxi Agricultural University. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
        


    <!-- JS here -->
    <script data-cfasync="false" src="static/js/email-decode.min.js"></script><script src="static/js/jquery.min.js"></script>
    <!-- <script src="static/js/bootstrap.bundle.min.js"></script> -->
    <script src="static/js/swiper-bundle.js"></script>
    <script src="static/js/venobox.min.js"></script>
    <script src="static/js/backToTop.js"></script>
    <script src="static/js/jquery.meanmenu.min.js"></script>
    <script src="static/js/jquery.magnific-popup.min.js"></script>
    <script src="static/js/ajax-form.js"></script>
    <script src="static/js/wow.min.js"></script>
    <script src="static/js/main.js"></script>
    
</body>

</html>