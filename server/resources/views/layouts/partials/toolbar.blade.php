	<!-- begin::Sticky Toolbar -->
<!--
# @Author: Codeals
# @Date:   22-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 07-12-2019
# @Copyright: Codeals
-->

@php
    $userLogin = \Auth::user();

    $offers = \App\Http\Controllers\OfferController::apiIndex();

@endphp

  <ul class="kt-sticky-toolbar" style="margin-top: 30px;">
    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" id="kt_demo_panel_toggle" data-toggle="kt-tooltip" title="Check out more demos" data-placement="right">
      <a href="#" class=""><i class="flaticon2-drop"></i></a>
    </li>
    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--brand" data-toggle="kt-tooltip" title="Settings Builder" data-placement="left">
      <a href="{{ route('settings.edit') }}"><i class="flaticon2-gear"></i></a>
    </li>
    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--warning" data-toggle="kt-tooltip" title="Documentation" data-placement="left">
      <a href="https://codeals.es" target="_blank"><i class="flaticon2-telegram-logo"></i></a>
    </li>
    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--danger" id="kt_sticky_toolbar_chat_toggler" data-toggle="kt-tooltip" title="Chat Example" data-placement="left">
      <a href="#" data-toggle="modal" data-target="#kt_chat_modal"><i class="flaticon2-chat-1"></i></a>
    </li>
  </ul>

  <!-- end::Sticky Toolbar -->

  <!-- begin::Demo Panel -->
  <div id="kt_demo_panel" class="kt-demo-panel">
  <div class="kt-demo-panel__head">
    <h3 class="kt-demo-panel__title">
      Ofertas

      <!--<small>5</small>-->
    </h3>
    <a href="#" class="kt-demo-panel__close" id="kt_demo_panel_close"><i class="flaticon2-delete"></i></a>
  </div>
  <div class="kt-demo-panel__body">
    @foreach($offers as $offer)
      <div class="kt-demo-panel__item ">
        <div class="kt-demo-panel__item-title">
          {{$offer->name}}
        </div>
        <div class="kt-demo-panel__item-preview">
          <img src="{{ asset('assets/media/demos/preview/demo1.jpg') }}" alt="" />
          <div class="kt-demo-panel__item-preview-overlay">
            <a href="#" class="btn btn-brand btn-elevate ">Estadisticas</a>
          </div>
        </div>
      </div>
    @endforeach
    <!-- <a href="https://1.envato.market/EA4JP" target="_blank" class="kt-demo-panel__purchase btn btn-brand btn-elevate btn-bold btn-upper">
      Buy Metronic Now!
    </a> -->
  </div>
</div>
