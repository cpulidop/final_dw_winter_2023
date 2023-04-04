
$(document).ready( function () {
    var error = document.getElementById("errorModal");
    var success = document.getElementById("successModal");

    if (error != null) {
        $('#errorModal').modal('show');
    }
    if (success != null) {
        $('#successModal').modal('show');
    }
});