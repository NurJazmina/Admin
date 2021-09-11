<?php
$cases_malaysia = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv';
$cases_state = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_state.csv';
$deaths_malaysia = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/deaths_malaysia.csv';
$aefi = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/aefi.csv';
$population = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/static/population.csv';
$tests_malaysia = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/tests_malaysia.csv';
$tests_state = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/tests_state.csv';
$icu = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/icu.csv';

// Open the file for reading
if (($h = fopen("{$cases_malaysia}", "r")) !== FALSE) 
{
    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
	$Date_time = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$Date = date_format($Date_time,"Y-m-d");

	$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 day'))->getTimestamp()*1000);
	$Date_time1 = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$Date1 = date_format($Date_time1,"Y-m-d");

	$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -2 day'))->getTimestamp()*1000);
	$Date_time2 = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$Date2 = date_format($Date_time2,"Y-m-d");

	$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -3 day'))->getTimestamp()*1000);
	$Date_time3 = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$Date3 = date_format($Date_time3,"Y-m-d");

    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -4 day'))->getTimestamp()*1000);
	$Date_time4 = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$Date4 = date_format($Date_time4,"Y-m-d");

    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -5 day'))->getTimestamp()*1000);
	$Date_time5 = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$Date5 = date_format($Date_time5,"Y-m-d");

    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -6 day'))->getTimestamp()*1000);
	$Date_time6 = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$Date6 = date_format($Date_time6,"Y-m-d");
	
	while (($row = fgetcsv($h, 0, ",")) !== FALSE) {
		//Print out my column data.
        if($row[0] == $Date) //today
		{  
            $date_display = date_format($Date_time,"F d,Y H:i");
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
		elseif($row[0] == $Date1) //1 days ago
		{
            $date_display = date_format($Date_time1,"F d,Y H:i");
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
	$Date = date_format($Date,"Y-m-d");

	$from_date1 = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 day'))->getTimestamp()*1000);
	$Date1 = $from_date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$Date1 = date_format($Date1,"Y-m-d");
	
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
	$Date = date_format($Date,"Y-m-d");

	$from_date1 = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 day'))->getTimestamp()*1000);
	$Date1 = $from_date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$Date1 = date_format($Date1,"Y-m-d");
	
	while (($row = fgetcsv($h, 0, ",")) !== FALSE) {
		//Print out my column data.
		if($row[0] == $Date)//today
		{
			$deaths_malaysia_date = $row[0];
			$deaths_new = $row[1];
			$deaths_bid = $row[2];
		}
		elseif($row[0] == $Date1)//yesterday
		{
			$deaths_malaysia_date = $row[0];
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
	$Date = date_format($Date,"Y-m-d");

	$from_date1 = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 day'))->getTimestamp()*1000);
	$Date1 = $from_date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
	$Date1 = date_format($Date1,"Y-m-d");
	
	while (($row = fgetcsv($h, 0, ",")) !== FALSE) {
		//Print out my column data.
		if($row[0] == $Date)//today
		{
			$aefi_date = $row[0];
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
		else
		{
			$aefi_date = $row[0];
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

if (($h = fopen("{$tests_malaysia}", "r")) !== FALSE) 
{
    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
	$Date = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $Date = date_format($Date,"Y-m-d");

	$from_date1 = new MongoDB\BSON\UTCDateTime((new DateTime('now -3 day'))->getTimestamp()*1000);
	$Date1 = $from_date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $Date1 = date_format($Date1,"Y-m-d");

	while (($row = fgetcsv($h, 0, ",")) !== FALSE) {
		//Print out my column data.
		if($row[0] == $Date)//today
		{
            $tests_malaysia_date = $row[0];
			$rtk_ag = $row[1];
			$pcr = $row[2];
		}
        elseif($row[0] == $Date1)
        {
            $tests_malaysia_date = $row[0];
            $rtk_ag = $row[1];
			$pcr = $row[2];
        }
        else
        {
            $tests_malaysia_date = 'out-of-date';
            $rtk_ag = 'out-of-date';
			$pcr = 'out-of-date';
        }
	}
	// Close the file
	fclose($h);
}

if (($h = fopen("{$tests_state}", "r")) !== FALSE) 
{
    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
	$Date = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $Date = date_format($Date,"Y-m-d");

	$from_date1 = new MongoDB\BSON\UTCDateTime((new DateTime('now -3 day'))->getTimestamp()*1000);
	$Date1 = $from_date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $Date1 = date_format($Date1,"Y-m-d");

	while (($row = fgetcsv($h, 0, ",")) !== FALSE) {
		//Print out my column data.
		if($row[0] == $Date)//today
		{
            $tests_state_date = $row[0];
            if($row[1] == 'Johor')
            {
                $state_rtk_ag_Johor = $row[2];
                $state_pcr_Johor = $row[3];
            }
            elseif($row[1] == 'Kedah')
            {
                $state_rtk_ag_Kedah = $row[2];
                $state_pcr_Kedah = $row[3];
            }
            elseif($row[1] == 'Kelantan')
            {
                $state_rtk_ag_Kelantan = $row[2];
                $state_pcr_Kelantan = $row[3];
            }
            elseif($row[1] == 'Melaka')
            {
                $state_rtk_ag_Melaka = $row[2];
                $state_pcr_Melaka = $row[3];
            }
            elseif($row[1] == 'Negeri Sembilan')
            {
                $state_rtk_ag_n9 = $row[2];
                $state_pcr_n9 = $row[3];
            }
            elseif($row[1] == 'Pahang')
            {
                $state_rtk_ag_Pahang = $row[2];
                $state_pcr_Pahang = $row[3];
            }
            elseif($row[1] == 'Perak')
            {
                $state_rtk_ag_Perak = $row[2];
                $state_pcr_Perak = $row[3];
            }
            elseif($row[1] == 'Perlis')
            {
                $state_rtk_ag_Perlis = $row[2];
                $state_pcr_Perlis = $row[3];
            }
            elseif($row[1] == 'Pulau Pinang')
            {
                $state_rtk_ag_ppinang = $row[2];
                $state_pcr_ppinang = $row[3];
            }
            elseif($row[1] == 'Sabah')
            {
                $state_rtk_ag_Sabah = $row[2];
                $state_pcr_Sabah = $row[3];
            }
            elseif($row[1] == 'Sarawak')
            {
                $state_rtk_ag_Sarawak = $row[2];
                $state_pcr_Sarawak = $row[3];
            }
            elseif($row[1] == 'Selangor')
            {
                $state_rtk_ag_Selangor = $row[2];
                $state_pcr_Selangor = $row[3];
            }
            elseif($row[1] == 'Terengganu')
            {
                $state_rtk_ag_Terengganu = $row[2];
                $state_pcr_Terengganu = $row[3];
            }
            elseif($row[1] == 'W.P. Kuala Lumpur')
            {
                $state_rtk_ag_kl = $row[2];
                $state_pcr_kl = $row[3];
            }
            elseif($row[1] == 'W.P. Labuan')
            {
                $state_rtk_ag_labuan = $row[2];
                $state_pcr_labuan = $row[3];
            }
            elseif($row[1] == 'W.P. Putrajaya')
            {
                $state_rtk_ag_putrajaya = $row[2];
                $state_pcr_putrajaya = $row[3];
            }
		}
        elseif($row[0] == $Date1)
        {
            $tests_state_date = $row[0];
            if($row[1] == 'Johor')
            {
                $state_rtk_ag_Johor = $row[2];
                $state_pcr_Johor = $row[3];
            }
            elseif($row[1] == 'Kedah')
            {
                $state_rtk_ag_Kedah = $row[2];
                $state_pcr_Kedah = $row[3];
            }
            elseif($row[1] == 'Kelantan')
            {
                $state_rtk_ag_Kelantan = $row[2];
                $state_pcr_Kelantan = $row[3];
            }
            elseif($row[1] == 'Melaka')
            {
                $state_rtk_ag_Melaka = $row[2];
                $state_pcr_Melaka = $row[3];
            }
            elseif($row[1] == 'Negeri Sembilan')
            {
                $state_rtk_ag_n9 = $row[2];
                $state_pcr_n9 = $row[3];
            }
            elseif($row[1] == 'Pahang')
            {
                $state_rtk_ag_Pahang = $row[2];
                $state_pcr_Pahang = $row[3];
            }
            elseif($row[1] == 'Perak')
            {
                $state_rtk_ag_Perak = $row[2];
                $state_pcr_Perak = $row[3];
            }
            elseif($row[1] == 'Perlis')
            {
                $state_rtk_ag_Perlis = $row[2];
                $state_pcr_Perlis = $row[3];
            }
            elseif($row[1] == 'Pulau Pinang')
            {
                $state_rtk_ag_ppinang = $row[2];
                $state_pcr_ppinang = $row[3];
            }
            elseif($row[1] == 'Sabah')
            {
                $state_rtk_ag_Sabah = $row[2];
                $state_pcr_Sabah = $row[3];
            }
            elseif($row[1] == 'Sarawak')
            {
                $state_rtk_ag_Sarawak = $row[2];
                $state_pcr_Sarawak = $row[3];
            }
            elseif($row[1] == 'Selangor')
            {
                $state_rtk_ag_Selangor = $row[2];
                $state_pcr_Selangor = $row[3];
            }
            elseif($row[1] == 'Terengganu')
            {
                $state_rtk_ag_Terengganu = $row[2];
                $state_pcr_Terengganu = $row[3];
            }
            elseif($row[1] == 'W.P. Kuala Lumpur')
            {
                $state_rtk_ag_kl = $row[2];
                $state_pcr_kl = $row[3];
            }
            elseif($row[1] == 'W.P. Labuan')
            {
                $state_rtk_ag_labuan = $row[2];
                $state_pcr_labuan = $row[3];
            }
            elseif($row[1] == 'W.P. Putrajaya')
            {
                $state_rtk_ag_putrajaya = $row[2];
                $state_pcr_putrajaya = $row[3];
            }
        }
        else
        {
            $tests_state_date = 'out-of-date';
            if($row[1] == 'Johor')
            {
                $state_rtk_ag_Johor = 'out-of-date';
                $state_pcr_Johor = 'out-of-date';
            }
            elseif($row[1] == 'Kedah')
            {
                $state_rtk_ag_Kedah = 'out-of-date';
                $state_pcr_Kedah = 'out-of-date';
            }
            elseif($row[1] == 'Kelantan')
            {
                $state_rtk_ag_Kelantan = 'out-of-date';
                $state_pcr_Kelantan = 'out-of-date';;
            }
            elseif($row[1] == 'Melaka')
            {
                $state_rtk_ag_Melaka = 'out-of-date';
                $state_pcr_Melaka = 'out-of-date';
            }
            elseif($row[1] == 'Negeri Sembilan')
            {
                $state_rtk_ag_n9 = 'out-of-date';
                $state_pcr_n9 = 'out-of-date';
            }
            elseif($row[1] == 'Pahang')
            {
                $state_rtk_ag_Pahang = 'out-of-date';
                $state_pcr_Pahang = 'out-of-date';
            }
            elseif($row[1] == 'Perak')
            {
                $state_rtk_ag_Perak = 'out-of-date';
                $state_pcr_Perak = 'out-of-date';
            }
            elseif($row[1] == 'Perlis')
            {
                $state_rtk_ag_Perlis = 'out-of-date';
                $state_pcr_Perlis = 'out-of-date';
            }
            elseif($row[1] == 'Pulau Pinang')
            {
                $state_rtk_ag_ppinang = 'out-of-date';
                $state_pcr_ppinang = 'out-of-date';
            }
            elseif($row[1] == 'Sabah')
            {
                $state_rtk_ag_Johor = 'out-of-date';
                $state_pcr_Johor = 'out-of-date';
            }
            elseif($row[1] == 'Sarawak')
            {
                $state_rtk_ag_Sarawak = 'out-of-date';
                $state_pcr_Sarawak = 'out-of-date';
            }
            elseif($row[1] == 'Selangor')
            {
                $state_rtk_ag_Selangor = 'out-of-date';
                $state_pcr_Selangor = 'out-of-date';
            }
            elseif($row[1] == 'Terengganu')
            {
                $state_rtk_ag_Terengganu = 'out-of-date';
                $state_pcr_Terengganu = 'out-of-date';
            }
            elseif($row[1] == 'W.P. Kuala Lumpur')
            {
                $state_rtk_ag_kl = 'out-of-date';
                $state_pcr_kl = 'out-of-date';
            }
            elseif($row[1] == 'W.P. Labuan')
            {
                $state_rtk_ag_labuan = 'out-of-date';
                $state_pcr_labuan = 'out-of-date';
            }
            elseif($row[1] == 'W.P. Putrajaya')
            {
                $state_rtk_ag_putrajaya = 'out-of-date';
                $state_pcr_putrajaya = 'out-of-date';
            }
        }
	}
	// Close the file
	fclose($h);
}


if (($h = fopen("{$icu}", "r")) !== FALSE) 
{
    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
	$Date = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $Date = date_format($Date,"Y-m-d");

	$from_date1 = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 day'))->getTimestamp()*1000);
	$Date1 = $from_date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $Date1 = date_format($Date1,"Y-m-d");

	while (($row = fgetcsv($h, 0, ",")) !== FALSE) {
		//Print out my column data.
		if($row[0] == $Date)//today
		{
            $icu_date = $row[0];
            if($row[1] == 'Johor')
            {
                $beds_icu_Johor = $row[2];
                $beds_icu_rep_Johor	= $row[3];
                $beds_icu_total_Johor = $row[4];
                $beds_icu_covid_Johor = $row[5];
                $vent_Johor = $row[6];
            }
            elseif($row[1] == 'Kedah')
            {
                $beds_icu_Kedah = $row[2];
                $beds_icu_rep_Kedah	= $row[3];
                $beds_icu_total_Kedah = $row[4];
                $beds_icu_covid_Kedah = $row[5];
                $vent_Kedah = $row[6];
            }
            elseif($row[1] == 'Kelantan')
            {
                $beds_icu_Kelantan = $row[2];
                $beds_icu_rep_Kelantan	= $row[3];
                $beds_icu_total_Kelantan = $row[4];
                $beds_icu_covid_Kelantan = $row[5];
                $vent_Kelantan = $row[6];
            }
            elseif($row[1] == 'Melaka')
            {
                $beds_icu_Melaka = $row[2];
                $beds_icu_rep_Melaka = $row[3];
                $beds_icu_total_Melaka = $row[4];
                $beds_icu_covid_Melaka = $row[5];
                $vent_Melaka = $row[6];
            }
            elseif($row[1] == 'Negeri Sembilan')
            {
                $beds_icu_n9 = $row[2];
                $beds_icu_rep_n9	= $row[3];
                $beds_icu_total_n9 = $row[4];
                $beds_icu_covid_n9 = $row[5];
                $vent_n9 = $row[6];
            }
            elseif($row[1] == 'Pahang')
            {
                $beds_icu_Pahang = $row[2];
                $beds_icu_rep_Pahang	= $row[3];
                $beds_icu_total_Pahang = $row[4];
                $beds_icu_covid_Pahang = $row[5];
                $vent_Pahang = $row[6];
            }
            elseif($row[1] == 'Perak')
            {
                $beds_icu_Perak = $row[2];
                $beds_icu_rep_Perak	= $row[3];
                $beds_icu_total_Perak = $row[4];
                $beds_icu_covid_Perak = $row[5];
                $vent_Perak = $row[6];
            }
            elseif($row[1] == 'Perlis')
            {
                $beds_icu_Perlis = $row[2];
                $beds_icu_rep_Perlis	= $row[3];
                $beds_icu_total_Perlis = $row[4];
                $beds_icu_covid_Perlis = $row[5];
                $vent_Perlis= $row[6];
            }
            elseif($row[1] == 'Pulau Pinang')
            {
                $beds_icu_ppinang = $row[2];
                $beds_icu_rep_ppinang	= $row[3];
                $beds_icu_total_ppinang = $row[4];
                $beds_icu_covid_ppinang = $row[5];
                $vent_ppinang = $row[6];
            }
            elseif($row[1] == 'Sabah')
            {
                $beds_icu_Sabah = $row[2];
                $beds_icu_rep_Sabah	= $row[3];
                $beds_icu_total_Sabah = $row[4];
                $beds_icu_covid_Sabah = $row[5];
                $vent_Sabah = $row[6];
            }
            elseif($row[1] == 'Sarawak')
            {
                $beds_icu_Sarawak = $row[2];
                $beds_icu_rep_Sarawak= $row[3];
                $beds_icu_total_Sarawak = $row[4];
                $beds_icu_covid_Sarawak = $row[5];
                $vent_Sarawak = $row[6];
            }
            elseif($row[1] == 'Selangor')
            {
                $beds_icu_Selangor = $row[2];
                $beds_icu_rep_Selangor	= $row[3];
                $beds_icu_total_Selangor = $row[4];
                $beds_icu_covid_Selangor = $row[5];
                $vent_Selangor = $row[6];
            }
            elseif($row[1] == 'Terengganu')
            {
                $beds_icu_Terengganu = $row[2];
                $beds_icu_rep_Terengganu	= $row[3];
                $beds_icu_total_Terengganu = $row[4];
                $beds_icu_covid_Terengganu = $row[5];
                $vent_Terengganu = $row[6];
            }
            elseif($row[1] == 'W.P. Kuala Lumpur')
            {
                $beds_icu_kl = $row[2];
                $beds_icu_rep_kl = $row[3];
                $beds_icu_total_kl = $row[4];
                $beds_icu_covid_kl = $row[5];
                $vent_kl = $row[6];
            }
            elseif($row[1] == 'W.P. Labuan')
            {
                $beds_icu_labuan = $row[2];
                $beds_icu_rep_labuan	= $row[3];
                $beds_icu_total_labuan = $row[4];
                $beds_icu_covid_labuan = $row[5];
                $vent_labuan = $row[6];
            }
            elseif($row[1] == 'W.P. Putrajaya')
            {
                $beds_icu_Putrajaya = $row[2];
                $beds_icu_rep_Putrajaya	= $row[3];
                $beds_icu_total_Putrajaya = $row[4];
                $beds_icu_covid_Putrajaya = $row[5];
                $vent_Putrajaya = $row[6];
            }
		}
        elseif($row[0] == $Date1)
        {
            $icu_date = $row[0];
            if($row[1] == 'Johor')
            {
                $beds_icu_Johor = $row[2];
                $beds_icu_rep_Johor	= $row[3];
                $beds_icu_total_Johor = $row[4];
                $beds_icu_covid_Johor = $row[5];
                $vent_Johor = $row[6];
            }
            elseif($row[1] == 'Kedah')
            {
                $beds_icu_Kedah = $row[2];
                $beds_icu_rep_Kedah	= $row[3];
                $beds_icu_total_Kedah = $row[4];
                $beds_icu_covid_Kedah = $row[5];
                $vent_Kedah = $row[6];
            }
            elseif($row[1] == 'Kelantan')
            {
                $beds_icu_Kelantan = $row[2];
                $beds_icu_rep_Kelantan	= $row[3];
                $beds_icu_total_Kelantan = $row[4];
                $beds_icu_covid_Kelantan = $row[5];
                $vent_Kelantan = $row[6];
            }
            elseif($row[1] == 'Melaka')
            {
                $beds_icu_Melaka = $row[2];
                $beds_icu_rep_Melaka = $row[3];
                $beds_icu_total_Melaka = $row[4];
                $beds_icu_covid_Melaka = $row[5];
                $vent_Melaka = $row[6];
            }
            elseif($row[1] == 'Negeri Sembilan')
            {
                $beds_icu_n9 = $row[2];
                $beds_icu_rep_n9	= $row[3];
                $beds_icu_total_n9 = $row[4];
                $beds_icu_covid_n9 = $row[5];
                $vent_n9 = $row[6];
            }
            elseif($row[1] == 'Pahang')
            {
                $beds_icu_Pahang = $row[2];
                $beds_icu_rep_Pahang	= $row[3];
                $beds_icu_total_Pahang = $row[4];
                $beds_icu_covid_Pahang = $row[5];
                $vent_Pahang = $row[6];
            }
            elseif($row[1] == 'Perak')
            {
                $beds_icu_Perak = $row[2];
                $beds_icu_rep_Perak	= $row[3];
                $beds_icu_total_Perak = $row[4];
                $beds_icu_covid_Perak = $row[5];
                $vent_Perak = $row[6];
            }
            elseif($row[1] == 'Perlis')
            {
                $beds_icu_Perlis = $row[2];
                $beds_icu_rep_Perlis	= $row[3];
                $beds_icu_total_Perlis = $row[4];
                $beds_icu_covid_Perlis = $row[5];
                $vent_Perlis= $row[6];
            }
            elseif($row[1] == 'Pulau Pinang')
            {
                $beds_icu_ppinang = $row[2];
                $beds_icu_rep_ppinang	= $row[3];
                $beds_icu_total_ppinang = $row[4];
                $beds_icu_covid_ppinang = $row[5];
                $vent_ppinang = $row[6];
            }
            elseif($row[1] == 'Sabah')
            {
                $beds_icu_Sabah = $row[2];
                $beds_icu_rep_Sabah	= $row[3];
                $beds_icu_total_Sabah = $row[4];
                $beds_icu_covid_Sabah = $row[5];
                $vent_Sabah = $row[6];
            }
            elseif($row[1] == 'Sarawak')
            {
                $beds_icu_Sarawak = $row[2];
                $beds_icu_rep_Sarawak= $row[3];
                $beds_icu_total_Sarawak = $row[4];
                $beds_icu_covid_Sarawak = $row[5];
                $vent_Sarawak = $row[6];
            }
            elseif($row[1] == 'Selangor')
            {
                $beds_icu_Selangor = $row[2];
                $beds_icu_rep_Selangor	= $row[3];
                $beds_icu_total_Selangor = $row[4];
                $beds_icu_covid_Selangor = $row[5];
                $vent_Selangor = $row[6];
            }
            elseif($row[1] == 'Terengganu')
            {
                $beds_icu_Terengganu = $row[2];
                $beds_icu_rep_Terengganu	= $row[3];
                $beds_icu_total_Terengganu = $row[4];
                $beds_icu_covid_Terengganu = $row[5];
                $vent_Terengganu = $row[6];
            }
            elseif($row[1] == 'W.P. Kuala Lumpur')
            {
                $beds_icu_kl = $row[2];
                $beds_icu_rep_kl = $row[3];
                $beds_icu_total_kl = $row[4];
                $beds_icu_covid_kl = $row[5];
                $vent_kl = $row[6];
            }
            elseif($row[1] == 'W.P. Labuan')
            {
                $beds_icu_labuan = $row[2];
                $beds_icu_rep_labuan	= $row[3];
                $beds_icu_total_labuan = $row[4];
                $beds_icu_covid_labuan = $row[5];
                $vent_labuan = $row[6];
            }
            elseif($row[1] == 'W.P. Putrajaya')
            {
                $beds_icu_Putrajaya = $row[2];
                $beds_icu_rep_Putrajaya	= $row[3];
                $beds_icu_total_Putrajaya = $row[4];
                $beds_icu_covid_Putrajaya = $row[5];
                $vent_Putrajaya = $row[6];
            }
        }
        else
        {
            $icu_date = 'out-of-date';
            if($row[1] == 'Johor')
            {
                $beds_icu_Johor = 'out-of-date';
                $beds_icu_rep_Johor	= 'out-of-date';
                $beds_icu_total_Johor = 'out-of-date';
                $beds_icu_covid_Johor = 'out-of-date';
                $vent_Johor = 'out-of-date';
            }
            elseif($row[1] == 'Kedah')
            {
                $beds_icu_Kedah = 'out-of-date';
                $beds_icu_rep_Kedah	= 'out-of-date';
                $beds_icu_total_Kedah = 'out-of-date';
                $beds_icu_covid_Kedah = 'out-of-date';
                $vent_Kedah = 'out-of-date';
            }
            elseif($row[1] == 'Kelantan')
            {
                $beds_icu_Kelantan = 'out-of-date';
                $beds_icu_rep_Kelantan = 'out-of-date';
                $beds_icu_total_Kelantan = 'out-of-date';
                $beds_icu_covid_Kelantan = 'out-of-date';
                $vent_Kelantan = 'out-of-date';
            }
            elseif($row[1] == 'Melaka')
            {
                $beds_icu_Melaka = 'out-of-date';
                $beds_icu_rep_Melaka = 'out-of-date';
                $beds_icu_total_Melaka = 'out-of-date';
                $beds_icu_covid_Melaka = 'out-of-date';
                $vent_Melaka = 'out-of-date';
            }
            elseif($row[1] == 'Negeri Sembilan')
            {
                $beds_icu_n9 = 'out-of-date';
                $beds_icu_rep_n9	= 'out-of-date';
                $beds_icu_total_n9 = 'out-of-date';
                $beds_icu_covid_n9 = 'out-of-date';
                $vent_n9 = 'out-of-date';
            }
            elseif($row[1] == 'Pahang')
            {
                $beds_icu_Pahang = 'out-of-date';
                $beds_icu_rep_Pahang	= 'out-of-date';
                $beds_icu_total_Pahang = 'out-of-date';
                $beds_icu_covid_Pahang = 'out-of-date';
                $vent_Pahang = 'out-of-date';
            }
            elseif($row[1] == 'Perak')
            {
                $beds_icu_Perak = 'out-of-date';
                $beds_icu_rep_Perak	= 'out-of-date';
                $beds_icu_total_Perak = 'out-of-date';
                $beds_icu_covid_Perak = 'out-of-date';
                $vent_Perak = 'out-of-date';
            }
            elseif($row[1] == 'Perlis')
            {
                $beds_icu_Perlis = 'out-of-date';
                $beds_icu_rep_Perlis	= 'out-of-date';
                $beds_icu_total_Perlis = 'out-of-date';
                $beds_icu_covid_Perlis = 'out-of-date';
                $vent_Perlis= 'out-of-date';
            }
            elseif($row[1] == 'Pulau Pinang')
            {
                $beds_icu_ppinang = 'out-of-date';
                $beds_icu_rep_ppinang	= 'out-of-date';
                $beds_icu_total_ppinang = 'out-of-date';
                $beds_icu_covid_ppinang = 'out-of-date';
                $vent_ppinang = 'out-of-date';
            }
            elseif($row[1] == 'Sabah')
            {
                $beds_icu_Sabah = 'out-of-date';
                $beds_icu_rep_Sabah	= 'out-of-date';
                $beds_icu_total_Sabah = 'out-of-date';
                $beds_icu_covid_Sabah = 'out-of-date';
                $vent_Sabah = 'out-of-date';
            }
            elseif($row[1] == 'Sarawak')
            {
                $beds_icu_Sarawak = 'out-of-date';
                $beds_icu_rep_Sarawak= 'out-of-date';
                $beds_icu_total_Sarawak = 'out-of-date';
                $beds_icu_covid_Sarawak = 'out-of-date';
                $vent_Sarawak = 'out-of-date';
            }
            elseif($row[1] == 'Selangor')
            {
                $beds_icu_Selangor = 'out-of-date';
                $beds_icu_rep_Selangor	= 'out-of-date';
                $beds_icu_total_Selangor = 'out-of-date';
                $beds_icu_covid_Selangor = 'out-of-date';
                $vent_Selangor = 'out-of-date';
            }
            elseif($row[1] == 'Terengganu')
            {
                $beds_icu_Terengganu = 'out-of-date';
                $beds_icu_rep_Terengganu	= 'out-of-date';
                $beds_icu_total_Terengganu = 'out-of-date';
                $beds_icu_covid_Terengganu = 'out-of-date';
                $vent_Terengganu = 'out-of-date';
            }
            elseif($row[1] == 'W.P. Kuala Lumpur')
            {
                $beds_icu_kl = 'out-of-date';
                $beds_icu_rep_kl = 'out-of-date';
                $beds_icu_total_kl = 'out-of-date';
                $beds_icu_covid_kl = 'out-of-date';
                $vent_kl = 'out-of-date';
            }
            elseif($row[1] == 'W.P. Labuan')
            {
                $beds_icu_labuan = 'out-of-date';
                $beds_icu_rep_labuan	= 'out-of-date';
                $beds_icu_total_labuan = 'out-of-date';
                $beds_icu_covid_labuan = 'out-of-date';
                $vent_labuan = 'out-of-date';
            }
            elseif($row[1] == 'W.P. Putrajaya')
            {
                $beds_icu_Putrajaya = 'out-of-date';
                $beds_icu_rep_Putrajaya	= 'out-of-date';
                $beds_icu_total_Putrajaya = 'out-of-date';
                $beds_icu_covid_Putrajaya = 'out-of-date';
                $vent_Putrajaya = 'out-of-date';
            }
        }
	}
	// Close the file
	fclose($h);
}

?>