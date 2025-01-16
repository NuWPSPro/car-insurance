<?php $count = 1;
    foreach ($evaluation as $key => $value) {  
        $total5 = 0;
        $total4 = 0;
        $total3 = 0;
        $total2 = 0;
        $total1 = 0;  
        if($value['evaluation_type'] == 1){ 
            
            echo '<p class="question"><b> Q.'.$count.$value['evaluation_question'].'</b></p>';
    $count++;
    $n=0; 
    $fivestar = array();
    $total_reponses = 0;
    for($i=5;$i>$n;$i--){
        $fivestarwhere = array('course_id'=>$cid,'question_id'=>$value['id'],'star_mark'=>$i);
        $fivestar      = $this->user->get_record_by_field_name_all_record11('tbl_course_review',$fivestarwhere);

        if(!empty($fivestar)){
            $FivetotalFiveStar5 = 0;
            $FivetotalFiveStar4 = 0;
            $FivetotalFiveStar3 = 0;
            $FivetotalFiveStar2 = 0;
            $FivetotalFiveStar1 = 0;
            $FivetotalFiveStarPercentage5 = 0;
            $FivetotalFiveStarPercentage4 = 0;
            $FivetotalFiveStarPercentage3 = 0;
            $FivetotalFiveStarPercentage2 = 0;
            $FivetotalFiveStarPercentage1 = 0;
            
            if($i==5){
                    foreach ($fivestar as $value5) {
                        $FivetotalFiveStar5 = $FivetotalFiveStar5 + $value5['star_mark'];
                    }  
                $total5 = count($fivestar); 
                $FivetotalFiveStarPercentage5 = ($FivetotalFiveStar5 * $total5) / 100;
                $Fiveexact5 = ceil($FivetotalFiveStarPercentage5);
                    if($Fiveexact5 <= 10){
                        $FiveexactPercent5 = 10;
                    }
                    $total_reponses += $total5; 
            }

        if($i==4){
                foreach ($fivestar as $value4) {
                    $FivetotalFiveStar4 = $FivetotalFiveStar4 + $value4['star_mark'];
                }   
            $total4 = count($fivestar); 
            $FivetotalFiveStarPercentage4 = $FivetotalFiveStar4 * count($fivestar) / 100;
            $Fiveexact4 = ceil($FivetotalFiveStarPercentage4);
                if($Fiveexact4 <= 10){
                    $FiveexactPercent4 = 10;
                }
                $total_reponses += $total4;
        }


        if($i==3){
            foreach ($fivestar as $value3) {
                $FivetotalFiveStar3 = $FivetotalFiveStar3 + $value3['star_mark'];
            }     
        $total3 = count($fivestar);          

        $FivetotalFiveStarPercentage3 = $FivetotalFiveStar3 * count($fivestar) / 100;
        $Fiveexact3 = ceil($FivetotalFiveStarPercentage3);
            if($Fiveexact3 <= 10){
                $FiveexactPercent3 = 10;
            }
            $total_reponses += $total3;
        }

        if($i==2){
            foreach ($fivestar as $value2) {
                $FivetotalFiveStar2 = $FivetotalFiveStar2 + $value2['star_mark'];
            }     
        $total2 = count($fivestar); 
        $FivetotalFiveStarPercentage2 = $FivetotalFiveStar2 * count($fivestar) / 100;
        $Fiveexact2 = ceil($FivetotalFiveStarPercentage2);
            if($Fiveexact2 <= 10){
                $FiveexactPercent2 = 10;
            }
            $total_reponses += $total2;
        }

        if($i==1){
            foreach ($fivestar as $value1) {
                $FivetotalFiveStar1 = $FivetotalFiveStar1 + $value1['star_mark'];
            }     
        $total1 = count($fivestar); 
        $FivetotalFiveStarPercentage1 = $FivetotalFiveStar1 * count($fivestar) / 100;
        $Fiveexact1 = ceil($FivetotalFiveStarPercentage1);
            if($Fiveexact1 <= 10){
                $FiveexactPercent1 = 10;
            }
            $total_reponses += $total1;
        }

        }
    } 

        if($total5){ $total5 = $total5; }else{ $total5 = 0; } 
        if($total4){ $total4 = $total4; }else{ $total4 = 0; } 
        if($total3){ $total3 = $total3; }else{ $total3 = 0; } 
        if($total2){ $total2 = $total2; }else{ $total2 = 0; } 
        if($total1){ $total1 = $total1; }else{ $total1 = 0; } 

    ?>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Start Rating</th>
                <th></th>
                <th>Numbers</th>
                <th>Total Respondents</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                </td>
                <td>Excellent</td>
                <td> <span><?=$total5;?></span> </td>
                <td> <span><?=$total5;?>/<?=$total_reponses?></span> </td>
            </tr>
            <tr> 
                <td>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                </td>
                <td>Very Good</td>
                <td> <span><?=$total4;?></span> </td>
                <td> <span><?=$total4;?>/<?=$total_reponses?></span> </td>
            </tr>
            <tr>
                <td>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                </td>
                <td>Good</td>
                <td> <span><?=$total3;?></span> </td>
                <td> <span><?=$total3;?>/<?=$total_reponses?></span> </td>
            </tr>
            <tr>
                <td>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                </td>
                <td>Fair</td>
                <td> <span><?=$total2;?></span> </td>
                <td> <span><?=$total2;?>/<?=$total_reponses?></span> </td>
            </tr>
            <tr>
                <td>
                    <span class="rating_img">
                        <img src="<?php echo ASSETS_URL.'images/star.png'; ?>" style="width: 15px;" alt="" class="img-fluid">
                    </span>
                </td>
                <td>Needs Improvement</td>
                <td> <span><?=$total1;?></span> </td>
                <td> <span><?=$total1;?>/<?=$total_reponses?></span> </td>
            </tr>
            <tr>
                <th>Total</th>
                <th></th>
                <th><?=$total_reponses; ?></th>
                <th><?php echo ($total1+$total2+$total3+$total4+$total5).'/'.$total_reponses; ?></th>
            </tr>
        </tbody>
    </table>
	</div>		

	<?php }  }  ?>

 
<?php 
    $count1 = 1;
        foreach ($evaluation as $key => $values) { 
           if($values['evaluation_type'] == 2){   ?>
                <p class="question">
                    <b> Q. <?php echo $count1; ?> <?php  echo $values['evaluation_question']; ?></b>
                </p>
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width:5%; text-align: left;">#</th>
                      <th style="width:95%; text-align: left;">Answers</th>
                    </tr>
                  </thead>
            <?php 
                $count1++;
                $where   = array('course_id'=>$tr_id,'question_id'=>$values['id']);
                $review  = $this->user->getuniqecomments('tbl_course_review',$where);
                $number = 1;
                if(!empty($review)){ 
                    foreach ($review as $key => $val) {
                        if($val['comments'] !=""){ ?>
                <tbody>
                    <tr>
                      <th style="width:5%; text-align: left;"><?=$number;?></th>
                      <td style="width:95%; text-align: left;"><?=$val['comments'];?></td>
                    </tr>
                </tbody>
                <?php   } $number++;
                    }
                }else{ echo '<tbody><tr>
                        <th style="width:5%; text-align: left;">#</th>
                        <td style="width:95%; text-align: left;">N/A</td>
                        </tr></tbody>'; } 
                echo'</table>';
            }  
        } ?>

<style>	p.comments-section {
	    margin-left: 24px;
	}
    
    /* ******************** Aryan ******************** */
    
    span#speaker_name {
        font-size: 20px;
        color: #92278f;
    }
    .rating-box .row {
        margin-right: -15px;
        margin-left: -15px;
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    .rating-box .col-md-2, .rating-box .col-md-6 {
        position: relative;
        min-height: 1px;
        padding-right: 10px;
        padding-left: 10px;
    }
    .rating-box .col-md-2 {
        width: 20%;
    }
    .rating-box .col-md-6 {
        width: 50%;
    }
    p {
        margin: 0 0 15px;
    }
    .rating-box {
        padding: 30px 0;
    }
    .rating-box-content h3 {
        margin: 0 0 20px;
        font-size: 18px;
        font-weight: 600;
        color: #f66258;
    }
    .rating-position {
        text-align: center;
    }
    .rating-box-content p {
        text-align: center;
        font-weight: 600;
        font-size: 20px;
    }
    .rating-box-content ul {
        padding: 0;
        min-height: 210px;
    }
    .rating-box-content ul li {
        list-style: none;
        margin-bottom: 20px;
        /* text-align: right; */
        text-align: left;
    }
    .rating-position ul li {
        text-align: center;
    }
    .rating-box-content ul li span {
        color: #127ce0;
        display: inline-block;
    }
    .rating-box-content ul li .rating_img {
/*        width: 6%;*/
/*        height: 3%;*/
/*        width: 15px;*/
/*        height: 20px;*/
        margin-left: 10px;
        overflow: hidden;
/*        display: inline-block;*/
    }
    .rating-box-content ul li .rating_img:first-child {
        margin-left: 0px;
    }
    .rating-box-content ul li span img {
        width: 100%;
/*        height: 100%;*/
        width: 15px;
/*        height: 20px;*/
    }
    .fa-star:before {
        content: "\f005";
    }
    .fa-star {
        color: #ff7e00;
/*        background: #ff7e00;*/
    }
    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    </style>