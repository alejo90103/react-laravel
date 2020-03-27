<!--
# @Author: Codeals
# @Date:   05-12-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 07-12-2019
# @Copyright: Codeals
-->

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 7
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

	<!-- begin::Head -->
	<head>

@extends('layouts.app')

@section('css')


		<!--begin::Page Vendors Styles(used by this page) -->
		<link href="{{ asset('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

		<!--end::Page Vendors Styles -->

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="{{ asset('assets/css/demo2/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/demo2/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/demo2/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/demo2/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />

		<!--end::Layout Skins -->

@endsection

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
  <!-- NOTIFICACION -->
    @if(Session::has('msg'))
        <div class="alert alert-success fade show" role="alert">
            <div class="alert-icon"><i class="flaticon2-bell"></i></div>
            <div class="alert-text">{{ Session::get('msg') }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>
    @endif

    @if(Session::has('err'))
        <div class="alert alert-danger fade show" role="alert">
            <div class="alert-icon"><i class="flaticon2-cross"></i></div>
            <div class="alert-text">{{ Session::get('err') }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>
    @endif
				<!-- end:: Aside -->

					<!-- begin:: Header -->

					<!-- end:: Header -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Recargas por Cliente </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="{{ route('/') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="" class="kt-subheader__breadcrumbs-link">
						Dashboard </a>

					<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
				</div>
			</div>
			<div class="kt-subheader__toolbar">
				<div class="kt-subheader__wrapper">
					<a href="#" class="btn kt-subheader__btn-primary">
						Actions &nbsp;

						<!--<i class="flaticon2-calendar-1"></i>-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect id="bound" x="0" y="0" width="24" height="24" />
								<rect id="Rectangle-8" fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
								<path d="M7.5,11 L16.5,11 C17.3284271,11 18,11.6715729 18,12.5 C18,13.3284271 17.3284271,14 16.5,14 L7.5,14 C6.67157288,14 6,13.3284271 6,12.5 C6,11.6715729 6.67157288,11 7.5,11 Z M10.5,17 L13.5,17 C14.3284271,17 15,17.6715729 15,18.5 C15,19.3284271 14.3284271,20 13.5,20 L10.5,20 C9.67157288,20 9,19.3284271 9,18.5 C9,17.6715729 9.67157288,17 10.5,17 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
							</g>
						</svg> </a>
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
									Add anything or jump to:
									<i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
								</li>
								<li class="kt-nav__separator"></li>
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-drop"></i>
										<span class="kt-nav__link-text">Order</span>
									</a>
								</li>
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-calendar-8"></i>
										<span class="kt-nav__link-text">Ticket</span>
									</a>
								</li>
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-link"></i>
										<span class="kt-nav__link-text">Goal</span>
									</a>
								</li>
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-new-email"></i>
										<span class="kt-nav__link-text">Support Case</span>
										<span class="kt-nav__link-badge">
											<span class="kt-badge kt-badge--success">5</span>
										</span>
									</a>
								</li>
								<li class="kt-nav__separator"></li>
								<li class="kt-nav__foot">
									<a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
									<a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
								</li>
							</ul>

							<!--end::Nav-->
						</div>
					</div>
				</div>
			</div>
        </div>
	</div>

	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-container  kt-grid__item kt-grid__item--fluid" id="kt_content">
		<div class="alert alert-light alert-elevate" role="alert">
			<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
			<div class="alert-text">
				RowGroup adds this ability to DataTables with the ability to customise the start and end grouping rows displayed in the DataTable, letting you integrate the summarised data to fit perfectly in with your site.
				See official documentation <a class="kt-link kt-font-bold" href="https://datatables.net/extensions/rowgroup/" target="_blank">here</a>.
			</div>
		</div>
		<div class="kt-portlet kt-portlet--mobile">
			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="kt-font-brand flaticon2-line-chart"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						RowGroup DataTable
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<div class="kt-portlet__head-actions">
							<div class="dropdown dropdown-inline">
								<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="la la-download"></i> Export
								</button>
								<div class="dropdown-menu dropdown-menu-right">
									<ul class="kt-nav">
										<li class="kt-nav__section kt-nav__section--first">
											<span class="kt-nav__section-text">Choose an option</span>
										</li>
										<li class="kt-nav__item">
											<a href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-print"></i>
												<span class="kt-nav__link-text">Print</span>
											</a>
										</li>
										<li class="kt-nav__item">
											<a href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-copy"></i>
												<span class="kt-nav__link-text">Copy</span>
											</a>
										</li>
										<li class="kt-nav__item">
											<a href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-file-excel-o"></i>
												<span class="kt-nav__link-text">Excel</span>
											</a>
										</li>
										<li class="kt-nav__item">
											<a href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-file-text-o"></i>
												<span class="kt-nav__link-text">CSV</span>
											</a>
										</li>
										<li class="kt-nav__item">
											<a href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-file-pdf-o"></i>
												<span class="kt-nav__link-text">PDF</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
							&nbsp;
							<!-- <a href="#" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								New Record
							</a> -->
						</div>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">

				<!--begin: Datatable -->
				<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
					<thead>
						<tr>
							<th>Realizada</th>
							<th>Cliente</th>
							<th>Tipo</th>
							<th>Recarga a</th>
							<th>Pagó</th>
							<th>Recargó</th>
    <th>Status</th>
	<th>Oferta</th>
	<th>Inicio</th>
	<th>ADs</th>
	<!-- <th>Actions</th> -->
						</tr>
					</thead>
					<tbody>

  @foreach($userRechanges as $userRechange)

						<tr>
							<td>{{$userRechange->created_at}}</td>
    <td>{{$userRechange->user->email}}</td>
							<td>{{$userRechange->type}}</td>
    @if($userRechange->type == "Cell")
							    <td>{{$userRechange->phone}}</td>
    @else
							    <td>{{$userRechange->email}}</td>
    @endif

							<td>{{$userRechange->price_pay}}</td>
							<td>{{$userRechange->recharge_amount}}</td>
    <td>{{$userRechange->status}}</td>
							<td>{{$userRechange->name}}</td>
							<td>{{$userRechange->date_ini}}</td>
							<td>{{$userRechange->ads}}</td>
							<!-- <td nowrap></td> -->
						</tr>
						<!-- <tr>
							<td>112</td>
							<td>43538-171</td>
							<td>Argentina</td>
							<td>Oberá</td>
							<td>79213 Orin Street</td>
							<td>Kalli Gusticke</td>
							<td>Hegmann-Nitzsche</td>
							<td>10/26/2016</td>
							<td>2</td>
							<td>2</td>
							<td nowrap></td>
						</tr> -->

  @endforeach

					</tbody>
					<tfoot>
						<tr>
							<th>Realizada</th>
							<th>Cliente</th>
							<th>Tipo</th>
							<th>Recarga a</th>
							<th>Pagó</th>
							<th>Recargó</th>
                            <th>Status</th>
							<th>Oferta</th>
							<th>Inicio</th>
							<th>ADs</th>
						</tr>
					</tfoot>
				</table>

				<!--end: Datatable -->
			</div>
		</div>
	</div>
	<!-- end:: Content -->
</div>
		<!-- end:: Page -->

@endsection

@section('js')
		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Page Vendors(used by this page) -->
		<script src="{{ asset('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

		<!--end::Page Vendors -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="{{ asset('assets/js/demo2/pages/crud/datatables/extensions/rowgroup.js') }}" type="text/javascript"></script>

		<!--end::Page Scripts -->
@endsection
