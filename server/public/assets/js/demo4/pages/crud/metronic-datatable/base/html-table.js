/**
 * @Author: Codeals
 * @Date:   01-07-2019
 * @Email:  ian@codeals.es
 * @Last modified by:   Codeals
 * @Last modified time: 03-07-2019
 * @Copyright: Codeals
 */

"use strict";
// Class definition

var KTDatatableHtmlTableDemo = function() {
	// Private functions

	// demo initializer
	var demo = function() {

		var datatable = $('.kt-datatable').KTDatatable({
			data: {
				saveState: {cookie: false},
			},
			search: {
				input: $('#generalSearch'),
			},
			columns: [
				{
					field: 'Operation',
					title: 'Operation',
					autoHide: false,
                    width: 110,
					// callback function support for column rendering
					template: function(row) {
						var status = {
							'switch engine': {'title': 'Switch Engine', 'class': 'kt-badge--brand'},
							'cal_max': {'title': 'Calibration Max', 'class': ' kt-badge--danger'},
							'cal_min': {'title': 'Calibration Min', 'class': ' kt-badge--primary'},
							'weights': {'title': 'Weights', 'class': ' kt-badge--success'},
							'Mix': {'title': 'Mix', 'class': ' kt-badge--warning'},
						};
						return '<span class="center kt-badge ' + status[row.Operation].class + ' kt-badge--inline kt-badge--pill">' + status[row.Operation].title + '</span>';
					},
				}, {
					field: 'Type',
					title: 'Type',
                    width: 110,
					autoHide: false,
					// callback function support for column rendering
					template: function(row) {
						var status = {
							'Read': {'title': 'Read', 'state': 'primary'},
							'Write': {'title': 'Write', 'state': 'danger'},
						};
						return '<div class="center"><span class="kt-badge kt-badge--' + status[row.Type].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' +status[row.Type].state + '">' +	status[row.Type].title + '</span></div>';
					},
				},
                {
					field: 'User',
					title: 'User',
                    width: 110,
					autoHide: false,
				},
                {
					field: 'Create',
					title: 'Create',
                    width: 110,
					autoHide: false,
				},
                {
					field: 'Duration',
					title: 'Duration',
                    width: 110,
					autoHide: false
				},
			],
		});

    $('#kt_form_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Operation');
    });

    $('#kt_form_type').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Type');
    });

    $('#kt_form_status,#kt_form_type').selectpicker();

	};

	return {
		// Public functions
		init: function() {
			// init dmeo
			demo();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableHtmlTableDemo.init();
});
