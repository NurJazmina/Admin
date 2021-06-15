<style>
.btn-link:hover {
    color: #0a477e;
    text-decoration: underline;
    text-decoration-line: underline;
    text-decoration-thickness: initial;
    text-decoration-style: initial;
    text-decoration-color: initial;
}
</style>
<br>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b example example-compact">
                <form class="form">
                    <div class="card-body">
                        <h2>Adding a new Quiz</h2>
                        <a type="button" data-bs-toggle="popover" title="" data-bs-content='
                        <p>The quiz activity enables a teacher to create quizzes comprising questions of various types, including multiple choice, matching, short-answer and numerical.</p>
                        <p>The teacher can allow the quiz to be attempted multiple times, with the questions shuffled or randomly selected from the question bank. A time limit may be set.</p>

                        <p>Each attempt is marked automatically, with the exception of essay questions, and the grade is recorded in the gradebook.</p>

                        <p>The teacher can choose when and if hints, feedback and correct answers are shown to students.</p>

                        <p>Quizzes may be used</p>

                        <ul><li>As course exams</li>
                        <li>As mini tests for reading assignments or at the end of a topic</li>
                        <li>As exam practice using questions from past exams</li>
                        <li>To deliver immediate feedback about performance</li>
                        <li>For self-assessment</li>
                        </ul>'>
                        <i class="icon fa fa-question-circle text-info fa-fw " title="Help with Quiz" aria-label="Help with Quiz"></i></a>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    GENERAL
                                </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    TIMING
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <div class="fcontainer clearfix">
		<div id="fitem_id_timeopen" class="form-group row  fitem   " data-groupname="timeopen">
        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
            <p id="id_timeopen_label" class="mb-0 word-break" aria-hidden="true" style="cursor: default;">Open the quiz</p>
            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                <a class="btn btn-link p-0" role="button" data-container="body" data-toggle="popover" data-placement="right" data-content="<div class=&quot;no-overflow&quot;><p>Students can only start their attempt(s) after the open time and they must complete their attempts before the close time.</p>
                </div> <div class=&quot;helpdoclink&quot;><a href=&quot;http://docs.moodle.org/311/en/mod/quiz/timing&quot;><i class=&quot;icon fa fa-info-circle fa-fw iconhelp icon-pre&quot; aria-hidden=&quot;true&quot;  ></i>More help</a></div>" data-html="true" tabindex="0" data-trigger="focus">
                <i class="icon fa fa-question-circle text-info fa-fw " title="Help with Open and close dates" aria-label="Help with Open and close dates"></i>
                </a>
            </div>
        </div>
    <div class="col-md-9 form-inline align-items-start felement" data-fieldtype="date_time_selector">
        <fieldset data-fieldtype="date_time" class="m-0 p-0 border-0" id="id_timeopen">
            <legend class="sr-only">Open the quiz</legend>
            <div class="fdate_time_selector d-flex flex-wrap align-items-center" id="yui_3_17_2_1_1623748120682_671">
                
                <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2370">
        <label class="col-form-label sr-only" for="id_timeopen_day">
            Day
        </label>
    <span data-fieldtype="select" id="yui_3_17_2_1_1623748120682_2369">
    <select class="custom-select
                   
                   " name="timeopen[day]" id="id_timeopen_day" disabled="disabled">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15" selected="">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
    </select>
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_timeopen_day">
        
    </div>
</div>
                &nbsp;
                <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2372">
        <label class="col-form-label sr-only" for="id_timeopen_month">
            Month
        </label>
    <span data-fieldtype="select" id="yui_3_17_2_1_1623748120682_2371">
    <select class="custom-select
                   
                   " name="timeopen[month]" id="id_timeopen_month" disabled="disabled">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6" selected="">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_timeopen_month">
        
    </div>
</div>
                &nbsp;
                <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2374">
        <label class="col-form-label sr-only" for="id_timeopen_year">
            Year
        </label>
    <span data-fieldtype="select" id="yui_3_17_2_1_1623748120682_2373">
    <select class="custom-select
                   
                   " name="timeopen[year]" id="id_timeopen_year" disabled="disabled">
        <option value="1900">1900</option>
        <option value="1901">1901</option>
        <option value="1902">1902</option>
        <option value="1903">1903</option>
        <option value="1904">1904</option>
        <option value="1905">1905</option>
        <option value="1906">1906</option>
        <option value="1907">1907</option>
        <option value="1908">1908</option>
        <option value="1909">1909</option>
        <option value="1910">1910</option>
        <option value="1911">1911</option>
        <option value="1912">1912</option>
        <option value="1913">1913</option>
        <option value="1914">1914</option>
        <option value="1915">1915</option>
        <option value="1916">1916</option>
        <option value="1917">1917</option>
        <option value="1918">1918</option>
        <option value="1919">1919</option>
        <option value="1920">1920</option>
        <option value="1921">1921</option>
        <option value="1922">1922</option>
        <option value="1923">1923</option>
        <option value="1924">1924</option>
        <option value="1925">1925</option>
        <option value="1926">1926</option>
        <option value="1927">1927</option>
        <option value="1928">1928</option>
        <option value="1929">1929</option>
        <option value="1930">1930</option>
        <option value="1931">1931</option>
        <option value="1932">1932</option>
        <option value="1933">1933</option>
        <option value="1934">1934</option>
        <option value="1935">1935</option>
        <option value="1936">1936</option>
        <option value="1937">1937</option>
        <option value="1938">1938</option>
        <option value="1939">1939</option>
        <option value="1940">1940</option>
        <option value="1941">1941</option>
        <option value="1942">1942</option>
        <option value="1943">1943</option>
        <option value="1944">1944</option>
        <option value="1945">1945</option>
        <option value="1946">1946</option>
        <option value="1947">1947</option>
        <option value="1948">1948</option>
        <option value="1949">1949</option>
        <option value="1950">1950</option>
        <option value="1951">1951</option>
        <option value="1952">1952</option>
        <option value="1953">1953</option>
        <option value="1954">1954</option>
        <option value="1955">1955</option>
        <option value="1956">1956</option>
        <option value="1957">1957</option>
        <option value="1958">1958</option>
        <option value="1959">1959</option>
        <option value="1960">1960</option>
        <option value="1961">1961</option>
        <option value="1962">1962</option>
        <option value="1963">1963</option>
        <option value="1964">1964</option>
        <option value="1965">1965</option>
        <option value="1966">1966</option>
        <option value="1967">1967</option>
        <option value="1968">1968</option>
        <option value="1969">1969</option>
        <option value="1970">1970</option>
        <option value="1971">1971</option>
        <option value="1972">1972</option>
        <option value="1973">1973</option>
        <option value="1974">1974</option>
        <option value="1975">1975</option>
        <option value="1976">1976</option>
        <option value="1977">1977</option>
        <option value="1978">1978</option>
        <option value="1979">1979</option>
        <option value="1980">1980</option>
        <option value="1981">1981</option>
        <option value="1982">1982</option>
        <option value="1983">1983</option>
        <option value="1984">1984</option>
        <option value="1985">1985</option>
        <option value="1986">1986</option>
        <option value="1987">1987</option>
        <option value="1988">1988</option>
        <option value="1989">1989</option>
        <option value="1990">1990</option>
        <option value="1991">1991</option>
        <option value="1992">1992</option>
        <option value="1993">1993</option>
        <option value="1994">1994</option>
        <option value="1995">1995</option>
        <option value="1996">1996</option>
        <option value="1997">1997</option>
        <option value="1998">1998</option>
        <option value="1999">1999</option>
        <option value="2000">2000</option>
        <option value="2001">2001</option>
        <option value="2002">2002</option>
        <option value="2003">2003</option>
        <option value="2004">2004</option>
        <option value="2005">2005</option>
        <option value="2006">2006</option>
        <option value="2007">2007</option>
        <option value="2008">2008</option>
        <option value="2009">2009</option>
        <option value="2010">2010</option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021" selected="">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
        <option value="2027">2027</option>
        <option value="2028">2028</option>
        <option value="2029">2029</option>
        <option value="2030">2030</option>
        <option value="2031">2031</option>
        <option value="2032">2032</option>
        <option value="2033">2033</option>
        <option value="2034">2034</option>
        <option value="2035">2035</option>
        <option value="2036">2036</option>
        <option value="2037">2037</option>
        <option value="2038">2038</option>
        <option value="2039">2039</option>
        <option value="2040">2040</option>
        <option value="2041">2041</option>
        <option value="2042">2042</option>
        <option value="2043">2043</option>
        <option value="2044">2044</option>
        <option value="2045">2045</option>
        <option value="2046">2046</option>
        <option value="2047">2047</option>
        <option value="2048">2048</option>
        <option value="2049">2049</option>
        <option value="2050">2050</option>
    </select>
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_timeopen_year">
        
    </div>
</div>
                &nbsp;
                <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2376">
        <label class="col-form-label sr-only" for="id_timeopen_hour">
            Hour
        </label>
    <span data-fieldtype="select" id="yui_3_17_2_1_1623748120682_2375">
    <select class="custom-select
                   
                   " name="timeopen[hour]" id="id_timeopen_hour" disabled="disabled">
        <option value="0">00</option>
        <option value="1">01</option>
        <option value="2">02</option>
        <option value="3">03</option>
        <option value="4">04</option>
        <option value="5">05</option>
        <option value="6">06</option>
        <option value="7">07</option>
        <option value="8">08</option>
        <option value="9">09</option>
        <option value="10" selected="">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
    </select>
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_timeopen_hour">
        
    </div>
</div>
                &nbsp;
                <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2378">
        <label class="col-form-label sr-only" for="id_timeopen_minute">
            Minute
        </label>
    <span data-fieldtype="select" id="yui_3_17_2_1_1623748120682_2377">
    <select class="custom-select
                   
                   " name="timeopen[minute]" id="id_timeopen_minute" disabled="disabled">
        <option value="0">00</option>
        <option value="1">01</option>
        <option value="2">02</option>
        <option value="3">03</option>
        <option value="4">04</option>
        <option value="5">05</option>
        <option value="6">06</option>
        <option value="7">07</option>
        <option value="8" selected="">08</option>
        <option value="9">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
        <option value="32">32</option>
        <option value="33">33</option>
        <option value="34">34</option>
        <option value="35">35</option>
        <option value="36">36</option>
        <option value="37">37</option>
        <option value="38">38</option>
        <option value="39">39</option>
        <option value="40">40</option>
        <option value="41">41</option>
        <option value="42">42</option>
        <option value="43">43</option>
        <option value="44">44</option>
        <option value="45">45</option>
        <option value="46">46</option>
        <option value="47">47</option>
        <option value="48">48</option>
        <option value="49">49</option>
        <option value="50">50</option>
        <option value="51">51</option>
        <option value="52">52</option>
        <option value="53">53</option>
        <option value="54">54</option>
        <option value="55">55</option>
        <option value="56">56</option>
        <option value="57">57</option>
        <option value="58">58</option>
        <option value="59">59</option>
    </select>
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_timeopen_minute">
        
    </div>
</div>
                &nbsp;
                <a name="timeopen[calendar]" href="#" id="id_timeopen_calendar" style="cursor: default;"><i class="icon fa fa-calendar fa-fw " title="Calendar" aria-label="Calendar"></i></a>
                &nbsp;
                <label data-fieldtype="checkbox" class="form-check  fitem  ">
<input type="checkbox" name="timeopen[enabled]" class="form-check-input " id="id_timeopen_enabled" value="1">
    Enable
</label>

<span class="form-control-feedback invalid-feedback" id="id_error_timeopen_enabled">
    
</span>
            </div>
        </fieldset>
        <div class="form-control-feedback invalid-feedback" id="id_error_timeopen">
            
        </div>
    </div>
</div><div id="fitem_id_timeclose" class="form-group row  fitem   " data-groupname="timeclose">
    <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                    <p id="id_timeclose_label" class="mb-0 word-break" aria-hidden="true" style="cursor: default;">
                Close the quiz
            </p>

        <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
            
        </div>
    </div>
    <div class="col-md-9 form-inline align-items-start felement" data-fieldtype="date_time_selector">
        <fieldset data-fieldtype="date_time" class="m-0 p-0 border-0" id="id_timeclose">
            <legend class="sr-only">Close the quiz</legend>
            <div class="fdate_time_selector d-flex flex-wrap align-items-center" id="yui_3_17_2_1_1623748120682_698">
                
                <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2380">
        <label class="col-form-label sr-only" for="id_timeclose_day">
            Day
        </label>
    <span data-fieldtype="select" id="yui_3_17_2_1_1623748120682_2379">
    <select class="custom-select
                   
                   " name="timeclose[day]" id="id_timeclose_day" disabled="disabled">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15" selected="">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
    </select>
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_timeclose_day">
        
    </div>
</div>
                &nbsp;
                <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2382">
        <label class="col-form-label sr-only" for="id_timeclose_month">
            Month
        </label>
    <span data-fieldtype="select" id="yui_3_17_2_1_1623748120682_2381">
    <select class="custom-select
                   
                   " name="timeclose[month]" id="id_timeclose_month" disabled="disabled">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6" selected="">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_timeclose_month">
        
    </div>
</div>
                &nbsp;
                <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2384">
        <label class="col-form-label sr-only" for="id_timeclose_year">
            Year
        </label>
    <span data-fieldtype="select" id="yui_3_17_2_1_1623748120682_2383">
    <select class="custom-select
                   
                   " name="timeclose[year]" id="id_timeclose_year" disabled="disabled">
        <option value="1900">1900</option>
        <option value="1901">1901</option>
        <option value="1902">1902</option>
        <option value="1903">1903</option>
        <option value="1904">1904</option>
        <option value="1905">1905</option>
        <option value="1906">1906</option>
        <option value="1907">1907</option>
        <option value="1908">1908</option>
        <option value="1909">1909</option>
        <option value="1910">1910</option>
        <option value="1911">1911</option>
        <option value="1912">1912</option>
        <option value="1913">1913</option>
        <option value="1914">1914</option>
        <option value="1915">1915</option>
        <option value="1916">1916</option>
        <option value="1917">1917</option>
        <option value="1918">1918</option>
        <option value="1919">1919</option>
        <option value="1920">1920</option>
        <option value="1921">1921</option>
        <option value="1922">1922</option>
        <option value="1923">1923</option>
        <option value="1924">1924</option>
        <option value="1925">1925</option>
        <option value="1926">1926</option>
        <option value="1927">1927</option>
        <option value="1928">1928</option>
        <option value="1929">1929</option>
        <option value="1930">1930</option>
        <option value="1931">1931</option>
        <option value="1932">1932</option>
        <option value="1933">1933</option>
        <option value="1934">1934</option>
        <option value="1935">1935</option>
        <option value="1936">1936</option>
        <option value="1937">1937</option>
        <option value="1938">1938</option>
        <option value="1939">1939</option>
        <option value="1940">1940</option>
        <option value="1941">1941</option>
        <option value="1942">1942</option>
        <option value="1943">1943</option>
        <option value="1944">1944</option>
        <option value="1945">1945</option>
        <option value="1946">1946</option>
        <option value="1947">1947</option>
        <option value="1948">1948</option>
        <option value="1949">1949</option>
        <option value="1950">1950</option>
        <option value="1951">1951</option>
        <option value="1952">1952</option>
        <option value="1953">1953</option>
        <option value="1954">1954</option>
        <option value="1955">1955</option>
        <option value="1956">1956</option>
        <option value="1957">1957</option>
        <option value="1958">1958</option>
        <option value="1959">1959</option>
        <option value="1960">1960</option>
        <option value="1961">1961</option>
        <option value="1962">1962</option>
        <option value="1963">1963</option>
        <option value="1964">1964</option>
        <option value="1965">1965</option>
        <option value="1966">1966</option>
        <option value="1967">1967</option>
        <option value="1968">1968</option>
        <option value="1969">1969</option>
        <option value="1970">1970</option>
        <option value="1971">1971</option>
        <option value="1972">1972</option>
        <option value="1973">1973</option>
        <option value="1974">1974</option>
        <option value="1975">1975</option>
        <option value="1976">1976</option>
        <option value="1977">1977</option>
        <option value="1978">1978</option>
        <option value="1979">1979</option>
        <option value="1980">1980</option>
        <option value="1981">1981</option>
        <option value="1982">1982</option>
        <option value="1983">1983</option>
        <option value="1984">1984</option>
        <option value="1985">1985</option>
        <option value="1986">1986</option>
        <option value="1987">1987</option>
        <option value="1988">1988</option>
        <option value="1989">1989</option>
        <option value="1990">1990</option>
        <option value="1991">1991</option>
        <option value="1992">1992</option>
        <option value="1993">1993</option>
        <option value="1994">1994</option>
        <option value="1995">1995</option>
        <option value="1996">1996</option>
        <option value="1997">1997</option>
        <option value="1998">1998</option>
        <option value="1999">1999</option>
        <option value="2000">2000</option>
        <option value="2001">2001</option>
        <option value="2002">2002</option>
        <option value="2003">2003</option>
        <option value="2004">2004</option>
        <option value="2005">2005</option>
        <option value="2006">2006</option>
        <option value="2007">2007</option>
        <option value="2008">2008</option>
        <option value="2009">2009</option>
        <option value="2010">2010</option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021" selected="">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
        <option value="2027">2027</option>
        <option value="2028">2028</option>
        <option value="2029">2029</option>
        <option value="2030">2030</option>
        <option value="2031">2031</option>
        <option value="2032">2032</option>
        <option value="2033">2033</option>
        <option value="2034">2034</option>
        <option value="2035">2035</option>
        <option value="2036">2036</option>
        <option value="2037">2037</option>
        <option value="2038">2038</option>
        <option value="2039">2039</option>
        <option value="2040">2040</option>
        <option value="2041">2041</option>
        <option value="2042">2042</option>
        <option value="2043">2043</option>
        <option value="2044">2044</option>
        <option value="2045">2045</option>
        <option value="2046">2046</option>
        <option value="2047">2047</option>
        <option value="2048">2048</option>
        <option value="2049">2049</option>
        <option value="2050">2050</option>
    </select>
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_timeclose_year">
        
    </div>
</div>
                &nbsp;
                <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2386">
        <label class="col-form-label sr-only" for="id_timeclose_hour">
            Hour
        </label>
    <span data-fieldtype="select" id="yui_3_17_2_1_1623748120682_2385">
    <select class="custom-select
                   
                   " name="timeclose[hour]" id="id_timeclose_hour" disabled="disabled">
        <option value="0">00</option>
        <option value="1">01</option>
        <option value="2">02</option>
        <option value="3">03</option>
        <option value="4">04</option>
        <option value="5">05</option>
        <option value="6">06</option>
        <option value="7">07</option>
        <option value="8">08</option>
        <option value="9">09</option>
        <option value="10" selected="">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
    </select>
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_timeclose_hour">
        
    </div>
</div>
        &nbsp;
    <div class="form-group  fitem">
    <label class="col-form-label sr-only" for="id_timeclose_minute">Minute</label>
    <span data-fieldtype="select">
    <select class="custom-select
        " name="timeclose[minute]" id="id_timeclose_minute" disabled="disabled">
        <option value="0">00</option>
        <option value="1">01</option>
        <option value="2">02</option>
        <option value="3">03</option>
        <option value="4">04</option>
        <option value="5">05</option>
        <option value="6">06</option>
        <option value="7">07</option>
        <option value="8" selected="">08</option>
        <option value="9">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
        <option value="32">32</option>
        <option value="33">33</option>
        <option value="34">34</option>
        <option value="35">35</option>
        <option value="36">36</option>
        <option value="37">37</option>
        <option value="38">38</option>
        <option value="39">39</option>
        <option value="40">40</option>
        <option value="41">41</option>
        <option value="42">42</option>
        <option value="43">43</option>
        <option value="44">44</option>
        <option value="45">45</option>
        <option value="46">46</option>
        <option value="47">47</option>
        <option value="48">48</option>
        <option value="49">49</option>
        <option value="50">50</option>
        <option value="51">51</option>
        <option value="52">52</option>
        <option value="53">53</option>
        <option value="54">54</option>
        <option value="55">55</option>
        <option value="56">56</option>
        <option value="57">57</option>
        <option value="58">58</option>
        <option value="59">59</option>
    </select>
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_timeclose_minute">
        
    </div>
</div>
                &nbsp;
                <a name="timeclose[calendar]" href="#" id="id_timeclose_calendar" style="cursor: default;"><i class="icon fa fa-calendar fa-fw " title="Calendar" aria-label="Calendar"></i></a>
                &nbsp;
                <label data-fieldtype="checkbox" class="form-check  fitem  ">
<input type="checkbox" name="timeclose[enabled]" class="form-check-input " id="id_timeclose_enabled" value="1">
    Enable
</label>

<span class="form-control-feedback invalid-feedback" id="id_error_timeclose_enabled">
    
</span>
            </div>
        </fieldset>
        <div class="form-control-feedback invalid-feedback" id="id_error_timeclose">
            
        </div>
    </div>
</div><div id="fitem_id_timelimit" class="form-group row  fitem   " data-groupname="timelimit">
    <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                    <p id="id_timelimit_label" class="mb-0 word-break" aria-hidden="true" style="cursor: default;">
                Time limit
            </p>

        <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
            <a class="btn btn-link p-0" role="button" data-container="body" data-toggle="popover" data-placement="right" data-content="<div class=&quot;no-overflow&quot;><p>If enabled, the time limit is stated on the initial quiz page and a countdown timer is displayed in the quiz navigation block.</p>
</div> <div class=&quot;helpdoclink&quot;><a href=&quot;http://docs.moodle.org/311/en/mod/quiz/timing&quot;><i class=&quot;icon fa fa-info-circle fa-fw iconhelp icon-pre&quot; aria-hidden=&quot;true&quot;  ></i>More help</a></div>" data-html="true" tabindex="0" data-trigger="focus">
  <i class="icon fa fa-question-circle text-info fa-fw " title="Help with Time limit" aria-label="Help with Time limit"></i>
</a>
        </div>
    </div>
    <div class="col-md-9 form-inline align-items-start felement" data-fieldtype="duration">
        <fieldset class="w-100 m-0 p-0 border-0">
            <legend class="sr-only">Time limit</legend>
            <div class="d-flex flex-wrap align-items-center">
                
                <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2397">
        <label class="col-form-label sr-only" for="id_timelimit_number">
            Time
        </label>
    <span data-fieldtype="text" id="yui_3_17_2_1_1623748120682_2396">
    <input type="text" class="form-control " name="timelimit[number]" id="id_timelimit_number" value="0" size="3" disabled="disabled">
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_timelimit_number">
        
    </div>
</div>
                &nbsp;
                <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2399">
        <label class="col-form-label sr-only" for="id_timelimit_timeunit">
            Time unit
        </label>
    <span data-fieldtype="select" id="yui_3_17_2_1_1623748120682_2398">
    <select class="custom-select
                   
                   " name="timelimit[timeunit]" id="id_timelimit_timeunit" disabled="disabled">
        <option value="604800">weeks</option>
        <option value="86400">days</option>
        <option value="3600">hours</option>
        <option value="60" selected="">minutes</option>
        <option value="1">seconds</option>
    </select>
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_timelimit_timeunit">
        
    </div>
</div>
                &nbsp;
                <label data-fieldtype="checkbox" class="form-check  fitem  ">
<input type="checkbox" name="timelimit[enabled]" class="form-check-input " id="id_timelimit_enabled" value="1">
    Enable
</label>

<span class="form-control-feedback invalid-feedback" id="id_error_timelimit_enabled">
    
</span>
            </div>
        </fieldset>
        <div class="form-control-feedback invalid-feedback" id="id_error_timelimit">
            
        </div>
    </div>
</div><div id="fitem_id_overduehandling" class="form-group row  fitem   ">
    <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
        
                <label class="d-inline word-break " for="id_overduehandling">
                    When time expires
                </label>
        
        <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
            <a class="btn btn-link p-0" role="button" data-container="body" data-toggle="popover" data-placement="right" data-content="<div class=&quot;no-overflow&quot;><p>This setting controls what happens if a student fails to submit their quiz attempt before the time expires. If the student is actively working on the quiz at the time, then the countdown timer will always automatically submit the attempt for them, but if they have logged out, then this setting controls what happens.</p>
</div> <div class=&quot;helpdoclink&quot;><a href=&quot;http://docs.moodle.org/311/en/mod/quiz/timing&quot;><i class=&quot;icon fa fa-info-circle fa-fw iconhelp icon-pre&quot; aria-hidden=&quot;true&quot;  ></i>More help</a></div>" data-html="true" tabindex="0" data-trigger="focus">
  <i class="icon fa fa-question-circle text-info fa-fw " title="Help with When time expires" aria-label="Help with When time expires"></i>
</a>
        </div>
    </div>
    <div class="col-md-9 form-inline align-items-start felement" data-fieldtype="select">
        <select class="custom-select   
            " name="overduehandling" id="id_overduehandling">
            <option value="autosubmit">Open attempts are submitted automatically</option>
            <option value="graceperiod">There is a grace period when open attempts can be submitted, but no more questions answered</option>
            <option value="autoabandon" selected="">Attempts must be submitted before time expires, or they are not counted</option>
        </select>
        <div class="form-control-feedback invalid-feedback" id="id_error_overduehandling"></div>
    </div>
</div><div id="fitem_id_graceperiod" class="form-group row  fitem   " data-groupname="graceperiod" hidden="hidden" style="display: none;">
<div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
    <p id="id_graceperiod_label" class="mb-0 word-break" aria-hidden="true" style="cursor: default;">Submission grace period</p>
    <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
    <a class="btn btn-link p-0" role="button" data-container="body" data-toggle="popover" data-placement="right" data-content="<div class=&quot;no-overflow&quot;><p>If what to do when the time expires is set to 'There is a grace period...', then this is the amount of extra time that is allowed.</p>
    </div> " data-html="true" tabindex="0" data-trigger="focus">
    <i class="icon fa fa-question-circle text-info fa-fw " title="Help with Submission grace period" aria-label="Help with Submission grace period"></i>
    </a>
    </div>
    </div>
    <div class="col-md-9 form-inline align-items-start felement" data-fieldtype="duration">
        <fieldset class="w-100 m-0 p-0 border-0">
            <legend class="sr-only">Submission grace period</legend>
            <div class="d-flex flex-wrap align-items-center">
            <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2433" hidden="hidden" style="display: none;">
        <label class="col-form-label sr-only" for="id_graceperiod_number" hidden="hidden" style="display: none;">Time</label>
        <span data-fieldtype="text" id="yui_3_17_2_1_1623748120682_2432">
            <input type="text" class="form-control " name="graceperiod[number]" id="id_graceperiod_number" value="1" size="3" disabled="disabled">
        </span>
        <div class="form-control-feedback invalid-feedback" id="id_error_graceperiod_number"></div>
    </div>
    &nbsp;
    <div class="form-group  fitem  " id="yui_3_17_2_1_1623748120682_2435" hidden="hidden" style="display: none;">
    <label class="col-form-label sr-only" for="id_graceperiod_timeunit" hidden="hidden" style="display: none;">
    Time unit
    </label>
    <span data-fieldtype="select" id="yui_3_17_2_1_1623748120682_2434">
    <select class="custom-select   
        " name="graceperiod[timeunit]" id="id_graceperiod_timeunit" disabled="disabled">
        <option value="604800">weeks</option>
        <option value="86400" selected="">days</option>
        <option value="3600">hours</option>
        <option value="60">minutes</option>
        <option value="1">seconds</option>
    </select>
    </span>
    <div class="form-control-feedback invalid-feedback" id="id_error_graceperiod_timeunit"></div>
</div>
    &nbsp;
    <label data-fieldtype="checkbox" class="form-check  fitem  " id="yui_3_17_2_1_1623748120682_2436" hidden="hidden" style="display: none;">
<input type="checkbox" name="graceperiod[enabled]" class="form-check-input " id="id_graceperiod_enabled" value="1" checked="" disabled="disabled">Enable</label>
<span class="form-control-feedback invalid-feedback" id="id_error_graceperiod_enabled"></span>
</div>
</fieldset>
    <div class="form-control-feedback invalid-feedback" id="id_error_graceperiod"></div>
</div>
</div>
</div>
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    GRADE
                                </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    QUESTION BEHAVIOR
                                </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                   OVERALL FEEDBACK
                                </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    COMMON MODULE SETTING
                                </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    RESTRICT SETTING
                                </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    ACTIVITY COMPLETION
                                </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    TAGS
                                </button>
                                </h2>
                                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                    GRADE
                                </button>
                                </h2>
                                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="reset" class="btn btn-success mr-2">Save</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <button type="reset" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(function () {
  $('[data-bs-toggle="popover"]').popover()
})
</script>