<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Leave Type</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Leave Type</label>
                                <input type="text" class="form-control" id="leaveType">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>

<script>
    async function Save() {
        let leaveTitle = document.getElementById('leaveType').value;
        
        if(leaveTitle.length === 0){
            errorToast("Leave Type Required!");
        }
        else {
            document.getElementById('modal-close').click();
            showLoader();
            let res = await axios.post('/create-category', {
                catName:leaveTitle
            });
            hideLoader();

            if(res.status===201) {
                successToast('Request completed!');
                document.getElementById('save-form').reset();
                await getList();
            }else {
                errorToast("Request fail");
            }
        }
    }
</script>
