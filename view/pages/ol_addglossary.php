<?php
$_SESSION["title"] = "Add Glossary";
include 'view/partials/_subheader/subheader-v1.php'; 
include ('model/glossary.php');
$Subject_id = $_GET['Subject'];
$Submitfrom = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
$Submitfrom = $Submitfrom->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
$Submitfrom = date_format($Submitfrom,"Y-m-d\TH:i:s");
$Due = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 week'))->getTimestamp()*1000);
$Due = $Due->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
$Due = date_format($Due,"Y-m-d\TH:i:s");
?>
<div class="content d-flex flex-column flex-column-fluid">
    <div class="card card-custom gutter-b px-5">
        <div class="card-body">
            <p>Find or add here characters from City of God and La Haine. Definitions here so far have either been generated  by former students or taken from the Wikipedia page.</p>
            <h6>TO IMPORT ENTRIES INTO YOUR OWN VERSION OF THIS COURSE,CLICK HERE TO GET THE XML FILE</h6>
            <div class="separator separator-dashed my-10"></div>
            <div class="glossarydisplay">
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                    <a class="nav-link active" title="Browse by alphabet">Browse by alphabet</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="" title="Browse by category">Browse by category</a>
                    </li>
                </ul>
                <div class="entrybox">
                <div class="glossaryexplain">Browse the glossary using this index</div><br>
                    <a title="Shows entries that do not begin with a letter" href="">Special</a> | 
                    <a href="">A</a> | 
                    <a href="">B</a> | 
                    <a href="">C</a> | 
                    <a href="">D</a> | 
                    <a href="">E</a> | 
                    <a href="">F</a> | 
                    <a href="">G</a> | 
                    <a href="">H</a> | 
                    <a href="">I</a> | 
                    <a href="">J</a> | 
                    <a href="">K</a> | 
                    <a href="">L</a> | 
                    <a href="">M</a> | 
                    <a href="">N</a> | 
                    <a href="">O</a> | 
                    <a href="">P</a> | 
                    <a href="">Q</a> | 
                    <a href="">R</a> | 
                    <a href="">S</a> | 
                    <a href="">T</a> | 
                    <a href="">U</a> | 
                    <a href="">V</a> | 
                    <a href="">W</a> | 
                    <a href="">X</a> | 
                    <a href="">Y</a> | 
                    <a href="">Z</a> |  
                    <b>ALL</b>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="paging">
                        <div style="text-align:center">
                            <p>Page:&nbsp;&nbsp;<b>1</b>&nbsp;&nbsp;
                                <a href="">2</a>&nbsp;&nbsp;
                                <a href="">3</a>&nbsp;&nbsp;(
                                <a href="">Next</a>)<br>&nbsp;&nbsp;
                                <a href="">ALL</a>
                            </p>
                        </div>
                    </div>
                    <div>
                        <table  class="table table-borderless">
                            <tbody>
                                <tr class="text-center">
                                    <th>
                                        <h3>A</h3>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <table  class="table table-borderless">
                        <tbody>
                            <tr valign="top" class="text-left">
                                <td class="entry">
                                <div class="concept">
                                    <h4>Angélica</h4></div> 
                                <div class="no-overflow"><p>
                                <span>An old friend and love interest of <a href=""></i></a></span>
                                </td>
                            </tr>
                            <tr valign="top" class="text-left">
                                <td>
                                    <div class="form-group row">
                                        <label for="keyword" class="col-sm-2 col-form-label">Keyword(s): </label>
                                        <div class="col-sm-2">
                                            <select id="keyword" class="form-control">
                                                <option>City of </option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr valign="top" class="text-right">
                                <td class="icons">
                                    <span class="commands">
                                        <a title="Entry link: Angélica" class="icon" href="">
                                            <i class="icon fa fa-link fa-fw " title="Entry link: Angélica" aria-label="Entry link: Angélica"></i>
                                        </a>
                                        <a class="icon" title="Delete" href="deleteentry.php?id=75&amp;mode=delete&amp;entry=13061&amp;prevmode=letter&amp;hook=ALL">
                                            <i class="icon fa fa-trash fa-fw " title="Delete entry: Angélica" aria-label="Delete entry: Angélica"></i>
                                        </a>
                                        <a class="icon" title="Edit" href="edit.php?cmid=75&amp;id=13061&amp;mode=letter&amp;hook=ALL">
                                            <i class="icon fa fa-cog fa-fw " title="Edit entry: Angélica" aria-label="Edit entry: Angélica"></i>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <hr>
            </div>
        </div>
    </div>
</div>