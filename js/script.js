//$('table').dataTable();

  viewData(); 
  
$('#update').prop("disabled",true);

function viewData(){
    $.get('http://192.168.21.88/tracking_system/index.php/system/order/insert_detail', function(data){
        $('.records_content').html(data)
    })
}

function saveData(){
 
    var name = $('#nm').val()
    var email = $('#em').val()
	var ket = $('#ket').val()
	var sat = $('#sat').val()
  
    $.post('http://192.168.21.88/tracking_system/index.php/system/order/insert_detail?p=add', { nm:name, em:email,ket:ket,sat:sat}, function(data){
        viewData()
        $('#id').val(' ')
        $('#nm').val(' ')
        $('#em').val(' ')
		$('#ket').val(' ')
		$('#sat').val(' ')
       
    })
}

function editData(id, nm, em,ket,sat) {
    $('#id').val(id)
    $('#nm').val(nm)
    $('#em').val(em)
	$('#ket').val(ket)
	$('#sat').val(sat)
  
    $('#id').prop("readonly",true);
    $('#save').prop("disabled",true);
    $('#update').prop("disabled",false);
}

function updateData(){
    var id = $('#id').val()
    var name = $('#nm').val()
    var email = $('#em').val()
	var ket = $('#ket').val()
	var sat = $('#sat').val()
    
    $.post('http://192.168.21.88/tracking_system/index.php/system/order/insert_detail?p=update', {id:id, nm:name, em:email,ket:ket,sat:sat}, function(data){
        viewData()
        $('#id').val(' ')
        $('#nm').val(' ')
        $('#em').val(' ')
		$('#ket').val(' ')
	    $('#sat').val(' ')
       
        $('#id').prop("readonly",false);
        $('#save').prop("disabled",false);
        $('#update').prop("disabled",true);
    })
}

function deleteData(id){
    $.post('http://192.168.21.88/tracking_system/index.php/system/order/insert_detail?p=delete', {id:id}, function(data){
        viewData()
    })
}

function removeConfirm(id){
    var con = confirm('YAKIN DATA AKAN DIHAPUS?');
    if(con=='1'){
        deleteData(id);
    }
}