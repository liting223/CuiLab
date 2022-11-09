<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>BarleyExpDB: The Barley Expression Database</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS here -->
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/animate.min.css">
    <link rel="stylesheet" href="../static/css/custom-animation.css">
    <link rel="stylesheet" href="../static/css/fontawesome.min.css">
    <link rel="stylesheet" href="../static/css/meanmenu.css">
    <link rel="stylesheet" href="../static/css/magnific-popup.css">
    <link rel="stylesheet" href="../static/css/flaticon.css">
    <link rel="stylesheet" href="../static/css/venobox.min.css">
    <link rel="stylesheet" href="../static/css/backToTop.css">
    <link rel="stylesheet" href="../static/css/swiper-bundle.css">
    <link rel="stylesheet" href="../static/css/default.css">
    <link rel="stylesheet" href="../static/css/main.css">
    <link href="stylesheets/viroblast.css"  rel="Stylesheet" type="text/css" />
    <script type="text/javascript" src='javascripts/viroblast.js'></script>
</head>
<body>
    <header>
        <div class="tp-header-area">
            <div class="tp-header-top theme-dark-bg pt-50 pb-50 d-none d-xl-block">
                <div class="tp-custom-container">
                    <div class="row align-items-center" >
                        <div class="col-xxl-2 col-xl-2">
                            
                        </div>
                        <div class="col-xxl-8 col-xl-8">
                            <div class="header-logo text-center">
                                <img src="../static/picture/logo-white.png" class="img-fluid" alt="logo not found">
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
                                <img src="../static/picture/logo-blue.png" class="img-fluid" alt="logo not found">
                            </div>
                        </div>
                        <div class="col-xl-8 col-4">
                            <div class="tp-main-menu-bg">
                                <div class="tp-main-menu">
                                    <nav id="tp-mobile-menu">
                                        <ul class="text-center">
                                            <li class="menu-item-has-children"><a href="../index.html">Home</a></li>
                                            <li class="menu-item-has-children"><a href="viroblast.php" class="active">Blast</a></li>
                                            <li class="menu-item-has-children"><a href="../introduction.html">Introduction</a></li>
                                            <li class="menu-item-has-children"><a href="../download.html">Download</a> </li>
                                            <li class="menu-item-has-children"><a href="../about.html">About</a></li>

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
    <main>

        <div id="indent" class="blast_sty" style="margin-left:auto;margin-right:auto;">

            <form enctype='multipart/form-data' name='blastForm' action = 'blastresult.php' method='post'>
                
	                
                    <p style="font-size:20px;margin-top:30px">Enter query sequences here in Fasta format</p> 
                    <p><textarea name='querySeq' rows='5' cols='66' style="width:80%"></textarea></p>
                    <p>Or upload sequence fasta file: <input type='file' name='queryfile'></p>
                    <p><table border=0 style='font-size: 16px'>
                    <tr><td valign=top>
                    <a>Program</a> <select id="programList" name='program' onchange="changeDBList(this.value, this.form.dbList, dblib[programNode.value]); changeParameters(this.value, 'adv_parameters');">
                    <option value='blastn' selected>blastn
                    <option value='blastp'>blastp
                    <option value='blastx'>blastx
                    <option value='tblastn'>tblastn
                    <option value='tblastx'>tblastx
                    </select></td>

                    <td valign=top>&nbsp;&nbsp;&nbsp;
                    <a>Database(s) </a>
                    </td><td>
<?php
$fp = fopen ("./viroblast.ini", "r");
if(!$fp) {
	echo "<p><strong> Error: Couldn't open file viroblast.ini </strong></p></body></html>";
	exit;
}
while(!feof($fp)) {
	$blastdbstring = rtrim(fgets($fp));
	if (!$blastdbstring) {
		continue;
	}
	if (!preg_match("/^\s*#/", $blastdbstring)) {
		$blastdbArray = preg_split('/:/', $blastdbstring);	
		$blastProgram = $blastdbArray[0];
		$dbString = $blastdbArray[1];
		
		if ($blastProgram == "blast+") {
			echo "<input type='hidden' name= 'blastpath' value='$dbString'>";
		}else {
			if (preg_match("/^\s*(.*?)\s*$/", $blastProgram, $match)) {
				$blastProgram = $match[1];
			}
			if (preg_match("/^\s*(.*?)(\s*|\s*,\s*)$/", $dbString, $match)) {
				$dbString = $match[1];
			}
			$dbString = preg_replace("/\s*=>\s*/", "=>", $dbString);
			if (preg_match("/,/", $dbString, $match)) {
				$dbString = preg_replace("/\s*,\s*/", ",", $dbString);
			}		
			echo "<input id='$blastProgram' type='hidden' name='blastdb[]' value='$dbString'>";
		}
	}	
}
fclose($fp);

?>
<select id="dbList" size=1 multiple="multiple" name ="patientIDarray[]">
<script type="text/javascript">
	var dblib = Array();
	var programNode = document.getElementById("programList");
	var blastndbNode = document.getElementById("blastn");
	var blastpdbNode = document.getElementById("blastp");
	var blastxdbNode = document.getElementById("blastx");
	var tblastndbNode = document.getElementById("tblastn");
	var tblastxdbNode = document.getElementById("tblastx");
	dblib["blastn"] = blastndbNode.value;
	dblib["blastp"] = blastpdbNode.value;
	dblib["blastx"] = blastxdbNode.value;
	dblib["tblastn"] = tblastndbNode.value;
	dblib["tblastx"] = tblastxdbNode.value;
	changeDBList(programNode.value, document.getElementById("dbList"), dblib[programNode.value]);
</script>

</select>
</td></tr></table></p>

<p>
    And/or upload sequence fasta file: <input type='file' name='blastagainstfile'>
</p>

<input type='hidden' name='blast_flag' value=1>

<p style="margin-left:15%;margin-top:40px"><input class="blast_button" type='button' name="bblast" value='Search' onclick="checkform(this.form, this.value)">&nbsp;&nbsp;<input type='reset' value='Reset' class="blast_button" style="margin-left:20%;" onclick="window.location.reload();"></p>

<!--<div id="title">
	<span><strong>Advanced Search - setting your favorite parameters below</strong></span>
</div>

<div id="adv_parameters">

<script type="text/javascript">
	var programNode = document.getElementById("programList");
	changeParameters(programNode.value, 'adv_parameters');
</script>

</div>
<p><input type='button' name="ablast" value='Advanced search' onclick="checkform(this.form, this.value)">&nbsp;&nbsp;<input type='reset' value='Reset' onclick="window.location.reload();"></p>--> 
            
            </form>
            
        </div>
    
    </main>
    <div style="height:40px"></div>
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
    <script data-cfasync="false" src="../static/js/email-decode.min.js"></script>
    <script src="../static/js/jquery.min.js"></script>
    <script src="../static/js/bootstrap.bundle.min.js"></script>
    <script src="../static/js/swiper-bundle.js"></script>
    <script src="../static/js/venobox.min.js"></script>
    <script src="../static/js/backToTop.js"></script>
    <script src="../static/js/jquery.meanmenu.min.js"></script>
    <script src="../static/js/jquery.magnific-popup.min.js"></script>
    <script src="../static/js/ajax-form.js"></script>
    <script src="../static/js/wow.min.js"></script>
    <script src="../static/js/main.js"></script>

</body>

</html>
