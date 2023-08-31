<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Leave Management</h4>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Leave Cagegory</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
   getList();
   async function getList() {
    showLoader();
    let res = await axios.get("/leave-list");
    hideLoader();

    let tableList = $('#tableList')
    let tableData = $('#tableData')

    tableData.DataTable().destroy();
    tableList.empty();

    res.data.forEach((item, index) => {
        let row=`<tr>
                    <td>${index+1}</td>
                    <td>${item['user']['firstName']}</td>
                    <td>${item['user']['lastName']}</td>
                    <td>${item['leave_category']['category_name']}</td>
                    <td>${item['start_date']}</td>
                    <td>${item['end_date']}</td>
                    <td>${item['status']}</td>
                    <td>
                        <button data-id="${item['id']}" class ="btn approveBtn btn-sm btn-outline-success">Approve</button>
                        <button data-id="${item['id']}" class ="btn rejectBtn btn-sm btn-outline-danger">Reject</button>
                    </td>
                </tr>`
        tableList.append(row)
    })

    $('.approveBtn').on('click', function() {
        let id = $(this).data('id');
        $('#update-leave-modal').modal('show');
         $('#grantID').val(id);
    })

    $('.rejectBtn').on('click', function(){
        let id = $(this).data('id');
        $('#reject-leave-modal').modal('show');
        $('#rejectID').val(id);
    })

     new DataTable('#tableData', {
        order:[[0,'desc']],
        lengthMenu:[5,10,100]
     });

    }
</script>
