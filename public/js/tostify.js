function successToast(message) {
    toastr.success(message, 'Success', { timeOut: 2000 });
}

// Function to show error toast
function errorToast(message) {
    toastr.error(message, 'Error', { timeOut: 2000 });
}
