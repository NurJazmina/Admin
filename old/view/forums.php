<style>
.topic {
    border-color: #fff;
    color:#687a86;
    background-color: transparent;
}
</style>
<div><br><br><br><h1 style="color:#696969; text-align:center">Forums</h1></div><br>

<div class="row" >
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
    <div class="col-md-10 section-1-box wow fadeInUp">
        <div class="card">
            <div class="card-header">
                <strong>SCHOOL</strong>
            </div>
            <!--SCHOOL-->
            <?php
            if ($_SESSION["loggeduser_ConsumerGroup_id"]=='601b4cfd97728c027c01f187')
            {
            ?>
            <div class="card-body">
                <div class="table-responsive-sm" style="line-height: 80%;">
                    <a class="topic" href="index.php?page=schoolforum&forum=<?php echo "1"; ?>&topic=<?php echo "general" ?>">General</a><br><br>
                    <a class="topic" href="index.php?page=schoolforum&forum=<?php echo "2"; ?>&topic=<?php echo "proposal" ?>">Proposal</a><br><br>
                    <a class="topic" href="index.php?page=schoolforum&forum=<?php echo "3"; ?>&topic=<?php echo "short news / info" ?>">Short News / Info</a><br><br>
                </div>
            </div>
            <?php
            }
            ?>
        </div><br>

        <div class="card">
            <div class="card-header">
                <strong>PUBLIC</strong>
            </div>

            <div class="card-body">
                <div class="table-responsive-sm">
                    <a class="topic" href="index.php?page=publicforum&forum=<?php echo "4"; ?>&topic=<?php echo "general" ?>">General</a><br><br>
                    <a class="topic" href="index.php?page=publicforum&forum=<?php echo "5"; ?>&topic=<?php echo "proposal" ?>">Proposal</a><br><br>
                    <a class="topic" href="index.php?page=publicforum&forum=<?php echo "6"; ?>&topic=<?php echo "short news / info" ?>">Short News / Info</a><br><br>
                </div>
            </div>
        </div><br>
    </div>
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>