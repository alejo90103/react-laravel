/**
 * @Author: Codeals
 * @Date:   01-07-2019
 * @Email:  ian@codeals.es
 * @Last modified by:   Codeals
 * @Last modified time: 10-07-2019
 * @Copyright: Codeals
 */

"use strict";
// Class definition

var KTDatatableHtmlTableDemo = function() {
	// Private functions

	// demo initializer
	var demo = function() {

		var datatable = $('.kt-datatable_dash').KTDatatable({
			data: {
				saveState: {cookie: false},
			},
			search: {
				input: $('#generalSearch'),
			},
			columns: [
				{
					field: 'Engine',
					title: 'Engine',
					autoHide: false,
                    width: 110,
					// callback function support for column rendering
					template: function(row) {
						var status = {
							'OFF': {'title': 'OFF', 'class': 'kt-badge--brand'},
							'ON': {'title': 'ON', 'class': ' kt-badge--success'},
							'NOT': {'title': 'NOT', 'class': ' kt-badge--danger'},
						};
                        console.log(row);
						return '<span class="center kt-badge ' + status[row.Engine].class + ' kt-badge--inline kt-badge--pill">' + status[row.Engine].title + '</span>';
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
      datatable.search($(this).val().toLowerCase(), 'Engine');
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
