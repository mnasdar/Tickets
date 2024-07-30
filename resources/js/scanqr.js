import $ from 'jquery';
import { Html5QrcodeScanner } from "html5-qrcode";
$(document).ready(function () {
    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        // console.log(`Code matched = ${decodedText}`, decodedResult);
        $("#ticket_code").val(decodedText)

        html5QrcodeScanner.clear();
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
        fps: 10,
        qrbox: {
            width: 250,
            height: 250
        }
    },
        /* verbose= */
        false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
});

// // This method will trigger user permissions
// Html5Qrcode.getCameras().then(devices => {
//     /**
//      * devices would be an array of objects of type:
//      * { id: "id", label: "label" }
//      */
//     if (devices && devices.length) {
//       var cameraId = devices[0].id;
//       // .. use this to start scanning.
//     }
//   }).catch(err => {
//     // handle err
//   });
// const html5QrCode = new html5QrCode("reader", /* verbose= */ true);
// html5QrCode.start(
//         cameraId, {
//             fps: 10, // Optional, frame per seconds for qr code scanning
//             qrbox: { width: 250, height: 250 } // Optional, if you want bounded box UI
//         },
//         (decodedText, decodedResult) => {
//             // do something when code is read
//         },
//         (errorMessage) => {
//             // parse error, ignore it.
//         })
//     .catch((err) => {
//         // Start failed, handle it.
//     });
