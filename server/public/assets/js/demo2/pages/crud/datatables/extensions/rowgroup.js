/**
 * @Author: Codeals
 * @Date:   22-11-2019
 * @Email:  ian@codeals.es
 * @Last modified by:   Codeals
 * @Last modified time: 05-12-2019
 * @Copyright: Codeals
 */

"use strict";
var KTDatatablesExtensionsRowgroup = function() {

	var initTable1 = function() {
		var table = $('#kt_table_1');

		// begin first table
		table.DataTable({
			responsive: true,
			order: [[1, 'asc']],
			rowGroup: {
				dataSrc: 1,
			},
			columnDefs: [
				// {
				// 	targets: -1,
				// 	title: 'Actions',
				// 	orderable: false,
				// 	render: function(data, type, full, meta) {
				// 		return `
        //                 <span class="dropdown">
        //                     <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
        //                       <i class="la la-ellipsis-h"></i>
        //                     </a>
        //                     <div class="dropdown-menu dropdown-menu-right">
        //                         <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
        //                         <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
        //                         <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
        //                     </div>
        //                 </span>
        //                 <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
        //                   <i class="la la-edit"></i>
        //                 </a>`;
				// 	},
				// },
				{
					targets: 6,
					render: function(data, type, full, meta) {
						var status = {
							"Waiting": {'title': 'Pending', 'class': 'kt-badge--brand'},
							"Denied": {'title': 'Denied', 'class': ' kt-badge--danger'},
							"Cancel": {'title': 'Canceled', 'class': ' kt-badge--warning'},
							"Accepted": {'title': 'Accepted', 'class': ' kt-badge--success'},
							// 5: {'title': 'Info', 'class': ' kt-badge--info'},
							// 6: {'title': 'Danger', 'class': ' kt-badge--danger'},
							// 7: {'title': 'Warning', 'class': ' kt-badge--warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
					},
				},
				{
					targets: 9,
					render: function(data, type, full, meta) {
						var status = {
							0: {'title': '', 'state': 'primary'},
							1: {'title': 'ADs', 'state': 'success'},
							2: {'title': 'Online', 'state': 'danger'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge kt-badge--' + status[data].state + ' kt-badge--dot"></span>&nbsp;' +
							'<span class="kt-font-bold kt-font-' + status[data].state + '">' + status[data].title + '</span>';
					},
				},
			],
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
	KTDatatablesExtensionsRowgroup.init();
});
