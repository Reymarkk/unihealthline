<!-- Prompt modals -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function popup(status) {
        let icon;
        switch (status) {
            case 'alert':
                icon = 'alert';
                break;
            case 'warning':
                icon = 'warning';
                break;
            case 'success':
                icon = 'success';
                break;
            case 'info':
                icon = 'info';
                break;
            case 'error':
                icon = 'error';
                break;
            default:
                icon = 'info';
                break;
        }
        
        Swal.fire({
            position: 'top-end',
            icon: icon,
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
        });
    }
</script>
