<style type="text/css">




#sum_box h4 {
    text-align: left;
    margin-top: 0px;
    font-size: 30px;
    margin-bottom: 0px;
    padding-bottom: 0px;
	color:white;
}


#sum_box .db:hover {
    background: #40516f;
    color: #fff;
}




#sum_box .db:hover .icon {
    opacity: 1;
    color: #fafafa;
}

#sum_box .icon {
    color: #fff;
    font-size: 55px;
    margin-top: 7px;
    margin-bottom: 0px;
    float: right;
}


.panel.income.db.mbm{
        background-color: #5cb85c;
}

.panel.profit.db.mbm{
        background-color: #5bc0de;
}


.panel.task.db.mbm{
        background-color: #f0ad4e;
}

p.description {
	color:#efefef;
}
 


</style>
 <h3> Sistem Monitoring Pengiriman Barang <hr /></h3>

<div id="sum_box" class="row mbl">
							<div class="col-sm-6 col-md-3">
                                <div class="panel income db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-globe fa-spin"></i>
                                        </p>
                                        <h4 class="value">
                                            <span><?php foreach($sum_daily as $a) { print $a->TOTAL; } ?>  Data</span></h4>
                                        <p class="description">
                                            Shipment Daily</p>
                                  
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="panel profit db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-spinner fa-spin"></i>
                                        </p>
                                        <h4 class="value">
                                            <span data-counter="" data-start="10" data-end="50" data-step="1" data-duration="0"><?php foreach($sum_shipment as $a) { print $a->TOTAL; } ?></span><span> Data</span></h4>
                                        <p class="description">
                                            In Shipment </p>
                                   
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-3">
                                <div class="panel task db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-refresh fa-spin"></i>
                                        </p>
                                        <h4 class="value">
                                            <span><?php foreach($sum_return as $a) { print $a->TOTAL; } ?> Data </span></h4>
                                        <p class="description">
                                            Process Return </p>
                                   
                                    </div>
                                </div>
                            </div>
                            
                        </div>