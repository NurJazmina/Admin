<?php
include 'model/survey.php';
?>
<style>
   input[type='radio']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #04ada5;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-1">
				<!--begin::Page Heading-->
				<div class="d-flex align-items-baseline flex-wrap mr-5">
					<!--begin::Page Title-->
					<h5 class="text-dark font-weight-bold my-1 mr-5">Survey</h5>
					<!--end::Page Title-->
				</div>
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Detail-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">COLLES (Preffered and Actual)</span>
                </div>
                <!--end::Detail-->
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
            <div class="col-12 col-sm-12 col-sm-12">
                <div class="col-12 col-sm-12 col-lg-12 text-right">
                <div class="row">
          
                </div>
                </div>
            </div>
		</div>
		<!--end::Toolbar-->
	</div>
</div>
<!--end::Subheader-->
<div class="content d-flex flex-column flex-column-fluid">
    <div class="card card-custom gutter-b px-5">
        <div class="card-body">
            <div class="row">
                <form action="#" id="surveyform4" name="surveyform4" method="post">
                    <div>
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="sesskey" value="">
                        <h3 style="color:#04ada5;">COLLES (Preffered and Actual)</h3>
                        <div id="intro" class="box py-3 ">
                            <div class="no-overflow">The purpose of this questionnaire is to help us understand how well the online delivery of this unit enabled you to learn. Each couple of the 24 statements below asks you to compare your <b>preferred</b>(ideal) and <b>actual</b> experience in this unit. There are no 'right' or 'wrong' answers; we are interested only in your opinion. Please be assured that your responses will be treated with a high degree of confidentiality, and will not affect your assessment. Your carefully considered responses will help us improve the way this unit is presented online in the future. Thanks very much.</div>
                        </div>
                        <div class="mb-10">All questions are required and must be answered.</div>
                        <table class="table mt-10">
                            <colgroup colspan="7"></colgroup>
                            <tbody>
                            <h3 style="color:#04ada5;">Relevance</h3>
                                <tr class="bg-secondary" align="center">
                                    <th scope="row"></th>
                                    <th scope="col"><small>Not yet answered</small></th>
                                    <th scope="col"><small>Almost never</small></th>
                                    <th scope="col"><small>Seldom</small></th>
                                    <th scope="col"><small>Sometimes</small></th>
                                    <th scope="col"><small>Often</small></th>
                                    <th scope="col"><small>Almost always</small></th>
                                </tr>
                                <tr>
                                    <th scope="colgroup" colspan="7" style="color:#3F4254">In this online unit...</th>
                                </tr>
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" ><b>1</b> &nbsp; I prefer that   my learning focuses on issues that interest me..</th>
                                <td align="center" class="whitecell"><label for="q1"><input type="radio" name="q1" id="q1_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q1_1"><input type="radio" name="q1" id="q1_1" value="1"></label></td align="center"><td align="center"><label for="q1_2"><input type="radio" name="q1" id="q1_2" value="2"></label></td align="center"><td align="center"><label for="q1_3"><input type="radio" name="q1" id="q1_3" value="3"></label></td align="center"><td align="center"><label for="q1_4"><input type="radio" name="q1" id="q1_4" value="4"></label></td align="center"><td align="center"><label for="q1_5"><input type="radio" name="q1" id="q1_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">2</b> &nbsp; I found that   my learning focuses on issues that interest me.</th>
                                <td align="center" class="whitecell"><label for="q2"><input type="radio" name="q2" id="q2_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q2_1"><input type="radio" name="q2" id="q2_1" value="1"></label></td align="center"><td align="center"><label for="q2_2"><input type="radio" name="q2" id="q2_2" value="2"></label></td align="center"><td align="center"><label for="q2_3"><input type="radio" name="q2" id="q2_3" value="3"></label></td align="center"><td align="center"><label for="q2_4"><input type="radio" name="q2" id="q2_4" value="4"></label></td align="center"><td align="center"><label for="q2_5"><input type="radio" name="q2" id="q2_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">3</b> &nbsp; I prefer that   what I learn is important for my professional practice.</th>
                                <td align="center" class="whitecell"><label for="q3"><input type="radio" name="q3" id="q3_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q3_1"><input type="radio" name="q3" id="q3_1" value="1"></label></td align="center"><td align="center"><label for="q3_2"><input type="radio" name="q3" id="q3_2" value="2"></label></td align="center"><td align="center"><label for="q3_3"><input type="radio" name="q3" id="q3_3" value="3"></label></td align="center"><td align="center"><label for="q47_4"><input type="radio" name="q3" id="q3_4" value="4"></label></td align="center"><td align="center"><label for="q3_5"><input type="radio" name="q3" id="q3_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">4</b> &nbsp; I found that   what I learn is important for my professional practice.</th>
                                <td align="center" class="whitecell"><label for="q4"><input type="radio" name="q4" id="q4_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q4_1"><input type="radio" name="q4" id="q4_1" value="1"></label></td align="center"><td align="center"><label for="q4_2"><input type="radio" name="q4" id="q4_2" value="2"></label></td align="center"><td align="center"><label for="q4_3"><input type="radio" name="q4" id="q4_3" value="3"></label></td align="center"><td align="center"><label for="q4_4"><input type="radio" name="q4" id="q4_4" value="4"></label></td align="center"><td align="center"><label for="q4_5"><input type="radio" name="q48" id="q4_5" value="5"></label></td align="center"></tr>
                            
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" ><b>5</b> &nbsp; I prefer that   I learn how to improve my professional practice.</th>
                                <td align="center" class="whitecell"><label for="q5"><input type="radio" name="q5" id="q5_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q5_1"><input type="radio" name="q5" id="q5_1" value="1"></label></td align="center"><td align="center"><label for="q5_2"><input type="radio" name="q5" id="q5_2" value="2"></label></td align="center"><td align="center"><label for="q5_3"><input type="radio" name="q5" id="q5_3" value="3"></label></td align="center"><td align="center"><label for="q5_4"><input type="radio" name="q5" id="q5_4" value="4"></label></td align="center"><td align="center"><label for="q5_5"><input type="radio" name="q5" id="q5_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">6</b> &nbsp; I found that   I learn how to improve my professional practice.</th>
                                <td align="center" class="whitecell"><label for="q6"><input type="radio" name="q6" id="q6_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q6_1"><input type="radio" name="q6" id="q6_1" value="1"></label></td align="center"><td align="center"><label for="q6_2"><input type="radio" name="q6" id="q6_2" value="2"></label></td align="center"><td align="center"><label for="q6_3"><input type="radio" name="q6" id="q6_3" value="3"></label></td align="center"><td align="center"><label for="q6_4"><input type="radio" name="q6" id="q6_4" value="4"></label></td align="center"><td align="center"><label for="q6_5"><input type="radio" name="q6" id="q6_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">7</b> &nbsp;  I prefer that   what I learn connects well with my professional practice.</th>
                                <td align="center" class="whitecell"><label for="q7"><input type="radio" name="q7" id="q7_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q7_1"><input type="radio" name="q7" id="q7_1" value="1"></label></td align="center"><td align="center"><label for="q7_2"><input type="radio" name="q7" id="q7_2" value="2"></label></td align="center"><td align="center"><label for="q7_3"><input type="radio" name="q7" id="q7_3" value="3"></label></td align="center"><td align="center"><label for="q7_4"><input type="radio" name="q7" id="q7_4" value="4"></label></td align="center"><td align="center"><label for="q7_5"><input type="radio" name="q7" id="q7_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">8</b> &nbsp; I found that   what I learn connects well with my professional practice.</th>
                                <td align="center" class="whitecell"><label for="q8"><input type="radio" name="q8" id="q8_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q8_1"><input type="radio" name="q8" id="q8_1" value="1"></label></td align="center"><td align="center"><label for="q8_2"><input type="radio" name="q8" id="q8_2" value="2"></label></td align="center"><td align="center"><label for="q8_3"><input type="radio" name="q8" id="q8_3" value="3"></label></td align="center"><td align="center"><label for="q8_4"><input type="radio" name="q8" id="q8_4" value="4"></label></td align="center"><td align="center"><label for="q8_5"><input type="radio" name="q8" id="q8_5" value="5"></label></td align="center"></tr>
                            </tbody>
                        </table><br>
                        <table class="table mt-10">
                            <colgroup colspan="7"></colgroup>
                            <tbody>
                            <h3 style="color:#04ada5;">Reflective Thinking</h3>
                                <tr class="bg-secondary" align="center">
                                    <th scope="row"></th>
                                    <th scope="col"><small>Not yet answered</small></th>
                                    <th scope="col"><small>Almost never</small></th>
                                    <th scope="col"><small>Seldom</small></th>
                                    <th scope="col"><small>Sometimes</small></th>
                                    <th scope="col"><small>Often</small></th>
                                    <th scope="col"><small>Almost always</small></th>
                                </tr>
                                <tr>
                                    <th scope="colgroup" colspan="7" style="color:#3F4254">In this online unit...</th>
                                </tr>
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3"><b>9</b> &nbsp; I prefer that   I think critically about how I learn.</th>
                                <td align="center" class="whitecell"><label for="q9"><input type="radio" name="q9" id="q9_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q9_1"><input type="radio" name="q9" id="q9_1" value="1"></label></td align="center"><td align="center"><label for="q9_2"><input type="radio" name="q9" id="q9_2" value="2"></label></td align="center"><td align="center"><label for="q9_3"><input type="radio" name="q9" id="q9_3" value="3"></label></td align="center"><td align="center"><label for="q9_4"><input type="radio" name="q9" id="q9_4" value="4"></label></td align="center"><td align="center"><label for="q9_5"><input type="radio" name="q9" id="q9_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">10</b> &nbsp; I found that   I think critically about how I learn.</th>
                                <td align="center" class="whitecell"><label for="q10"><input type="radio" name="q10" id="q10_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q10_1"><input type="radio" name="q10" id="q10_1" value="1"></label></td align="center"><td align="center"><label for="q10_2"><input type="radio" name="q10" id="q10_2" value="2"></label></td align="center"><td align="center"><label for="q10_3"><input type="radio" name="q10" id="q10_3" value="3"></label></td align="center"><td align="center"><label for="q10_4"><input type="radio" name="q10" id="q10_4" value="4"></label></td align="center"><td align="center"><label for="q10_5"><input type="radio" name="q10" id="q10_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">11</b> &nbsp; I prefer that   I think critically about my own ideas.</th>
                                <td align="center" class="whitecell"><label for="q11"><input type="radio" name="q11" id="q11_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q11_1"><input type="radio" name="q11" id="q11_1" value="1"></label></td align="center"><td align="center"><label for="q11_2"><input type="radio" name="q11" id="q11_2" value="2"></label></td align="center"><td align="center"><label for="q11_3"><input type="radio" name="q11" id="q11_3" value="3"></label></td align="center"><td align="center"><label for="q11_4"><input type="radio" name="q11" id="q11_4" value="4"></label></td align="center"><td align="center"><label for="q11_5"><input type="radio" name="q11" id="q11_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">12</b> &nbsp;  I found that   I think critically about my own ideas.</th>
                                <td align="center" class="whitecell"><label for="q12"><input type="radio" name="q12" id="q12_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q12_1"><input type="radio" name="q12" id="q12_1" value="1"></label></td align="center"><td align="center"><label for="q12_2"><input type="radio" name="q12" id="q12_2" value="2"></label></td align="center"><td align="center"><label for="q12_3"><input type="radio" name="q12" id="q12_3" value="3"></label></td align="center"><td align="center"><label for="q12_4"><input type="radio" name="q12" id="q12_4" value="4"></label></td align="center"><td align="center"><label for="q12_5"><input type="radio" name="q12" id="q12_5" value="5"></label></td align="center"></tr>

                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3"><b>13</b> &nbsp; I prefer that   I think critically about other students' ideas.	</th>
                                <td align="center" class="whitecell"><label for="q13"><input type="radio" name="q13" id="q13_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q13_1"><input type="radio" name="q13" id="q13_1" value="1"></label></td align="center"><td align="center"><label for="q13_2"><input type="radio" name="q13" id="q13_2" value="2"></label></td align="center"><td align="center"><label for="q13_3"><input type="radio" name="q13" id="q13_3" value="3"></label></td align="center"><td align="center"><label for="q13_4"><input type="radio" name="q13" id="q13_4" value="4"></label></td align="center"><td align="center"><label for="q13_5"><input type="radio" name="q13" id="q13_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">14</b> &nbsp; I found that   I think critically about other students' ideas.</th>
                                <td align="center" class="whitecell"><label for="q14"><input type="radio" name="q14" id="q14_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q14_1"><input type="radio" name="q14" id="q14_1" value="1"></label></td align="center"><td align="center"><label for="q14_2"><input type="radio" name="q14" id="q14_2" value="2"></label></td align="center"><td align="center"><label for="q14_3"><input type="radio" name="q14" id="q14_3" value="3"></label></td align="center"><td align="center"><label for="q14_4"><input type="radio" name="q14" id="q14_4" value="4"></label></td align="center"><td align="center"><label for="q14_5"><input type="radio" name="q14" id="q14_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">15</b> &nbsp; I prefer that   I think critically about ideas in the readings.</th>
                                <td align="center" class="whitecell"><label for="q15"><input type="radio" name="q15" id="q15_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q15_1"><input type="radio" name="q15" id="q15_1" value="1"></label></td align="center"><td align="center"><label for="q15_2"><input type="radio" name="q15" id="q15_2" value="2"></label></td align="center"><td align="center"><label for="q15_3"><input type="radio" name="q15" id="q15_3" value="3"></label></td align="center"><td align="center"><label for="q15_4"><input type="radio" name="q15" id="q15_4" value="4"></label></td align="center"><td align="center"><label for="q15_5"><input type="radio" name="q15" id="q15_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">16</b> &nbsp; I found that   I think critically about ideas in the readings.</th>
                                <td align="center" class="whitecell"><label for="q16"><input type="radio" name="q16" id="q16_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q16_1"><input type="radio" name="q16" id="q16_1" value="1"></label></td align="center"><td align="center"><label for="q16_2"><input type="radio" name="q16" id="q16_2" value="2"></label></td align="center"><td align="center"><label for="q16_3"><input type="radio" name="q16" id="q16_3" value="3"></label></td align="center"><td align="center"><label for="q16_4"><input type="radio" name="q16" id="q16_4" value="4"></label></td align="center"><td align="center"><label for="q16_5"><input type="radio" name="q16" id="q16_5" value="5"></label></td align="center"></tr>
                            </tbody>
                        </table><br>
                        <table class="table mt-10">
                            <colgroup colspan="7"></colgroup>
                            <tbody>
                            <h3 style="color:#04ada5;">Interactivity</h3>
                                <tr class="bg-secondary" align="center">
                                    <th scope="row"></th>
                                    <th scope="col"><small>Not yet answered</small></th>
                                    <th scope="col"><small>Almost never</small></th>
                                    <th scope="col"><small>Seldom</small></th>
                                    <th scope="col"><small>Sometimes</small></th>
                                    <th scope="col"><small>Often</small></th>
                                    <th scope="col"><small>Almost always</small></th>
                                </tr>
                                <tr>
                                    <th scope="colgroup" colspan="7" style="color:#3F4254">In this online unit...</th>
                                </tr>
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3"><b>17</b> &nbsp;  I prefer that   I explain my ideas to other students.</th>
                                <td align="center" class="whitecell"><label for="q17"><input type="radio" name="q17" id="q17_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q17_1"><input type="radio" name="q17" id="q17_1" value="1"></label></td align="center"><td align="center"><label for="q17_2"><input type="radio" name="q45" id="q17_2" value="2"></label></td align="center"><td align="center"><label for="q17_3"><input type="radio" name="q45" id="q45_3" value="3"></label></td align="center"><td align="center"><label for="q45_4"><input type="radio" name="q17" id="q17_4" value="4"></label></td align="center"><td align="center"><label for="q17_5"><input type="radio" name="q17" id="q17_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">18</b> &nbsp; I found that   I explain my ideas to other students.</th>
                                <td align="center" class="whitecell"><label for="q18"><input type="radio" name="q18" id="q18_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q18_1"><input type="radio" name="q18" id="q18_1" value="1"></label></td align="center"><td align="center"><label for="q18_2"><input type="radio" name="q18" id="q18_2" value="2"></label></td align="center"><td align="center"><label for="q18_3"><input type="radio" name="q18" id="q18_3" value="3"></label></td align="center"><td align="center"><label for="q18_4"><input type="radio" name="q18" id="q18_4" value="4"></label></td align="center"><td align="center"><label for="q18_5"><input type="radio" name="q18" id="q18_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">19</b> &nbsp;  I prefer that   I ask other students to explain their ideas.</th>
                                <td align="center" class="whitecell"><label for="q19"><input type="radio" name="q19" id="q19_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q19_1"><input type="radio" name="q19" id="q19_1" value="1"></label></td align="center"><td align="center"><label for="q19_2"><input type="radio" name="q19" id="q19_2" value="2"></label></td align="center"><td align="center"><label for="q19_3"><input type="radio" name="q47" id="q19_3" value="3"></label></td align="center"><td align="center"><label for="q19_4"><input type="radio" name="q19" id="q19_4" value="4"></label></td align="center"><td align="center"><label for="q19_5"><input type="radio" name="q19" id="q19_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">20</b> &nbsp; I found that   I ask other students to explain their ideas.</th>
                                <td align="center" class="whitecell"><label for="q20"><input type="radio" name="q20" id="q20_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q20_1"><input type="radio" name="q20" id="q20_1" value="1"></label></td align="center"><td align="center"><label for="q20_2"><input type="radio" name="q20" id="q20_2" value="2"></label></td align="center"><td align="center"><label for="q20_3"><input type="radio" name="q20" id="q20_3" value="3"></label></td align="center"><td align="center"><label for="q20_4"><input type="radio" name="q20" id="q20_4" value="4"></label></td align="center"><td align="center"><label for="q20_5"><input type="radio" name="q20" id="q20_5" value="5"></label></td align="center"></tr>

                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">21</b> &nbsp; I prefer that   other students ask me to explain my ideas.</th>
                                <td align="center" class="whitecell"><label for="q21"><input type="radio" name="q21" id="q21_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q21_1"><input type="radio" name="q21" id="q21_1" value="1"></label></td align="center"><td align="center"><label for="q21_2"><input type="radio" name="q21" id="q21_2" value="2"></label></td align="center"><td align="center"><label for="q21_3"><input type="radio" name="q21" id="q21_3" value="3"></label></td align="center"><td align="center"><label for="q21_4"><input type="radio" name="q21" id="q21_4" value="4"></label></td align="center"><td align="center"><label for="q21_5"><input type="radio" name="q21" id="q21_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">22</b> &nbsp;  I found that   other students ask me to explain my ideas.</th>
                                <td align="center" class="whitecell"><label for="q22"><input type="radio" name="q22" id="q22_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q22_1"><input type="radio" name="q22" id="q22_1" value="1"></label></td align="center"><td align="center"><label for="q22_2"><input type="radio" name="q22" id="q22_2" value="2"></label></td align="center"><td align="center"><label for="q46_3"><input type="radio" name="q46" id="q46_3" value="3"></label></td align="center"><td align="center"><label for="q46_4"><input type="radio" name="q46" id="q46_4" value="4"></label></td align="center"><td align="center"><label for="q46_5"><input type="radio" name="q22" id="q22_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">23</b> &nbsp; I prefer that   other students respond to my ideas.</th>
                                <td align="center" class="whitecell"><label for="q23"><input type="radio" name="q23" id="q23_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q23_1"><input type="radio" name="q23" id="q23_1" value="1"></label></td align="center"><td align="center"><label for="q23_2"><input type="radio" name="q23" id="q23_2" value="2"></label></td align="center"><td align="center"><label for="q23_3"><input type="radio" name="q23" id="q23_3" value="3"></label></td align="center"><td align="center"><label for="q23_4"><input type="radio" name="q23" id="q23_4" value="4"></label></td align="center"><td align="center"><label for="q23_5"><input type="radio" name="q23" id="q23_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">24</b> &nbsp; I found that   other students respond to my ideas.</th>
                                <td align="center" class="whitecell"><label for="q24"><input type="radio" name="q24" id="q24_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q24_1"><input type="radio" name="q24" id="q24_1" value="1"></label></td align="center"><td align="center"><label for="q24_2"><input type="radio" name="q24" id="q24_2" value="2"></label></td align="center"><td align="center"><label for="q24_3"><input type="radio" name="q24" id="q24_3" value="3"></label></td align="center"><td align="center"><label for="q24_4"><input type="radio" name="q24" id="q24_4" value="4"></label></td align="center"><td align="center"><label for="q24_5"><input type="radio" name="q24" id="q24_5" value="5"></label></td align="center"></tr>
                            </tbody>
                        </table><br>
                        <table class="table mt-10">
                            <colgroup colspan="7"></colgroup>
                            <tbody>
                            <h3 style="color:#04ada5;">Tutor Support</h3>
                                <tr class="bg-secondary" align="center">
                                    <th scope="row"></th>
                                    <th scope="col"><small>Not yet answered</small></th>
                                    <th scope="col"><small>Almost never</small></th>
                                    <th scope="col"><small>Seldom</small></th>
                                    <th scope="col"><small>Sometimes</small></th>
                                    <th scope="col"><small>Often</small></th>
                                    <th scope="col"><small>Almost always</small></th>
                                </tr>
                                <tr>
                                    <th scope="colgroup" colspan="7" style="color:#3F4254">In this online unit...</th>
                                </tr>
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" ><b>25</b> &nbsp;I prefer that   the tutor stimulates my thinking.</th>
                                <td align="center" class="whitecell"><label for="q25"><input type="radio" name="q25" id="q25_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q25_1"><input type="radio" name="q25" id="q25_1" value="1"></label></td align="center"><td align="center"><label for="q25_2"><input type="radio" name="q25" id="q25_2" value="2"></label></td align="center"><td align="center"><label for="q25_3"><input type="radio" name="q25" id="q25_3" value="3"></label></td align="center"><td align="center"><label for="q25_4"><input type="radio" name="q25" id="q25_4" value="4"></label></td align="center"><td align="center"><label for="q25_5"><input type="radio" name="q25" id="q25_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">26</b> &nbsp;  I found that   the tutor stimulates my thinking.</th>
                                <td align="center" class="whitecell"><label for="q26"><input type="radio" name="q26" id="q26_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q26_1"><input type="radio" name="q26" id="q26_1" value="1"></label></td align="center"><td align="center"><label for="q26_2"><input type="radio" name="q26" id="q6_2" value="2"></label></td align="center"><td align="center"><label for="q26_3"><input type="radio" name="q26" id="q26_3" value="3"></label></td align="center"><td align="center"><label for="q26_4"><input type="radio" name="q26" id="q26_4" value="4"></label></td align="center"><td align="center"><label for="q26_5"><input type="radio" name="q26" id="q26_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">27</b> &nbsp;  I prefer that   the tutor encourages me to participate.</th>
                                <td align="center" class="whitecell"><label for="q27"><input type="radio" name="q27" id="q27_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q27_1"><input type="radio" name="q27" id="q27_1" value="1"></label></td align="center"><td align="center"><label for="q27_2"><input type="radio" name="q27" id="q27_2" value="2"></label></td align="center"><td align="center"><label for="q27_3"><input type="radio" name="q27" id="q27_3" value="3"></label></td align="center"><td align="center"><label for="q27_4"><input type="radio" name="q27" id="q27_4" value="4"></label></td align="center"><td align="center"><label for="q27_5"><input type="radio" name="q27" id="q27_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">28</b> &nbsp; I found that   the tutor encourages me to participate.</th>
                                <td align="center" class="whitecell"><label for="q28"><input type="radio" name="q28" id="q28_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q28_1"><input type="radio" name="q28" id="q28_1" value="1"></label></td align="center"><td align="center"><label for="q28_2"><input type="radio" name="q28" id="q28_2" value="2"></label></td align="center"><td align="center"><label for="q28_3"><input type="radio" name="q28" id="q28_3" value="3"></label></td align="center"><td align="center"><label for="q28_4"><input type="radio" name="q28" id="q28_4" value="4"></label></td align="center"><td align="center"><label for="q28_5"><input type="radio" name="q28" id="q28_5" value="5"></label></td align="center"></tr>

                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3"><b>29</b> &nbsp;  I prefer that   the tutor models good discourse.</th>
                                <td align="center" class="whitecell"><label for="q29"><input type="radio" name="q29" id="q29_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q29_1"><input type="radio" name="q29" id="q29_1" value="1"></label></td align="center"><td align="center"><label for="q29_2"><input type="radio" name="q29" id="q29_2" value="2"></label></td align="center"><td align="center"><label for="q29_3"><input type="radio" name="q29" id="q29_3" value="3"></label></td align="center"><td align="center"><label for="q29_4"><input type="radio" name="q29" id="q29_4" value="4"></label></td align="center"><td align="center"><label for="q29_5"><input type="radio" name="q29" id="q29_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">30</b> &nbsp;  I found that   the tutor models good discourse.</th>
                                <td align="center" class="whitecell"><label for="q30"><input type="radio" name="q10" id="q30_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q30_1"><input type="radio" name="q30" id="q30_1" value="1"></label></td align="center"><td align="center"><label for="q30_2"><input type="radio" name="q30" id="q30_2" value="2"></label></td align="center"><td align="center"><label for="q30_3"><input type="radio" name="q30" id="q30_3" value="3"></label></td align="center"><td align="center"><label for="q30_4"><input type="radio" name="q30" id="q30_4" value="4"></label></td align="center"><td align="center"><label for="q30_5"><input type="radio" name="q30" id="q30_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">31</b> &nbsp; I prefer that   the tutor models critical self-reflection.</th>
                                <td align="center" class="whitecell"><label for="q31"><input type="radio" name="q31" id="q31_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q31_1"><input type="radio" name="q31" id="q31_1" value="1"></label></td align="center"><td align="center"><label for="q31_2"><input type="radio" name="q31" id="q31_2" value="2"></label></td align="center"><td align="center"><label for="q31_3"><input type="radio" name="q31" id="q31_3" value="3"></label></td align="center"><td align="center"><label for="q31_4"><input type="radio" name="q31" id="q31_4" value="4"></label></td align="center"><td align="center"><label for="q31_5"><input type="radio" name="q31" id="q31_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">32</b> &nbsp;  I found that   the tutor models critical self-reflection.</th>
                                <td align="center" class="whitecell"><label for="q32"><input type="radio" name="q32" id="q32_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q32_1"><input type="radio" name="q32" id="q32_1" value="1"></label></td align="center"><td align="center"><label for="q32_2"><input type="radio" name="q32" id="q32_2" value="2"></label></td align="center"><td align="center"><label for="q32_3"><input type="radio" name="q32" id="q32_3" value="3"></label></td align="center"><td align="center"><label for="q32_4"><input type="radio" name="q32" id="q32_4" value="4"></label></td align="center"><td align="center"><label for="q12_5"><input type="radio" name="q32" id="q32_5" value="5"></label></td align="center"></tr>

                            </tbody>
                        </table><br>
                        <table class="table mt-10">
                            <colgroup colspan="7"></colgroup>
                            <tbody>
                            <h3 style="color:#04ada5;">Peer Support</h3>
                                <tr class="bg-secondary" align="center">
                                    <th scope="row"></th>
                                    <th scope="col"><small>Not yet answered</small></th>
                                    <th scope="col"><small>Almost never</small></th>
                                    <th scope="col"><small>Seldom</small></th>
                                    <th scope="col"><small>Sometimes</small></th>
                                    <th scope="col"><small>Often</small></th>
                                    <th scope="col"><small>Almost always</small></th>
                                </tr>
                                <tr>
                                    <th scope="colgroup" colspan="7" style="color:#3F4254">In this online unit...</th>
                                </tr>

                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" ><b>33</b> &nbsp; I prefer that   other students encourage my participation.</th>
                                <td align="center" class="whitecell"><label for="q33"><input type="radio" name="q33" id="q33_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q33_1"><input type="radio" name="q33" id="q33_1" value="1"></label></td align="center"><td align="center"><label for="q33_2"><input type="radio" name="q33" id="q33_2" value="2"></label></td align="center"><td align="center"><label for="q33_3"><input type="radio" name="q33" id="q33_3" value="3"></label></td align="center"><td align="center"><label for="q33_4"><input type="radio" name="q33" id="q33_4" value="4"></label></td align="center"><td align="center"><label for="q33_5"><input type="radio" name="q33" id="q33_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">34</b> &nbsp; I found that   other students encourage my participation.</th>
                                <td align="center" class="whitecell"><label for="q34"><input type="radio" name="q34" id="q34_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q34_1"><input type="radio" name="q34" id="q34_1" value="1"></label></td align="center"><td align="center"><label for="q34_2"><input type="radio" name="q34" id="q34_2" value="2"></label></td align="center"><td align="center"><label for="q34_3"><input type="radio" name="q34" id="q34_3" value="3"></label></td align="center"><td align="center"><label for="q34_4"><input type="radio" name="q34" id="q34_4" value="4"></label></td align="center"><td align="center"><label for="q34_5"><input type="radio" name="q34" id="q34_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">35</b> &nbsp;  I prefer that   other students praise my contribution.</th>
                                <td align="center" class="whitecell"><label for="q35"><input type="radio" name="q35" id="q35_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q35_1"><input type="radio" name="q35" id="q35_1" value="1"></label></td align="center"><td align="center"><label for="q35_2"><input type="radio" name="q35" id="q35_2" value="2"></label></td align="center"><td align="center"><label for="q35_3"><input type="radio" name="q35" id="q35_3" value="3"></label></td align="center"><td align="center"><label for="q35_4"><input type="radio" name="q35" id="q35_4" value="4"></label></td align="center"><td align="center"><label for="q35_5"><input type="radio" name="q35" id="q35_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">36</b> &nbsp; I found that   other students praise my contribution.</th>
                                <td align="center" class="whitecell"><label for="q36"><input type="radio" name="q36" id="q36_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q36_1"><input type="radio" name="q36" id="q36_1" value="1"></label></td align="center"><td align="center"><label for="q36_2"><input type="radio" name="q36" id="q36_2" value="2"></label></td align="center"><td align="center"><label for="q36_3"><input type="radio" name="q36" id="q36_3" value="3"></label></td align="center"><td align="center"><label for="q36_4"><input type="radio" name="q36" id="q36_4" value="4"></label></td align="center"><td align="center"><label for="q36_5"><input type="radio" name="q36" id="q36_5" value="5"></label></td align="center"></tr>

                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3"><b>37</b> &nbsp;  I prefer that   other students value my contribution.</th>
                                <td align="center" class="whitecell"><label for="q37"><input type="radio" name="q37" id="q37_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q37_1"><input type="radio" name="q37" id="q37_1" value="1"></label></td align="center"><td align="center"><label for="q37_2"><input type="radio" name="q37" id="q37_2" value="2"></label></td align="center"><td align="center"><label for="q37_3"><input type="radio" name="q37" id="q37_3" value="3"></label></td align="center"><td align="center"><label for="q37_4"><input type="radio" name="q37" id="q37_4" value="4"></label></td align="center"><td align="center"><label for="q37_5"><input type="radio" name="q37" id="q37_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">38</b> &nbsp;   I found that   other students value my contribution.</th>
                                <td align="center" class="whitecell"><label for="q38"><input type="radio" name="q38" id="q38_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q38_1"><input type="radio" name="q38" id="q38_1" value="1"></label></td align="center"><td align="center"><label for="q38_2"><input type="radio" name="q38" id="q38_2" value="2"></label></td align="center"><td align="center"><label for="q38_3"><input type="radio" name="q38" id="q38_3" value="3"></label></td align="center"><td align="center"><label for="q38_4"><input type="radio" name="q38" id="q38_4" value="4"></label></td align="center"><td align="center"><label for="q38_5"><input type="radio" name="q38" id="q38_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">39</b> &nbsp; I prefer that   other students empathise with my struggle to learn.</th>
                                <td align="center" class="whitecell"><label for="q39"><input type="radio" name="q39" id="q39_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q39_1"><input type="radio" name="q39" id="q39_1" value="1"></label></td align="center"><td align="center"><label for="q39_2"><input type="radio" name="q39" id="q39_2" value="2"></label></td align="center"><td align="center"><label for="q39_3"><input type="radio" name="q39" id="q39_3" value="3"></label></td align="center"><td align="center"><label for="q39_4"><input type="radio" name="q39" id="q39_4" value="4"></label></td align="center"><td align="center"><label for="q39_5"><input type="radio" name="q39" id="q39_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">40</b> &nbsp;  I found that   other students empathise with my struggle to learn.</th>
                                <td align="center" class="whitecell"><label for="q40"><input type="radio" name="q40" id="q40_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q40_1"><input type="radio" name="q40" id="q40_1" value="1"></label></td align="center"><td align="center"><label for="q40_2"><input type="radio" name="q40" id="q40_2" value="2"></label></td align="center"><td align="center"><label for="q40_3"><input type="radio" name="q40" id="q40_3" value="3"></label></td align="center"><td align="center"><label for="q40_4"><input type="radio" name="q40" id="q40_4" value="4"></label></td align="center"><td align="center"><label for="q40_5"><input type="radio" name="q40" id="q40_5" value="5"></label></td align="center"></tr>

                            </tbody>
                        </table><br>
                        <table class="table mt-10">
                            <colgroup colspan="7"></colgroup>
                            <tbody>
                            <h3 style="color:#04ada5;">Interpretation</h3>
                                <tr class="bg-secondary" align="center">
                                    <th scope="row"></th>
                                    <th scope="col"><small>Not yet answered</small></th>
                                    <th scope="col"><small>Almost never</small></th>
                                    <th scope="col"><small>Seldom</small></th>
                                    <th scope="col"><small>Sometimes</small></th>
                                    <th scope="col"><small>Often</small></th>
                                    <th scope="col"><small>Almost always</small></th>
                                </tr>
                                <tr>
                                    <th scope="colgroup" colspan="7" style="color:#3F4254">In this online unit...</th>
                                </tr>

                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" ><b>41</b> &nbsp; I prefer that   I make good sense of other students' messages.</th>
                                <td align="center" class="whitecell"><label for="q41"><input type="radio" name="q41" id="q41_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q41_1"><input type="radio" name="q41" id="q41_1" value="1"></label></td align="center"><td align="center"><label for="q41_2"><input type="radio" name="q41" id="q41_2" value="2"></label></td align="center"><td align="center"><label for="q41_3"><input type="radio" name="q41" id="q41_3" value="3"></label></td align="center"><td align="center"><label for="q1_4"><input type="radio" name="q1" id="q1_4" value="4"></label></td align="center"><td align="center"><label for="q41_5"><input type="radio" name="q41" id="q41_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">42</b> &nbsp; I found that   I make good sense of other students' messages.</th>
                                <td align="center" class="whitecell"><label for="q42"><input type="radio" name="q42" id="q42_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q42_1"><input type="radio" name="q42" id="q42_1" value="1"></label></td align="center"><td align="center"><label for="q42_2"><input type="radio" name="q42" id="q42_2" value="2"></label></td align="center"><td align="center"><label for="q42_3"><input type="radio" name="q42" id="q42_3" value="3"></label></td align="center"><td align="center"><label for="q2_4"><input type="radio" name="q2" id="q2_4" value="4"></label></td align="center"><td align="center"><label for="q42_5"><input type="radio" name="q42" id="q42_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">43</b> &nbsp; I prefer that   other students make good sense of my messages.</th>
                                <td align="center" class="whitecell"><label for="q43"><input type="radio" name="q43" id="q43_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q43_1"><input type="radio" name="q43" id="q3_1" value="1"></label></td align="center"><td align="center"><label for="q43_2"><input type="radio" name="q43" id="q43_2" value="2"></label></td align="center"><td align="center"><label for="q43_3"><input type="radio" name="q43" id="q43_3" value="3"></label></td align="center"><td align="center"><label for="q47_4"><input type="radio" name="q3" id="q3_4" value="4"></label></td align="center"><td align="center"><label for="q43_5"><input type="radio" name="q43" id="q43_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">44</b> &nbsp; I found that   other students make good sense of my messages.</th>
                                <td align="center" class="whitecell"><label for="q44"><input type="radio" name="q44" id="q44_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q44_1"><input type="radio" name="q44" id="q44_1" value="1"></label></td align="center"><td align="center"><label for="q44_2"><input type="radio" name="q44" id="q44_2" value="2"></label></td align="center"><td align="center"><label for="q44_3"><input type="radio" name="q44" id="q4_3" value="3"></label></td align="center"><td align="center"><label for="q4_4"><input type="radio" name="q4" id="q4_4" value="4"></label></td align="center"><td align="center"><label for="q44_5"><input type="radio" name="q48" id="q44_5" value="5"></label></td align="center"></tr>
                            
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" ><b>5</b> &nbsp;  I prefer that   I make good sense of the tutor's messages.</th>
                                <td align="center" class="whitecell"><label for="q45"><input type="radio" name="q45" id="q45_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q45_1"><input type="radio" name="q45" id="q45_1" value="1"></label></td align="center"><td align="center"><label for="q45_2"><input type="radio" name="q45" id="q45_2" value="2"></label></td align="center"><td align="center"><label for="q45_3"><input type="radio" name="q45" id="q45_3" value="3"></label></td align="center"><td align="center"><label for="q5_4"><input type="radio" name="q5" id="q5_4" value="4"></label></td align="center"><td align="center"><label for="q45_5"><input type="radio" name="q45" id="q45_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">46</b> &nbsp; I found that   I make good sense of the tutor's messages.</th>
                                <td align="center" class="whitecell"><label for="q46"><input type="radio" name="q46" id="q46_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q46_1"><input type="radio" name="q46" id="q46_1" value="1"></label></td align="center"><td align="center"><label for="q46_2"><input type="radio" name="q6" id="q46_2" value="2"></label></td align="center"><td align="center"><label for="q46_3"><input type="radio" name="q46" id="q46_3" value="3"></label></td align="center"><td align="center"><label for="q6_4"><input type="radio" name="q6" id="q6_4" value="4"></label></td align="center"><td align="center"><label for="q46_5"><input type="radio" name="q46" id="q46_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">47</b> &nbsp;  I prefer that   the tutor makes good sense of my messages.</th>
                                <td align="center" class="whitecell"><label for="q47"><input type="radio" name="q47" id="q47_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q47_1"><input type="radio" name="q47" id="q47_1" value="1"></label></td align="center"><td align="center"><label for="q47_2"><input type="radio" name="q47" id="q47_2" value="2"></label></td align="center"><td align="center"><label for="q47_3"><input type="radio" name="q47" id="q47_3" value="3"></label></td align="center"><td align="center"><label for="q7_4"><input type="radio" name="q7" id="q7_4" value="4"></label></td align="center"><td align="center"><label for="q47_5"><input type="radio" name="q47" id="q47_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">48</b> &nbsp; I found that   the tutor makes good sense of my messages.</th>
                                <td align="center" class="whitecell"><label for="q48"><input type="radio" name="q48" id="q48_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q48_1"><input type="radio" name="q48" id="q48_1" value="1"></label></td align="center"><td align="center"><label for="q48_2"><input type="radio" name="q48" id="q48_2" value="2"></label></td align="center"><td align="center"><label for="q48_3"><input type="radio" name="q48" id="q48_3" value="3"></label></td align="center"><td align="center"><label for="q8_4"><input type="radio" name="q8" id="q8_4" value="4"></label></td align="center"><td align="center"><label for="q48_5"><input type="radio" name="q48" id="q48_5" value="5"></label></td align="center"></tr>
                            </tbody>
                        </div>
                        </table>
                        <table class="table mt-5">
                            <tbody>
                                <tr>
                                    <th scope="row" class="w-50 p-3"><b>49</b> &nbsp; How long did this survey take you to complete?</th>
                                    <td align="left" class="whitecell">
                                    <div class="col-sm-9">
                                        <select class="form-control" id="q49" name="q49">
                                            <option value="1">under 1 min</option>
                                            <option value="2">1-2 min</option>
                                            <option value="3">2-3 min</option>
                                            <option value="4">3-4 min</option>
                                            <option value="5">4-5-min</option>
                                            <option value="6">5-10 min</option>
                                            <option value="7">more than 10</option>
                                        </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="w-50 p-3"><b>50</b> &nbsp; Do you have any other comments?</th>
                                    <td align="left" class="whitecell">
                                    <div class="col-sm-2">
                                        <textarea class="survey2" name="q50"></textarea>
                                        </div>
                                    </td>
                                </tr>
                            </div>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success" name="surveyform4">Click here to continue</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
//custom tinymce
tinymce.init({
  selector: '.survey2',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:50,
  width:500,
});
</script>