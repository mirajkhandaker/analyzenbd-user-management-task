$(document).ready(function() {
    const hideDiv = $('.hide-div');
    if (hideDiv.length) {
        setTimeout(function() {
            hideDiv.slideUp('slow',function() {
                hideDiv.remove();
            });
        }, 2500);
    }
});

//Append Address
$(document).ready(function() {
    $("#add-address").click(function() {
        const appendAddressField = "<div class=\"row\">\n" +
            "            <div class=\"col-11\">\n" +
            "                <label for=\"address\" class=\"form-label\">Address</label>\n" +
            "                <textarea type=\"file\" class=\"form-control form-control-sm\" id=\"address\" name=\"address[]\"></textarea>\n" +
            "            </div>\n" +
            "            <div class=\"col-1 d-flex align-items-center justify-content-center\">\n" +
            "                <button class=\"btn btn-danger btn-sm remove-button\" type=\"button\">\n" +
            "                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-dash-circle\" viewBox=\"0 0 16 16\">\n" +
            "                        <path d=\"M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16\"/>\n" +
            "                        <path d=\"M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8\"/>\n" +
            "                    </svg>\n" +
            "                </button>\n" +
            "            </div>\n" +
            "        </div>";
        $("#addresses").append(appendAddressField);
    });
});

//Remove Address
$(document).ready(function() {
    $(document).on('click', '.remove-button', function() {
        $(this).closest('.row').remove();
    });
});

//Delete Confirmation
$(document).ready(function () {
    $('.delete').on('click', function (e) {
        e.preventDefault();
        let form = $(this).parents('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        });
    });
});

//Restore Confirmation
$(document).ready(function() {
    $('.restore').click(function(event) {
        event.preventDefault();
        const uri = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: "This user data will be restore",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                window.location.href = uri;
            }
        });
    });
});
