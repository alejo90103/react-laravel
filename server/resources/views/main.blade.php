@extends('layouts.app')
<!--
# @Author: Codeals
# @Date:   22-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 07-12-2019
# @Copyright: Codeals
-->

@php

    $current_year = date('Y');
    $dashboard = \App\Http\Controllers\HomeController::dashboard();
    $dash_chart = \App\Http\Controllers\HomeController::dashboardChart($current_year);
    $getRecharges = \App\Http\Controllers\HomeController::getRecharge();

@endphp

@section('content')

  <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
    <div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

        <!-- begin:: Content Head -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
          <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Dashboard</h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <!-- <span class="kt-subheader__desc">#XRS-45670</span>
            <a href="#" class="btn btn-label-primary btn-bold btn-icon-h kt-margin-l-10">
              Add New
            </a> -->
          </div>
          <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
              <a href="#" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip" title="Select dashboard daterange" data-placement="left">
                <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                <span class="kt-subheader__btn-daterange-date" id="kt_dashboard_daterangepicker_date">Aug 16</span>
                <i class="flaticon2-calendar-1"></i>
              </a>
              <a href="#" class="btn kt-subheader__btn-primary btn-icon">
                <i class="flaticon2-file"></i>
              </a>
              <a href="#" class="btn kt-subheader__btn-primary btn-icon">
                <i class="flaticon-download-1"></i>
              </a>
              <a href="#" class="btn kt-subheader__btn-primary btn-icon">
                <i class="flaticon2-fax"></i>
              </a>
              <a href="#" class="btn kt-subheader__btn-primary btn-icon">
                <i class="flaticon2-settings"></i>
              </a>
              <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="left">
                <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                      <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                      <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" id="Combined-Shape" fill="#000000" />
                    </g>
                  </svg>

                  <!--<i class="flaticon2-plus"></i>-->
                </a>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">

                  <!--begin::Nav-->
                  <ul class="kt-nav">
                    <li class="kt-nav__head">
                      Export Options:
                      <i class="flaticon2-correct kt-font-warning" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                    </li>
                    <li class="kt-nav__separator"></li>
                    <li class="kt-nav__item">
                      <a href="#" class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-drop"></i>
                        <span class="kt-nav__link-text">Orders</span>
                      </a>
                    </li>
                    <li class="kt-nav__item">
                      <a href="#" class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-new-email"></i>
                        <span class="kt-nav__link-text">Members</span>
                        <span class="kt-nav__link-badge">
                          <span class="kt-badge kt-badge--brand kt-badge--rounded">15</span>
                        </span>
                      </a>
                    </li>
                    <li class="kt-nav__item">
                      <a href="#" class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                        <span class="kt-nav__link-text">Reports</span>
                      </a>
                    </li>
                    <li class="kt-nav__item">
                      <a href="#" class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-link"></i>
                        <span class="kt-nav__link-text">Finance</span>
                      </a>
                    </li>
                    <li class="kt-nav__separator"></li>
                    <li class="kt-nav__foot">
                      <a class="btn btn-label-brand btn-bold btn-sm" href="#">More options</a>
                      <a class="btn btn-clean btn-bold btn-sm kt-hidden" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                    </li>
                  </ul>

                  <!--end::Nav-->
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- end:: Content Head -->

        <!-- begin:: Content -->
        <div class="kt-content kt-grid__item kt-grid__item--fluid">

          <!--Begin::Dashboard 2-->

          <!--Begin::Section::Primera Fila-->
          <div class="row">
            <div class="col-xl-6 col-md-6">

              <!--begin:: Widgets/Daily Sales-->
              <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-widget14">
                  <div class="kt-widget14__header">
                    <h3 class="kt-widget14__title">
                      Recargas por mes
                    </h3>
                    <span class="kt-widget14__desc">
                      Recargas con y sin ofertas
                    </span>
                  </div>
                  <div class="kt-widget14__chart" style="height:150px;">
                    <canvas id="kt_chart_daily_sales_dash"></canvas>
                  </div>
                </div>
              </div>

              <!--end:: Widgets/Daily Sales-->
            </div>
            <div class="col-xl-3 col-md-3">

              <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-widget14">
                  <div class="kt-widget14__header">
                    <h3 class="kt-widget14__title">
                      Recargas realizadas
                    </h3>
                    <span class="kt-widget14__desc">
                      Ganacias por tipo de recarga
                    </span>
                  </div>
                  <div class="kt-widget14__content">
                    <div class="kt-widget14__chart">
                      <div class="kt-widget14__stat"><?php echo $getRecharges[2]; ?>€</div>
                      <canvas id="kt_chart_profit_share_dash" style="height: 140px; width: 150px;"></canvas>
                    </div>
                    <div class="kt-widget14__legends">
                      <div class="kt-widget14__legend">
                        <span class="kt-widget14__bullet kt-bg-success"></span>
                        <span class="kt-widget14__stats">37% Sport Tickets</span>
                      </div>
                      <div class="kt-widget14__legend">
                        <span class="kt-widget14__bullet kt-bg-warning"></span>
                        <span class="kt-widget14__stats">47% Business Events</span>
                      </div>
                      <div class="kt-widget14__legend">
                        <span class="kt-widget14__bullet kt-bg-brand"></span>
                        <span class="kt-widget14__stats">19% Others</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>


            <div class="col-xl-3 col-md-3">
              <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-widget14">
                  <div class="kt-widget14__header">
                    <h3 class="kt-widget14__title">
                      Revenue Change
                    </h3>
                    <span class="kt-widget14__desc">
                      Revenue change breakdown by cities
                    </span>
                  </div>
                  <div class="kt-widget14__content">
                    <div class="kt-widget14__chart">
                      <div id="kt_chart_revenue_change_dash" style="height: 150px; width: 150px;"></div>
                    </div>
                    <div class="kt-widget14__legends">
                      <div class="kt-widget14__legend">
                        <span class="kt-widget14__bullet kt-bg-success"></span>
                        <span class="kt-widget14__stats">+10% New York</span>
                      </div>
                      <div class="kt-widget14__legend">
                        <span class="kt-widget14__bullet kt-bg-warning"></span>
                        <span class="kt-widget14__stats">-7% London</span>
                      </div>
                      <div class="kt-widget14__legend">
                        <span class="kt-widget14__bullet kt-bg-brand"></span>
                        <span class="kt-widget14__stats">+20% California</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--End::Section-->

          <!--Begin::Section::Segunda Fila-->
            <div class="row">
              <div class="col-xl-8 col-md-8">

                <!--begin:: Widgets/Order Statistics-->
                <div id="kt_blockui_2_1" class="kt-portlet kt-portlet--height-fluid">
                  <div class="kt-portlet__head kt-widget14">
                    <!-- <div class="kt-portlet__head-label">
                      <h3 class="kt-portlet__head-title">
                        Recargas por mes
                      </h3>
                    </div> -->
                    <div class="kt-widget14__header">
                      <h3 class="kt-widget14__title">
                        Recargas Mensual
                      </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="input-group date">
                            <div style="margin-left: 5px; display: inline-block;">
                                  <div class="fg-line">
                                      <div class="select">
                                        <select id="rechargeYear" class="selectpicker" style="text-align: center">
                                            <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                                            <option value="<?php echo date ( 'Y' , strtotime ( '-1 year' , strtotime ( date('Y') ) ) ); ?>"><?php echo date ( 'Y' , strtotime ( '-1 year' , strtotime ( date('Y') ) ) ); ?></option>
                                            <option value="<?php echo date ( 'Y' , strtotime ( '-2 year' , strtotime ( date('Y') ) ) ); ?>"><?php echo date ( 'Y' , strtotime ( '-2 year' , strtotime ( date('Y') ) ) ) ?></option>
                                            <option value="<?php echo date ( 'Y' , strtotime ( '-3 year' , strtotime ( date('Y') ) ) ); ?>"><?php echo date ( 'Y' , strtotime ( '-3 year' , strtotime ( date('Y') ) ) ) ?></option>
                                        </select>
                                      </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget12">
                      <div class="kt-widget12__content">


                      </div>
                      <div class="kt-widget12__chart" style="height:200px;">
                          <!-- <canvas id="kt_chart_order_statistics"></canvas> -->
                        <canvas id="kt_chart_rechargePerMonth"></canvas>
                      </div>
                    </div>
                  </div>
                </div>

                <!--end:: Widgets/Order Statistics-->
              </div>

              <div class="col-xl-4">

                <!--begin:: Widgets/Inbound Bandwidth-->
                <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder ">
                  <div class="kt-portlet__head kt-portlet__space-x">
                    <div class="kt-portlet__head-label">
                      <h3 class="kt-portlet__head-title">
                        Monto mensual
                      </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                      <a href="#" class="btn btn-label-success btn-sm btn-bold dropdown-toggle" data-toggle="dropdown">
                        Export
                      </a>
                      <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                        <ul class="kt-nav">
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                              <span class="kt-nav__link-text">Reports</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-send"></i>
                              <span class="kt-nav__link-text">Messages</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                              <span class="kt-nav__link-text">Charts</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-avatar"></i>
                              <span class="kt-nav__link-text">Members</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-settings"></i>
                              <span class="kt-nav__link-text">Settings</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget20">
                      <div class="kt-widget20__content kt-portlet__space-x">
                        <span class="kt-widget20__number kt-font-brand"><?php echo $getRecharges[2]; ?>€</span>
                        <span class="kt-widget20__desc">Successful transactions</span>
                      </div>
                      <div class="kt-widget20__chart" style="height:180px;">
                        <canvas id="kt_chart_bandwidth1_dash"></canvas>
                      </div>
                    </div>
                  </div>
                </div>

                <!--end:: Widgets/Inbound Bandwidth-->
                <!-- <div class="kt-space-20"></div> -->

                <!--begin:: Widgets/Outbound Bandwidth-->
                <!-- <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder kt-portlet--height-fluid-half">
                  <div class="kt-portlet__head kt-portlet__space-x">
                    <div class="kt-portlet__head-label">
                      <h3 class="kt-portlet__head-title">
                        Outbound Bandwidth
                      </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                      <a href="#" class="btn btn-label-warning btn-sm  btn-bold dropdown-toggle" data-toggle="dropdown">
                        Download
                      </a>
                      <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                        <ul class="kt-nav">
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                              <span class="kt-nav__link-text">Reports</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-send"></i>
                              <span class="kt-nav__link-text">Messages</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                              <span class="kt-nav__link-text">Charts</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-avatar"></i>
                              <span class="kt-nav__link-text">Members</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-settings"></i>
                              <span class="kt-nav__link-text">Settings</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget20">
                      <div class="kt-widget20__content kt-portlet__space-x">
                        <span class="kt-widget20__number kt-font-danger">1340+</span>
                        <span class="kt-widget20__desc">Completed orders</span>
                      </div>
                      <div class="kt-widget20__chart" style="height:130px;">
                        <canvas id="kt_chart_bandwidth2"></canvas>
                      </div>
                    </div>
                  </div>
                </div> -->

                <!--end:: Widgets/Outbound Bandwidth-->
              </div>

            </div>

            <!--End::Section-->

          <!--Begin::Section-->


          <!--End::Section-->

          <!--Begin::Section-->


          <!--End::Section-->

          <!--Begin::Section-->


          <!--End::Section-->

          <!--Begin::Section-->


          <!--End::Section-->

          <!--Begin::Section-->


          <!--End::Section-->



          <!--End::Dashboard 2-->
        </div>

        <!-- end:: Content -->
      </div>
    </div>
  </div>

@endsection

@section('js')

<script type="text/javascript">

        jQuery(document).ready(function() {

            var chartRecharge = '';

            $('#rechargeYear').on('change', function() {
                KTApp.block('#kt_blockui_2_1', {
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'success',
                    size: 'lg',
                    message: 'Cargando...'
                });

                $.get(
                    "{{ route('home.dashboardChart', 'year') }}".replace(/year/i, this.value),
                    function (result) {

                        KTApp.unblock('#kt_blockui_2_1');

                        if (!KTUtil.getByID('kt_chart_rechargePerMonth')) {
                            return;
                        }

                        var recharges = [];
                        for (var i = 0; i < result[0].length; i++) {
                            recharges.push(result[0][i]);
                        }

                        chartRecharge.data.datasets[0].data = recharges;
                        chartRecharge.update();

                    }
                );
            });

            var chartRechargePerMonth = function() {
                var container = KTUtil.getByID('kt_chart_rechargePerMonth');

                if (!container) {
                    return;
                }

                var color = Chart.helpers.color;
                var barChartData = {
                    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    datasets : [
                        {
                            fill: true,
                            borderWidth: 2,
                            backgroundColor: color(KTApp.getStateColor('success')).alpha(0.5).rgbString(),
                            borderColor : color(KTApp.getStateColor('success')).alpha(1).rgbString(),

                            pointHoverRadius: 4,
                            pointHoverBorderWidth: 12,
                            pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                            pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                            pointHoverBackgroundColor: KTApp.getStateColor('success'),
                            pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),

                            data: [
                                <?php
                                    foreach ($dash_chart[0] as $key => $year) {
                                        echo $year.',';
                                    }
                                ?>
                            ]
                        }
                    ]
                };

                var ctx = container.getContext('2d');
                chartRecharge = new Chart(ctx, {
                    type: 'line',
                    data: barChartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: false,
                        scales: {
                            xAxes: [{
                                categoryPercentage: 0.35,
                                barPercentage: 0.70,
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'Month'
                                },
                                gridLines: false,
                                ticks: {
                                    display: true,
                                    beginAtZero: true,
                                    fontColor: KTApp.getBaseColor('shape', 3),
                                    fontSize: 13,
                                    padding: 10
                                }
                            }],
                            yAxes: [{
                                categoryPercentage: 0.35,
                                barPercentage: 0.70,
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'Value'
                                },
                                gridLines: {
                                    color: KTApp.getBaseColor('shape', 2),
                                    drawBorder: false,
                                    offsetGridLines: false,
                                    drawTicks: false,
                                    borderDash: [3, 4],
                                    zeroLineWidth: 1,
                                    zeroLineColor: KTApp.getBaseColor('shape', 2),
                                    zeroLineBorderDash: [3, 4]
                                },
                                ticks: {
                                    max: {{$dash_chart[1]}},
                                    stepSize: {{$dash_chart[1] / 5}},
                                    display: true,
                                    beginAtZero: true,
                                    fontColor: KTApp.getBaseColor('shape', 3),
                                    fontSize: 13,
                                    padding: 10
                                }
                            }]
                        },
                        title: {
                            display: false
                        },
                        hover: {
                            mode: 'index'
                        },
                        tooltips: {
                            enabled: true,
                            intersect: false,
                            mode: 'nearest',
                            bodySpacing: 5,
                            yPadding: 10,
                            xPadding: 10,
                            caretPadding: 0,
                            displayColors: false,
                            backgroundColor: KTApp.getStateColor('brand'),
                            titleFontColor: '#ffffff',
                            cornerRadius: 4,
                            footerSpacing: 0,
                            titleSpacing: 0
                        },
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 5,
                                bottom: 5
                            }
                        }
                    }
                });
            }

            chartRechargePerMonth();

            //  cantidad de recargas con y sin offertas por mes

            // Based on Chartjs plugin - http://www.chartjs.org/
            var dailySales = function() {
                var chartContainer = KTUtil.getByID('kt_chart_daily_sales_dash');

                if (!chartContainer) {
                    return;
                }

                var chartData = {
                    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    datasets: [{
                        label: 'Con Ofertas',
                        backgroundColor: KTApp.getStateColor('success'),
                        data: [
                            <?php
                                foreach ($getRecharges[0] as $key => $recharge) {
                                    echo $recharge.',';
                                }
                            ?>
                        ]
                    }, {
                        label: 'Sin Ofertas',
                        backgroundColor: '#f3f3fb',
                        // backgroundColor: KTApp.getStateColor('brand'),
                        data: [
                            <?php
                                foreach ($getRecharges[1] as $key => $recharge) {
                                    echo $recharge.',';
                                }
                            ?>
                        ]
                    }]
                };

                var chart = new Chart(chartContainer, {
                    type: 'bar',
                    data: chartData,
                    options: {
                        title: {
                            display: true,
                        },
                        tooltips: {
                            intersect: true,
                            mode: 'nearest',
                            xPadding: 5,
                            yPadding: 5,
                            caretPadding: 5
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        barRadius: 2,
                        scales: {
                            xAxes: [{
                                display: false,
                                gridLines: true,
                                stacked: true
                            }],
                            yAxes: [{
                                display: false,
                                stacked: true,
                                gridLines: true
                            }]
                        },
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 0,
                                bottom: 0
                            }
                        }
                    }
                });
            }

            dailySales();

            var revenueChange = function() {
                if ($('#kt_chart_revenue_change_dash').length == 0) {
                    return;
                }

                Morris.Donut({
                    element: 'kt_chart_revenue_change_dash',
                    data: [{
                            label: "Accepted",
                            value: <?php echo $getRecharges[3]["accepted"]; ?>
                        },
                        {
                            label: "Denied",
                            value: <?php echo $getRecharges[3]["denied"]; ?>
                        },
                        {
                            label: "Cancel",
                            value: <?php echo $getRecharges[3]["cancel"]; ?>
                        },
                        {
                            label: "Pending",
                            value: <?php echo $getRecharges[3]["waiting"]; ?>
                        },
                        {
                            label: "Scheduled",
                            value: <?php echo $getRecharges[3]["scheduled"]; ?>
                        }
                    ],
                    colors: [
                        KTApp.getStateColor('success'),
                        KTApp.getStateColor('danger'),
                        KTApp.getStateColor('warning'),
                        KTApp.getStateColor('brand'),
                        KTApp.getStateColor('info')
                    ],
                });
            }

            revenueChange();

            // ganancias generadas por tipo de racarga
            var profitShare = function() {
                if (!KTUtil.getByID('kt_chart_profit_share_dash')) {
                    return;
                }

                var randomScalingFactor = function() {
                    return Math.round(Math.random() * 100);
                };

                var config = {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [
                                <?php echo $getRecharges[4]["Cell"]; ?>, <?php echo $getRecharges[4]["Nauta"]; ?>
                            ],
                            backgroundColor: [
                                KTApp.getStateColor('success'),
                                KTApp.getStateColor('brand')
                            ]
                        }],
                        labels: [
                            'Cell',
                            'Nauta'
                        ]
                    },
                    options: {
                        cutoutPercentage: 80,
                        responsive: true,
                        maintainAspectRatio: true,
                        legend: {
                            display: false,
                            position: 'top',
                        },
                        title: {
                            display: false,
                            text: 'Technology'
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        },
                        tooltips: {
                            enabled: true,
                            intersect: true,
                            mode: 'nearest',
                            bodySpacing: 10,
                            yPadding: 15,
                            xPadding: 15,
                            caretPadding: 0,
                            displayColors: true,
                            backgroundColor: KTApp.getStateColor('brand'),
                            titleFontColor: '#ffffff',
                            cornerRadius: 5,
                            footerSpacing: 0,
                            titleSpacing: 0
                        }
                    }
                };

                var ctx = KTUtil.getByID('kt_chart_profit_share_dash').getContext('2d');
                var myDoughnut = new Chart(ctx, config);
            }

            profitShare();

            var bandwidthChart1 = function() {
                if ($('#kt_chart_bandwidth1_dash').length == 0) {
                    return;
                }

                var ctx = document.getElementById("kt_chart_bandwidth1_dash").getContext("2d");

                var gradient = ctx.createLinearGradient(0, 0, 0, 240);
                gradient.addColorStop(0, Chart.helpers.color('#d1f1ec').alpha(1).rgbString());
                gradient.addColorStop(1, Chart.helpers.color('#d1f1ec').alpha(0.3).rgbString());

                var config = {
                    type: 'line',
                    data: {
                        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                        datasets: [{
                            label: "Monto",
                            backgroundColor: gradient,
                            borderColor: KTApp.getStateColor('success'),

                            pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                            pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                            pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                            pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),

                            //fill: 'start',
                            data: [
                                <?php
                                    foreach ($getRecharges[5] as $key => $recharge) {
                                        echo $recharge.',';
                                    }
                                ?>
                            ]
                        }]
                    },
                    options: {
                        title: {
                            display: false,
                        },
                        tooltips: {
                            mode: 'nearest',
                            intersect: false,
                            position: 'nearest',
                            xPadding: 10,
                            yPadding: 10,
                            caretPadding: 10
                        },
                        legend: {
                            display: false
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            xAxes: [{
                                display: false,
                                gridLines: false,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Month'
                                }
                            }],
                            yAxes: [{
                                display: false,
                                gridLines: false,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Value'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        elements: {
                            line: {
                                tension: 0.0000001
                            },
                            point: {
                                radius: 4,
                                borderWidth: 12
                            }
                        },
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 10,
                                bottom: 0
                            }
                        }
                    }
                };

                var chart = new Chart(ctx, config);
            }

            bandwidthChart1();
        });

    </script>

@endsection
