<!--
# @Author: Codeals
# @Date:   20-06-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 07-12-2019
# @Copyright: Codeals
-->

@extends('layouts.app')

@section('content')

<!-- begin:: Subheader -->


						<!-- end:: Subheader -->

						<!-- begin:: Content -->
						<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

							@if ($errors->any())
                <div class="alert alert-danger fade show" role="alert">
      						<div class="alert-icon"><i class="flaticon2-cross"></i></div>
      						<div class="alert-text">
                    @foreach ($errors->all() as $err)
            				 {{ $err }} </br>
            				@endforeach
                  </div>
      						<div class="alert-close">
      							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      								<span aria-hidden="true"><i class="la la-close"></i></span>
      							</button>
      						</div>
      					</div>
              @endif

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
              <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                  <div class="kt-container ">
                      <div class="kt-subheader__main">
												<h3 class="kt-subheader__title">
													Editar Configuración </h3>
											</div>

                  </div>
              </div>
              <div class="kt-container  kt-grid__item kt-grid__item--fluid">
                  <div class="alert alert-light alert-elevate" role="alert">
                      <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                      <div class="alert-text">
                          Configuraciones para el correcto funcionamiento del sistema. <a class="kt-link kt-font-bold" href="https://codeals.es" target="_blank">here</a>.
                      </div>
                  </div>
                  <div class="kt-portlet kt-portlet--mobile">
                      <div class="kt-portlet__head kt-portlet__head--lg">
                          <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                  <i class="kt-font-brand flaticon2-bell"></i>
                              </span>
                              <h3 class="kt-portlet__head-title">
                                  Modificar Configuración
                              </h3>
                          </div>

                      </div>
                      <div class="kt-portlet__body">
							<!--begin::Portlet-->
							<div class="row">

								<div class="col-lg-12">


									<div class="kt-portlet">
										<div class="row">

										</div>

										<div class="row">

											<div class="col-lg-3">

											</div>

											<div class="col-lg-6">

												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">
															Editar Configuración
														</h3>
													</div>
												</div>
												<!--begin::Form-->
												<form class="kt-form kt-form--label-right" action="{{ route('settings.update', $setting->id) }}" method="post">
													<input type="hidden" name="_method" value="PUT">
                      		@csrf
													<input type="hidden" name="id" value="{{$setting->id}}">
													<div class="kt-portlet__body">
														<div class="form-group form-group-last">

														</div>
														<div class="form-group row">
															<label for="example-text-input" class="col-2 col-form-label">Email App</label>
															<div class="col-10">
																<input class="form-control" name="email" required type="text" value="{{$setting->email}}" id="example-text-input">
															</div>
														</div>
														<div class="form-group row">
															<label for="example-server_client" class="col-2 col-form-label">Dominio Cliente App</label>
															<div class="col-10">
																<input class="form-control" required name="server_client" type="text" value="{{$setting->server_client}}" id="server_client">
															</div>
														</div>
														<div class="form-group row">
															<label for="example-date-input" class="col-2 col-form-label">Comisión %</label>
															<div class="col-10">
																<input class="form-control" name="commission" required type="text" value="{{$setting->commission}}" id="example-commission">
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<div class="row">
																<div class="col-2">
																</div>
																<div class="col-10">
																	<button type="submit" class="btn btn-success">Editar</button>
																	<!-- <button type="reset" class="btn btn-secondary">Cancel</button> -->
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
											<div class="col-lg-3">

											</div>
										</div>


									</div>
									<!--end::Portlet-->
								</div>
                            </div>
                        </div>
							</div>
						</div>

						<!-- end:: Content -->

@endsection

@section('js')

    <!--begin::Page Scripts(used by this page) -->
		<script src="{{ asset('assets/js/demo2/pages/crud/forms/validation/form-controls.js') }}" type="text/javascript"></script>

		<!--end::Page Scripts -->

@endsection
