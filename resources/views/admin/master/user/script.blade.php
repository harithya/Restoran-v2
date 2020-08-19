<script>
    $(document).ready(function(){
         // get role data
         const renderTable = () => {
            const table = $('#table').DataTable({
                pageLength: 25,
                processing: true,
                serverSide: true,
                ajax: "{{ url('admin/master/user') }}",
                columns: [
                    {"data": "DT_RowIndex"},
                    {"mData": "nama",
		                render :function(data,type,row){
		                   return data ?? 'N/A';
		                }
		            },
                    {"data": "username"},
                    {"mData": "no_hp",
		                render :function(data,type,row){
		                   return data ?? 'N/A';
		                }
		            },
                    {"data": "role"},
                    {"mData": "id",
		                render :function(data,type,row){
		                   return ` 
		                     <div class="dropdown">
		                          <button class="btn btn-transparent dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                            <i class="dripicons-view-list"></i>
		                          </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item reset" data-id="${data}"  href="#"><i class="ti-reload  pr-2"></i> Reset</a>
		                            <a class="dropdown-item update" data-id="${data}"  href="#"><i class="ti-pencil-alt  pr-2"></i> Update</a>
		                            <a class="dropdown-item delete" data-id="${data}"  href="#"> <i class="ti-trash  pr-2"></i> Delete</a>
		                          </div>
		                        </div>`; 
		                }
		            },
                ],
            });
        }
        renderTable();

        // insert data
        $("#formAdd").on('submit', function(e){
            e.preventDefault();
			const data = new FormData(this);
		    const url = "{{ url('admin/master/user') }}";
			_insert(url,data);
        })

         // delete data
         $("#table").on('click', '.delete', function(e){
            e.preventDefault();
            const id = $(this).attr("data-id");
            const url = "{{ url('admin/master/user') }}/"+ id;
            _delete(url);
        });

        // get data
        $("#table").on('click', '.update', function(e){
            e.preventDefault();
            const id = $(this).attr("data-id");
            const url = "{{ url('admin/master/user') }}/"+ id;
            $.get(url, function(data){
                $("#id").val(data.id);
                $("#username").val(data.username);
                $("#role option[value='"+ data.role_id +"']").prop('selected',true);
            });
            $("#modalUpdate").modal('show');
        })

        // update data
        $("#formUpdate").on('submit', function(e){
            e.preventDefault();
            const data = new FormData(this);
            const id = $("#id").val();
		    const url = "{{ url('admin/master/user') }}/"+ id;
			_update(url,data);
        })

        // reset password
        $("#table").on('click', '.reset', function(e){
            e.preventDefault();
            const konfirmasi = confirm("Apakah yakin ?");
            const id = $(this).attr("data-id");
            const url = "{{ url('admin/master/user/reset/') }}/"+ id;
            if(konfirmasi == true) {
                $.get(url, function(data){
                    if (data.status == true) {
                        _alert("success","Password baru "+ data.result);
                    }
                })
            }

        })

        
    })
</script>