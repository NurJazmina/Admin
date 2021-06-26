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
        background-color: #ffa500;
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
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">ATTLS (20 Item Version)</span>
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
                <form action="#" id="surveyform1" name="surveyform1" method="post">
                    <div>
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="sesskey" value="">
                        <div id="intro" class="box py-3 ">
                            <div class="no-overflow">The purpose of this questionnaire is to help us evaluate your attitudes towards thinking and learning.There are no 'right' or 'wrong' answers; we are interested only in your opinion. Please be assured that your responses will be treated with a high degree of confidentiality, and will not affect your assessment.</div>
                        </div>
                        <div class="mb-10">All questions are required and must be answered.</div>
                        <h3 style="color:#04ada5;">Attitudes Towards Thinking and Learning</h3>
                        <table class="table mt-10">
                            <colgroup colspan="7"></colgroup>
                            <tbody>
                                <tr class="bg-success text-light">
                                    <th scope="row" >Responses</th>
                                    <th scope="col" class="hresponse"><small>Not yet answered</small></th>
                                    <th scope="col" class="hresponse"><small>Strongly disagree</small></th>
                                    <th scope="col" class="hresponse"><small>Somewhat disagree</small></th>
                                    <th scope="col" class="hresponse"><small>Neither agree nor disagree</small></th>
                                    <th scope="col" class="hresponse"><small>Somewhat agree</small></th>
                                    <th scope="col" class="hresponse"><small>Strongly agree</small></th>
                                </tr>
                                <tr>
                                    <th scope="colgroup" colspan="7" style="color:#3F4254">In discussion ...</th>
                                </tr>
                                <tr class="bg-success text-light"><th scope="row"><b>1</b> &nbsp; In evaluating what someone says, I focus on the quality of their argument, not on the person who's presenting it.</th>
                                <td class="whitecell"><label for="q45"><input type="radio" name="q45" id="q45_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q45_1"><input type="radio" name="q45" id="q45_1" value="1"></label></td><td><label for="q45_2"><input type="radio" name="q45" id="q45_2" value="2"></label></td><td><label for="q45_3"><input type="radio" name="q45" id="q45_3" value="3"></label></td><td><label for="q45_4"><input type="radio" name="q45" id="q45_4" value="4"></label></td><td><label for="q45_5"><input type="radio" name="q45" id="q45_5" value="5"></label></td></tr>
                                
                                <tr class="table-light" ><th scope="row" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">2</b> &nbsp; I like playing devil's advocate - arguing the opposite of what someone is saying.</th>
                                <td class="whitecell"><label for="q46"><input type="radio" name="q46" id="q46_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q46_1"><input type="radio" name="q46" id="q46_1" value="1"></label></td><td><label for="q46_2"><input type="radio" name="q46" id="q46_2" value="2"></label></td><td><label for="q46_3"><input type="radio" name="q46" id="q46_3" value="3"></label></td><td><label for="q46_4"><input type="radio" name="q46" id="q46_4" value="4"></label></td><td><label for="q46_5"><input type="radio" name="q46" id="q46_5" value="5"></label></td></tr>
                                
                                <tr class="bg-success text-light"><th scope="row" class="optioncell"><b class="qnumtopcell">3</b> &nbsp; I like to understand where other people are 'coming from', what experiences have led them to feel the way they do.</th>
                                <td class="whitecell"><label for="q47"><input type="radio" name="q47" id="q47_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q47_1"><input type="radio" name="q47" id="q47_1" value="1"></label></td><td><label for="q47_2"><input type="radio" name="q47" id="q47_2" value="2"></label></td><td><label for="q47_3"><input type="radio" name="q47" id="q47_3" value="3"></label></td><td><label for="q47_4"><input type="radio" name="q47" id="q47_4" value="4"></label></td><td><label for="q47_5"><input type="radio" name="q47" id="q47_5" value="5"></label></td></tr>
                                
                                <tr class="table-light"><th scope="row" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">4</b> &nbsp; The most important part of my education has been learning to understand people who are very different to me.</th>
                                <td class="whitecell"><label for="q48"><input type="radio" name="q48" id="q48_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q48_1"><input type="radio" name="q48" id="q48_1" value="1"></label></td><td><label for="q48_2"><input type="radio" name="q48" id="q48_2" value="2"></label></td><td><label for="q48_3"><input type="radio" name="q48" id="q48_3" value="3"></label></td><td><label for="q48_4"><input type="radio" name="q48" id="q48_4" value="4"></label></td><td><label for="q48_5"><input type="radio" name="q48" id="q48_5" value="5"></label></td></tr>
                                
                                <tr class="bg-success text-light"><th scope="row" class="optioncell"><b class="qnumtopcell">5</b> &nbsp; I feel that the best way for me to achieve my own identity is to interact with a variety of other people.</th>
                                <td class="whitecell"><label for="q49"><input type="radio" name="q49" id="q49_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q49_1"><input type="radio" name="q49" id="q49_1" value="1"></label></td><td><label for="q49_2"><input type="radio" name="q49" id="q49_2" value="2"></label></td><td><label for="q49_3"><input type="radio" name="q49" id="q49_3" value="3"></label></td><td><label for="q49_4"><input type="radio" name="q49" id="q49_4" value="4"></label></td><td><label for="q49_5"><input type="radio" name="q49" id="q49_5" value="5"></label></td></tr>
                                
                                <tr class="table-light"><th scope="row" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">6</b> &nbsp; I enjoy hearing the opinions of people who come from backgrounds different to mine - it helps me to understand how the same things can be seen in such different ways.</th>
                                <td class="whitecell"><label for="q50"><input type="radio" name="q50" id="q50_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q50_1"><input type="radio" name="q50" id="q50_1" value="1"></label></td><td><label for="q50_2"><input type="radio" name="q50" id="q50_2" value="2"></label></td><td><label for="q50_3"><input type="radio" name="q50" id="q50_3" value="3"></label></td><td><label for="q50_4"><input type="radio" name="q50" id="q50_4" value="4"></label></td><td><label for="q50_5"><input type="radio" name="q50" id="q50_5" value="5"></label></td></tr>
                                
                                <tr class="bg-success text-light"><th scope="row" class="optioncell"><b class="qnumtopcell">7</b> &nbsp; I find that I can strengthen my own position through arguing with someone who disagrees with me.</th>
                                <td class="whitecell"><label for="q51"><input type="radio" name="q51" id="q51_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q51_1"><input type="radio" name="q51" id="q51_1" value="1"></label></td><td><label for="q51_2"><input type="radio" name="q51" id="q51_2" value="2"></label></td><td><label for="q51_3"><input type="radio" name="q51" id="q51_3" value="3"></label></td><td><label for="q51_4"><input type="radio" name="q51" id="q51_4" value="4"></label></td><td><label for="q51_5"><input type="radio" name="q51" id="q51_5" value="5"></label></td></tr>
                                
                                <tr class="table-light"><th scope="row" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">8</b> &nbsp; I am always interested in knowing why people say and believe the things they do.</th>
                                <td class="whitecell"><label for="q52"><input type="radio" name="q52" id="q52_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q52_1"><input type="radio" name="q52" id="q52_1" value="1"></label></td><td><label for="q52_2"><input type="radio" name="q52" id="q52_2" value="2"></label></td><td><label for="q52_3"><input type="radio" name="q52" id="q52_3" value="3"></label></td><td><label for="q52_4"><input type="radio" name="q52" id="q52_4" value="4"></label></td><td><label for="q52_5"><input type="radio" name="q52" id="q52_5" value="5"></label></td></tr>
                                
                                <tr class="bg-success text-light"><th scope="row" class="optioncell"><b class="qnumtopcell">9</b> &nbsp; I often find myself arguing with the authors of books that I read, trying to logically figure out why they're wrong.</th>
                                <td class="whitecell"><label for="q53"><input type="radio" name="q53" id="q53_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q53_1"><input type="radio" name="q53" id="q53_1" value="1"></label></td><td><label for="q53_2"><input type="radio" name="q53" id="q53_2" value="2"></label></td><td><label for="q53_3"><input type="radio" name="q53" id="q53_3" value="3"></label></td><td><label for="q53_4"><input type="radio" name="q53" id="q53_4" value="4"></label></td><td><label for="q53_5"><input type="radio" name="q53" id="q53_5" value="5"></label></td></tr>
                                
                                <tr class="table-light"><th scope="row" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">10</b> &nbsp; It's important for me to remain as objective as possible when I analyze something.</th>
                                <td class="whitecell"><label for="q54"><input type="radio" name="q54" id="q54_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q54_1"><input type="radio" name="q54" id="q54_1" value="1"></label></td><td><label for="q54_2"><input type="radio" name="q54" id="q54_2" value="2"></label></td><td><label for="q54_3"><input type="radio" name="q54" id="q54_3" value="3"></label></td><td><label for="q54_4"><input type="radio" name="q54" id="q54_4" value="4"></label></td><td><label for="q54_5"><input type="radio" name="q54" id="q54_5" value="5"></label></td></tr>
                                
                                <tr class="bg-success text-light"><th scope="row" class="optioncell"><b class="qnumtopcell">11</b> &nbsp; I try to think with people instead of against them.</th>
                                <td class="whitecell"><label for="q55"><input type="radio" name="q55" id="q55_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q55_1"><input type="radio" name="q55" id="q55_1" value="1"></label></td><td><label for="q55_2"><input type="radio" name="q55" id="q55_2" value="2"></label></td><td><label for="q55_3"><input type="radio" name="q55" id="q55_3" value="3"></label></td><td><label for="q55_4"><input type="radio" name="q55" id="q55_4" value="4"></label></td><td><label for="q55_5"><input type="radio" name="q55" id="q55_5" value="5"></label></td></tr>
                                
                                <tr class="table-light"><th scope="row" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">12</b> &nbsp; I have certain criteria I use in evaluating arguments.</th>
                                <td class="whitecell"><label for="q56"><input type="radio" name="q56" id="q56_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q56_1"><input type="radio" name="q56" id="q56_1" value="1"></label></td><td><label for="q56_2"><input type="radio" name="q56" id="q56_2" value="2"></label></td><td><label for="q56_3"><input type="radio" name="q56" id="q56_3" value="3"></label></td><td><label for="q56_4"><input type="radio" name="q56" id="q56_4" value="4"></label></td><td><label for="q56_5"><input type="radio" name="q56" id="q56_5" value="5"></label></td></tr>
                                
                                <tr class="bg-success text-light"><th scope="row" class="optioncell"><b class="qnumtopcell">13</b> &nbsp; I'm more likely to try to understand someone else's opinion than to try to evaluate it.</th>
                                <td class="whitecell"><label for="q57"><input type="radio" name="q57" id="q57_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q57_1"><input type="radio" name="q57" id="q57_1" value="1"></label></td><td><label for="q57_2"><input type="radio" name="q57" id="q57_2" value="2"></label></td><td><label for="q57_3"><input type="radio" name="q57" id="q57_3" value="3"></label></td><td><label for="q57_4"><input type="radio" name="q57" id="q57_4" value="4"></label></td><td><label for="q57_5"><input type="radio" name="q57" id="q57_5" value="5"></label></td></tr>
                                
                                <tr class="table-light"><th scope="row" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">14</b> &nbsp; I try to point out weaknesses in other people's thinking to help them clarify their arguments.</th>
                                <td class="whitecell"><label for="q58"><input type="radio" name="q58" id="q58_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q58_1"><input type="radio" name="q58" id="q58_1" value="1"></label></td><td><label for="q58_2"><input type="radio" name="q58" id="q58_2" value="2"></label></td><td><label for="q58_3"><input type="radio" name="q58" id="q58_3" value="3"></label></td><td><label for="q58_4"><input type="radio" name="q58" id="q58_4" value="4"></label></td><td><label for="q58_5"><input type="radio" name="q58" id="q58_5" value="5"></label></td></tr>
                                
                                <tr class="bg-success text-light"><th scope="row" class="optioncell"><b class="qnumtopcell">15</b> &nbsp; I tend to put myself in other people's shoes when discussing controversial issues, to see why they think the way they do.</th>
                                <td class="whitecell"><label for="q59"><input type="radio" name="q59" id="q59_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q59_1"><input type="radio" name="q59" id="q59_1" value="1"></label></td><td><label for="q59_2"><input type="radio" name="q59" id="q59_2" value="2"></label></td><td><label for="q59_3"><input type="radio" name="q59" id="q59_3" value="3"></label></td><td><label for="q59_4"><input type="radio" name="q59" id="q59_4" value="4"></label></td><td><label for="q59_5"><input type="radio" name="q59" id="q59_5" value="5"></label></td></tr>
                                
                                <tr class="table-light"><th scope="row" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">16</b> &nbsp; One could call my way of analysing things 'putting them on trial' because I am careful to consider all the evidence.</th>
                                <td class="whitecell"><label for="q60"><input type="radio" name="q60" id="q60_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q60_1"><input type="radio" name="q60" id="q60_1" value="1"></label></td><td><label for="q60_2"><input type="radio" name="q60" id="q60_2" value="2"></label></td><td><label for="q60_3"><input type="radio" name="q60" id="q60_3" value="3"></label></td><td><label for="q60_4"><input type="radio" name="q60" id="q60_4" value="4"></label></td><td><label for="q60_5"><input type="radio" name="q60" id="q60_5" value="5"></label></td></tr>
                                
                                <tr class="bg-success text-light"><th scope="row" class="optioncell"><b class="qnumtopcell">17</b> &nbsp; I value the use of logic and reason over the incorporation of my own concerns when solving problems.</th>
                                <td class="whitecell"><label for="q61"><input type="radio" name="q61" id="q61_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q61_1"><input type="radio" name="q61" id="q61_1" value="1"></label></td><td><label for="q61_2"><input type="radio" name="q61" id="q61_2" value="2"></label></td><td><label for="q61_3"><input type="radio" name="q61" id="q61_3" value="3"></label></td><td><label for="q61_4"><input type="radio" name="q61" id="q61_4" value="4"></label></td><td><label for="q61_5"><input type="radio" name="q61" id="q61_5" value="5"></label></td></tr>
                                
                                <tr class="table-light"><th scope="row" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">18</b> &nbsp; I can obtain insight into opinions that differ from mine through empathy.</th>
                                <td class="whitecell"><label for="q62"><input type="radio" name="q62" id="q62_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q62_1"><input type="radio" name="q62" id="q62_1" value="1"></label></td><td><label for="q62_2"><input type="radio" name="q62" id="q62_2" value="2"></label></td><td><label for="q62_3"><input type="radio" name="q62" id="q62_3" value="3"></label></td><td><label for="q62_4"><input type="radio" name="q62" id="q62_4" value="4"></label></td><td><label for="q62_5"><input type="radio" name="q62" id="q62_5" value="5"></label></td></tr>
                                
                                <tr class="bg-success text-light"><th scope="row" class="optioncell"><b class="qnumtopcell">19</b> &nbsp; When I encounter people whose opinions seem alien to me, I make a deliberate effort to 'extend' myself into that person, to try to see how they could have those opinions.</th>
                                <td class="whitecell"><label for="q63"><input type="radio" name="q63" id="q63_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q63_1"><input type="radio" name="q63" id="q63_1" value="1"></label></td><td><label for="q63_2"><input type="radio" name="q63" id="q63_2" value="2"></label></td><td><label for="q63_3"><input type="radio" name="q63" id="q63_3" value="3"></label></td><td><label for="q63_4"><input type="radio" name="q63" id="q63_4" value="4"></label></td><td><label for="q63_5"><input type="radio" name="q63" id="q63_5" value="5"></label></td></tr>
                                
                                <tr class="table-light"><th scope="row" style="color:#3F4254" class="optioncell"><b class="qnumtopcell">20</b> &nbsp; I spend time figuring out what's 'wrong' with things. For example, I'll look for something in a literary interpretation that isn't argued well enough.</th>
                                <td class="whitecell"><label for="q64"><input type="radio" name="q64" id="q64_D" value="0" checked="checked" data-survey-default="true"></label></td><td><label for="q64_1"><input type="radio" name="q64" id="q64_1" value="1"></label></td><td><label for="q64_2"><input type="radio" name="q64" id="q64_2" value="2"></label></td><td><label for="q64_3"><input type="radio" name="q64" id="q64_3" value="3"></label></td><td><label for="q64_4"><input type="radio" name="q64" id="q64_4" value="4"></label></td><td><label for="q64_5"><input type="radio" name="q64" id="q64_5" value="5"></label></td></tr>
                            </tbody>
                        </table><br>
                        <div class="row">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success" name="surveyform1">Click here to continue</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>