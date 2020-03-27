"use strict";
// Class definition

var KTDatatableColumnWidthDemo = function() {
	// Private functions

	// basic demo
	var demo = function() {
		var datatable = $('.kt-datatable').KTDatatable({
			// datasource definition
			data: {
				saveState: {cookie: false},
			},

			// layout definition
			layout: {
				scroll: true, // enable/disable datatable scroll both horizontal and
				// vertical when needed.
				height: null, // datatable's body's fixed height
				footer: false, // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch'),
			},

			// columns definition
			columns: [
				{
					field: 'Operation',
					title: 'Operation',
					sortable: 'asc',
					width: 110,
					selector: false,
					textAlign: 'center',
                    template: function(row) {
						var status = {
							'switch engine': {'title': 'Switch Engine', 'class': 'kt-badge--brand'},
							'cal_max': {'title': 'Calibration Max', 'class': ' kt-badge--danger'},
							'cal_min': {'title': 'Calibration Min', 'class': ' kt-badge--primary'},
							'weights': {'title': 'Weights', 'class': ' kt-badge--success'},
							'Mix': {'title': 'Mix', 'class': ' kt-badge--warning'},
						};
						return '<span class="center kt-badge ' + status[row.Operation].class + ' kt-badge--inline kt-badge--pill">' + status[row.Operation].title + '</span>';
					}
				}, {
					field: 'Type',
					title: 'Type',
                    template: function(row) {
						var status = {
							'Read': {'title': 'Read', 'state': 'primary'},
							'Write': {'title': 'Write', 'state': 'danger'},
						};
						return '<span class="kt-badge kt-badge--' + status[row.Type].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' +status[row.Type].state + '">' +	status[row.Type].title + '</span>';
					},
				}, {
					field: 'User',
					title: 'User',
				}, {
					field: 'Create',
					title: 'Create',
					type: 'date',
					format: 'MM/DD/YYYY',
				}, {
					field: 'Duration',
					title: 'Duration',
					// callback function support for column rendering

				},
			],

		});

    $('#kt_form_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Status');
    });

    $('#kt_form_type').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Type');
    });

    $('#kt_form_status,#kt_form_type').selectpicker();

	};

	return {
		// public functions
		init: function() {
			demo();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableColumnWidthDemo.init();
});
