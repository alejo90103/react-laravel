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
					{!! trans('user.views.user') !!} </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="{{ route('/') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon-home-2"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="{{ route('/') }}" class="kt-subheader__breadcrumbs-link">
						{!! trans('share.layouts.home') !!} </a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{!! trans('user.views.users') !!}</span>
				</div>
			</div>

		</div> -->

<!-- end:: Subheader -->

<!-- begin:: Content -->

    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
      <!-- NOTIFICACION -->
      @if(Session::has('msg'))
          <div class="alert alert-success fade show" role="alert">
						<div class="alert-icon"><i class="flaticon-user-ok"></i></div>
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
  													Listar Usuarios </h3>

  											</div>
                    </div>
                </div>
                <div class="kt-container  kt-grid__item kt-grid__item--fluid">
            		<div class="alert alert-light alert-elevate" role="alert">
                    	<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                    	<div class="alert-text">
                          Listado de usuarios del sistema. <a class="kt-link kt-font-bold" href="https://codeals.es/" target="_blank">here</a>.
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
									<th>Usuario</th>
									<th>Correo</th>
									<th>Rol</th>
									<th>Registrado</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
                @foreach($users as $user)
								<tr>
									<td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  @if($user->admin == 1)
                    <td>Admin</td>
                  @else
                    <td>Cliente</td>
                  @endif
                  <td>{{$user->created_at}}</td>
									<td>

                      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Editar">
                        <i class="la la-edit"></i>
                      </a>

                        {!! Form::open(['route' => ['users.destroy', $user->id], 'id' => 'form_user_'.$user->id, 'style' => 'display: inline']) !!}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" form-id="form_user_{{$user->id}}" data-dialog="delete_dialog" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Eliminar">
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
