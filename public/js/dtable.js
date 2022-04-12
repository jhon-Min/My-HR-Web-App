$.extend(true, $.fn.dataTable.defaults, {
    processing: true,
    serverSide: true,
    responsive: true,
    mark: true,
    columnDefs: [
        {
            targets: "hidden",
            visible: false,
        },
        {
            targets: "no-sort",
            orderable: false,
        },
    ],
});
