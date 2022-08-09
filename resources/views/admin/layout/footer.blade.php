<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<footer class="footer footer-static footer-light">
    <p class="clearfix blue-grey lighten-2 mb-0">
        <span class="float-md-left d-block d-md-inline-block mt-25">
            {{-- COPYRIGHT &copy; 2021 --}}
            Copyright @ 
            <a class="text-bold-800 grey darken-2" href="https://shreehariinfosolution.com/" target="_blank">www.shreehariinfosolution.com,</a>
            All rights Reserved
        </span>
        {{-- <span class="float-md-right d-none d-md-block">
            Hand-crafted & Made with
            <i class="feather icon-heart pink"></i>
        </span> --}}
        <button class="btn btn-primary btn-icon scroll-top" type="button">
            <i class="feather icon-arrow-up"></i>
        </button>
    </p>
</footer>



<script src="{{ asset('public/assets/admin/app-assets/vendors/js/vendors.min.js') }}"></script>

<script src="{{ asset('public/assets/admin/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>

<script src="{{ asset('public/assets/admin/app-assets/js/core/app-menu.js') }}"></script>

<script src="{{ asset('public/assets/admin/app-assets/js/core/app.js') }}"></script>

<script src="{{ asset('public/assets/admin/app-assets/js/scripts/components.js') }}"></script>

<script src="{{ asset('public/assets/admin/app-assets/js/scripts/pages/app-chat.js') }}"></script>

<script src="{{ asset('public/assets/admin/assets/js/jquery.validate.min.js') }}"></script>

<script src="{{ asset('public/assets/admin/assets/js/additional-methods.min.js') }}"></script>

<script src="{{ asset('public/assets/admin/assets/izitoast/js/iziToast.min.js') }}"></script>

<script src="{{ asset('public/assets/admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('public/assets/admin/app-assets/js/scripts/extensions/sweet-alerts.js') }}"></script>

<script src="{{ asset('public/assets/admin/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

<script src="{{ asset('public/assets/admin/app-assets/js/scripts/forms/select/form-select2.js') }}"></script>

<script type="text/javascript">
    $(".delete-record").off('click').on('click', function(event) {

        event.stopPropagation();

        Swal.fire({

            title: "Are you sure?",

            text: "Once deleted, you will not be able to recover this data!",

            type: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#3085d6',

            cancelButtonColor: '#d33',

            confirmButtonText: 'Yes, delete it!',

            confirmButtonClass: 'btn btn-primary',

            cancelButtonClass: 'btn btn-danger ml-1',

            buttonsStyling: false,

        }).then((willDelete) => {

            if (willDelete.value) {

                var action = $(this).data('action');

                let _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({

                    url: action,

                    method: 'DELETE',

                    data: {

                        _token: _token

                    },

                    success: function(response) {

                        // console.log(response);

                        location.reload();

                    },

                    error: function(error) {

                        console.log(error);

                        alert(error);

                    }

                })

            } else if (willDelete.dismiss === Swal.DismissReason.cancel) {

                Swal.fire({

                title: 'Cancelled',

                text: 'Your imaginary file is safe :)',

                type: 'error',

                confirmButtonClass: 'btn btn-success',

                })

            }

        });

    });
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        // var regex = /[0-9]|\./;
        var regex = /[0-9]/;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>

@include('flash')



@yield('footer')