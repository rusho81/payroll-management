<div class="modal" id="update-leave-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Request Grant !</h3>
                <p class="mb-3">Are you sure, you want to grant the leave request?</p>
                <input class="d-none" id="grantID"/>
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="grant-modal-close" class="btn shadow-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemUpdate()" type="button" id="confirmDelete" class="btn shadow-sm btn-danger" >Approve</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async  function  itemUpdate(){
            let id=document.getElementById('grantID').value;
            document.getElementById('grant-modal-close').click();
            showLoader();
            let res=await axios.post("/approve-leave",{id:id})
            hideLoader();
            if(res.status===200){
                successToast("Leave Granted");
                await getList();   
            }else{
                errorToast("Update Failed");
            }
     }
</script>