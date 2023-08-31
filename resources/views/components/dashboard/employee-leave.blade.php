<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-10">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Leave Request Form</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-12 p-2">
                                <label>Select Leave Type</label><br>
                                <select id="categorySelect" class="form-select form-select-lg" aria-label=".form-select-lg example">
                                    <option selected>Please select the type of leave you want</option>
                                </select>
                            </div>
                            <div class="col-md-12 p-2">
                                <label>Start Date</label>
                                <input id="startDate" class="form-control" type="date"/>
                            </div>
                            <div class="col-md-12 p-2">
                                <label>End Date</label>
                                <input id="endDate" class="form-control" type="date"/>
                            </div>
                            <div class="col-md-12 p-2">
                                <label>Reason</label>
                                <input id="reason" placeholder="Input the reason of your leave" class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onSubmit()" class="btn mt-3 w-100  btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    fillCategory()
    async function fillCategory() {
        const selectElement = document.getElementById('categorySelect');
        showLoader();
        let res = await axios.get('/list-category');
        hideLoader();
        res.data.forEach(item => {
            const option = document.createElement("option");
            option.value = item['id'];
            option.text = item['category_name'];
            selectElement.appendChild(option);
        });
    }

    async function onSubmit() {
        var catId = document.getElementById("categorySelect").value;
        var begDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;
        var reason = document.getElementById("reason").value;

        if(catId.length === 0){
            errorToast("Category Required");
        }else if(begDate.length === 0){
            errorToast("Leave start date required");
        }else if(endDate.length === 0){
            errorToast("Leave end date required");
        }else if(reason.length === 0){
            errorToast("Reason Required!");
        }else {
            showLoader();
            let res = await axios.post('/create-leave', {
                catId:catId,
                begDate:begDate,
                endDate:endDate,
                reason:reason});
            hideLoader();
            if(res.status===201){
                successToast("Leave request submitted Successfull");
            }else{
                errorToast("Leave request submition failed");
            }

        }
    }

</script>