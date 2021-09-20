
<style src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css"></style>
<style>
  @import url(https://fonts.googleapis.com/css?family=Lato:300,400,700);

html { height: 100%; }
*,*:after,*:before {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	padding: 0;
	margin: 0;
}
.clearfix:before,.clearfix:after {
    content: " "; /* 1 */
    display: table; /* 2 */
}
.clearfix:after { clear: both;}
.clearfix {    *zoom: 1;}
body {
  font-family: 'Lato', Calibri, Arial, sans-serif;
  background-image: url(https://goo.gl/XZ7Kr7);
  background-position: center;
  background-size: cover;
  font-weight: 400;
  font-size: 15px;
  color: #333;
}

section {
	width: 100%;
	height: 100%;
	position: relative;
}
section, .main {
  border-radius: 8px;
	padding: 0 5px 50px 5px;
	width: 100%;
	margin: 0 auto;
  max-width: 660px;
}
.fc-calendar1-container {
	position: relative;
	height: 400px;
	width: 400px;
}
.fc-calendar1 {
	width: 100%;
	height: 100%;
}
.fc-calendar1 .fc-head {
	height: 30px;
	line-height: 30px;
	background: #ccc;
	color: #fff;
}
.fc-calendar1 .fc-body {
	position: relative;
	width: 100%;
	height: 100%;
	height: -moz-calc(100% - 30px);
	height: -webkit-calc(100% - 30px);
	height: calc(100% - 30px);
	border: 1px solid #ddd;
}
.fc-calendar1 .fc-row {
	width: 100%;
	border-bottom: 1px solid #ddd;
}
.fc-four-rows .fc-row  {
	height: 25%;
}
.fc-five-rows .fc-row  {
	height: 20%;
}
.fc-six-rows .fc-row {
	height: 16.66%;
	height: -moz-calc(100%/6);
	height: -webkit-calc(100%/6);
	height: calc(100%/6);
}
.fc-calendar1 .fc-row > div, .fc-calendar1 .fc-head > div {
	float: left;
	height: 100%;
	width:  14.28%; /* 100% / 7 */
	width: -moz-calc(100%/7);
	width: -webkit-calc(100%/7);
	width: calc(100%/7);
	position: relative;
}
.ie9 .fc-calendar1 .fc-row > div, .ie9 .fc-calendar1 .fc-head > div {
	width:  14.2%;
}
.fc-calendar1 .fc-row > div {
	border-right: 1px solid #ddd;
	padding: 4px;
	overflow: hidden;
	position: relative;
}
.fc-calendar1 .fc-head > div {
	text-align: center;
}
.fc-calendar1 .fc-row > div > span.fc-date {
	position: absolute;
	width: 30px;
	height: 20px;
	font-size: 20px;
	line-height: 20px;
	font-weight: 700;
	color: #ddd;
	text-shadow: 0 -1px 0 rgba(255,255,255,0.8);
	bottom: 5px;
	right: 5px;
	text-align: right;
}
.fc-calendar1 .fc-row > div > span.fc-weekday {
	padding-left: 5px;
	display: none;
}
.fc-calendar1 .fc-row > div.fc-today {
	background: #fff4c3;
}
.fc-calendar1 .fc-row > div.fc-out {
	opacity: 0.6;
}
.fc-calendar1 .fc-row > div:last-child,.fc-calendar1 .fc-head > div:last-child {
	border-right: none;
}
.fc-calendar1 .fc-row:last-child {
	border-bottom: none;
}
.custom-calendar1-wrap {
	margin: 10px auto;
	position: relative;
	overflow: hidden;
}
.custom-inner {
	background: #fff;
  border-radius: 5px;
	box-shadow: 0 1px 3px rgba(0,0,0,0.2);
  overflow: hidden;
}
.custom-inner:before,.custom-inner:after  {
	content: '';
	width: 99%;
	height: 50%;
	position: absolute;
	background: #f6f6f6;
	bottom: -4px;
	left: 0.5%;
	z-index: -1;
	box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}
.custom-inner:after {
	content: '';
	width: 98%;
	bottom: -7px;
	left: 1%;
	z-index: -2;
}
.custom-header {
	background: #ef4f69;
	padding: 5px 10px 10px 20px;
	height: 70px;
	position: relative;
	border-top: 5px solid #ef4f69;
	border-bottom: 1px solid #ddd;
}
.custom-header h2,.custom-header h3 {
	text-align: center;
	text-transform: uppercase;
}
.custom-header h2 {
	color: #FFF;
	font-weight: 700;
	font-size: 18px;
	margin-top: 10px;
}
.custom-header h3 {
	font-size: 10px;
	font-weight: 700;
	color: #FFF;
}
.custom-header nav span {
	position: absolute;
	top: 17px;
	width: 30px;
	height: 30px;
	color: transparent;
	cursor: pointer;
	margin: 0 1px;
	font-size: 20px;
	line-height: 30px;
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	user-select: none;
}
.custom-header nav span:first-child {	left: 5px;}
.custom-header nav span:last-child {	right: 5px;}
.custom-header nav span:before {
	font-family: 'fontawesome-selected';
	color: #FFF;
	position: absolute;
	text-align: center;
	width: 100%;
}
.custom-header nav span.custom-prev:before {	content: '\25c2';}
.custom-header nav span.custom-next:before {	content: '\25b8';}
.custom-header nav span:hover:before {	color: #495468;}
.custom-content-reveal {
	background: #f6f6f6;
	background: rgba(246, 246, 246, 0.9);
	width: 100%;
	height: 100%;
	position: absolute;
	z-index: 100;
	top: 100%;
	left: 0px;
	text-align: center;
	-webkit-transition: all 0.6s ease-in-out;
	-moz-transition: all 0.6s ease-in-out;
	-o-transition: all 0.6s ease-in-out;
	-ms-transition: all 0.6s ease-in-out;
	transition: all 0.6s ease-in-out;
}
.custom-content-reveal span.custom-content-close {
	position: absolute;
	top: 15px;
	right: 10px;
	width: 20px;
	height: 20px;
	text-align: center;
	background: #ef4f69;
	box-shadow: 0 1px 1px rgba(0,0,0,0.1);
	cursor: pointer;
	line-height: 13px;
	padding: 0;
}
.custom-content-reveal span.custom-content-close:after {
	content: 'x';
	font-size: 18px;
	color: #fff;
}
.custom-content-reveal a, .custom-content-reveal span {
	font-size: 22px;
	padding: 10px 30px;
	display: block;
}
.custom-content-reveal h4 {
	text-transform: uppercase;
	font-size: 13px;
	font-weight: 300;
	letter-spacing: 3px;
	color: #777;
	padding: 20px;
	background: #fff;
	border-bottom: 1px solid #ddd;
	border-top: 5px solid #ef4f69;
	box-shadow: 0 1px rgba(255,255,255,0.9);
	margin-bottom: 30px;
}
.custom-content-reveal span {	color: #888;}
.custom-content-reveal a {	color: #ef4f69;}
.custom-content-reveal a:hover {	color: #333;}

/* Modifications */
.fc-calendar1-container {
	height: 400px;
	width: auto;
	padding: 30px;
	background: #f6f6f6;
	box-shadow: inset 0 1px rgba(255,255,255,0.8);
}
.fc-calendar1 .fc-head {
	background: transparent;
	color: #ef4f69;
	font-weight: bold;
	text-transform: uppercase;
	font-size: 12px;
}
.fc-calendar1 .fc-row > div {
	background: #fff;
	cursor: pointer;
}
.fc-calendar1 .fc-row > div:empty {
	background: transparent;
}
.fc-calendar1 .fc-row > div > span.fc-date {
	top: 50%;
	left: 50%;
	text-align: center;
	margin: -10px 0 0 -15px;
	color: #686a6e;
	font-weight: 400;
	pointer-events: none;
}
.fc-calendar1 .fc-row > div.fc-today {
	background: #ef4f69;
	box-shadow: inset 0 -1px 1px rgba(0,0,0,0.1);
}
.fc-calendar1 .fc-row > div.fc-today > span.fc-date {
	color: #fff;
	text-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.fc-calendar1 .fc-row > div.fc-content:after {
	content: '\00B7';
	text-align: center;
	width: 20px;
	margin-left: -10px;
	position: absolute;
	color: #DDD;
	font-size: 70px;
	line-height: 20px;
	left: 50%;
	bottom: 3px;
}
.fc-calendar1 .fc-row > div.fc-today.fc-content:after {	color: #b02c42;}
.fc-calendar1 .fc-row > div.fc-content:hover:after{	color: #ef4f69;}
.fc-calendar1 .fc-row > div.fc-today.fc-content:hover:after{	color: #fff;}
.fc-calendar1 .fc-row > div > div a, .fc-calendar1 .fc-row > div > div span {
	display: none;
	font-size: 22px;
}
@media screen and (max-width: 400px) {
	.fc-calendar1-container {		height: 300px;	}
	.fc-calendar1 .fc-row > div > span.fc-date {		font-size: 15px;	}
}
</style>
<div class="main">
	<div class="custom-calendar1-wrap">
		<div id="custom-inner" class="custom-inner">
			<div class="custom-header clearfix">
				<nav>
					<span id="custom-prev" class="custom-prev"></span>
					<span id="custom-next" class="custom-next"></span>
				</nav>
				<h2 id="custom-month" class="custom-month"></h2>
				<h3 id="custom-year" class="custom-year"></h3>
			</div>
			<div id="calendar1" class="fc-calendar1-container"></div>
		</div>
	</div>
</div>