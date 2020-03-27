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
              <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                  <div class="kt-container ">
                      <div class="kt-subheader__main">
												<h3 class="kt-subheader__title">
													Editar Oferta </h3>
												<span class="kt-subheader__separator kt-hidden"></span>
												<div class="kt-subheader__breadcrumbs">
													<span class="kt-subheader__breadcrumbs-separator"></span>
													<a href="{{ route('offers.index') }}" class="kt-subheader__breadcrumbs-link">
														Listar Ofertas </a>
													<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
												</div>
											</div>
                      <div class="kt-subheader__toolbar">
                          <div class="kt-subheader__wrapper">
                              <a href="#" class="btn kt-subheader__btn-primary">
                                  Actions &nbsp;
                                  <!--<i class="flaticon2-calendar-1"></i>-->
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
                                      </svg>                        <!--<i class="flaticon2-plus"></i>-->
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">
                                      <!--begin::Nav-->
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
                                      <!--end::Nav-->
                                  </div>
                              </div>
                          </div>
                      </div>
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
                                  Modificar Oferta
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
															Editar Oferta
														</h3>
													</div>
												</div>
												<!--begin::Form-->
												<form class="kt-form kt-form--label-right" action="{{ route('offers.update', $offer->id) }}" method="post">
													<input type="hidden" name="_method" value="PUT">
                      		@csrf
													<input type="hidden" name="id" value="{{$offer->id}}">
													<div class="kt-portlet__body">
														<div class="form-group form-group-last">
															<!-- <div class="alert alert-secondary" role="alert">
																<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
																<div class="alert-text">
																	Here are examples of <code>.form-control</code> applied to each textual HTML5 input type:
																</div>
															</div> -->
														</div>
														<div class="form-group row">
															<label for="example-text-input" class="col-2 col-form-label">Nombre Oferta</label>
															<div class="col-10">
																<input class="form-control" name="name" type="text" value="{{$offer->name}}" id="example-text-input">
															</div>
														</div>
														<div class="form-group row">
															<label for="example-search-input" class="col-2 col-form-label">Tipo</label>
															<div class="col-10">
																 {!! Form::select('type', $types, $offer->type, ['class' => 'form-control', 'id' => 'example-search-input']) !!}
																<!-- <input class="form-control" type="search" value="How do I shoot web" id="example-search-input"> -->
															</div>
														</div>
														<!-- <div class="form-group row">
															<label for="example-tel-input" class="col-2 col-form-label">Celular</label>
															<div class="col-10">
																<input class="form-control" name="phone" type="tel" value="{{ old('phone') }}" id="example-tel-input">
															</div>
														</div>
														<div class="form-group row">
															<label for="example-email-input" class="col-2 col-form-label">Email</label>
															<div class="col-10">
																<input class="form-control" name="phone" type="email" value="{{ old('email') }}" id="example-email-input">
															</div>
														</div> -->
														<div class="form-group row">
															<label for="example-datetime-local-input" class="col-2 col-form-label">Fecha Inicio</label>
															<div class="col-10">
																<input class="form-control" name="date_ini" type="date" value="{{$offer->date_ini}}" id="example-datetime-local-input">
															</div>
														</div>
														<div class="form-group row">
															<label for="example-date-input" class="col-2 col-form-label">Fecha Fin</label>
															<div class="col-10">
																<input class="form-control" name="date_end" type="date" value="{{$offer->date_end}}" id="example-date-input">
															</div>
														</div>
														<div class="form-group row">
															<label for="example-date-input" class="col-2 col-form-label">Fecha Explira</label>
															<div class="col-10">
																<input class="form-control" name="date_expire" type="date" value="{{$offer->date_expire}}" id="example-date-input">
															</div>
														</div>
														<div class="form-group row">
															<label for="example-date-input" class="col-2 col-form-label">Precio a Pagar</label>
															<div class="col-10">
																<input class="form-control" name="price_pay" type="text" value="{{$offer->price_pay}}" id="example-date-input">
															</div>
														</div>
														<div class="form-group row">
															<label for="example-date-input" class="col-2 col-form-label">Monto a Recargar</label>
															<div class="col-10">
																<input class="form-control" name="recharge_amount" type="text" value="{{$offer->recharge_amount}}" id="example-date-input">
															</div>
														</div>
														<div class="form-group row">
															<label for="example-date-input" class="col-2 col-form-label">Descripción de Oferta</label>
															<div class="col-10">
																<input class="form-control" name="receive" type="text" value="{{$offer->receive}}" id="example-date-input">
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
