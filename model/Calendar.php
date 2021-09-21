<?php
if (isset($_POST['add_calendar']))
{
  $consumer_id = $_SESSION["loggeduser_id"];
  $title = $_POST['title'];
  $detail = $_POST['detail'];
  $venue = $_POST['venue'];
  $date_start = $_POST['date_start'];
  $date_end = $_POST['date_end'];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert([
                'Created_by'=>$consumer_id,
                'Title'=> $title,
                'Detail'=>$detail,
                'Venue'=> $venue,
                'Date_start'=> new MongoDB\BSON\UTCDateTime(new DateTime($date_start)),
                'Date_end'=> new MongoDB\BSON\UTCDateTime(new DateTime($date_end)),
                ]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Calendar', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError())
    {
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }
    // Check if any write operations did not complete at all
    foreach ($result->getWriteErrors() as $writeError)
    {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
  }
  catch (MongoDB\Driver\Exception\Exception $e)
  {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
  printf("Inserted %d document(s)\n", $result->getInsertedCount());
}

if (isset($_POST['edit_calendar']))
{
    $consumer_id = $_SESSION["loggeduser_id"];
    $calendar_id = $_POST['calendar_id'];
    $title = $_POST['title'];
    $detail = $_POST['detail'];
    $venue = $_POST['venue'];
    $date_start = $_POST['date_start'];
    $date_end = $_POST['date_end'];

    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($calendar_id)],
                    ['$set' => 
                    [
                        'Title'=>$title,
                        'Detail'=>$detail,
                        'Venue'=>$venue,
                        'Date_start'=> new MongoDB\BSON\UTCDateTime(new DateTime($date_start)),
                        'Date_end'=> new MongoDB\BSON\UTCDateTime(new DateTime($date_end))
                    ]
                    ]
                );
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    try
    {
        $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Calendar', $bulk, $writeConcern);
    }
    catch (MongoDB\Driver\Exception\BulkWriteException $e)
    {
        $result = $e->getWriteResult();
        // Check if the write concern could not be fulfilled
        if ($writeConcernError = $result->getWriteConcernError())
        {
            printf("%s (%d): %s\n",
                $writeConcernError->getMessage(),
                $writeConcernError->getCode(),
                var_export($writeConcernError->getInfo(), true)
            );
        }
        // Check if any write operations did not complete at all
        foreach ($result->getWriteErrors() as $writeError)
        {
            printf("Operation#%d: %s (%d)\n",
                $writeError->getIndex(),
                $writeError->getMessage(),
                $writeError->getCode()
            );
        }
    }
    catch (MongoDB\Driver\Exception\Exception $e)
    {
        printf("Other error: %s\n", $e->getMessage());
        exit;
    }
    printf("Matched: %d\n", $result->getMatchedCount());
    printf("Updated  %d document(s)\n", $result->getModifiedCount());
}


if (isset($_POST['delete_calendar']))
{
    $calendar_id = $_POST['calendar_id'];
    $password = $_POST['password'];
    $password_hash = $_SESSION["loggeduser_ConsumerPassword"];

    if (password_verify($password, $password_hash))
    {
        //database calendar
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->delete(['_id'=>new \MongoDB\BSON\ObjectID($calendar_id)],['limit' => 1]);
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Calendar', $bulk, $writeConcern);
    }
}

if (isset($_GET['paging']) && !empty($_GET['paging']))
{
    $next = $_GET['paging']+1;
    $previous = $_GET['paging']-1;
}
else
{
    $next = + 1;
    $previous = - 1;
}
if (isset($_GET['paging']) && !empty($_GET['paging']))
{
    $date_paging = new MongoDB\BSON\UTCDateTime((new DateTime('first day of '.$_GET['paging'].' month'))->getTimestamp()*1000);
    $date_paging_datetime = $date_paging->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $date_paging = date_format($date_paging_datetime,"Y-m-d");
    $date_paging_header = date_format($date_paging_datetime,"F Y");
}
elseif ($_GET['paging'] == 0)
{
    $date_paging = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
    $date_paging_datetime = $date_paging->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $date_paging = date_format($date_paging_datetime,"Y-m-d");
    $date_paging_header = date_format($date_paging_datetime,"F Y");
}
$calendar = new Calendar($date_paging);

// default date start $ date end
$default_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
$default_date = $default_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
$default_date = date_format($default_date,"Y-m-d\TH:i:s");

$filter = ['Created_by'=>$_SESSION["loggeduser_id"]];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Calendar',$query);
foreach ($cursor as $document)
{
    $calendar_id = strval($document->_id);
    $Title = $document->Title;
    $Date_start = strval($document->Date_start);
    $Date_end = strval($document->Date_end);

    $Date_start = new MongoDB\BSON\UTCDateTime($Date_start);
    $Datetime_Start = $Date_start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $Date_start = date_format($Datetime_Start,"Y-m-d");

    $Date_end = new MongoDB\BSON\UTCDateTime($Date_end);
    $Datetime_End = $Date_end->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $Date_end = date_format($Datetime_End,"Y-m-d");

    $date1 = date_create($Date_start);
    
    $date2 = date_create($Date_end);

    //difference between two dates
    $diff = date_diff($date1,$date2);
    $diff = $diff->format("%a");

    $calendar->add_event(mb_strimwidth($Title, 0,9, ".."), $Date_start,$diff + 1, $calendar_id);
}

class Calendar {

    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    public function add_event($txt, $date, $days = 1, $id) {
        // $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $id];
    }

    public function __toString() {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar2">';
        $html .= '<div class="days">';
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        } 
        ?>
        <!-- <form name="detail" action="index.php?page=personal_calendar&paging=0" method="post">
            <input type="hidden" name="calendar_id" value="<?= $calendar_id; ?>">
            <button type="submit" class="btn btn-outline-success btn-sm btn-pill" name="detail"><?= $Title ?></button>
        </form> 
        $html .= '<div class="event' . $event[3] . '">';-->
        <?php
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->active_day) {
                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div>';
                        $html .= '<form name="detail" action="index.php?page=personal_calendar&paging=0" method="post">';
                        $html .= '<input type="hidden" name="calendar_id" value="' . $event[3] . '">';
                        $html .= '<button type="submit" class="btn btn-success btn-hover-light btn-sm btn-pill" name="detail">';
                        $html .= $event[0];
                        $html .= '</button></form></div>';
                    }
                }
            }
            $html .= '</div>';
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}
?>