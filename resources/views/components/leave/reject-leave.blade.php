<div class="modal" id="reject-leave-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Request Reject !</h3>
                <p class="mb-3">Are you sure, you want to reject the leave request?</p>
                <input class="d-none" id="rejectID"/>
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="reject-modal-close" class="btn shadow-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemReject()" type="button" id="confirmDelete" class="btn shadow-sm btn-danger" >Reject</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async  function  itemReject(){
            let id=document.getElementById('rejectID').value;
            document.getElementById('reject-modal-close').click();
            showLoader();
            let res=await axios.post("/reject-leave",{id:id})
            hideLoader();
            if(res.status===200){
                successToast("Leave rejected successful");
                await getList();   
            }else{
                errorToast("Reject update Failed");
            }
     }
</script>