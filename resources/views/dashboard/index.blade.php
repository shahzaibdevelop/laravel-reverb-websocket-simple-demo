<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <title>Dashboard</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="container vw-100 vh-100 d-flex flex-column gap-3 justify-content-center align-items-center">
        @if (Auth::user()->type != 1)
            <button onclick="sendNotification()" class="btn btn-info text-white">Send Notification to admin</button>
        @endif
        <a href="{{ route('logout') }}">Logout</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function sendNotification() {
            $.ajax({
                url: "{{ route('sendAdminNotification') }}",
                method: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: (response) => {
                    console.log(response);
                    if (response.success == true) {
                        Swal.fire({
                            title: 'Notification sent!',
                            text: 'Admin has been notified',
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to send notification',
                            icon: 'error',
                            confirmButtonText: 'Try again'
                        });
                    }
                },
                error: (error) => {
                    console.log(error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to send notification',
                        icon: 'error',
                        confirmButtonText: 'Try again'
                    });
                }
            });
        }
    </script>
    @if (Auth::user()->type == 1)
        <script>
            window.onload = () => {
                //Public example channel anyone can access it even if thery are not using your web app
                 // Echo.channel('example').listen('Example',(event)=>{
                //     console.log(event);
                // })
                //private channel only your site users can access it
                Echo.private('adminNotification').listen('AdminNotification', (event) => {
                    console.log(event);
                    Swal.fire({
                        title: 'New Notification!',
                        text: event.user + ' says hi with email ' + event.email,
                        icon: 'success',
                        confirmButtonText: 'Okay'
                    });
                });
            };
        </script>
    @endif
</body>

</html>
