import './bootstrap';

// Add SweetAlert for better notifications
import Swal from 'sweetalert2';
window.Swal = Swal;

// Global AJAX Setup
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Global form submission handler
$(document).on('submit', 'form', function(e) {
    const $form = $(this);

    if ($form.hasClass('delete-form')) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $form[0].submit();
            }
        });
    }
});

// Success message handler
if (document.querySelector('.alert')) {
    setTimeout(() => {
        $('.alert').fadeOut('slow');
    }, 3000);
}
