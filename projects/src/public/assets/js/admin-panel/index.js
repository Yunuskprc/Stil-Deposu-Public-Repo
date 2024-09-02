

/**
 * This function allows users to log out safelys
 */
function logOut() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    fetch('http://stildeposu.test/seller/logout', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toastr.success('Çıkış başarılı. ', data.message);
            window.location.href = '/';
        } else {
            toastr.error('Çıkış yapılamıyor!.');
            console.log(data);
        }
    })
    .catch(error => {
        toastr.error('Çıkış yapılırken bir hata oluştu!.');
        console.error('Error:', error);
    });
}
