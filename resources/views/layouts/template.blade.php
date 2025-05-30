<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="STARS - Student Achievement Record System">
    <meta name="author" content="STARS Team">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'STARS - Student Achievement Record System')</title>

    <!-- Favicons -->
    <link href="{{ asset('img/logo.svg') }}" rel="icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('RuangAdmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('RuangAdmin/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('RuangAdmin/css/ruang-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Custom CSS File -->
    <link href="{{ asset('css/layouts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/preload.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Additional CSS -->
    @stack('css')

    <style>
        .swal2-popup {
            font-family: "Poppins", sans-serif !important;
            border-radius: 12px !important;
        }

        .swal2-title {
            color: var(--heading-color) !important;
        }

        .swal2-confirm {
            background-color: var(--primary-color) !important;
            border-radius: 8px !important;
        }

        .swal2-cancel {
            background-color: #6c757d !important;
            border-radius: 8px !important;
        }


        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body id="page-top">
    <div class="preloader">
        <div class="preloader-content">
            <div class="system-name">
                <span>S</span>TUDENT <span>A</span>CHIEVEMENT <span>R</span>ECORD <span>S</span>YSTEM
            </div>
            <div class="star-container">
                <div class="logo-main"></div>
                <div class="logo-glow"></div>
                <div class="star-rays"></div>
                <div class="particles">
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                </div>
            </div>
            <div class="progress-container">
                <div class="progress-bar"></div>
            </div>
            <div class="loading-text">Loading resources...</div>
            <div class="progress-percentage">0%</div>
        </div>
    </div>

    <div id="wrapper">
        @include('layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layouts.header')
                <div class="container-fluid" id="container-wrapper">
                    @include('layouts.breadcrumb')

                    <!-- Main Content Area -->
                    <div class="min-content-height">
                        @yield('content')
                    </div>
                </div>
            </div>
            {{-- @include('layouts.footer') --}}
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Apakah Anda yakin ingin keluar?</h5>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!-- Vendor JS Files -->
    <script src="{{ asset('RuangAdmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('RuangAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('RuangAdmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('RuangAdmin/js/ruang-admin.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <!-- Jquery Validation -->
    <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>



    <!-- Additional JS -->
    <script src="{{ asset('js/layouts.js') }}"></script>
    <script>
        // Global AJAX setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function(xhr, status, error) {
                $('#loadingOverlay').hide();
                console.error('AJAX Error:', error);

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    for (let field in errors) {
                        errorMessage += `• ${errors[field][0]}\n`;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorMessage.replace(/\n/g, '<br>'),
                        confirmButtonColor: '#102044',
                        showClass: {
                            popup: 'animate__animated animate__fadeIn'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOut'
                        }
                    });
                } else if (xhr.status === 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'Internal server error occurred. Please try again.',
                        confirmButtonColor: '#102044'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.',
                        confirmButtonColor: '#102044'
                    });
                }
            }
        });

        // Enhanced SweetAlert configuration
        window.showSuccess = function(message, title = 'Success!') {
            Swal.fire({
                icon: 'success',
                title: title,
                text: message,
                confirmButtonColor: '#102044',
                timer: 3000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__bounceIn'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOut'
                }
            });
        };

        window.showError = function(message, title = 'Error!') {
            Swal.fire({
                icon: 'error',
                title: title,
                text: message,
                confirmButtonColor: '#102044',
                showClass: {
                    popup: 'animate__animated animate__shakeX'
                }
            });
        };

        window.showWarning = function(message, title = 'Warning!') {
            Swal.fire({
                icon: 'warning',
                title: title,
                text: message,
                confirmButtonColor: '#102044',
                showClass: {
                    popup: 'animate__animated animate__pulse'
                }
            });
        };

        window.showInfo = function(message, title = 'Information') {
            Swal.fire({
                icon: 'info',
                title: title,
                text: message,
                confirmButtonColor: '#102044'
            });
        };

        // Enhanced validation handling
        window.handleValidationErrors = function(errors) {
            let errorList = '<ul class="text-left">';
            for (let field in errors) {
                errorList += `<li>${errors[field][0]}</li>`;
            }
            errorList += '</ul>';

            Swal.fire({
                icon: 'error',
                title: 'Validation Errors',
                html: errorList,
                confirmButtonColor: '#102044',
                customClass: {
                    htmlContainer: 'text-left'
                }
            });
        };

        // Loading overlay functions
        window.showLoading = function(message = 'Processing...') {
            Swal.fire({
                title: message,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        };

        window.hideLoading = function() {
            Swal.close();
        };
    </script>
    @stack('js')
</body>

</html>
