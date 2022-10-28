<script>
    let kelas_id;

    const create = () => {
        $('#createForm').trigger('reset');
        $('#createModal').modal('show');
    }

    const deleteData = (id) => {
        Swal.fire({
            title: 'Apa anda yakin untuk menghapus pengguna ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            Swal.close();

            if(result.value) {
                Swal.fire({
                    title: 'Mohon tunggu',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    willOpen: () => {
                        Swal.showLoading()
                    }
                });

                $.ajax({
                    type: "delete",
                    url: `/kelas/${id}`,
                    dataType: "json",
                    success: function (response) {
                        Swal.close();

                        if(response.status) {
                            Swal.fire(
                                'Success!',
                                response.msg,
                                'success'
                            )

                            $('#table').DataTable().ajax.reload();
                        } else {
                            Swal.fire(
                                'Error!',
                                response.msg,
                                'warning'
                            )
                        }
                    }
                });
            }
        });
    }

    const edit = (id) => {

        var formData = new FormData($("#editForm")[0]);

        Swal.fire({
            title: 'Mohon tunggu',
            showConfirmButton: false,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading()
            }
        });

        kelas_id = id;

        $.ajax({
            type: "get",
            url: `/kelas/${kelas_id}`,
            contentType: false,
            dataType: "json",
            success: function (response) {
                // $("#gambarEdit").val(response.gambar);
                $("#kodeEdit").val(response.kode);
                $("#judulkelasEdit").val(response.judulkelas);
                $("#kategori_idEdit").val(response.kategori_id);
                $("#pengajarEdit").val(response.pengajar);
                $("#hargaEdit").val(response.harga);
                $("#deskripsiEdit").val(response.deskripsi);

                Swal.close();
                $('#editModal').modal('show');
            }
        });
    }

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });


            $('#table').DataTable({
                order: [],
                lengthMenu: [[5, 10, 25, 50, -1], ['5', '10', '25', '50', 'All']],
                filter: true,
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: '/kelas/kumahaaingwe'
                },
                "columns":
                [
                    { data: 'DT_RowIndex', orderable: false, searchable: false},
                    { data: 'gambar', name:'kelass.gambar'},
                    { data: 'kode', name:'kelass.kode'},
                    { data: 'judulkelas', name:'kelass.judulkelas'},
                    { data: 'kategorikelas', name:'kelass.kategori_id'},
                    { data: 'pengajar', name:'kelass.alamat'},
                    { data: 'harga', name:'kelass.harga'},
                    { data: 'deskripsi', name:'kelass.deskripsi'},
                    { data: 'action', orderable: false, searchable: false},
                ]
            });




        $('#createSubmit').click(function (e) {
            e.preventDefault();

            var formData = new FormData($("#createForm")[0]);

            Swal.fire({
                title: 'Mohon tunggu',
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading()
                }
            });

            $.ajax({
                type: "post",
                url: "/kelas",
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {

                    Swal.close();
                    if(data.status) {
                        Swal.fire(
                            'Success!',
                            data.msg,
                            'success'
                        )

                        $('#createModal').modal('hide');
                        $('#table').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'warning'
                        )
                    }
                }
            })
        });

        $('#editSubmit').click(function (e) {
            e.preventDefault();

            var formData = new FormData($("#editForm")[0]);

            Swal.fire({
                title: 'Mohon tunggu',
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading()
                }
            });

            $.ajax({
                type: "post",
                url: `/kelas/${kelas_id}`,
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    Swal.close();

                    if(data.status) {
                        Swal.fire(
                            'Success!',
                            data.msg,
                            'success'
                        )

                        pengguna_id = null;
                        $('#editModal').modal('hide');
                        $('#table').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'warning'
                        )
                    }
                }
            })
        });
    });
</script>
