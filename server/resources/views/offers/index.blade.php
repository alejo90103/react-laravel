<!--
# @Author: Codeals
# @Date:   20-06-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 07-12-2019
# @Copyright: Codeals
-->

@extends('layouts.app')

@section('css')

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{ asset('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles -->

@endsection

@section('content')

<!-- begin:: Subheader -->
		<!-- <div class="kt-subheader   kt-grid__item" id="kt_subheader">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					{!! trans('offer.views.offer') !!} </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="{{ route('/') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon-home-2"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="{{ route('/') }}" class="kt-subheader__breadcrumbs-link">
						{!! trans('share.layouts.home') !!} </a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{!! trans('offer.views.offers') !!}</span>
				</div>
			</div>

		</div> -->

<!-- end:: Subheader -->

<!-- begin:: Content -->

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
				<!-- <div class="alert alert-light alert-elevate" role="alert">
					<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
					<div class="alert-text">
						You can use the dom initialisation parameter to move DataTables features around the table to where you want them.
						See official documentation <a class="kt-link kt-font-bold" href="https://datatables.net/examples/advanced_init/dom_multiple_elements.html" target="_blank">here</a>.
					</div>
				</div> -->
                <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                    <div class="kt-container ">
                        <div class="kt-subheader__main">
  												<h3 class="kt-subheader__title">
  													Listar Oferta </h3>

  											</div>
                        <!-- <div class="kt-subheader__toolbar">
                            <div class="kt-subheader__wrapper">
                                <a href="#" class="btn kt-subheader__btn-primary">
                                    Actions &nbsp;
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

                                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                    <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"></path>
                                            </g>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">
                                        <ul class="kt-nav">
                                            <li class="kt-nav__head">
                                                Export Options:
                                                <i class="flaticon2-correct kt-font-warning" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>
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
                                                <a class="btn btn-clean btn-bold btn-sm kt-hidden" href="#" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Click to learn more...">Learn more</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="kt-container  kt-grid__item kt-grid__item--fluid">
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
    								<i class="kt-font-brand flaticon2-bell"></i>
    							</span>
    							<h3 class="kt-portlet__head-title">
    								Ofertas
    							</h3>
    						</div>

    					</div>
    					<div class="kt-portlet__body">

    						<!--begin: Datatable -->
    						<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
    							<thead>
    								<tr>
    									<th>Oferta</th>
    									<th>Tipo</th>
    									<th>Fecha Inicio</th>
    									<th>Fecha Fin</th>
    									<th>Expira</th>
    									<th>A Pagar</th>
    									<th>A Recargar</th>
    									<th>Descripción</th>
    									<th>Actions</th>
    								</tr>
    							</thead>
    							<tbody>
                                    @foreach($offers as $offer)
				                        <tr>
    									<td>{{$offer->name}}</td>
                                        <td>{{$offer->type}}</td>
                                        <td>{{$offer->date_ini}}</td>
                                        <td>{{$offer->date_end}}</td>
                                        <td>{{$offer->date_expire}}</td>
                                        <td>{{$offer->price_pay}}</td>
                                        <td>{{$offer->recharge_amount}}</td>
                                        <td>{{$offer->receive}}</td>
    									<td>
                                            <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Editar">
                                                <i class="la la-edit"></i>
                                            </a>

                                            {!! Form::open(['route' => ['offers.destroy', $offer->id], 'id' => 'form_offer_'.$offer->id, 'style' => 'display: inline']) !!}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" form-id="form_offer_{{$offer->id}}" data-dialog="delete_dialog" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Eliminar">
                                                    <i class="la la-trash"></i>
                                                </button>
                                            {!! Form::close() !!}
                                            </td>
        								</tr>
                                    @endforeach
    							</tbody>
    						</table>
    						<!--end: Datatable -->
    					</div>
    				</div>
                </div>
            </div>

            <div class="modal modal-stick-to-bottom fade" id="delete_dialog" role="dialog" data-backdrop="false" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Atención</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Desea eliminar el usuario</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger delete">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>

<!-- end:: Content -->

@endsection

@section('js')

<!--begin::Page Vendors(used by this page) -->
		<script src="{{ asset('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

		<!--end::Page Vendors -->

		<!--begin::Page Scripts(used by this page) -->
		<!-- <script src="{{ asset('assets/js/demo4/pages/crud/datatables/advanced/multiple-controls.js') }}" type="text/javascript"></script> -->

        <script type="text/javascript">
            var form_to_submit = '';

            $(document).ready(function() {

                $('[data-dialog]').click(function (e) {
                    e.preventDefault();
                    form_to_submit = $(this).attr('form-id');
                    $('#delete_dialog').modal('show');
                });

                $('.delete').click(function () {
                    if(form_to_submit != '') {
                        // alert('Eliminar '+form_to_submit);
                        $("#"+form_to_submit).submit();
                    }
                });
            });

        </script>
		<!--end::Page Scripts -->

    <script type="text/javascript">

  			var KTDatatablesAdvancedMultipleControls = function() {

        	var initTable1 = function() {
        		var table = $('#kt_table_1');

        		// begin first table
        		table.DataTable({
        			// DOM Layout settings
        			dom:
        				"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        				"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>" +
        				"<'row'<'col-sm-12'tr>>" +
        				"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // read more: https://datatables.net/examples/basic_init/dom.html

        			// columnDefs: [
        			// 	{
        			// 		targets: 3,
        			// 		render: function(data, type, full, meta) {
        			// 			var status = {
        			// 				'Super Admin': {'title': 'Super Admin', 'class': 'kt-badge--brand'},
        			// 				'Admin': {'title': 'Admin', 'class': ' kt-badge--success'},
        			// 				'Supervisor': {'title': 'Supervisor', 'class': ' kt-badge--warning'},
        			// 				'Guest': {'title': 'Guest', 'class': ' kt-badge--danger'},
        			// 			};
        			// 			if (typeof status[data] === 'undefined') {
        			// 				return data;
        			// 			}
        			// 			return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
        			// 		},
        			// 	},
              //
        			// ],
        		});
        	};

        	return {

        		//main function to initiate the module
        		init: function() {
        			initTable1();
        		},

        	};

        }();

        jQuery(document).ready(function() {
        	KTDatatablesAdvancedMultipleControls.init();
        });

		</script>

@endsection
