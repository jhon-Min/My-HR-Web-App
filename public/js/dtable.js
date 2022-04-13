// Csrf token
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": token.content,
        },
    });
} else {
    console.log("csrf token not found");
}

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
