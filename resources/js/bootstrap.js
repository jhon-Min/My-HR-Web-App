window._ = require("lodash");
import Dropzone from "dropzone";
import QrScanner from "qr-scanner";
import SortableMin from "sortablejs";
import Swal from "sweetalert2/dist/sweetalert2";
import Viewer from "viewerjs";

try {
    window.$ = window.jQuery = require("jquery");
    window.Swal = Swal;
    window.QrScanner = QrScanner;
    window.Viewer = Viewer;
    window.Sortable = SortableMin;
    // window.Dropzone = Dropzone;
    require("bootstrap");
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
