<script>


    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('#namaMember').change(function (e) {
            e.preventDefault();

            var id = $(this).val()

            $.ajax({
                type: "post",
                url: "/namaMember",
                data: {
                    id:id
                },
                dataType: "json",
                success: function (response) {
                    $("#alamatMember").val(response.alamat);
                }
            });
        });
    });

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('#kelasMember').change(function (e) {
            e.preventDefault();

            var id = $(this).val()

            $.ajax({
                type: "post",
                url: "/kelasMember",
                data: {
                    id:id
                },
                dataType: "json",
                success: function (response) {
                    $("#namaPengajar").val(response.pengajar),
                    $("#biayaKelas").val(response.harga);
                }
            });
        });
    });




</script>
