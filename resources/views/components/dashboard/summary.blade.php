<div class="container-fluid">
    <div class="row">

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h6 id="pending" class="mb-0 text-capitalize font-weight-bold">01</h6>
                                
                            </div>
                        </div>
                        <div class="col-3 col-lg-3 col-md-4 col-sm-3 text-end">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h6 id="approved" class="mb-0 text-capitalize font-weight-bold">01</h6>
                                
                            </div>
                        </div>
                        <div class="col-3 col-lg-3 col-md-4 col-sm-3 text-end">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h6 id="rejected" class="mb-0 text-capitalize font-weight-bold">01</h6>
                                
                            </div>
                        </div>
                        <div class="col-3 col-lg-3 col-md-4 col-sm-3 text-end">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h6 id="total" class="mb-0 text-capitalize font-weight-bold">01</h6>
                                
                            </div>
                        </div>
                        <div class="col-3 col-lg-3 col-md-4 col-sm-3 text-end">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    metrics();
   async function metrics() {
        showLoader();
        let res = await axios.get('/metrics');
        hideLoader();
        document.getElementById('pending').textContent = `Pending Leave Request: ${res.data['pending']}`;
        document.getElementById('approved').textContent = `Total Approved: ${res.data['approved']}`;
        document.getElementById('rejected').textContent = `Total Rejected: ${res.data['rejected']}`;
        document.getElementById('total').textContent = `Total Leave Request: ${res.data['total']}`;
    }
    
</script>
