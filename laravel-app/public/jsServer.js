function addDetail(){
    var s='';
    var amount = document.getElementById("amount_detail").value;
    var amount = parseInt(amount) + 1;
    s+='<div style="width: 380px; height: 120px; float: left; position: relative">';
        s+='<div style="font-size: 1rem; #212529"><b>Detail Category Name '+amount+'</b></div>';
        s+='<input class="form-control" type="text" id="detail-'+amount+'" name="detail-'+amount+'" aria-label="default input example" style="margin-top: 10px; width: 300px">';
        s+='<div style="position: absolute; top:80px; color: red; font-size: 14px; font-weight: bold" id="kt-'+amount+'"></div>';
    s+='</div>';
    $(".detail_category").append(s);
    document.getElementById("amount_detail").value = amount;
}
function addDetail_install(){
    var s='';
    var amount = document.getElementById("amount_detail").value;
    var amount = parseInt(amount) + 1;
    s+='<div style="width: 380px; height: 120px; position: relative">';
        s+='<div style="font-size: 1rem; #212529"><b>Detail Category Name '+amount+'</b></div>';
        s+='<input class="form-control" type="text" id="detail-'+amount+'" name="detail-'+amount+'" aria-label="default input example" style="margin-top: 10px; width: 300px">';
        s+='<div style="position: absolute; top:80px; color: red; font-size: 14px; font-weight: bold" id="kt-'+amount+'"></div>';
    s+='</div>';
    $("#addDetail").append(s);
    document.getElementById("amount_detail").value = amount;
}
function checkNameCategory(){
    var ten=[];
	ten=document.getElementById("categoryName").value;
	var name=document.getElementById("categoryName").value;
	if(name=="")	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Category name cannot be empty';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	
	if(ten.length>10)	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Category name should not exceed 10 characters';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	for(var i=0;i<ten.length;i++)
	{
		if(ten[i]=="'"||ten[i]=='"') 
		{
			document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Do not enter special characters';
			return false;
		}
	}
	document.getElementById("kt").innerHTML="";
	return true;
}
function checkDetailCategory(num){
    var ten=[];
	ten=document.getElementById("detail-"+num).value;
	var name=document.getElementById("detail-"+num).value;
	
	if(ten.length>10)	{document.getElementById("kt-"+num).innerHTML='<i class="fas fa-exclamation-circle"></i> Category name should not exceed 10 characters';
			return false;	}
	else {document.getElementById("kt-"+num).innerHTML="";}
	for(var i=0;i<ten.length;i++)
	{
		if(ten[i]=="'"||ten[i]=='"') 
		{
			document.getElementById("kt-"+num).innerHTML='<i class="fas fa-exclamation-circle"></i> Do not enter special characters';
			return false;
		}
	}
	document.getElementById("kt-"+num).innerHTML="";
	return true;
}
function checkCreateCategory(){
    if(!checkNameCategory()) return false;
    var amount = document.getElementById("amount_detail").value;
    amount = parseInt(amount);
    if(amount>0){
        for(var i=1; i<=amount;i++){
            if(!checkDetailCategory(i)) return false;
        }
    }
    return true;
}
function checkUpdateCategory(){
    if(!checkNameCategory()) return false;
    var amount = document.getElementById("amount_detail").value;
    amount = parseInt(amount);
    if(amount>0){
        for(var i=1; i<=amount;i++){
            if(!checkDetailCategory(i)) return false;
        }
    }
    return true;
}
function deleteCategory(id){
	document.getElementById('delete').style.display='block';
	var idCategory = "'"+id+"'";
	var s="";
	s+='<div style="width:100%; height:200px; position:fixed; margin-top:250px">';
		s+='<div style="width:450px; height:200px; margin:auto">';
		s+='<h3 style="font-size:27px; font-family: Tahoma; color:#FF0000">Are you sure to delete this category?</h3>';
		s+='<div class="d-grid gap-2" style="margin-top:40px">';
		s+='<button class="btn btn-success" type="button" style="height:50px" onclick="deteleCategory_confirm('+idCategory+')">Confirm</button>';
		s+='<button class="btn btn-danger" type="button" style="height:50px; margin-top:5px" onclick="cancel()">Cancel</button>';
		s+='</div>';
		s+='</div>';
	s+='</div>';
	document.getElementById('delete').innerHTML=s;	
}
function deleteProduct(id){
	document.getElementById('delete').style.display='block';
	var idProduct = "'"+id+"'";
	var s="";
	s+='<div style="width:100%; height:200px; position:fixed; margin-top:250px">';
		s+='<div style="width:450px; height:200px; margin:auto">';
		s+='<h3 style="font-size:27px; font-family: Tahoma; color:#FF0000">Are you sure to delete this product?</h3>';
		s+='<div class="d-grid gap-2" style="margin-top:40px">';
		s+='<button class="btn btn-success" type="button" style="height:50px" onclick="deteleProduct_confirm('+idProduct+')">Confirm</button>';
		s+='<button class="btn btn-danger" type="button" style="height:50px; margin-top:5px" onclick="cancel()">Cancel</button>';
		s+='</div>';
		s+='</div>';
	s+='</div>';
	document.getElementById('delete').innerHTML=s;	
}
function cancel(){
	document.getElementById('delete').style.display='none';
}
function deteleCategory_confirm(id){
	var url="/delete_category/"+id;
	location.replace(url);
}
function deteleProduct_confirm(id){
	var url="/delete_product/"+id;
	location.replace(url);
}
function loadView_installProduct(){
	document.getElementById("product").style.background="#ccc";
    document.getElementById("p2").style.display="block";
    document.getElementById("list_product").style.background="#007bff";
    document.getElementById("list_product").style.color="#fff";
	var heightForm1 = ($('#form1-left').height()>$('#form1-right').height()) ? $('#form1-left').height():$('#form1-right').height()
    document.getElementById("form1").style.height=heightForm1+"px";
}
function loadView_createProduct(){
	document.getElementById("product").style.background="#ccc";
    document.getElementById("p2").style.display="block";
    document.getElementById("create_product").style.background="#007bff";
    document.getElementById("create_product").style.color="#fff";
	var heightForm1 = ($('#form-left').height()>$('#form-right').height()) ? $('#form-left').height():$('#form-right').height()
    document.getElementById("form").style.height=heightForm1+"px";
}
function checkNameProduct(){
	var name=document.getElementById("productName").value;
	var t=[];
	t=document.getElementById("productName").value;
	if(name=="")	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Product name cannot be empty';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	for(var i=0;i<t.length;i++)
	{
		if(t[i]=="'"||t[i]=='"') 
		{
			document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Do not enter special characters';
			return false;
		}
	}
	document.getElementById("kt").innerHTML="";
	return true;
}
function checkProductPrice(){
	var price=[];
	price=document.getElementById("productPrice").value;
	var t=document.getElementById("productPrice").value;
	if(t=="") {document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Product price cannot be empty';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	for(var i=0;i<price.length;i++)
	{
		if(price[i].charCodeAt()<48||price[i].charCodeAt()>57) 
		{
			document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Product price must be number';
			return false;
		}
	}
	document.getElementById("kt").innerHTML="";
	return true;
}
function checkInforProduct(){
	if(!checkNameProduct()) return false;
    if(!checkProductPrice()) return false;
    return true;
}
function hoverImage(a){
    var t=a.id;
    var c= t.split('-');
    document.getElementById("setting-"+c[1]).style.display='block';
  }
function overImage(a){
	var t=a.id;
	var c= t.split('-');
	document.getElementById("setting-"+c[1]).style.display='none';
}
function ktDN(){
	var t1 = document.getElementById("Username").value;
	var t2 = document.getElementById("Password").value;
	if(t1==''||t2==''){
		return false;
	}
	var check=true;
	var c1=[];
	c1=document.getElementById("Username").value;
	var c2=[];
	c2=document.getElementById("Password").value;
	for(var i=0;i<c1.length;i++)
	{
		if(c1[i]=="'"||c1[i]=='"') 
		{
			check=false;
			break;
		}
	}
	for(var i=0;i<c2.length;i++)
	{
		if(c2[i]=="'"||c2[i]=='"') 
		{
			check=false;
			break;
		}
	}
	if(check==false){
		document.getElementById("loginError").style.display="block";
	}
	return check;
	}