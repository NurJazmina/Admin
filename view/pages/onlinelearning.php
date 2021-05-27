<?php
$_SESSION["title"] = "Online learning";
include 'view/partials/_subheader/subheader-v1.php'; 
?>
<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label"> Notes </div>
        </div>
    </div>
    <div class="row">
        <?php
        $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Note_sort'=>1];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OnlineLearningNotes',$query);
        foreach ($cursor as $document)
        {
            $Subject_id = $document->Subject_id;
            $Title = $document->Title;
            $Detail = $document->Detail;
            $Created_by = $document->Created_by;
            $Edited_by = $document->Edited_by;

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
            foreach ($cursor as $document)
            {
                $SubjectName = $document->SubjectName;
            }
            ?>
            <div class="col-lg-4">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                    <div class="card-header">
                        <div class="card-title">
                        <a href="index.php?page=notes"><?php echo $SubjectName; ?></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="claimedRight"><?php echo $Title; ?> <br> <?php echo $Detail; ?></div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
        <?php
        }
        ?>
    </div>
</div>

<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Exercises and quiz </div>
    </div>
    <div class="row">
        <?php
        $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OnlineLearningNotes',$query);
        foreach ($cursor as $document)
        {
            $Subject_id = $document->Subject_id;
            $Note_sort = $document->Note_sort;

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
            foreach ($cursor as $document)
            {
                $SubjectName = $document->SubjectName;
            }

            $filter = ['Subject_id'=>$Subject_id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OnlineLearningQuestions',$query);
            foreach ($cursor as $document)
            {
                $Question_id = $document->_id;
                $Question_type = $document->Question_type;
                $Questions = $document->Questions;
                $Option_A = $document->Option_A;
                $Option_B = $document->Option_B;
                $Option_C = $document->Option_C;
                $Option_D = $document->Option_D;
                $Date_end = $document->Date_end;
                $Date_start = $document->Date_start;
            }
        }
        ?>
        <div class="col-lg-4">
            <!--begin::Card-->
            <div class="card card-custom card-stretch">
                <div class="card-header">
                    <div class="card-title">
                        <a href="index.php?page=notes"><?php echo $SubjectName; ?></a>
                    </div>
                </div>
                <div class="menu-section" style="border-bottom: 1px solid #eceef7; margin-top: 12px; padding-top: 12px;">
                    <div class="card-title" align="center">
                        <a><?php echo "SLOT : ".$Note_sort; ?></a>
                    </div>
                </div>
                <div class="card-body">
                <a href="index.php?page=notes&id=<?php echo $Question_id ; ?>"><?php echo $Question_type; ?> <br> <?php echo $Questions; ?></a>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <?php
        
        ?>
    </div>
</div>
