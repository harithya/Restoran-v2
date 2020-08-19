<script>
    $(document).ready(function() {
        
        // get role data
        const renderTable = () => {
            const table = $('#table').DataTable({
                pageLength: 25,
                processing: true,
                serverSide: true,
                ajax: "{{ url('admin/master/role') }}",
                columns: [
                    {"data":"DT_RowIndex"},
                    {"data":"role"},
                    {"mData": "id",
		                render :function(data,type,row){
		                   return ` 
		                     <div class="dropdown">
		                          <button class="btn btn-transparent dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                            <i class="dripicons-view-list"></i>
		                          </button>
		                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
		    const url = "{{ url('admin/master/role') }}";
			_insert(url,data);
        })

        // delete data
        $("#table").on('click', '.delete', function(e){
            e.preventDefault();
            const id = $(this).attr("data-id");
            const url = "{{ route('role.store') }}/"+ id;
            _delete(url);
        });

        // get data
        $("#table").on('click', '.update', function(e){
            e.preventDefault();
            const id = $(this).attr("data-id");
            const url = "{{ url('admin/master/role/') }}/"+ id;
            $.get(url,function(data){
                $("#id").val(data.id);
                $("#role").val(data.role);
            });
            $("#modalUpdate").modal('show');
        });


         // update data
         $("#formUpdate").on('submit', function(e){
            e.preventDefault();
            const data = new FormData(this);
            const id = $("#id").val();
		    const url = "{{ url('admin/master/role') }}/"+id;
			_update(url,data);
        })

    });
</script>