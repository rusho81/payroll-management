<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Leave</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Update Leave</label>
                                <input type="text" class="form-control" id="leaveUpdateTitle">
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn btn-sm  btn-success" >Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function FillUpUpdatedForm(id) {
        document.getElementById("updateID").value=id;
        showLoader();
        let res = await axios.post('/category-by-id', {id:id});
        hideLoader();
        document.getElementById("leaveUpdateTitle").value=res.data['category_name'];
    }
    async function Update() {
        var leaveUpdateTitle = document.getElementById("leaveUpdateTitle").value;
        var updateId = document.getElementById("updateID").value;

        if(leaveUpdateTitle.length === 0){
            errorToast("Leave Category Required!");
        }else {
            document.getElementById('update-modal-close').click();
            showLoader();
            let res = await axios.post('/update-category', {
                catName:leaveUpdateTitle,
                id:updateId});
            hideLoader();
            if(res.status===200 && res.data===1){
                successToast("Update Successfull");
                await getList();
            }else{
                errorToast("Update Failed");
            }
        }
    }
</script>