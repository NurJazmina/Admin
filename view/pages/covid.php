<?php
$_SESSION["title"] = "Covid19 Live Update : Epidemic";
include 'view/partials/_subheader/subheader-v1.php'; 
include 'model/covid.php'; 
?>
<!--begin::Dashboard-->
<!--begin::Row-->
<div class="row">
    <div class="col-xl-8">
        <!--begin::Nav Panel Widget 1-->
        <div class="card card-custom gutter-b card-stretch card-shadowless">
            <!--begin::Header-->
            <div class="card-header h-auto border-0">
                <!--begin::Title-->
                <div class="card-title py-5">
                    <h3 class="card-label">
                        <span class="d-block text-dark font-weight-bolder">Cases State</span>
                        <span class="d-block text-dark-50 mt-2 font-size-sm">Last updated: <?= $cases_state_date; ?></span>
                        <span class="d-block text-dark-50 mt-2 font-size-sm">Daily recorded COVID-19 cases at state level</span>
                    </h3>
                </div>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body p-0">
                <!--begin::Nav Tabs-->
                <div id="carouselIndicators" class="carousel slide" data-interval="false">
                    <!-- <ol class="carousel-indicators">
                        <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselIndicators" data-slide-to="2"></li>
                    </ol> -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <!--begin::Nav Tabs-->
                            <ul class="dashboard-tabs nav nav-pills nav-light-success row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 m-3">
                                    <a class="nav-link border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_1">
                                        <img src="assets/media/svg/malaysia_flags/johor.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Johor</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_Johor; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_Johor; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 m-3">
                                    <a class="nav-link border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_2">
                                        <img src="assets/media/svg/malaysia_flags/kedah.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Kedah</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_Kedah; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_Kedah; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 m-3">
                                    <a class="nav-link active border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_3">
                                        <img src="assets/media/svg/malaysia_flags/kelantan.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Kelantan</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_Kelantan; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_Kelantan; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 m-3">
                                    <a class="nav-link border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_4">
                                        <img src="assets/media/svg/malaysia_flags/melaka.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Melaka</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_Melaka; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_Melaka; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 m-3">
                                    <a class="nav-link border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_5">
                                        <img src="assets/media/svg/malaysia_flags/n9.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Negeri Sembilan</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_n9; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_n9; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Nav Tabs-->
                        </div>
                        <div class="carousel-item">
                            <!--begin::Nav Tabs-->
                            <ul class="dashboard-tabs nav nav-pills nav-light-success row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-0 m-3">
                                    <a class="nav-link border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_5">
                                        <img src="assets/media/svg/malaysia_flags/pahang.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Pahang</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_Pahang; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_Pahang; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 m-3">
                                    <a class="nav-link border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_1">
                                        <img src="assets/media/svg/malaysia_flags/perak.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Perak</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_Perak; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_Perak; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 m-3">
                                    <a class="nav-link border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_2">
                                        <img src="assets/media/svg/malaysia_flags/perlis.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Perlis</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_Perlis; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_Perlis; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 m-3">
                                    <a class="nav-link active border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_3">
                                        <img src="assets/media/svg/malaysia_flags/penang.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Pulau Pinang</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_PPinang; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_PPinang; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 m-3">
                                    <a class="nav-link border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_4">
                                        <img src="assets/media/svg/malaysia_flags/sabah.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Sabah</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_Sabah; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_Sabah; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Nav Tabs-->
                        </div>
                        <div class="carousel-item">
                            <!--begin::Nav Tabs-->
                            <ul class="dashboard-tabs nav nav-pills nav-light-success row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 m-3">
                                    <a class="nav-link border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_5">
                                        <img src="assets/media/svg/malaysia_flags/sarawak.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Sarawak</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_Sarawak; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_Sarawak; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-0 m-3">
                                    <a class="nav-link border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_5">
                                        <img src="assets/media/svg/malaysia_flags/selangor.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Selangor</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_Selangor; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_Selangor; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 m-3">
                                    <a class="nav-link border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_1">
                                        <img src="assets/media/svg/malaysia_flags/terengganu.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Terengganu</span>
                                        <div class="text-center">
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_Terengganu; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_Terengganu; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 m-3">
                                    <a class="nav-link border d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_2">
                                        <img src="assets/media/svg/malaysia_flags/wp.png" width="100" height="100">
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">W.Persekutuan</span>
                                        <div class="text-center">
                                            <?php
                                            $cases_new_wp = $cases_new_Kl + $cases_new_Labuan + $cases_new_Putrajaya;
                                            $cases_recovered_wp = $cases_recovered_Kl + $cases_recovered_Labuan + $cases_recovered_Putrajaya;
                                            ?>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">New Cases : <?= $cases_new_wp; ?></span><br>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder">Recovered : <?= $cases_recovered_wp; ?></span>
                                        </div>
                                    </a>
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Nav Tabs-->
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                        <span><i class="fas fa-chevron-left icon-3x text-success" aria-hidden="true"></i></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                        <span><i class="fas fa-chevron-right icon-3x text-success" aria-hidden="true"></i></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!--end::Nav Tabs-->
                <!--begin::Nav Content-->
                <div class="tab-content m-0 p-0">
                    <div class="tab-pane active" id="forms_widget_tab_1" role="tabpanel"></div>
                    <div class="tab-pane" id="forms_widget_tab_2" role="tabpanel"></div>
                    <div class="tab-pane" id="forms_widget_tab_3" role="tabpanel"></div>
                    <div class="tab-pane" id="forms_widget_tab_4" role="tabpanel"></div>
                    <div class="tab-pane" id="forms_widget_tab_6" role="tabpanel"></div>
                </div>
                <!--end::Nav Content-->
            </div>
            <!--end::Body-->
        </div>
        <!--begin::Nav Panel Widget 1-->
    </div>
    <div class="col-xl-4">
        <!--begin::Engage Widget 8-->
        <div class="card card-custom gutter-b card-stretch card-shadowless">
            <div class="card-body p-0 d-flex">
                <div class="d-flex align-items-start justify-content-start flex-grow-1 p-8 card-rounded flex-grow-1 position-relative">
                    <div class="d-flex flex-column align-items-start">
                        <div class="p-1 flex-grow-1">
                            <h4 class="text-warning font-weight-bolder">Population in Malaysia, 2020</h4>
                            <p class="text-dark-50 font-weight-bold mt-3">Population by age group</p>
                        </div>
                        <div class="p-1 flex-grow-1 mt-8">
                            <h4 class="text-dark-50 font-weight-bolder">POP : <?= number_format($pop,2,",","."); ?> people</h4><br>
                            <h4 class="text-dark-50 font-weight-bolder">POP 18 : <?= number_format($pop_18,2,",","."); ?> people</h4><br>
                            <h4 class="text-dark-50 font-weight-bolder">POP 60 : <?= number_format($pop_60,2,",","."); ?> people</h4><br>
                        </div>
                    </div>
                    <div class="position-absolute right-0 bottom-0 mr-5 overflow-hidden">
                        <img src="assets/media/svg/humans/custom-13.svg" class="max-h-200px max-h-xl-275px mb-n20" alt="" />
                    </div>
                </div>
            </div>
        </div>
        <!--end::Engage Widget 8-->
    </div>
</div>
<!--end::Row-->
<!--begin::Row-->
<div class="row">
    <div class="col-xl-8">
        <!--begin::Charts Widget 2-->
        <div class="card card-custom gutter-b card-stretch card-shadowless">
            <!--begin::Header-->
            <div class="card-header h-auto border-0">
                <!--begin::Title-->
                <div class="card-title py-5">
                    <h3 class="card-label">
                        <span class="d-block text-dark font-weight-bolder">Vaccination</span>
                        <span class="d-block text-dark-50 mt-2 font-size-sm">Last updated: <?= $aefi_date; ?></span>
                        <span class="d-block text-dark-50 mt-2 font-size-sm">MoH collaborates with MoSTI and the COVID-19 Immunisation Task Force (CITF) to publish open data on Malaysia's vaccination rollout.</span>
                    </h3>
                </div>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2 table-responsive">
                <!--begin::table-->
                <table class="table table-bordered table-sm">
                    <tbody class="text-center">
                        <tr class="bg-success text-white">
                            <td class="text-left">Vax type</td>
                            <td>Pfizer</td>
                            <td>Sinovac</td>
                            <td>Astrazeneca</td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Doses</td>
                            <td><?= $doses_pfizer; ?></td>
                            <td><?= $doses_sinovac; ?></td>
                            <td><?= $doses_astrazeneca; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Reports mysj</td>
                            <td><?= $reports_mysj_pfizer; ?></td>
                            <td><?= $reports_mysj_sinovac; ?></td>
                            <td><?= $reports_mysj_astrazeneca; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Reports npra</td>
                            <td><?= $reports_npra_pfizer; ?></td>
                            <td><?= $reports_npra_sinovac; ?></td>
                            <td><?= $reports_npra_astrazeneca; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Non serious</td>
                            <td><?= $nonserious_pfizer; ?></td>
                            <td><?= $nonserious_sinovac; ?></td>
                            <td><?= $nonserious_astrazeneca; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Serious</td>
                            <td><?= $serious_pfizer; ?></td>
                            <td><?= $serious_sinovac; ?></td>
                            <td><?= $serious_astrazeneca; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Suspected anaphylaxis</td>
                            <td><?= $suspected_anaphylaxis_pfizer; ?></td>
                            <td><?= $suspected_anaphylaxis_sinovac; ?></td>
                            <td><?= $suspected_anaphylaxis_astrazeneca; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Acute facial paralysis</td>
                            <td><?= $acute_facial_paralysis_pfizer; ?></td>
                            <td><?= $acute_facial_paralysis_sinovac; ?></td>
                            <td><?= $acute_facial_paralysis_astrazeneca; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Venous thromboembolism</td>
                            <td><?= $venous_thromboembolism_pfizer; ?></td>
                            <td><?= $venous_thromboembolism_sinovac; ?></td>
                            <td><?= $venous_thromboembolism_astrazeneca; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Myo pericarditis</td>
                            <td><?= $myo_pericarditis_pfizer; ?></td>
                            <td><?= $myo_pericarditis_sinovac; ?></td>
                            <td><?= $myo_pericarditis_astrazeneca; ?></td>
                        </tr>
                    </tbody>
                </table>
                <!--end::table-->
            </div>
            <!--end::Body-->
            <!--begin::Header-->
            <div class="card-header h-auto border-0">
                <!--begin::Title-->
                <div class="card-title py-5">
                    <h3 class="card-label">
                        <span class="d-block text-dark font-weight-bolder">Cluster Covid19</span>
                        <span class="d-block text-dark-50 mt-2 font-size-sm">Daily recorded COVID-19 cases at country level</span>
                    </h3>
                </div>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2 table-responsive">
                <!--begin::table-->
                <table class="table table-bordered table-sm">
                    <tbody class="text-center">
                        <tr class="bg-success text-white">
                            <td class="text-left">Date</td>
                            <td><?= $date6; ?></td>
                            <td><?= $date5; ?></td>
                            <td><?= $date4; ?></td>
                            <td><?= $date3; ?></td>
                            <td><?= $date2; ?></td>
                            <td><?= $date1; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Cluster import</td>
                            <td><?= $cluster_import6; ?></td>
                            <td><?= $cluster_import5; ?></td>
                            <td><?= $cluster_import4; ?></td>
                            <td><?= $cluster_import3; ?></td>
                            <td><?= $cluster_import2; ?></td>
                            <td><?= $cluster_import1; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Cluster religious</td>
                            <td><?= $cluster_religious6; ?></td>
                            <td><?= $cluster_religious5; ?></td>
                            <td><?= $cluster_religious4; ?></td>
                            <td><?= $cluster_religious3; ?></td>
                            <td><?= $cluster_religious2; ?></td>
                            <td><?= $cluster_religious1; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Cluster community</td>
                            <td><?= $cluster_community6; ?></td>
                            <td><?= $cluster_community5; ?></td>
                            <td><?= $cluster_community4; ?></td>
                            <td><?= $cluster_community3; ?></td>
                            <td><?= $cluster_community2; ?></td>
                            <td><?= $cluster_community1; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Cluster high risk</td>
                            <td><?= $cluster_highRisk6; ?></td>
                            <td><?= $cluster_highRisk5; ?></td>
                            <td><?= $cluster_highRisk4; ?></td>
                            <td><?= $cluster_highRisk3; ?></td>
                            <td><?= $cluster_highRisk2; ?></td>
                            <td><?= $cluster_highRisk1; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Cluster education</td>
                            <td><?= $cluster_education6; ?></td>
                            <td><?= $cluster_education5; ?></td>
                            <td><?= $cluster_education4; ?></td>
                            <td><?= $cluster_education3; ?></td>
                            <td><?= $cluster_education2; ?></td>
                            <td><?= $cluster_education1; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Cluster detention centre</td>
                            <td><?= $cluster_detentionCentre6; ?></td>
                            <td><?= $cluster_detentionCentre5; ?></td>
                            <td><?= $cluster_detentionCentre4; ?></td>
                            <td><?= $cluster_detentionCentre3; ?></td>
                            <td><?= $cluster_detentionCentre2; ?></td>
                            <td><?= $cluster_detentionCentre1; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Cluster workplace</td>
                            <td><?= $cluster_workplace6; ?></td>
                            <td><?= $cluster_workplace5; ?></td>
                            <td><?= $cluster_workplace4; ?></td>
                            <td><?= $cluster_workplace3; ?></td>
                            <td><?= $cluster_workplace2; ?></td>
                            <td><?= $cluster_workplace1; ?></td>
                        </tr>
                    </tbody>
                </table>
                <!--end::table-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Charts Widget 2-->
    </div>
    <div class="col-xl-4">
        <!--begin::List Widget 2-->
        <div class="card card-custom gutter-b card-stretch card-shadowless">
            <!--begin::Body-->
            <div class="card-body pt-2">
                <!--begin::Item-->
				<div class="text-center text-dark-50">
					<div class="row">
						<a class="text-muted mt-3">Last updated: <?= $date_display; ?></a>
						<div class="col-sm"></div>
						<div class="col-sm">
							<img src="assets/media/client-logos/malaysia.png" class="img-fluid" alt="...">
						</div>
						<div class="col-sm"></div>
						<h1 class="mt-10">Coronavirus Cases :</h1>
						<a class="h1 font-weight-boldest text-primary"><?= $cases_new1; ?></a>

						<h1 class="mt-10">Death :</h1>
						<a class="h1 font-weight-boldest text-danger"><?= $deaths_new; ?></a>

						<h1 class="mt-10">Recovered :</h1>
						<a class="h1 font-weight-boldest text-warning"><?= $cases_recovered1; ?></a>
					</div>
				</div>
                <!--end::Item-->
                <img src="assets/media/svg/illustrations/data-points.svg" class="img-fluid" alt="...">
            </div>
            <!--end::Body-->
        </div>
        <!--end::List Widget 2-->
    </div>
</div>
<!--end::Row-->
<!--begin::Row-->
<div class="row">
    <div class="col-xl-8">
        <!--begin::Advance Table Widget 2-->
        <div class="card card-custom gutter-b card-stretch card-shadowless">
            <!--begin::Header-->
            <div class="card-header h-auto border-0">
                <!--begin::Title-->
                <div class="card-title py-5">
                    <h3 class="card-label">
                        <span class="d-block text-dark font-weight-bolder">ICU</span>
                        <span class="d-block text-dark-50 mt-2 font-size-sm">Last updated: <?= $icu_date; ?></span>
                        <span class="d-block text-dark-50 mt-2 font-size-sm">Number of individuals within the cluster currently under intensive care.</span>
                    </h3>
                </div>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2 table-responsive">
                <!--begin::table-->
                <table class="table table-bordered table-sm">
                    <tbody class="text-center">
                        <tr class="bg-success text-white">
                            <td class="text-left">State</td>
                            <td>Beds icu</td>
                            <td>Bed icu rep</td>
                            <td>Beds icu total</td>
                            <td>Beds icu covid</td>
                            <td>Ventilator</td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Johor</td>
                            <td><?= $beds_icu_Johor; ?></td>
                            <td><?= $beds_icu_rep_Johor; ?></td>
                            <td><?= $beds_icu_total_Johor; ?></td>
                            <td><?= $beds_icu_covid_Johor; ?></td>
                            <td><?= $vent_Johor; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Kedah</td>
                            <td><?= $beds_icu_Kedah; ?></td>
                            <td><?= $beds_icu_rep_Kedah; ?></td>
                            <td><?= $beds_icu_total_Kedah; ?></td>
                            <td><?= $beds_icu_covid_Kedah; ?></td>
                            <td><?= $vent_Kedah; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Kelantan</td>
                            <td><?= $beds_icu_Kelantan; ?></td>
                            <td><?= $beds_icu_rep_Kelantan; ?></td>
                            <td><?= $beds_icu_total_Kelantan; ?></td>
                            <td><?= $beds_icu_covid_Kelantan; ?></td>
                            <td><?= $vent_Kelantan; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Melaka</td>
                            <td><?= $beds_icu_Melaka; ?></td>
                            <td><?= $beds_icu_rep_Melaka; ?></td>
                            <td><?= $beds_icu_total_Melaka; ?></td>
                            <td><?= $beds_icu_covid_Melaka; ?></td>
                            <td><?= $vent_Melaka; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Negeri Sembilan</td>
                            <td><?= $beds_icu_n9; ?></td>
                            <td><?= $beds_icu_rep_n9; ?></td>
                            <td><?= $beds_icu_total_n9; ?></td>
                            <td><?= $beds_icu_covid_n9; ?></td>
                            <td><?= $vent_n9; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Pahang</td>
                            <td><?= $beds_icu_Pahang; ?></td>
                            <td><?= $beds_icu_rep_Pahang; ?></td>
                            <td><?= $beds_icu_total_Pahang; ?></td>
                            <td><?= $beds_icu_covid_Pahang; ?></td>
                            <td><?= $vent_Pahang; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Perak</td>
                            <td><?= $beds_icu_Perak; ?></td>
                            <td><?= $beds_icu_rep_Perak; ?></td>
                            <td><?= $beds_icu_total_Perak; ?></td>
                            <td><?= $beds_icu_covid_Perak; ?></td>
                            <td><?= $vent_Perak; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Perlis</td>
                            <td><?= $beds_icu_Perlis; ?></td>
                            <td><?= $beds_icu_rep_Perlis; ?></td>
                            <td><?= $beds_icu_total_Perlis; ?></td>
                            <td><?= $beds_icu_covid_Perlis; ?></td>
                            <td><?= $vent_Perlis; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Pulau Pinang</td>
                            <td><?= $beds_icu_ppinang; ?></td>
                            <td><?= $beds_icu_rep_ppinang; ?></td>
                            <td><?= $beds_icu_total_ppinang; ?></td>
                            <td><?= $beds_icu_covid_ppinang; ?></td>
                            <td><?= $vent_ppinang; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Sabah</td>
                            <td><?= $beds_icu_Sabah; ?></td>
                            <td><?= $beds_icu_rep_Sabah; ?></td>
                            <td><?= $beds_icu_total_Sabah; ?></td>
                            <td><?= $beds_icu_covid_Sabah; ?></td>
                            <td><?= $vent_Sabah; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Sarawak</td>
                            <td><?= $beds_icu_Sarawak; ?></td>
                            <td><?= $beds_icu_rep_Sarawak; ?></td>
                            <td><?= $beds_icu_total_Sarawak; ?></td>
                            <td><?= $beds_icu_covid_Sarawak; ?></td>
                            <td><?= $vent_Sarawak; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Selangor</td>
                            <td><?= $beds_icu_Selangor; ?></td>
                            <td><?= $beds_icu_rep_Selangor; ?></td>
                            <td><?= $beds_icu_total_Selangor; ?></td>
                            <td><?= $beds_icu_covid_Selangor; ?></td>
                            <td><?= $vent_Selangor; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Terengganu</td>
                            <td><?= $beds_icu_Terengganu; ?></td>
                            <td><?= $beds_icu_rep_Terengganu; ?></td>
                            <td><?= $beds_icu_total_Terengganu; ?></td>
                            <td><?= $beds_icu_covid_Terengganu; ?></td>
                            <td><?= $vent_Terengganu; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">W.P. Kuala Lumpur</td>
                            <td><?= $beds_icu_kl; ?></td>
                            <td><?= $beds_icu_rep_kl; ?></td>
                            <td><?= $beds_icu_total_kl; ?></td>
                            <td><?= $beds_icu_covid_kl; ?></td>
                            <td><?= $vent_kl; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">W.P. Labuan</td>
                            <td><?= $beds_icu_labuan; ?></td>
                            <td><?= $beds_icu_rep_labuan; ?></td>
                            <td><?= $beds_icu_total_labuan; ?></td>
                            <td><?= $beds_icu_covid_labuan; ?></td>
                            <td><?= $vent_labuan; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">W.P. Putrajaya</td>
                            <td><?= $beds_icu_Putrajaya; ?></td>
                            <td><?= $beds_icu_rep_Putrajaya; ?></td>
                            <td><?= $beds_icu_total_Putrajaya; ?></td>
                            <td><?= $beds_icu_covid_Putrajaya; ?></td>
                            <td><?= $vent_Putrajaya; ?></td>
                        </tr>
                    </tbody>
                </table>
                <!--end::table-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 2-->
    </div>
    <div class="col-xl-4">
        <!--begin::List Widget 5-->
        <div class="card card-custom gutter-b card-stretch">
            <!--begin::Header-->
            <div class="card-header h-auto border-0">
                <!--begin::Title-->
                <div class="card-title py-5">
                    <h3 class="card-label">
                        <span class="d-block text-dark font-weight-bolder">Test</span>
                        <span class="d-block text-dark-50 mt-2 font-size-sm">Last updated: <?= $tests_state_date; ?></span>
                        <span class="d-block text-dark-50 mt-2 font-size-sm">Number of tests carried out on individuals within the cluster. Denominator for computing a cluster's current positivity rate.</span>
                    </h3>
                </div>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0">
                <!--begin::table-->
                <table class="table table-bordered table-sm">
                    <tbody class="text-center">
                        <tr class="bg-success text-white">
                            <td class="text-left">State</td>
                            <td>Rtk_ag</td>
                            <td>Pcr</td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Johor</td>
                            <td><?= $state_rtk_ag_Johor; ?></td>
                            <td><?= $state_pcr_Johor; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Kedah</td>
                            <td><?= $state_rtk_ag_Kedah; ?></td>
                            <td><?= $state_pcr_Kedah; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Kelantan</td>
                            <td><?= $state_rtk_ag_Kelantan; ?></td>
                            <td><?= $state_pcr_Kelantan; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Melaka</td>
                            <td><?= $state_rtk_ag_Melaka; ?></td>
                            <td><?= $state_pcr_Melaka; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Negeri Sembilan</td>
                            <td><?= $state_rtk_ag_n9; ?></td>
                            <td><?= $state_pcr_n9; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Pahang</td>
                            <td><?= $state_rtk_ag_Pahang; ?></td>
                            <td><?= $state_pcr_Pahang; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Perak</td>
                            <td><?= $state_rtk_ag_Perak; ?></td>
                            <td><?= $state_pcr_Perak; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Perlis</td>
                            <td><?= $state_rtk_ag_Perlis; ?></td>
                            <td><?= $state_pcr_Perlis; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Pulau Pinang</td>
                            <td><?= $state_rtk_ag_ppinang; ?></td>
                            <td><?= $state_pcr_ppinang; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Sabah</td>
                            <td><?= $state_rtk_ag_Sabah; ?></td>
                            <td><?= $state_pcr_Sabah; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Sarawak</td>
                            <td><?= $state_rtk_ag_Sarawak; ?></td>
                            <td><?= $state_pcr_Sarawak; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Selangor</td>
                            <td><?= $state_rtk_ag_Selangor; ?></td>
                            <td><?= $state_pcr_Selangor; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">Terengganu</td>
                            <td><?= $state_rtk_ag_Terengganu; ?></td>
                            <td><?= $state_pcr_Terengganu; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">W.P. Kuala Lumpur</td>
                            <td><?= $state_rtk_ag_kl; ?></td>
                            <td><?= $state_pcr_kl; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">W.P. Labuan</td>
                            <td><?= $state_rtk_ag_labuan; ?></td>
                            <td><?= $state_pcr_labuan; ?></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="text-left">W.P. Putrajaya</td>
                            <td><?= $state_rtk_ag_putrajaya; ?></td>
                            <td><?= $state_pcr_putrajaya; ?></td>
                        </tr>
                    </tbody>
                </table>
                <!--end::table-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::List Widget 5-->
    </div>
</div>
<!--end::Row-->
<!--end::Dashboard-->