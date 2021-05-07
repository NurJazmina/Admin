<?php
$_SESSION["title"] = "Forums";
include 'view/partials/_subheader/subheader-v1.php'; 
include 'model/forums.php';
?>
<style>
.topic {
    border-color: #fff;
    color:#687a86;
    background-color: transparent;
}
</style>
<div><br><br><br><h1 style="color:#696969; text-align:center">Forums</h1></div><br>

<div class="row" >
    <div class="col-md-0 section-1-box wow fadeInUp"></div>
    <div class="col-md-10 section-1-box wow fadeInUp">
    <?php
    if ($_SESSION["loggeduser_ConsumerGroup_id"]=='601b4cfd97728c027c01f187' || $_SESSION["loggeduser_ConsumerGroup_id"] =='601b4f1697728c027c01f188')
    {
    ?>
        <div class="card">
            <div class="card-header">
                <strong>SCHOOL</strong>
            </div>
            <!--SCHOOL-->
            <div class="card-body">
            <div class="table-responsive-sm" style="line-height: 100%;">
                <a class="topic" href="index.php?page=schoolforum&forum=<?php echo "1"; ?>&topic=<?php echo "general" ?>">General</a><br><br>
                <a class="topic" href="index.php?page=schoolforum&forum=<?php echo "2"; ?>&topic=<?php echo "proposal" ?>">Proposal</a><br><br>
                <a class="topic" href="index.php?page=schoolforum&forum=<?php echo "3"; ?>&topic=<?php echo "short news / info" ?>">Short News / Info</a><br><br>
            </div>
            </div>
        </div>
    <?php
    }
    ?>
        <br>

        <div class="card">
            <div class="card-header">
                <strong>PUBLIC</strong>
            </div>

            <div class="card-body">
                <div class="table-responsive-sm" style="line-height: 100%;">
                    <a class="topic" href="index.php?page=publicforum&forum=<?php echo "4"; ?>&topic=<?php echo "general" ?>">General</a><br><br>
                    <a class="topic" href="index.php?page=publicforum&forum=<?php echo "5"; ?>&topic=<?php echo "proposal" ?>">Proposal</a><br><br>
                    <a class="topic" href="index.php?page=publicforum&forum=<?php echo "6"; ?>&topic=<?php echo "short news / info" ?>">Short News / Info</a><br><br>
                </div>
            </div>
        </div><br>
    </div>
    <div class="col-md-2 section-1-box wow fadeInUp">
    <div class="card">
    <div class="card-header">
                <strong>Details</strong>
            </div>
            <div class="card-body">
                <div class="spacing-right">
                <div class="padding-gutter">
                    <div class="guidelines expanded" data-role="guidelines">
                    <p class="spacing-bottom">The following are not allowed on SmartSchool:</p>

                    <ol class="list-num spacing-bottom">
                    <li>Targeted harassment or encouraging others</li>
                    <li>Spam</li>
                    <li>Impersonation</li>
                    <li>Direct threat of harm</li>
                    <li>Posting personally identifiable information</li>
                    <li>Inappropriate profile content</li>
                    </ol>

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <a class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Show guidelines
                        </button>
                        </a>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                        <p><strong>Targeted harassment or encouraging others to do so</strong></p>
                        <p class="spacing-bottom">The targeted and systematic harassment of people has no place on SmartSchool, nor do we tolerate communities dedicated to fostering harassing behavior.</p>

                        <p><strong>Spam</strong></p>
                        <p class="spacing-bottom">Examples include 1) comments posted in large quantities to promote a product or service, 2) the exact same comment posted repeatedly to disrupt a thread. 3) following users multiple times</p>

                        <p><strong>Impersonation</strong></p>
                        <p class="spacing-bottom">You may not impersonate others in a manner that does or is intended to mislead, confuse, or deceive others.</p>

                        <p><strong>Direct threat of harm</strong></p>
                        <p class="spacing-bottom">This covers active threats of harm directed towards a specific person or defined group of individuals. Contact local authorities if you feel a crime has been committed or is imminent.</p>

                        <p><strong>Posting personally identifiable information</strong></p>
                        <p class="spacing-bottom">Examples of protected information: credit card number, home/work address, phone number, email address, social security number. Real name isn't currently covered.</p>

                        <p><strong>Inappropriate profile content</strong></p>
                        <p class="spacing-bottom">Graphic media containing violence and pornographic content are not allowed. Profile content allowed by SmartSchool may not be allowed on all communitie, so report such profiles to the site moderator.</p>

                        <p class="spacing-bottom">Read the <a href="#">Basic Rules</a>.</p>
                        </div>

                        </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
                </div>
            </div>
            </div>
    </div>
    </div>
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>