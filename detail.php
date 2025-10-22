<?php
//数据准备
class site_info
{
  //链接
  public $pdo;
  protected $loaction_dbname;
  protected $username;
  protected $password;
  // 链接数据库
  public function __construct($loaction_dbname, $username, $password)
  {
    $pdo=new PDO($loaction_dbname, $username, $password);
    $this->pdo = $pdo;
  }
	public function basic ($StruRM_ID,$table)
  {
    $stmt = $this->pdo->prepare(
      'SELECT
        StruRM_ID,
        Modification,
        Species,
        seqnames,
        start,
        strand,
        Sequence,
        modified_location,
        Gene_name,
        Gene_id,
        Region,
        Bio_type,
        RNA_type,
        similarity_score,
        relative_score,
        forester_distance,
        smcscore,
        Data_source,
        Database_source,
        secondary_structure_before,
        MFE,
        secondary_structure_after,
        MFE_mod,
        plot_path_before,
        plot_path_after,
        RBP_Num,
        miRNA_Num,
        SNP_Num
      FROM '.$table.'
      WHERE StruRM_ID = :StruRM_ID'
    );
    $stmt->bindValue(':StruRM_ID', $StruRM_ID);
    $stmt->execute();
    $cart = array();

    while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $cart[] = array(
      'StruRM_ID'=>$user["StruRM_ID"],
      'Modification'=>$user["Modification"],
      'Species'=>$user["Species"],
      'seqnames'=>$user["seqnames"],
      'start'=>$user["start"],
      'strand'=>$user["strand"],
      'Sequence'=>$user["Sequence"],
      'modified_location'=>$user["modified_location"],
      'Gene_name'=>$user["Gene_name"],
      'Gene_id'=>$user["Gene_id"],
      'Region'=>$user["Region"],
      'Bio_type'=>$user["Bio_type"],
      'RNA_type'=>$user["RNA_type"],
      'similarity_score'=>$user["similarity_score"],
      'relative_score'=>$user["relative_score"],
      'forester_distance'=>$user["forester_distance"],
      'smcscore'=>$user["smcscore"],
      'Data_source'=>$user["Data_source"],
      'Database_source'=>$user["Database_source"],
      'secondary_structure_before'=>$user["secondary_structure_before"],
      'MFE'=>$user["MFE"],
      'secondary_structure_after'=>$user["secondary_structure_after"],
      'MFE_mod'=>$user["MFE_mod"],
      'plot_path_before'=>$user["plot_path_before"],
      'plot_path_after'=>$user["plot_path_after"],
      'RBP_Num'=>$user["RBP_Num"],
      'miRNA_Num'=>$user["miRNA_Num"],
      'SNP_Num'=>$user["SNP_Num"],
      );
    }
    return $cart;
  }

  //rbp
  public function rbp_table ($StruRM_ID,$tableName)
  {
    $table = $tableName."_RBP";
    $stmt = $this->pdo->prepare(
        'SELECT
          StruRM_ID,
          RBP_name,
          experiment,
          cell_line,
          GSE,
          seqnames,
          start,
          end,
          strand
         FROM '.$table.'
         WHERE StruRM_ID = :StruRM_ID'
    );
    $stmt->bindValue(':StruRM_ID', $StruRM_ID);
    $stmt->execute();
    $cart = array();

    while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $cart[] = array('StruRM_ID'=>$user["StruRM_ID"], 
      'StruRM_ID'=>$user["StruRM_ID"],
      'RBP_name'=>$user["RBP_name"],
      'experiment'=>$user["experiment"],
      'cell_line'=>$user["cell_line"], 
      'GSE'=>$user["GSE"],
      'seqnames'=>$user["seqnames"],
      'start'=>$user["start"],
      'end'=>$user["end"],
      'strand'=>$user["strand"]);
    }
    return $cart;
  }

  //mirna
  public function mirna_table ($StruRM_ID,$tableName)
  {
    $table = $tableName."_miRNA";
      $stmt = $this->pdo->prepare(
        'SELECT
          StruRM_ID,
          miRNAid,
          miRNAname,
          miRNA_type,
          geneID,
          geneName,
          geneType,
          clipExpNum
        FROM '.$table.'
        WHERE StruRM_ID = :StruRM_ID'
      );
      $stmt->bindValue(':StruRM_ID', $StruRM_ID);
      $stmt->execute();
      $cart = array();

      while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $cart[] = array('StruRM_ID'=>$user["StruRM_ID"], 
        'miRNAid'=>$user["miRNAid"],
        'miRNAname'=>$user["miRNAname"],
        'miRNA_type'=>$user["miRNA_type"], 
        'geneID'=>$user["geneID"],
        'geneName'=>$user["geneName"],
        'geneType'=>$user["geneType"],
        'clipExpNum'=>$user["clipExpNum"]);
      }
      return $cart;
  }

  //ss
  public function snp_table ($StruRM_ID,$species)
  {
    $table = $species."_SNP";
      $stmt = $this->pdo->prepare(
        'SELECT
          StruRM_ID,
          rs_ID,
          Ref,
          Alt,
          Info,
          seqnames,
          start,
          end,
          strand
        FROM '.$table.'
        WHERE StruRM_ID = :StruRM_ID'
      );
      $stmt->bindValue(':StruRM_ID', $StruRM_ID);
      $stmt->execute();
      $cart = array();

      while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $cart[] = array('StruRM_ID'=>$user["StruRM_ID"], 
        'rs_ID'=>$user["rs_ID"],
        'Ref'=>$user["Ref"], 
        'Alt'=>$user["Alt"],
        'Info'=>$user["Info"],
        'seqnames'=>$user["seqnames"],
        'start'=>$user["start"],
        'end'=>$user["end"],
        'strand'=>$user["strand"]);
      }    
      return $cart;
  }

}


$cl = new site_info('mysql:host=localhost;dbname=structrmdb', 'StructRMDB', 'StructRMDB@2024');
//获得变量
$StruRM_ID=$_GET['ID'];
$species = $_GET["species"];
$modification = $_GET["modification"];
$software = $_GET["softwore"];
$table = $modification."_".$species."_".$software;

//根据条件获取数据
$ans=$cl -> basic($StruRM_ID,$table);
$RBP_Num = $ans[0]['RBP_Num'];
$miRNA_Num = $ans[0]['miRNA_Num'];
$SNP_Num = $ans[0]['SNP_Num'];
if (!empty($RBP_Num)) {
  $rbp_table = $cl-> rbp_table($StruRM_ID,$table);
}
if (!empty($miRNA_Num)) {
  $mirna_table = $cl-> mirna_table($StruRM_ID,$table);
}
if (!empty($SNP_Num)) {
  $snp_table = $cl-> snp_table($StruRM_ID,$table);
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>StructRMDB</title>
  <script src="./file/jquery-3.6.0.js"></script>
  <link rel="stylesheet" href="./file/table.css">
  <link rel="stylesheet" href="./file/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./file/bootstrap.min.css">
  <script src="./file/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./file/bootstrap-table.min.css">
  <script src="./file/bootstrap-table.min.js"></script>
  <script type="text/javascript" src="./file/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./file/jquery.dataTables.min.css">
  <link rel="stylesheet" href="./index.css">
  <!-- 为了布局后加的 -->
  <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
</head>
<style>
  body{
    background-color: #dcd2c6;
  }
  nav{
    font-size: 20px;
  }
  .navbar-brand{
    font-size: 1.4em;
    color: #800020;
  }
  .navbar-fixed-top{
    background-color: #EEECE7!important;
  } 
  main{
    width: 80%;
    margin: 120px auto;
    padding: 10px 20px 40px 20px;
    background-color: #fff;
    border:2px solid;
    border-radius:5px;
    box-shadow: 3px 3px 1px 1px #292c33;
  }
  .container {
    width:99.4%;
  }  
  .text {
    line-height: 1.5;
    max-height: 4.5em;
    overflow: hidden;
  } 
  .text::before{
    content: '';
    float: right;
    width: 0;
    height: calc(100% - 24px);
  }
  #exp:checked+.text::after{
    visibility: hidden;
  }
  #exp:checked+.text{
    max-height: none;
  }
  #exp:checked+.text .mybutton::after{
    content:'hide all';
  }
  .mybutton {
    float: right;
    clear: both;
    color: #deb887;
  }
  .mybutton::after{
    content:'show all' /*采用content生成*/
  }
  .wrap{
    display: flex;
  }
  .bigImg {
    position: absolute;
    top: 50%;
    left: 50%;
    /*图片向左移动自身宽度的50%, 向上移动自身高度的50%。*/
    transform: translate(-50%,-50%);
  }
  /*遮罩层*/
  .opacityBottom {
    width: 100%;
    height: 100%;
    position: fixed;
    background: #fff;
    z-index: 9999;
    top: 0;
    left: 0;
  }
  /*datatable 的processing被挡住，让datatable显示在底层*/
  #example_processing { 
    z-index: 1000;
  }
</style>
<body>
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <span class="navbar-brand" style=""><b>StructRMDB</b></span>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>  
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-database" ></i> RNAstructure <b class="caret"></b></a>
            <ul class="dropdown-menu nav-sub" style="width: auto;">
              <li><a href="table.html?modification=m6A&species=Arabidopsis_Thaliana&software=RNAstructure"> N6-methyladenosine (m<sup>6</sup>A) </a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-database" ></i> ViennaRNA <b class="caret"></b></a>
            <ul class="dropdown-menu nav-sub" style="width: auto;">
              <li><a href="table.html?modification=m6A&species=Arabidopsis_Thaliana&software=vienna"> N6-methyladenosine (m<sup>6</sup>A) </a></li>
              <li role="separator" class="divider" style="padding:0px;margin:0px" ></li>
              <li><a href="table.html?modification=PSI&species=Homo_sapiens&software=vienna"> Pseudouridine (Ψ) </a></li>
              <li role="separator" class="divider" style="padding:0px;margin:0px" ></li>
              <li><a href="table.html?modification=ATOI&species=Homo_sapiens&software=vienna"> Adenosine-to-inosine (A-to-I) </a></li>
            </ul>
          </li>
          <li><a href="download.html" ><i class="fa fa-cloud-download" aria-hidden="true"></i> Download</a></li>
          <li><a href="api.html" ><i class="fa fa-bars" aria-hidden="true"></i> API</a></li>
          <li><a href="help.html" ><i class="fa fa-question-circle" aria-hidden="true"></i> Help</a></li>
          <li><a href="contact.html" ><i class="fa fa-envelope" aria-hidden="true"></i> Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

	<main>
	<div class="container">
		<div class="panel panel-danger" style="margin-top:20px" id="info">
    	<div class="panel-heading">
        <h4 class="panel-title"><a id="show1" data-toggle="collapse" href="#" style="text-decoration : none; ">Basic information of :<span style="color:#154181;"> <?php  echo $StruRM_ID;?></span></a>
        </h4>
    	</div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body" style="overflow:auto">
          <table class="table table-hover table-striped" style="table-layout:fixed;word-break:break-all;font-size:16.6px">
            <tr>
              <th >StructRM ID</th>
              <td><?php echo $ans[0]['StruRM_ID'] ?></td>
            </tr>

            <tr>
              <th >Modification Type</th>
              <td><?php echo $ans[0]['Modification'] ?></td>
            </tr>   

            <tr>
              <th >Species</th>
              <td><?php echo $ans[0]['Species'] ?></td>
            </tr> 

            <tr>
              <th >Chromosome</th>
              <td><?php echo $ans[0]['seqnames'] ?></td>
            </tr>

            <tr>
              <th >Position</th>
              <td><?php echo $ans[0]['start'] ?></td>
            </tr> 

            <tr>
              <th >Strand </th>
              <td><?php echo $ans[0]['strand'] ?></td>
            </tr> 

            <tr>
              <th >Modified Position </th>
              <td><?php echo $ans[0]['modified_location'] ?></td>
            </tr> 

            <tr>
              <th >Gene Type</th>
              <td>
                <?php
                  if (empty($ans[0]['Bio_type'])) {
                    echo "-";
                  } else {
                    echo $ans[0]['Bio_type'];
                  }
                ?>
              </td>
            </tr> 
                          
            <tr>
              <th >Gene</th>
              <td>
                <?php
                  if (empty($ans[0]['Gene_name'])) {
                    echo "-";
                  } else {
                    echo $ans[0]['Gene_name'];
                  }
                ?>
              </td>
            </tr>            

            <tr>
              <th >Gene ID</th>
              <td><?php echo $ans[0]['Gene_id'] ?></td>
            </tr> 

            <tr>
              <th >Gene Region</th>
              <td><?php echo $ans[0]['Region'] ?></td>
            </tr>  

            <tr>
              <th >RNA Type</th>
              <td><?php echo $ans[0]['RNA_type'] ?></td>
            </tr> 

            <tr>
              <th >Similarity Score</th>
              <td><?php echo $ans[0]['similarity_score'] ?></td>
            </tr> 


            <tr>
              <th >Relative Score</th>
              <td><?php echo $ans[0]['relative_score'] ?></td>
            </tr> 

            <tr>
              <th >Distance score</th>
              <td><?php echo $ans[0]['forester_distance'] ?></td>
            </tr> 

            <tr>
              <th >SMC score </th>
              <td><?php echo $ans[0]['smcscore'] ?></td>
            </tr>  

            <tr>
              <th >Data source  </th>
              <td><?php echo $ans[0]['Data_source'] ?></td>
            </tr>  

            <tr>
              <th >Database source </th>
              <td><?php echo $ans[0]['Database_source'] ?></td>
            </tr> 

            <tr>
              <th >Sequence </th>
              <td>
                <?php 
                  echo substr($ans[0]['Sequence'],0,$ans[0]['modified_location']-1);?><span style="color:red;"><b><?php 
                  echo substr($ans[0]['Sequence'],$ans[0]['modified_location']-1,1) ?></b></span><?php ;
                  echo substr($ans[0]['Sequence'],$ans[0]['modified_location'],strlen($ans[0]['Sequence'])); 
                ?>
              </td>
            </tr>            
              
          </table>
        </div>
      </div>
    </div>
    <br>

    <?php if (!empty($RBP_Num)) { ?>
      <!--rbp-->
      <div class="panel panel-success" id="collapse_rbp">
        <div class="panel-heading">
          <h4 class="panel-title"><a id="show4" data-toggle="collapse" href="#" style="text-decoration : none">Post-transcriptional regulation <span style="color:#B2584F;">(RNA Binding Protein)</span> involved in: <span style="color:#B2584F;"> <?php  echo $StruRM_ID;?></span></a>
          </h4>
        </div>
        
        <div id="collapse4" class="panel-collapse collapse in">
          <div class="panel-body">
            <table class="table table-hover table-striped" data-pagination="true" data-search="true" data-page-size="5"  data-toggle="table" style="font-size:16.6px">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Experiment</th>
                  <th>Cell Line</th>
                  <th>Study</th>
                  <th>Binding Region</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($rbp_table as $exact_term) : ?>
                <tr>
                  <td class="col-md-1"><?php echo $exact_term['RBP_name'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['experiment'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['cell_line'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['GSE'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['seqnames'].":".$exact_term['start']."-".$exact_term['end']."(".$exact_term['strand'].")" ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>    
    <?php } ?>
    <br>

    <?php if (!empty($miRNA_Num)) { ?>
      <!--rbp-->
      <div class="panel panel-success" id="collapse_rbp">
        <div class="panel-heading">
          <h4 class="panel-title"><a id="show4" data-toggle="collapse" href="#" style="text-decoration : none">Post-transcriptional regulation <span style="color:#B2584F;">(miRNA Targets)</span> involved in: <span style="color:#B2584F;"> <?php  echo $StruRM_ID;?></span></a>
          </h4>
        </div>
        
        <div id="collapse4" class="panel-collapse collapse in">
          <div class="panel-body">
            <table class="table table-hover table-striped" data-pagination="true" data-search="true" data-page-size="5"  data-toggle="table" style="font-size:16.6px">
              <thead>
                <tr>
                  <th>ID </th>
                  <th>Name </th>
                  <th>target RNA type </th>
                  <th>Gene ID </th>
                  <th>Gene Name </th>
                  <th>Gene Type  </th>
                  <th>Clip ExpNum  </th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($mirna_table as $exact_term) : ?>
                <tr>
                  <td class="col-md-1"><?php echo $exact_term['miRNAid'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['miRNAname'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['miRNA_type'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['geneID'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['geneName'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['geneType'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['clipExpNum'] ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>    
    <?php } ?>
    <br>

    <?php if (!empty($SNP_Num)) { ?>
      <!--rbp-->
      <div class="panel panel-success" id="collapse_rbp">
        <div class="panel-heading">
          <h4 class="panel-title"><a id="show4" data-toggle="collapse" href="#" style="text-decoration : none">Post-transcriptional regulation <span style="color:#B2584F;">(SNP)</span> involved in: <span style="color:#B2584F;"> <?php  echo $StruRM_ID;?></span></a>
          </h4>
        </div>
        
        <div id="collapse4" class="panel-collapse collapse in">
          <div class="panel-body">
            <table class="table table-hover table-striped" data-pagination="true" data-search="true" data-page-size="5"  data-toggle="table" style="font-size:16.6px">
              <thead>
                <tr>
                  <th>ID </th>
                  <th>Ref </th>
                  <th>Alt </th>
                  <th>Location </th>
                  <th>Information </th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($snp_table as $exact_term) : ?>
                <tr>
                  <td class="col-md-1"><?php echo $exact_term['rs_ID'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['Ref'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['Alt'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['seqnames'].":".$exact_term['start']."-".$exact_term['end'] ?></td>
                  <td class="col-md-1"><?php echo $exact_term['Info'] ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>    
    <?php } ?>
    <br>

    <div class="figure">
      <div class="panel panel-warning col-md-29" id="plot_before" style="padding:0">
        <div class="panel-heading">
          <h4 class="panel-title"><a id="show2" data-toggle="collapse" href="#" style="text-decoration : none">Secondary Structure <span style="color:#B2584F;">without</span> Modification</a>
          </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse in">
          <div class="panel-body">
            <div>
              <b><i>Predicted RNA Secondary Structure</i></b>
            </div>
            <div>
              <?php 
                echo substr($ans[0]['secondary_structure_before'],0,$ans[0]['modified_location']-1);?><span style="color:red;"><b><?php 
                echo substr($ans[0]['secondary_structure_before'],$ans[0]['modified_location']-1,1) ?></b></span><?php ;
                echo substr($ans[0]['secondary_structure_before'],$ans[0]['modified_location'],strlen($ans[0]['secondary_structure_before'])); 
              ?>
            </div>
            <div><b>Minimum Free Energy&nbsp;:&nbsp;&nbsp;</b><?php echo $ans[0]['MFE'] ?></div>
            <div>
              <?php 
                echo '<img id="img_before" src="http://180.208.58.19/StructRMDB/plot/',$ans[0]['plot_path_before'],'" alt="Secondary Structure before Modification" style="width: 99%" data-toggle="tooltip" data-placement="top" title="Click the image to enlarge, and click again to shrink.">';
              ?>              
            </div>
          </div>
       </div>
      </div>
      <div class="col-md-2"></div>
      <div class="panel panel-warning col-md-29" id="plot_after" style="padding:0">
        <div class="panel-heading">
          <h4 class="panel-title"><a id="show3" data-toggle="collapse" href="#" style="text-decoration : none">Secondary Structure <span style="color:#B2584F;">with</span> Modification</a>
          </h4>
        </div>       
        <div id="collapse3" class="panel-collapse collapse in">
          <div class="panel-body">
          <div>
            <b><i>Predicted RNA Secondary Structure with modification</i></b>
          </div>
          <div>
            <?php 
              echo substr($ans[0]['secondary_structure_after'],0,$ans[0]['modified_location']-1);?><span style="color:red;"><b><?php 
              echo substr($ans[0]['secondary_structure_after'],$ans[0]['modified_location']-1,1) ?></b></span><?php ;
              echo substr($ans[0]['secondary_structure_after'],$ans[0]['modified_location'],strlen($ans[0]['secondary_structure_after'])); 
            ?>
          </div>
          <div><b>Minimum Free Energy&nbsp;:&nbsp;&nbsp;</b><?php echo $ans[0]['MFE_mod'] ?></div>        
          <div>           
            <?php 
              echo '<img id="img_after" src="http://180.208.58.19/StructRMDB/plot/',$ans[0]['plot_path_after'],'" alt="Secondary Structure after Modification" style="width: 99%" data-toggle="tooltip" data-placement="top" title="Click the image to enlarge, and click again to shrink.">';
            ?>
          </div>
       </div>
      </div>     
    </div>
    <br>


	</div>
	</main>
</body>

<footer>
  <br><br><br><br>
  <nav class="navbar navbar-inverse navbar-bottom" style="background-color:#dcd2c6; border:0px">
    <div class="container">
      <div style="text-align:center; font-size:16px; margin-top:20px ">
        <strong>StructRMDB &copy; The Meng Lab (2024). All Rights Reserved</strong>
      </div>
    </div>
  </nav>
</footer>

<script>  
  $('#img_before').click(function () {
    //获取图片路径
    var imgsrc = $("#img_before").attr("src");
    var opacityBottom = '<div class="opacityBottom" style = "display:none"><img class="bigImg" src="http://180.208.58.19/StructRMDB/plot/<?php echo $ans[0]['plot_path_before']; ?>" alt="Secondary Structure before Modification" style="height:100%;">+</div>';
    $(document.body).append(opacityBottom);
    toBigImg();//变大函数
  });
  $('#img_after').click(function () {
    //获取图片路径
    var imgsrc = $("#img_after").attr("src");
    var opacityBottom = '<div class="opacityBottom" style = "display:none"><img class="bigImg" src="http://180.208.58.19/StructRMDB/plot/<?php echo $ans[0]['plot_path_after']; ?>" alt="Secondary Structure after Modification" style="height:100%;">+</div>';
    $(document.body).append(opacityBottom);
    toBigImg();//变大函数
  });
  function toBigImg() {
    $(".opacityBottom").addClass("opacityBottom");//添加遮罩层
    $(".opacityBottom").show();
    $("html,body").addClass("none-scroll");//下层不可滑动
    $(".bigImg").addClass("bigImg");//添加图片样式
    $(".opacityBottom").click(function () {//点击关闭
        $("html,body").removeClass("none-scroll");
        $(".opacityBottom").remove();
    });
  }
</script>

<script>
  //tooltip 鼠标停留显示内容
  $(document).ready(function(){
    $(function () { $('body').tooltip({selector: '[data-toggle="tooltip"]'}); });
  });

  //hide
  $(document).ready( function () {
    <?php if (in_array($species, array("HomoSapiens","MusMusculus","SaccharomycesCerevisiae"))) { ?>
    if(! <?php echo count($rbp_table); ?>){
      $("#collapse_rbp").hide();
      $("#rbp").hide();
    }else{
      $("#rbp2").hide();
    }
    <?php } ?>

    <?php if (in_array($species, array("HomoSapiens","MusMusculus"))) { ?>
    if(! <?php echo count($mirna_table); ?>){
      $("#collapse_mirna").hide();
      $("#mirna").hide();
    }else{
      $("#mirna2").hide();
    }
    <?php } ?>

    <?php if (in_array($species, array("HomoSapiens","MusMusculus"))) { ?>
    if(! <?php echo count($ss); ?>){
      $("#collapse_splicing").hide();
      $("#ss").hide();
    }else{
      $("#ss2").hide();
    }
    <?php } ?>
  });

  $(function(){
    if(<?php echo strlen($ans[0]['Sequence']) ?> < 101){
      $(".mybutton").detach();
    } 
  });   

</script>


</html>