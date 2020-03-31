export const muiTableLanguageConfig = (t) => ({
  body: {
    noMatch: t("TableTextLabels.body.noMatch"),
    toolTip: t("TableTextLabels.body.tooltip"),
    columnHeaderTooltip: column => `${t("TableTextLabels.body.columnHeaderTooltip")}${column.label}`,
  },
  pagination: {
    next: t("TableTextLabels.pagination.next"),
    previous: t("TableTextLabels.pagination.previous"),
    rowsPerPage: t("TableTextLabels.pagination.rowsPerPage"),
    displayRows: t("TableTextLabels.pagination.displayRows"),
  },
  toolbar: {
    search: t("TableTextLabels.toolbar.search"),
    downloadCsv: t("TableTextLabels.toolbar.downloadCsv"),
    print: t("TableTextLabels.toolbar.print"),
    viewColumns: t("TableTextLabels.toolbar.viewColumns"),
    filterTable: t("TableTextLabels.toolbar.filterTable"),
  },
  filter: {
    all: t("TableTextLabels.filter.all"),
    title: t("TableTextLabels.filter.title"),
    reset: t("TableTextLabels.filter.reset"),
  },
  viewColumns: {
    title: t("TableTextLabels.viewColumns.title"),
    titleAria: t("TableTextLabels.viewColumns.titleAria"),
  },
  selectedRows: {
    text: t("TableTextLabels.selectedRows.text"),
    delete: t("TableTextLabels.selectedRows.delete"),
    deleteAria: t("TableTextLabels.selectedRows.deleteAria"),
  }
})