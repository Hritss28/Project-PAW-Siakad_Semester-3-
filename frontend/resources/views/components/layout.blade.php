@props([
    'class' => '',
])

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script src="https://cdn.socket.io/4.6.1/socket.io.min.js"></script>
    <title>Next Siakad</title>
</head>

<body class="{{ $class }}">
    {{ $slot }}
    <script>
        const socket = io('http://localhost:3000/'); // URL backend WebSocket

        socket.on('maintenanceMode', (data) => {
            if (data.status) {
                axios.patch('/token/destroy-token')
                Swal.fire({
                    icon: 'warning',
                    title: 'Maintenance Mode',
                    text: 'Sistem sedang dalam perbaikan, silahkan coba lagi beberapa saat lagi.',
                })
                window.location.href = '/auth/login';
            }
        });
    </script>
</body>

</html>
