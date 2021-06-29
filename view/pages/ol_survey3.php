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
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">COLLES (Prefer)</span>
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
                        <h3 style="color:#04ada5;">COLLES (Prefer)</h3>
                        <div id="intro" class="box py-3 ">
                            <div class="no-overflow">The purpose of this survey is to help us understand what you value in an online learning experience. Each one of the 24 statements below asks about your preferred (ideal) experience in this unit. There are no 'right' or 'wrong' answers; we are interested only in your opinion. Please be assured that your responses will be treated with a high degree of confidentiality, and will not affect your assessment. Your carefully considered responses will help us improve the way this unit is presented online in the future. Thanks very much.</div>
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
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" ><b>1</b> &nbsp; my learning focuses on issues that interest me.</th>
                                <td align="center" class="whitecell"><label for="q1"><input type="radio" name="q1" id="q1_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q1_1"><input type="radio" name="q1" id="q1_1" value="1"></label></td align="center"><td align="center"><label for="q1_2"><input type="radio" name="q1" id="q1_2" value="2"></label></td align="center"><td align="center"><label for="q1_3"><input type="radio" name="q1" id="q1_3" value="3"></label></td align="center"><td align="center"><label for="q1_4"><input type="radio" name="q1" id="q1_4" value="4"></label></td align="center"><td align="center"><label for="q1_5"><input type="radio" name="q1" id="q1_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">2</b> &nbsp; what I learn is important for my professional practice.</th>
                                <td align="center" class="whitecell"><label for="q2"><input type="radio" name="q2" id="q2_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q2_1"><input type="radio" name="q2" id="q2_1" value="1"></label></td align="center"><td align="center"><label for="q2_2"><input type="radio" name="q2" id="q2_2" value="2"></label></td align="center"><td align="center"><label for="q2_3"><input type="radio" name="q2" id="q2_3" value="3"></label></td align="center"><td align="center"><label for="q2_4"><input type="radio" name="q2" id="q2_4" value="4"></label></td align="center"><td align="center"><label for="q2_5"><input type="radio" name="q2" id="q2_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">3</b> &nbsp;  I learn how to improve my professional practice.</th>
                                <td align="center" class="whitecell"><label for="q3"><input type="radio" name="q3" id="q3_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q3_1"><input type="radio" name="q3" id="q3_1" value="1"></label></td align="center"><td align="center"><label for="q3_2"><input type="radio" name="q3" id="q3_2" value="2"></label></td align="center"><td align="center"><label for="q3_3"><input type="radio" name="q3" id="q3_3" value="3"></label></td align="center"><td align="center"><label for="q47_4"><input type="radio" name="q3" id="q3_4" value="4"></label></td align="center"><td align="center"><label for="q3_5"><input type="radio" name="q3" id="q3_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">4</b> &nbsp; what I learn connects well with my professional practice.</th>
                                <td align="center" class="whitecell"><label for="q4"><input type="radio" name="q4" id="q4_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q4_1"><input type="radio" name="q4" id="q4_1" value="1"></label></td align="center"><td align="center"><label for="q4_2"><input type="radio" name="q4" id="q4_2" value="2"></label></td align="center"><td align="center"><label for="q4_3"><input type="radio" name="q4" id="q4_3" value="3"></label></td align="center"><td align="center"><label for="q4_4"><input type="radio" name="q4" id="q4_4" value="4"></label></td align="center"><td align="center"><label for="q4_5"><input type="radio" name="q48" id="q4_5" value="5"></label></td align="center"></tr>
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
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" ><b>5</b> &nbsp; I think critically about how I learn.</th>
                                <td align="center" class="whitecell"><label for="q5"><input type="radio" name="q5" id="q5_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q5_1"><input type="radio" name="q5" id="q5_1" value="1"></label></td align="center"><td align="center"><label for="q5_2"><input type="radio" name="q5" id="q5_2" value="2"></label></td align="center"><td align="center"><label for="q5_3"><input type="radio" name="q5" id="q5_3" value="3"></label></td align="center"><td align="center"><label for="q5_4"><input type="radio" name="q5" id="q5_4" value="4"></label></td align="center"><td align="center"><label for="q5_5"><input type="radio" name="q5" id="q5_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">6</b> &nbsp; I think critically about my own ideas.</th>
                                <td align="center" class="whitecell"><label for="q6"><input type="radio" name="q6" id="q6_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q6_1"><input type="radio" name="q6" id="q6_1" value="1"></label></td align="center"><td align="center"><label for="q6_2"><input type="radio" name="q6" id="q6_2" value="2"></label></td align="center"><td align="center"><label for="q6_3"><input type="radio" name="q6" id="q6_3" value="3"></label></td align="center"><td align="center"><label for="q6_4"><input type="radio" name="q6" id="q6_4" value="4"></label></td align="center"><td align="center"><label for="q6_5"><input type="radio" name="q6" id="q6_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">7</b> &nbsp; I think critically about other students' ideas.</th>
                                <td align="center" class="whitecell"><label for="q7"><input type="radio" name="q7" id="q7_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q7_1"><input type="radio" name="q7" id="q7_1" value="1"></label></td align="center"><td align="center"><label for="q7_2"><input type="radio" name="q7" id="q7_2" value="2"></label></td align="center"><td align="center"><label for="q7_3"><input type="radio" name="q7" id="q7_3" value="3"></label></td align="center"><td align="center"><label for="q7_4"><input type="radio" name="q7" id="q7_4" value="4"></label></td align="center"><td align="center"><label for="q7_5"><input type="radio" name="q7" id="q7_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">8</b> &nbsp; I think critically about ideas in the readings.</th>
                                <td align="center" class="whitecell"><label for="q8"><input type="radio" name="q8" id="q8_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q8_1"><input type="radio" name="q8" id="q8_1" value="1"></label></td align="center"><td align="center"><label for="q8_2"><input type="radio" name="q8" id="q8_2" value="2"></label></td align="center"><td align="center"><label for="q8_3"><input type="radio" name="q8" id="q8_3" value="3"></label></td align="center"><td align="center"><label for="q8_4"><input type="radio" name="q8" id="q8_4" value="4"></label></td align="center"><td align="center"><label for="q8_5"><input type="radio" name="q8" id="q8_5" value="5"></label></td align="center"></tr>
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
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3"><b>9</b> &nbsp; I explain my ideas to other students.</th>
                                <td align="center" class="whitecell"><label for="q9"><input type="radio" name="q9" id="q9_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q9_1"><input type="radio" name="q9" id="q9_1" value="1"></label></td align="center"><td align="center"><label for="q9_2"><input type="radio" name="q9" id="q9_2" value="2"></label></td align="center"><td align="center"><label for="q9_3"><input type="radio" name="q9" id="q9_3" value="3"></label></td align="center"><td align="center"><label for="q9_4"><input type="radio" name="q9" id="q9_4" value="4"></label></td align="center"><td align="center"><label for="q9_5"><input type="radio" name="q9" id="q9_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">10</b> &nbsp;  I ask other students to explain their ideas.</th>
                                <td align="center" class="whitecell"><label for="q10"><input type="radio" name="q10" id="q10_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q10_1"><input type="radio" name="q10" id="q10_1" value="1"></label></td align="center"><td align="center"><label for="q10_2"><input type="radio" name="q10" id="q10_2" value="2"></label></td align="center"><td align="center"><label for="q10_3"><input type="radio" name="q10" id="q10_3" value="3"></label></td align="center"><td align="center"><label for="q10_4"><input type="radio" name="q10" id="q10_4" value="4"></label></td align="center"><td align="center"><label for="q10_5"><input type="radio" name="q10" id="q10_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">11</b> &nbsp;  other students ask me to explain my ideas</th>
                                <td align="center" class="whitecell"><label for="q11"><input type="radio" name="q11" id="q11_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q11_1"><input type="radio" name="q11" id="q11_1" value="1"></label></td align="center"><td align="center"><label for="q11_2"><input type="radio" name="q11" id="q11_2" value="2"></label></td align="center"><td align="center"><label for="q11_3"><input type="radio" name="q11" id="q11_3" value="3"></label></td align="center"><td align="center"><label for="q11_4"><input type="radio" name="q11" id="q11_4" value="4"></label></td align="center"><td align="center"><label for="q11_5"><input type="radio" name="q11" id="q11_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">12</b> &nbsp; other students respond to my ideas.</th>
                                <td align="center" class="whitecell"><label for="q12"><input type="radio" name="q12" id="q12_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q12_1"><input type="radio" name="q12" id="q12_1" value="1"></label></td align="center"><td align="center"><label for="q12_2"><input type="radio" name="q12" id="q12_2" value="2"></label></td align="center"><td align="center"><label for="q12_3"><input type="radio" name="q12" id="q12_3" value="3"></label></td align="center"><td align="center"><label for="q12_4"><input type="radio" name="q12" id="q12_4" value="4"></label></td align="center"><td align="center"><label for="q12_5"><input type="radio" name="q12" id="q12_5" value="5"></label></td align="center"></tr>
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
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3"><b>13</b> &nbsp;  the tutor stimulates my thinking.</th>
                                <td align="center" class="whitecell"><label for="q13"><input type="radio" name="q13" id="q13_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q13_1"><input type="radio" name="q13" id="q13_1" value="1"></label></td align="center"><td align="center"><label for="q13_2"><input type="radio" name="q13" id="q13_2" value="2"></label></td align="center"><td align="center"><label for="q13_3"><input type="radio" name="q13" id="q13_3" value="3"></label></td align="center"><td align="center"><label for="q13_4"><input type="radio" name="q13" id="q13_4" value="4"></label></td align="center"><td align="center"><label for="q13_5"><input type="radio" name="q13" id="q13_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">14</b> &nbsp; the tutor encourages me to participate.</th>
                                <td align="center" class="whitecell"><label for="q14"><input type="radio" name="q14" id="q14_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q14_1"><input type="radio" name="q14" id="q14_1" value="1"></label></td align="center"><td align="center"><label for="q14_2"><input type="radio" name="q14" id="q14_2" value="2"></label></td align="center"><td align="center"><label for="q14_3"><input type="radio" name="q14" id="q14_3" value="3"></label></td align="center"><td align="center"><label for="q14_4"><input type="radio" name="q14" id="q14_4" value="4"></label></td align="center"><td align="center"><label for="q14_5"><input type="radio" name="q14" id="q14_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">15</b> &nbsp; the tutor models good discourse.</th>
                                <td align="center" class="whitecell"><label for="q47"><input type="radio" name="q47" id="q47_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q15_1"><input type="radio" name="q15" id="q15_1" value="1"></label></td align="center"><td align="center"><label for="q15_2"><input type="radio" name="q15" id="q15_2" value="2"></label></td align="center"><td align="center"><label for="q15_3"><input type="radio" name="q15" id="q15_3" value="3"></label></td align="center"><td align="center"><label for="q15_4"><input type="radio" name="q15" id="q15_4" value="4"></label></td align="center"><td align="center"><label for="q15_5"><input type="radio" name="q15" id="q15_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">16</b> &nbsp;  the tutor models critical self-reflection.</th>
                                <td align="center" class="whitecell"><label for="q48"><input type="radio" name="q48" id="q48_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q16_1"><input type="radio" name="q16" id="q16_1" value="1"></label></td align="center"><td align="center"><label for="q16_2"><input type="radio" name="q16" id="q16_2" value="2"></label></td align="center"><td align="center"><label for="q16_3"><input type="radio" name="q16" id="q16_3" value="3"></label></td align="center"><td align="center"><label for="q16_4"><input type="radio" name="q16" id="q16_4" value="4"></label></td align="center"><td align="center"><label for="q16_5"><input type="radio" name="q16" id="q16_5" value="5"></label></td align="center"></tr>
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
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3"><b>17</b> &nbsp; other students encourage my participation.</th>
                                <td align="center" class="whitecell"><label for="q17"><input type="radio" name="q17" id="q17_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q17_1"><input type="radio" name="q17" id="q17_1" value="1"></label></td align="center"><td align="center"><label for="q17_2"><input type="radio" name="q45" id="q17_2" value="2"></label></td align="center"><td align="center"><label for="q17_3"><input type="radio" name="q45" id="q45_3" value="3"></label></td align="center"><td align="center"><label for="q45_4"><input type="radio" name="q17" id="q17_4" value="4"></label></td align="center"><td align="center"><label for="q17_5"><input type="radio" name="q17" id="q17_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">18</b> &nbsp; other students praise my contribution.</th>
                                <td align="center" class="whitecell"><label for="q18"><input type="radio" name="q18" id="q18_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q18_1"><input type="radio" name="q18" id="q18_1" value="1"></label></td align="center"><td align="center"><label for="q18_2"><input type="radio" name="q18" id="q18_2" value="2"></label></td align="center"><td align="center"><label for="q18_3"><input type="radio" name="q18" id="q18_3" value="3"></label></td align="center"><td align="center"><label for="q18_4"><input type="radio" name="q18" id="q18_4" value="4"></label></td align="center"><td align="center"><label for="q18_5"><input type="radio" name="q18" id="q18_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">19</b> &nbsp; other students value my contribution.</th>
                                <td align="center" class="whitecell"><label for="q19"><input type="radio" name="q19" id="q19_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q19_1"><input type="radio" name="q19" id="q19_1" value="1"></label></td align="center"><td align="center"><label for="q19_2"><input type="radio" name="q19" id="q19_2" value="2"></label></td align="center"><td align="center"><label for="q19_3"><input type="radio" name="q47" id="q19_3" value="3"></label></td align="center"><td align="center"><label for="q19_4"><input type="radio" name="q19" id="q19_4" value="4"></label></td align="center"><td align="center"><label for="q19_5"><input type="radio" name="q19" id="q19_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">20</b> &nbsp; other students empathise with my struggle to learn.</th>
                                <td align="center" class="whitecell"><label for="q20"><input type="radio" name="q20" id="q20_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q20_1"><input type="radio" name="q20" id="q20_1" value="1"></label></td align="center"><td align="center"><label for="q48_2"><input type="radio" name="q20" id="q20_2" value="2"></label></td align="center"><td align="center"><label for="q20_3"><input type="radio" name="q20" id="q20_3" value="3"></label></td align="center"><td align="center"><label for="q20_4"><input type="radio" name="q20" id="q20_4" value="4"></label></td align="center"><td align="center"><label for="q20_5"><input type="radio" name="q20" id="q20_5" value="5"></label></td align="center"></tr>
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
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3"><b>21</b> &nbsp; I make good sense of other students' messages.</th>
                                <td align="center" class="whitecell"><label for="q21"><input type="radio" name="q21" id="q21_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q21_1"><input type="radio" name="q21" id="q21_1" value="1"></label></td align="center"><td align="center"><label for="q21_2"><input type="radio" name="q21" id="q21_2" value="2"></label></td align="center"><td align="center"><label for="q21_3"><input type="radio" name="q21" id="q21_3" value="3"></label></td align="center"><td align="center"><label for="q21_4"><input type="radio" name="q21" id="q21_4" value="4"></label></td align="center"><td align="center"><label for="q21_5"><input type="radio" name="q21" id="q21_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light" ><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">22</b> &nbsp; other students make good sense of my messages.</th>
                                <td align="center" class="whitecell"><label for="q22"><input type="radio" name="q22" id="q22_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q22_1"><input type="radio" name="q22" id="q22_1" value="1"></label></td align="center"><td align="center"><label for="q22_2"><input type="radio" name="q22" id="q22_2" value="2"></label></td align="center"><td align="center"><label for="q46_3"><input type="radio" name="q46" id="q46_3" value="3"></label></td align="center"><td align="center"><label for="q46_4"><input type="radio" name="q46" id="q46_4" value="4"></label></td align="center"><td align="center"><label for="q46_5"><input type="radio" name="q22" id="q22_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="bg-secondary"><th scope="row" class="w-50 p-3" class="optioncell"><b class="qnumtopcell">23</b> &nbsp;  I make good sense of the tutor's messages.</th>
                                <td align="center" class="whitecell"><label for="q23"><input type="radio" name="q23" id="q23_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q23_1"><input type="radio" name="q23" id="q23_1" value="1"></label></td align="center"><td align="center"><label for="q23_2"><input type="radio" name="q23" id="q23_2" value="2"></label></td align="center"><td align="center"><label for="q23_3"><input type="radio" name="q23" id="q23_3" value="3"></label></td align="center"><td align="center"><label for="q23_4"><input type="radio" name="q23" id="q23_4" value="4"></label></td align="center"><td align="center"><label for="q23_5"><input type="radio" name="q23" id="q23_5" value="5"></label></td align="center"></tr>
                                
                                <tr class="table-light"><th scope="row" class="w-50 p-3" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">24</b> &nbsp;the tutor makes good sense of my messages.</th>
                                <td align="center" class="whitecell"><label for="q24"><input type="radio" name="q24" id="q24_D" value="0" checked="checked" data-survey-default="true"></label></td align="center"><td align="center"><label for="q24_1"><input type="radio" name="q24" id="q24_1" value="1"></label></td align="center"><td align="center"><label for="q24_2"><input type="radio" name="q24" id="q24_2" value="2"></label></td align="center"><td align="center"><label for="q24_3"><input type="radio" name="q24" id="q24_3" value="3"></label></td align="center"><td align="center"><label for="q24_4"><input type="radio" name="q24" id="q24_4" value="4"></label></td align="center"><td align="center"><label for="q24_5"><input type="radio" name="q24" id="q24_5" value="5"></label></td align="center"></tr>
                            </tbody>
                        </table>
                        <table class="table mt-5">
                            <tbody>
                                <tr>
                                    <th scope="row" class="w-50 p-3"><b>25</b> &nbsp; How long did this survey take you to complete?</th>
                                    <td align="left" class="whitecell">
                                    <div class="col-sm-12">
                                        <select class="form-control" id="q25" name="q25">
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
                                    <th scope="row" class="w-50 p-3"><b>26</b> &nbsp; Do you have any other comments?</th>
                                    <td align="left" class="whitecell">
                                    <div class="col-sm-12">
                                        <textarea class="survey3" name="q26"></textarea>
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
  selector: '.survey3',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:50,
});
</script>