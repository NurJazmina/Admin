<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$GoNGetzConnectionString="mongodb://admin:TempPassword@51.79.173.45:27017/gngoffice?authSource=admin";
$GoNGetzDatabase = new MongoDB\Driver\Manager($GoNGetzConnectionString);
$apiSession = $_GET['api_session'];

if(isset($_GET['is_mobile']) && !is_null($_GET['is_mobile']))
{
    $_SESSION['is_mobile'] = true;
    
    $filter = ['ConsumerToken'=>$apiSession];
    $option = ['limit' => 1];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
        $_SESSION['api_session'] = $apiSession;
        $_SESSION["loggeduser_id"] = strval($document->_id);
        $_SESSION["loggeduser_consumerFName"] = $document->ConsumerFName;
        $_SESSION["loggeduser_consumerLName"] = $document->ConsumerLName;
        $_SESSION["loggeduser_consumerIDType"] = $document->ConsumerIDType;
        $_SESSION["loggeduser_consumerIDNo"] = $document->ConsumerIDNo;
        $_SESSION["loggeduser_consumerEmail"] = $document->ConsumerEmail;
        $_SESSION["loggeduser_consumerPhone"] = $document->ConsumerPhone;
        $_SESSION["loggeduser_consumerAddress"] = $document->ConsumerAddress;
        $_SESSION["loggeduser_consumerPostcode"] = $document->ConsumerPostcode;
        $_SESSION["loggeduser_consumerCity"] = $document->ConsumerCity;
        $_SESSION["loggeduser_consumerState"] = $document->ConsumerState;
        $_SESSION["loggeduser_consumerStatus"] = $document->ConsumerStatus;
        $_SESSION["loggeduser_ConsumerGroup_id"] = $document->ConsumerGroup_id;
        $_SESSION["loggeduser_ConsumerPassword"] = $document->ConsumerPassword;

        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_ConsumerGroup_id"])];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.ConsumerGroup',$query);
        foreach ($cursor as $document)
        {
            $_SESSION["loggeduser_ConsumerGroupName"] = $document->ConsumerGroupName;
        }

        $filter = ['ConsumerID'=>$_SESSION["loggeduser_id"]];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
        foreach ($cursor as $document)
        {
            $_SESSION["loggeduser_teacherid"] = strval($document->_id);
            $_SESSION["loggeduser_school_id"] = $document->SchoolID;
            $_SESSION["loggeduser_StaffLevel"] = $document->StaffLevel;
            $_SESSION["loggeduser_ConsumerID"] = $document->ConsumerID;
            $_SESSION["loggeduser_class_id"] = $document->ClassID;
            $_SESSION["loggeduser_Staffdepartment"] = $document->Staffdepartment;
            
            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_school_id"])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
            foreach ($cursor as $document)
            {
                $_SESSION["loggeduser_school_id"] = strval($document->_id);
                $_SESSION["loggeduser_schoolName"] = $document->SchoolsName;
                $_SESSION["loggeduser_schoolsPhoneNo"] = $document->SchoolsPhoneNo;
                $_SESSION["loggeduser_schoolsAddress"] = $document->SchoolsAddress;
                $_SESSION["loggeduser_SchoolsEmail"] = $document->SchoolsEmail;
            }

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_Staffdepartment"])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
            foreach ($cursor as $document)
            {
                $_SESSION["loggeduser_DepartmentName"] = $document->DepartmentName;
            }
        }

        $filter = ['Consumer_id'=>$_SESSION["loggeduser_id"]];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
        foreach ($cursor as $document)
        {
            $_SESSION["loggeduser_studentid"] = strval($document->_id);
            $_SESSION["loggeduser_Schools_id"] = $document->Schools_id;
            $_SESSION["loggeduser_class_id"] = $document->Class_id;

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_Schools_id"])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
            foreach ($cursor as $document)
            {
                $_SESSION["loggeduser_school_id"] = strval($document->_id);
                $_SESSION["loggeduser_schoolName"] = $document->SchoolsName;
                $_SESSION["loggeduser_schoolsPhoneNo"] = $document->SchoolsPhoneNo;
                $_SESSION["loggeduser_schoolsAddress"] = $document->SchoolsAddress;
                $_SESSION["loggeduser_SchoolsEmail"] = $document->SchoolsEmail;
            }
            
            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_class_id"])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
            foreach ($cursor as $document)
            {
                $_SESSION["loggeduser_ClassCategory"] = $document->ClassCategory;
                $_SESSION["loggeduser_ClassName"] = $document->ClassName;
            }

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_class_id"])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
            foreach ($cursor as $document)
            {
                $_SESSION["loggeduser_Subject_id"] = $document->Subject_id;
            }

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_Subject_id"])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
            foreach ($cursor as $document)
            {
                $_SESSION["loggeduser_SubjectName"] = $document->SubjectName;
                $_SESSION["loggeduser_Class_category"] = $document->Class_category;
            }
        }

        if($_SESSION["loggeduser_ConsumerGroupName"] == 'SCHOOL')
        {
            if($_SESSION["loggeduser_StaffLevel"] == '1')
            {
                $_SESSION["loggeduser_ACCESS"] = "STAFF";
            }
            elseif ($_SESSION["loggeduser_StaffLevel"] == '0')
            {
                $_SESSION["loggeduser_ACCESS"] = "TEACHER";
            }
        }
        elseif ($_SESSION["loggeduser_ConsumerGroupName"] == 'GONGETZ')
        {
            $_SESSION["loggeduser_ACCESS"] = "STAFF";
            $_SESSION["loggeduser_teacherid"] = '';
            $_SESSION["loggeduser_school_id"] = '';
            $_SESSION["loggeduser_StaffLevel"] = '';
            $_SESSION["loggeduser_ConsumerID"] = '';
            $_SESSION["loggeduser_class_id"] = '';
            $_SESSION["loggeduser_Staffdepartment"] = '';
            $_SESSION["loggeduser_DepartmentName"] = '';
        }
        elseif ($_SESSION["loggeduser_ConsumerGroupName"] == 'STUDENT')
        {
            $_SESSION["loggeduser_ACCESS"] = "STUDENT";
        }
        header ('location: index.php?page=dashboard&action=loginsuccesful');
    }
}