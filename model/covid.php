<?php
$cases_malaysia = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv';
$cases_state = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_state.csv';
$deaths_malaysia = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/deaths_malaysia.csv';
$aefi = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/aefi.csv';
$population = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/static/population.csv';

// Open the file for reading
if (($h = fopen("{$cases_malaysia}", "r")) !== FALSE) 
{
	$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 day'))->getTimestamp()*1000);
	$Date = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$year = date_format($Date,"Y");
	$month = date_format($Date,"m");
	$day = date_format($Date,"d");
	$Date1 = $year.'-'.$month.'-'.$day;

	$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -2 day'))->getTimestamp()*1000);
	$Date = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$year = date_format($Date,"Y");
	$month = date_format($Date,"m");
	$day = date_format($Date,"d");
	$Date2 = $year.'-'.$month.'-'.$day;

	$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -3 day'))->getTimestamp()*1000);
	$Date = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$year = date_format($Date,"Y");
	$month = date_format($Date,"m");
	$day = date_format($Date,"d");
	$Date3 = $year.'-'.$month.'-'.$day;

    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -4 day'))->getTimestamp()*1000);
	$Date = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$year = date_format($Date,"Y");
	$month = date_format($Date,"m");
	$day = date_format($Date,"d");
	$Date4 = $year.'-'.$month.'-'.$day;

    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -5 day'))->getTimestamp()*1000);
	$Date = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$year = date_format($Date,"Y");
	$month = date_format($Date,"m");
	$day = date_format($Date,"d");
	$Date5 = $year.'-'.$month.'-'.$day;

    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -6 day'))->getTimestamp()*1000);
	$Date = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$year = date_format($Date,"Y");
	$month = date_format($Date,"m");
	$day = date_format($Date,"d");
	$Date6 = $year.'-'.$month.'-'.$day;
	
	while (($row = fgetcsv($h, 0, ",")) !== FALSE) {
		//Print out my column data.
		if($row[0] == $Date1) //1 days ago
		{
			$date1 = $row[0];
			$cases_new1 = $row[1];
			$cases_import1 = $row[2];
			$cases_recovered1 = $row[3];
			$cluster_import1 = $row[4];
			$cluster_religious1 = $row[5];
			$cluster_community1 = $row[6];
			$cluster_highRisk1 = $row[7];
			$cluster_education1 = $row[8];
			$cluster_detentionCentre1 = $row[9];
			$cluster_workplace1 = $row[10];
		}
		elseif($row[0] == $Date2) //2 days ago
		{
			$date2 = $row[0];
			$cases_new2 = $row[1];
			$cases_import2 = $row[2];
			$cases_recovered2 = $row[3];
			$cluster_import2 = $row[4];
			$cluster_religious2 = $row[5];
			$cluster_community2 = $row[6];
			$cluster_highRisk2 = $row[7];
			$cluster_education2 = $row[8];
			$cluster_detentionCentre2 = $row[9];
			$cluster_workplace2 = $row[10];
		}
		elseif($row[0] == $Date3) //3 days ago
		{
			$date3 = $row[0];
			$cases_new3 = $row[1];
			$cases_import3 = $row[2];
			$cases_recovered3 = $row[3];
			$cluster_import3 = $row[4];
			$cluster_religious3 = $row[5];
			$cluster_community3 = $row[6];
			$cluster_highRisk3 = $row[7];
			$cluster_education3 = $row[8];
			$cluster_detentionCentre3 = $row[9];
			$cluster_workplace3 = $row[10];
		}
        elseif($row[0] == $Date4) //3 days ago
		{
			$date4 = $row[0];
			$cases_new4 = $row[1];
			$cases_import4 = $row[2];
			$cases_recovered4 = $row[3];
			$cluster_import4 = $row[4];
			$cluster_religious4 = $row[5];
			$cluster_community4 = $row[6];
			$cluster_highRisk4 = $row[7];
			$cluster_education4 = $row[8];
			$cluster_detentionCentre4 = $row[9];
			$cluster_workplace4 = $row[10];
		}
        elseif($row[0] == $Date5) //3 days ago
		{
			$date5 = $row[0];
			$cases_new5 = $row[1];
			$cases_import5 = $row[2];
			$cases_recovered5 = $row[3];
			$cluster_import5 = $row[4];
			$cluster_religious5 = $row[5];
			$cluster_community5 = $row[6];
			$cluster_highRisk5 = $row[7];
			$cluster_education5 = $row[8];
			$cluster_detentionCentre5 = $row[9];
			$cluster_workplace5 = $row[10];
		}
        elseif($row[0] == $Date6) //3 days ago
		{
			$date6 = $row[0];
			$cases_new6 = $row[1];
			$cases_import6 = $row[2];
			$cases_recovered6 = $row[3];
			$cluster_import6 = $row[4];
			$cluster_religious6 = $row[5];
			$cluster_community6 = $row[6];
			$cluster_highRisk6 = $row[7];
			$cluster_education6 = $row[8];
			$cluster_detentionCentre6 = $row[9];
			$cluster_workplace6 = $row[10];
		}
	}
	// Close the file
	fclose($h);
}
if (($h = fopen("{$cases_state}", "r")) !== FALSE) 
{
	$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
	$Date = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$date_display = date_format($Date,"F d,Y H:i");
	$year = date_format($Date,"Y");
	$month = date_format($Date,"m");
	$day = date_format($Date,"d");
	$Date = $year.'-'.$month.'-'.$day;

	$from_date1 = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 day'))->getTimestamp()*1000);
	$Date1 = $from_date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$date_display1 = date_format($Date1,"F d,Y H:i");
	$year1 = date_format($Date1,"Y");
	$month1 = date_format($Date1,"m");
	$day1 = date_format($Date1,"d");
	$Date1 = $year1.'-'.$month1.'-'.$day1;
	
	while (($row = fgetcsv($h, 0, ",")) !== FALSE) {
		//Print out my column data.
		if($row[0] == $Date)//today
		{
            $cases_state_date = $row[0];
            if($row[1] == 'Johor')
            {
                $cases_new_Johor = $row[3];
                $cases_recovered_Johor = $row[4];
            }
            elseif($row[1] == 'Kedah')
            {
                $cases_new_Kedah = $row[3];
                $cases_recovered_Kedah = $row[4];
            }
            elseif($row[1] == 'Kelantan')
            {
                $cases_new_Kelantan = $row[3];
                $cases_recovered_Kelantan = $row[4];
            }
            elseif($row[1] == 'Melaka')
            {
                $cases_new_Melaka = $row[3];
                $cases_recovered_Melaka = $row[4];
            }
            elseif($row[1] == 'Negeri Sembilan')
            {
                $cases_new_n9 = $row[3];
                $cases_recovered_n9 = $row[4];
            }
            elseif($row[1] == 'Pahang')
            {
                $cases_new_Pahang = $row[3];
                $cases_recovered_Pahang = $row[4];
            }
            elseif($row[1] == 'Perak')
            {
                $cases_new_Perak = $row[3];
                $cases_recovered_Perak = $row[4];
            }
            elseif($row[1] == 'Perlis')
            {
                $cases_new_Perlis = $row[3];
                $cases_recovered_Perlis = $row[4];
            }
            elseif($row[1] == 'Johor')
            {
                $cases_new_Johor = $row[3];
                $cases_recovered_Johor = $row[4];
            }
            elseif($row[1] == 'Pulau Pinang')
            {
                $cases_new_PPinang = $row[3];
                $cases_recovered_PPinang = $row[4];
            }
            elseif($row[1] == 'Sabah')
            {
                $cases_new_Sabah = $row[3];
                $cases_recovered_Sabah = $row[4];
            }
            elseif($row[1] == 'Sarawak')
            {
                $cases_new_Sarawak = $row[3];
                $cases_recovered_Sarawak = $row[4];
            }
            elseif($row[1] == 'Selangor')
            {
                $cases_new_Selangor = $row[3];
                $cases_recovered_Selangor = $row[4];
            }
            elseif($row[1] == 'Terengganu')
            {
                $cases_new_Terengganu = $row[3];
                $cases_recovered_Terengganu = $row[4];
            }
            elseif($row[1] == 'W.P. Kuala Lumpur')
            {
                $cases_new_Kl = $row[3];
                $cases_recovered_Kl = $row[4];
            }
            elseif($row[1] == 'W.P. Labuan')
            {
                $cases_new_Labuan = $row[3];
                $cases_recovered_Labuan = $row[4];
            }
            elseif($row[1] == 'W.P. Putrajaya')
            {
                $cases_new_Putrajaya = $row[3];
                $cases_recovered_Putrajaya = $row[4];
            }
		}
		elseif($row[0] == $Date1)//yesterday
		{
            $cases_state_date = $row[0];
            if($row[1] == 'Johor')
            {
                $cases_new_Johor = $row[3];
                $cases_recovered_Johor = $row[4];
            }
            elseif($row[1] == 'Kedah')
            {
                $cases_new_Kedah = $row[3];
                $cases_recovered_Kedah = $row[4];
            }
            elseif($row[1] == 'Kelantan')
            {
                $cases_new_Kelantan = $row[3];
                $cases_recovered_Kelantan = $row[4];
            }
            elseif($row[1] == 'Melaka')
            {
                $cases_new_Melaka = $row[3];
                $cases_recovered_Melaka = $row[4];
            }
            elseif($row[1] == 'Negeri Sembilan')
            {
                $cases_new_n9 = $row[3];
                $cases_recovered_n9 = $row[4];
            }
            elseif($row[1] == 'Pahang')
            {
                $cases_new_Pahang = $row[3];
                $cases_recovered_Pahang = $row[4];
            }
            elseif($row[1] == 'Perak')
            {
                $cases_new_Perak = $row[3];
                $cases_recovered_Perak = $row[4];
            }
            elseif($row[1] == 'Perlis')
            {
                $cases_new_Perlis = $row[3];
                $cases_recovered_Perlis = $row[4];
            }
            elseif($row[1] == 'Johor')
            {
                $cases_new_Johor = $row[3];
                $cases_recovered_Johor = $row[4];
            }
            elseif($row[1] == 'Pulau Pinang')
            {
                $cases_new_PPinang = $row[3];
                $cases_recovered_PPinang = $row[4];
            }
            elseif($row[1] == 'Sabah')
            {
                $cases_new_Sabah = $row[3];
                $cases_recovered_Sabah = $row[4];
            }
            elseif($row[1] == 'Sarawak')
            {
                $cases_new_Sarawak = $row[3];
                $cases_recovered_Sarawak = $row[4];
            }
            elseif($row[1] == 'Selangor')
            {
                $cases_new_Selangor = $row[3];
                $cases_recovered_Selangor = $row[4];
            }
            elseif($row[1] == 'Terengganu')
            {
                $cases_new_Terengganu = $row[3];
                $cases_recovered_Terengganu = $row[4];
            }
            elseif($row[1] == 'W.P. Kuala Lumpur')
            {
                $cases_new_Kl = $row[3];
                $cases_recovered_Kl = $row[4];
            }
            elseif($row[1] == 'W.P. Labuan')
            {
                $cases_new_Labuan = $row[3];
                $cases_recovered_Labuan = $row[4];
            }
            elseif($row[1] == 'W.P. Putrajaya')
            {
                $cases_new_Putrajaya = $row[3];
                $cases_recovered_Putrajaya = $row[4];
            }
		}
	}
	// Close the file
	fclose($h);
}

if (($h = fopen("{$deaths_malaysia}", "r")) !== FALSE) 
{
	$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
	$Date = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$date_display = date_format($Date,"F d,Y H:i");
	$year = date_format($Date,"Y");
	$month = date_format($Date,"m");
	$day = date_format($Date,"d");
	$Date = $year.'-'.$month.'-'.$day;

	$from_date1 = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 day'))->getTimestamp()*1000);
	$Date1 = $from_date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$date_display1 = date_format($Date1,"F d,Y H:i");
	$year1 = date_format($Date1,"Y");
	$month1 = date_format($Date1,"m");
	$day1 = date_format($Date1,"d");
	$Date1 = $year1.'-'.$month1.'-'.$day1;
	
	while (($row = fgetcsv($h, 0, ",")) !== FALSE) {
		//Print out my column data.
		if($row[0] == $Date)//today
		{
			$date = $row[0];
			$deaths_new = $row[1];
			$deaths_bid = $row[2];
		}
		elseif($row[0] == $Date1)//yesterday
		{
			$date = $row[0];
			$deaths_new = $row[1];
			$deaths_bid = $row[2];
		}
	}
	// Close the file
	fclose($h);
}

if (($h = fopen("{$aefi}", "r")) !== FALSE) 
{
	$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
	$Date = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$date_display = date_format($Date,"F d,Y H:i");
	$year = date_format($Date,"Y");
	$month = date_format($Date,"m");
	$day = date_format($Date,"d");
	$Date = $year.'-'.$month.'-'.$day;

	$from_date1 = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 day'))->getTimestamp()*1000);
	$Date1 = $from_date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$date_display1 = date_format($Date1,"F d,Y H:i");
	$year1 = date_format($Date1,"Y");
	$month1 = date_format($Date1,"m");
	$day1 = date_format($Date1,"d");
	$Date1 = $year1.'-'.$month1.'-'.$day1;
	
	while (($row = fgetcsv($h, 0, ",")) !== FALSE) {
		//Print out my column data.
		if($row[0] == $Date)//today
		{
			$date = $row[0];
            if($row[1] == 'pfizer')
            {
                $doses_pfizer = $row[2];
                $reports_mysj_pfizer = $row[3];
                $reports_npra_pfizer = $row[4];
                $nonserious_pfizer = $row[5];
                $serious_pfizer = $row[6];
                $suspected_anaphylaxis_pfizer = $row[7];
                $acute_facial_paralysis_pfizer = $row[8];
                $venous_thromboembolism_pfizer = $row[9];
                $myo_pericarditis_pfizer = $row[10];
            }
            elseif($row[1] == 'sinovac')
            {
                $doses_sinovac = $row[2];
                $reports_mysj_sinovac = $row[3];
                $reports_npra_sinovac = $row[4];
                $nonserious_sinovac = $row[5];
                $serious_sinovac = $row[6];
                $suspected_anaphylaxis_sinovac = $row[7];
                $acute_facial_paralysis_sinovac = $row[8];
                $venous_thromboembolism_sinovac = $row[9];
                $myo_pericarditis_sinovac = $row[10];
            }
            elseif($row[1] == 'astrazeneca')
            {
                $doses_astrazeneca = $row[2];
                $reports_mysj_astrazeneca = $row[3];
                $reports_npra_astrazeneca = $row[4];
                $nonserious_astrazeneca = $row[5];
                $serious_astrazeneca = $row[6];
                $suspected_anaphylaxis_astrazeneca = $row[7];
                $acute_facial_paralysis_astrazeneca = $row[8];
                $venous_thromboembolism_astrazeneca = $row[9];
                $myo_pericarditis_astrazeneca = $row[10];
            }
		}
		else//yesterday
		{
			$date = $row[0];
            if($row[1] == 'pfizer')
            {
                $doses_pfizer = $row[2];
                $reports_mysj_pfizer = $row[3];
                $reports_npra_pfizer = $row[4];
                $nonserious_pfizer = $row[5];
                $serious_pfizer = $row[6];
                $suspected_anaphylaxis_pfizer = $row[7];
                $acute_facial_paralysis_pfizer = $row[8];
                $venous_thromboembolism_pfizer = $row[9];
                $myo_pericarditis_pfizer = $row[10];
            }
            elseif($row[1] == 'sinovac')
            {
                $doses_sinovac = $row[2];
                $reports_mysj_sinovac = $row[3];
                $reports_npra_sinovac = $row[4];
                $nonserious_sinovac = $row[5];
                $serious_sinovac = $row[6];
                $suspected_anaphylaxis_sinovac = $row[7];
                $acute_facial_paralysis_sinovac = $row[8];
                $venous_thromboembolism_sinovac = $row[9];
                $myo_pericarditis_sinovac = $row[10];
            }
            elseif($row[1] == 'astrazeneca')
            {
                $doses_astrazeneca = $row[2];
                $reports_mysj_astrazeneca = $row[3];
                $reports_npra_astrazeneca = $row[4];
                $nonserious_astrazeneca = $row[5];
                $serious_astrazeneca = $row[6];
                $suspected_anaphylaxis_astrazeneca = $row[7];
                $acute_facial_paralysis_astrazeneca = $row[8];
                $venous_thromboembolism_astrazeneca = $row[9];
                $myo_pericarditis_astrazeneca = $row[10];
            }
		}
	}
	// Close the file
	fclose($h);
}

if (($h = fopen("{$population}", "r")) !== FALSE) 
{
	while (($row = fgetcsv($h, 0, ",")) !== FALSE) {
		//Print out my column data.
		if($row[0] == 'Malaysia')//today
		{
			$pop = $row[2];
			$pop_18 = $row[3];
			$pop_60 = $row[4];
		}
	}
	// Close the file
	fclose($h);
}

?>