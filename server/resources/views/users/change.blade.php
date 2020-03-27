<!--
# @Author: Codeals
# @Date:   11-07-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 07-12-2019
# @Copyright: Codeals
-->

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
									<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{!! trans('user.views.change') !!} {!! trans('user.views.password') !!}</span>
								</div>
							</div>

						</div> -->

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
                    <div class="alert-icon"><i class="flaticon-like"></i></div>
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
													Cambiar Contraseña </h3>
												<span class="kt-subheader__separator kt-hidden"></span>
												<div class="kt-subheader__breadcrumbs">
													<span class="kt-subheader__breadcrumbs-separator"></span>
													<a href="{{ route('users.index') }}" class="kt-subheader__breadcrumbs-link">
														Listar Usuarios </a>
													<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
												</div>
											</div>

                  </div>
              </div>
              <div class="kt-container  kt-grid__item kt-grid__item--fluid">
                  <div class="alert alert-light alert-elevate" role="alert">
                      <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                      <div class="alert-text">
                          Cambiar la contraseña. <a class="kt-link kt-font-bold" href="https://codeals.es/" target="_blank">here</a>.
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

							<!--begin::Portlet-->
							<div class="row">

                <!--Begin:: App Aside-->
								<div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

									<!--begin:: Widgets/Applications/User/Profile1-->
									<div class="kt-portlet ">
										<div class="kt-portlet__head  kt-portlet__head--noborder">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
												</h3>
											</div>

										</div>
										<div class="kt-portlet__body kt-portlet__body--fit-y">

											<!--begin::Widget -->
											<div class="kt-widget kt-widget--user-profile-1">
												<div class="kt-widget__head">
													<!-- <div class="kt-widget__media">
														<img src="{{ asset('uploads/users/'.$user->imagen) }}" alt="image">
													</div> -->
													<div class="kt-widget__content">
														<div class="kt-widget__section">
															<a href="#" class="kt-widget__username">
																{{$user->name}}
																<i class="flaticon2-correct kt-font-success"></i>
															</a>
															<span class="kt-widget__subtitle">
																{{$user->role}}
															</span>
														</div>
                            @if($user->admin == 1)
														<div class="kt-widget__action">
															<a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Editar</a>&nbsp;
														</div>
                            @endif
													</div>
												</div>
												<div class="kt-widget__body">
													<div class="kt-widget__content">
														<div class="kt-widget__info">
															<!-- <span class="kt-widget__label">{!! trans('user.views.email') !!}:</span> -->
															<a href="#" class="kt-widget__data">{{$user->email}}</a>
														</div>


													</div>

												</div>
											</div>

											<!--end::Widget -->
										</div>
									</div>

									<!--end:: Widgets/Applications/User/Profile1-->
								</div>

								<div class="col-lg-8">
									<div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Cambiar password
												</h3>
											</div>
										</div>

										<!--begin::Form-->
										<form class="kt-form kt-form--label-right" action="{{route('users.store-password')}}" method="post" enctype="multipart/form-data">
                      @csrf
											<div class="kt-portlet__body">
												<div class="kt-section">
													<h3 class="kt-section__title">
														Nueva contraseña
													</h3>

		                			<input type="hidden" name="password" value="">

													<div class="kt-section__content">
														<div class="form-group form-group-last row">
															<div class="col-lg-6">
																<label class="form-control-label">* Nueva contraseña:</label>
																<input type="password" name="password" class="form-control" placeholder="" value="{{ old('password') }}">
															</div>

                              <div class="col-lg-6">
																<label class="form-control-label">* Confirmar contraseña:</label>
																<input type="password" name="password_confirmation" class="form-control" placeholder="" value="{{ old('email') }}">
															</div>

														</div>

													</div>
												</div>
												<!-- <div class="kt-separator kt-separator--border-dashed kt-separator--space-xl"></div> -->

											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-12">
															<button type="submit" class="btn btn-brand">Aceptar</button>
															<!-- <button type="reset" class="btn btn-secondary">{!! trans('share.views.cancel') !!}</button> -->
														</div>
													</div>
												</div>
											</div>
										</form>

										<!--end::Form-->
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
		<script src="{{ asset('assets/js/demo4/pages/crud/forms/validation/form-controls.js') }}" type="text/javascript"></script>

		<!--end::Page Scripts -->

@endsection
