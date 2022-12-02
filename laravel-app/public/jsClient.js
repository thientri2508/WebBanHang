function formatNumber(num) { // định dạng giá tiền
	return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}
function hoverProduct(a){
    var t=a.id;
    var c=t.slice(3,t.length);
    document.getElementById("sp"+c).style.display='block';
}
function overProduct(a){
    var t=a.id;
    var c=t.slice(3,t.length);
    document.getElementById("sp"+c).style.display='none';
}
var checkSeach = false;
var checkLoggin = false;
var checkCart = false
function btnLoggin(){
    if(!checkLoggin){
        document.getElementById("loggin").style.display='block';
        checkLoggin = true;
    }else{
        document.getElementById("loggin").style.display='none';
        checkLoggin = false;
    }
    if(checkSeach){
        document.getElementById("div_search_inp").style.display='none';
        checkSeach = false;
    }
    if(checkCart){
        document.getElementById("cart").style.display='none';
        checkCart = false;
    }
}
function btnSearch(){
    if(!checkSeach){
        document.getElementById("div_search_inp").style.display='block';
        checkSeach = true;
    }else{
        document.getElementById("div_search_inp").style.display='none';
        checkSeach = false;
    }
    if(checkLoggin){
        document.getElementById("loggin").style.display='none';
        checkLoggin = false;
    }
    if(checkCart){
        document.getElementById("cart").style.display='none';
        checkCart = false;
    }
}
function btnCart(){
    if(!checkCart){
        document.getElementById("cart").style.display='block';
        checkCart = true;
    }else{
        document.getElementById("cart").style.display='none';
        checkCart = false;
    }
    if(checkLoggin){
        document.getElementById("loggin").style.display='none';
        checkLoggin = false;
    }
    if(checkLoggin){
        document.getElementById("loggin").style.display='none';
        checkLoggin = false;
    }
    if(checkSeach){
        document.getElementById("div_search_inp").style.display='none';
        checkSeach = false;
    }
}
function selectSize(a,id){
    var t=a.split('-');
    var size=t[1];
    if(size=="free") { 
        document.getElementById("dropdownMenuButton1").innerHTML='<h6 style="position:absolute; left:10px; top:8px"><b>free</b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i>';
        document.getElementById("freeSize").style.background='#E8E8E8';
        document.getElementById("size").value="freesize";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("HienThiSL").innerHTML = this.responseText;
          }
        };
        //xmlhttp.open("GET", "HienThiSLSP.php?id=" + id + "&&size=" + size, true);
        xmlhttp.open("GET", "/HienThiSLSP/" + id + "/" + size, true);
        xmlhttp.send();
        document.getElementById("btnSLnone").style.display='none';
    }
    else if(size=="40"||size=="41"||size=="42"||size=="43") {
    document.getElementById("dropdownMenuButton1").innerHTML='<h6 style="position:absolute; left:10px; top:8px; text-transform: uppercase"><b>'+size+'</b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i>';
    document.getElementById("dropdownMenuButton2").innerHTML='<h6 style="position:absolute; left:10px; top:8px"><b></b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i>';
    document.getElementById("qty").value="";
    document.getElementById("size").value=size;
    document.getElementById("size-40").style.background='';
    document.getElementById("size-41").style.background='';	
    document.getElementById("size-42").style.background='';	
    document.getElementById("size-43").style.background='';	
    document.getElementById("size-"+size).style.background='#E8E8E8';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("HienThiSL").innerHTML = this.responseText;
          }
        };
        //xmlhttp.open("GET", "HienThiSLSP.php?id=" + id + "&&size=" + size, true);
        xmlhttp.open("GET", "/HienThiSLSP/" + id + "/" + size, true);
        xmlhttp.send();
    document.getElementById("btnSLnone").style.display='none';
    document.getElementById("bntthemnone").style.display='block';
    }
    else if(size=="29"||size=="30"||size=="31"||size=="32"||size=="33"||size=="34"||size=="35"||size=="36") {
        document.getElementById("dropdownMenuButton1").innerHTML='<h6 style="position:absolute; left:10px; top:8px; text-transform: uppercase"><b>'+size+'</b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i>';
        document.getElementById("dropdownMenuButton2").innerHTML='<h6 style="position:absolute; left:10px; top:8px"><b></b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i>';
        document.getElementById("qty").value="";
        document.getElementById("size").value=size;
        document.getElementById("size-29").style.background='';
        document.getElementById("size-30").style.background='';	
        document.getElementById("size-31").style.background='';	
        document.getElementById("size-32").style.background='';	
        document.getElementById("size-33").style.background='';
        document.getElementById("size-34").style.background='';	
        document.getElementById("size-35").style.background='';	
        document.getElementById("size-36").style.background='';	
        document.getElementById("size-"+size).style.background='#E8E8E8';
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                document.getElementById("HienThiSL").innerHTML = this.responseText;
              }
            };
            //xmlhttp.open("GET", "HienThiSLSP.php?id=" + id + "&&size=" + size, true);
            xmlhttp.open("GET", "/HienThiSLSP/" + id + "/" + size, true);
            xmlhttp.send();
        document.getElementById("btnSLnone").style.display='none';
        document.getElementById("bntthemnone").style.display='block';
    }
    else {
        document.getElementById("dropdownMenuButton1").innerHTML='<h6 style="position:absolute; left:10px; top:8px; text-transform: uppercase"><b>'+size+'</b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i>';
        document.getElementById("dropdownMenuButton2").innerHTML='<h6 style="position:absolute; left:10px; top:8px"><b></b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i>';
        document.getElementById("qty").value="";
        document.getElementById("size").value=size;
        document.getElementById("size-s").style.background='';
        document.getElementById("size-m").style.background='';	
        document.getElementById("size-l").style.background='';	
        document.getElementById("size-xl").style.background='';	
        document.getElementById("size-"+size).style.background='#E8E8E8';
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                document.getElementById("HienThiSL").innerHTML = this.responseText;
              }
            };
            xmlhttp.open("GET", "/HienThiSLSP/" + id + "/" + size, true);
            xmlhttp.send();
        document.getElementById("btnSLnone").style.display='none';
        document.getElementById("bntthemnone").style.display='block';
    }
}
function scrollImg(pos){
    $('.hiddenScroll').animate({scrollTop: 775*pos},500);
}
function selectSoLuong(a){
    var t=a.split('-');
    var sl=t[1];
    document.getElementById("dropdownMenuButton2").innerHTML='<h6 style="position:absolute; left:10px; top:8px"><b>'+sl+'</b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i>';
    document.getElementById("qty").value=sl;
    for(var i=1;i<=12;i++)
    {
        document.getElementById("sl-"+i).style.background='';	
    }
    document.getElementById("sl-"+sl).style.background='#E8E8E8';
    document.getElementById("bntthemnone").style.display='none';
}
function addMyCart(id){
    var qty=document.getElementById("qty").value;
    var size=document.getElementById("size").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("cart").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "/addMyCart/" + id + "/" + qty + "/" + size , true);
        xmlhttp.send();
        btnCart();
}
function resetCartMini(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("cart").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "/resetCartMini", true);
    xmlhttp.send();
}
function delCart(a){
    var t=a.split('-');
    var index=t[1];
    var url="/delItemCart/"+index;
    location.replace(url);
}
function selectSizeCart(a){
    var t=a.split('-');
    var id=t[1];
    var size=t[2];
    var sizetype=t[3];
    document.getElementById(id+"-dropdownMenuButton3").innerHTML='<h6 style="position:absolute; left:10px; top:8px; text-transform: uppercase"><b>'+size+'</b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i>';
    document.getElementById(id+"-dropdownMenuButton4").innerHTML='<h6 style="position:absolute; left:10px; top:8px"><b>1</b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i>';
    if(sizetype=="word"){
        document.getElementById("sizeCart-"+id+"-s-word").style.background='';	
        document.getElementById("sizeCart-"+id+"-m-word").style.background='';	
        document.getElementById("sizeCart-"+id+"-l-word").style.background='';	
        document.getElementById("sizeCart-"+id+"-xl-word").style.background='';	
        document.getElementById("sizeCart-"+id+"-"+size+"-word").style.background='#E8E8E8';
    }else if(sizetype=="number1"){
        document.getElementById("sizeCart-"+id+"-29-number1").style.background='';	
        document.getElementById("sizeCart-"+id+"-30-number1").style.background='';	
        document.getElementById("sizeCart-"+id+"-31-number1").style.background='';	
        document.getElementById("sizeCart-"+id+"-32-number1").style.background='';	
        document.getElementById("sizeCart-"+id+"-33-number1").style.background='';	
        document.getElementById("sizeCart-"+id+"-34-number1").style.background='';	
        document.getElementById("sizeCart-"+id+"-35-number1").style.background='';	
        document.getElementById("sizeCart-"+id+"-36-number1").style.background='';	
        document.getElementById("sizeCart-"+id+"-"+size+"-number1").style.background='#E8E8E8';
    }else if(sizetype=="number2"){
        document.getElementById("sizeCart-"+id+"-40-number2").style.background='';	
        document.getElementById("sizeCart-"+id+"-41-number2").style.background='';	
        document.getElementById("sizeCart-"+id+"-42-number2").style.background='';	
        document.getElementById("sizeCart-"+id+"-43-number2").style.background='';	
        document.getElementById("sizeCart-"+id+"-"+size+"-number2").style.background='#E8E8E8';
    }
    var price=document.getElementById("priceSP-"+id).value;
    document.getElementById("priceTT-"+id).innerHTML=formatNumber(price)+'₫';
         var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("total").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "/fixSizeItemCart/" + id + "/" + size, true);
        xmlhttp.send();
        resetCartMini();
}
function selectSoLuongCart(a){
    var t=a.split('-');
    var id=t[1];
    var sl=t[2];
    document.getElementById(id+"-dropdownMenuButton4").innerHTML='<h6 style="position:absolute; left:10px; top:8px"><b>'+sl+'</b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i>';
    for(var i=1;i<=12;i++)
    {
        document.getElementById("slCart-"+id+"-"+i).style.background='';	
    }
    document.getElementById("slCart-"+id+"-"+sl).style.background='#E8E8E8';
    var price=document.getElementById("priceSP-"+id).value;
    var total=price*sl;
    document.getElementById("priceTT-"+id).innerHTML=formatNumber(total)+'₫';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("total").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "/fixAmountItemCart/" + id + "/" + sl, true);
        xmlhttp.send();
        resetCartMini();
}
function loadSLSP(idSP,size,index){
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("HienThiSL-"+index).innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "/ResetAmountProductCart/" + idSP + "/" + size + "/" + index, true);
    xmlhttp.send();
}
function checkFirstName(){
	var ten=[];
	ten=document.getElementById("firstname").value;
	var name=document.getElementById("firstname").value;
	if(name=="")	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Vui lòng nhập đầy đủ thông tin';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	
	if(ten.length>10)	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Họ không được quá 10 kí tự';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	for(var i=0;i<ten.length;i++)
	{
		if(ten[i]=="'"||ten[i]=='"') 
		{
			document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Họ không được có ký tự đặc biệt';
			return false;
		}
	}
	document.getElementById("kt").innerHTML="";
	return true;
}
function checkLastName(){
	var ten=[];
	ten=document.getElementById("lastname").value;
	var name=document.getElementById("lastname").value;
	if(name=="")	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Vui lòng nhập đầy đủ thông tin';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	
	if(ten.length>10)	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Tên không được quá 10 kí tự';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	for(var i=0;i<ten.length;i++)
	{
		if(ten[i]=="'"||ten[i]=='"') 
		{
			document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Tên không được có ký tự đặc biệt';
			return false;
		}
	}
	document.getElementById("kt").innerHTML="";
	return true;
}
function checkEmail(){
	var user=[];
	user=document.getElementById("email").value;
	var name=document.getElementById("email").value;
	if(name=="")	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Email không được bỏ trống';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	for(var i=0;i<user.length;i++)
	{
		if(user[i]=="'"||user[i]=='"') 
		{
			document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Email không tồn tại';
			return false;
		}
	}
	document.getElementById("kt").innerHTML="";
	if(name.indexOf("@")==-1) {
		document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Email không tồn tại';
		return false;
	}
	document.getElementById("kt").innerHTML="";
	return true;
}
function checkPass(){
	var mk=[];
	mk=document.getElementById("password").value;
	var pass=document.getElementById("password").value;
	if(pass=="")	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu không được bỏ trống';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	if(mk.length<6)	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu phải từ 6 ký tự trở lên';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
    if(mk.length>20)	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu không được quá 20 ký tự';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	for(var i=0;i<mk.length;i++)
	{
		if(mk[i]=="'"||mk[i]=='"') 
		{
			document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu không được có ký tự đặc biệt';
			return false;
		}
	}
	document.getElementById("kt").innerHTML="";
	return true;
}
function checkPrePass(){
	var pass=document.getElementById("checkpassword").value;
	var mk=document.getElementById("password").value;
	if(pass=="")	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Vui lòng xác nhận lại mật khẩu';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	if(pass!=mk)	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Xác nhận lại mật khẩu không khớp';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	return true;
}
function check(){
    if(!checkFirstName()) return false;
    if(!checkLastName()) return false;
    if(!checkEmail()) return false;
    if(!checkPass()) return false;
    if(!checkPrePass()) return false;
    return true;
}
function selectCity(){
    var city = document.getElementById("city").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
          document.getElementById("district").innerHTML = this.responseText;
        }
     };
    xmlhttp.open("GET", "/selectCity/" + city , true);
    xmlhttp.send();
    document.getElementById("ward").innerHTML="<option selected>Phường/Xã</option>";
}
function selectDistrict(){
	var city = document.getElementById("city").value;
	var district = document.getElementById("district").value;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      document.getElementById("ward").innerHTML = this.responseText;
    }
 };
xmlhttp.open("GET", "/selectDistrict/" + district + "/" + city, true);
xmlhttp.send();
}
function checkCity(){
	var city=document.getElementById("city").value;
	if(city=="Tỉnh/Thành Phố") {document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Vui lòng chọn Tỉnh/Thành Phố';
		return false;	}
	else {document.getElementById("kt").innerHTML="";}
	return true;
}
function checkAddress(){
	var a=[];
	a=document.getElementById("txtaddress").value;
	var add=document.getElementById("txtaddress").value;
	if(add=="")	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Địa chỉ không được bỏ trống';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	for(var i=0;i<a.length;i++)
	{
		if(a[i]=="'"||a[i]=='"') 
		{
			document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Không được nhập ký tự đặc biệt';
			return false;
		}
	}
	document.getElementById("kt").innerHTML="";
	return true;
}
function checkDistrict(){
	var district=document.getElementById("district").value;
	if(district=="Quận/Huyện") {document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Vui lòng chọn Quận/Huyện';
		return false;	}
	else {document.getElementById("kt").innerHTML="";}
	return true;
}
function checkWard(){
	var ward=document.getElementById("ward").value;
	if(ward=="Phường/Xã") {document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Vui lòng chọn Phường/Xã';
		return false;	}
	else {document.getElementById("kt").innerHTML="";}
	return true;
}
function checkPhone(){
	var sdt=[];
	sdt=document.getElementById("phone").value;
	var phone=document.getElementById("phone").value;
	if(phone=="")	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Số điện thoại không được bỏ trống';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	if(sdt.length<10 || sdt.length>11)	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Số điện thoại không hợp lệ';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	for(var i=0;i<sdt.length;i++)
	{
		if(sdt[i].charCodeAt()<48||sdt[i].charCodeAt()>57) 
		{
			document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Số điện thoại không hợp lệ';
			return false;
		}
	}
	document.getElementById("kt").innerHTML="";
	return true;
}
function checkAddr(){
    if(!checkCity()) return false;
    if(!checkDistrict()) return false;
    if(!checkWard()) return false;
    if(!checkAddress()) return false;
    if(!checkPhone()) return false;
    return true;
}
function checkEmail_Loggin(){
	var user=[];
	user=document.getElementById("email_loggin").value;
	var name=document.getElementById("email_loggin").value;
	if(name=="")	{document.getElementById("ktLoggin").innerHTML='<i class="fas fa-exclamation-circle"></i> Email không được bỏ trống';
			return false;	}
	else {document.getElementById("ktLoggin").innerHTML="";}
	for(var i=0;i<user.length;i++)
	{
		if(user[i]=="'"||user[i]=='"') 
		{
			document.getElementById("ktLoggin").innerHTML='<i class="fas fa-exclamation-circle"></i> Email không tồn tại';
			return false;
		}
	}
	document.getElementById("ktLoggin").innerHTML="";
	if(name.indexOf("@")==-1) {
		document.getElementById("ktLoggin").innerHTML='<i class="fas fa-exclamation-circle"></i> Email không tồn tại';
		return false;
	}
	document.getElementById("ktLoggin").innerHTML="";
	return true;
}
function checkPass_Loggin(){
	var mk=[];
	mk=document.getElementById("password_loggin").value;
	var pass=document.getElementById("password_loggin").value;
	if(pass=="")	{document.getElementById("ktLoggin").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu không được bỏ trống';
			return false;	}
	else {document.getElementById("ktLoggin").innerHTML="";}
	if(mk.length<6)	{document.getElementById("ktLoggin").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu phải từ 6 ký tự trở lên';
			return false;	}
	else {document.getElementById("ktLoggin").innerHTML="";}
    if(mk.length>20)	{document.getElementById("ktLoggin").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu không được quá 20 ký tự';
			return false;	}
	else {document.getElementById("ktLoggin").innerHTML="";}
	for(var i=0;i<mk.length;i++)
	{
		if(mk[i]=="'"||mk[i]=='"') 
		{
			document.getElementById("ktLoggin").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu không được có ký tự đặc biệt';
			return false;
		}
	}
	document.getElementById("ktLoggin").innerHTML="";
	return true;
}
function checkUserLoggin(){
    if(!checkEmail_Loggin()) return false;
    if(!checkPass_Loggin()) return false;
    return true;
}
function checkOldPass(){
	var mk=[];
	mk=document.getElementById("old_pass").value;
	var pass=document.getElementById("old_pass").value;
	if(pass=="")	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Vui lòng nhập mật khẩu cũ';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	if(mk.length<6)	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu cũ không đúng';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
    if(mk.length>20)	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu cũ không đúng';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	for(var i=0;i<mk.length;i++)
	{
		if(mk[i]=="'"||mk[i]=='"') 
		{
			document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu cũ không đúng';
			return false;
		}
	}
	document.getElementById("kt").innerHTML="";
	return true;
}
function checkNewPass(){
	var mk=[];
	mk=document.getElementById("new_pass").value;
	var pass=document.getElementById("new_pass").value;
	if(pass=="")	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Vui lòng nhập mật khẩu mới';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	if(mk.length<6)	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu phải từ 6 ký tự trở lên';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
    if(mk.length>20)	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu không được quá 20 ký tự';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	for(var i=0;i<mk.length;i++)
	{
		if(mk[i]=="'"||mk[i]=='"') 
		{
			document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Mật khẩu không được có ký tự đặc biệt';
			return false;
		}
	}
	document.getElementById("kt").innerHTML="";
	return true;
}
function checkPrePassword(){
	var pass=document.getElementById("checkpass").value;
	var mk=document.getElementById("new_pass").value;
	if(pass=="")	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Vui lòng xác nhận lại mật khẩu mới';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	if(pass!=mk)	{document.getElementById("kt").innerHTML='<i class="fas fa-exclamation-circle"></i> Xác nhận lại mật khẩu mới không khớp';
			return false;	}
	else {document.getElementById("kt").innerHTML="";}
	return true;
}
function checkPassword(){
    if(!checkOldPass()) return false;
    if(!checkNewPass()) return false;
    if(!checkPrePassword()) return false;
    return true;
}
function cancelOrder(id){
	document.getElementById('delete').style.display='block';
	var idOrder = "'"+id+"'";
	var s="";
	s+='<div style="width:100%; height:200px; position:fixed; margin-top:250px">';
		s+='<div style="width:560px; height:200px; margin:auto">';
		s+='<h3 style="font-size:27px; font-family: Tahoma; color:#FF0000">Bạn có chắc chắn hủy đơn hàng này không?</h3>';
		s+='<div class="d-grid gap-2" style="margin-top:40px">';
		s+='<button class="btn btn-success" type="button" style="height:50px" onclick="cancelOrder_confirm('+idOrder+')">Xác nhận</button>';
		s+='<button class="btn btn-danger" type="button" style="height:50px; margin-top:5px" onclick="cancel()">Hủy</button>';
		s+='</div>';
		s+='</div>';
	s+='</div>';
	document.getElementById('delete').innerHTML=s;	
}
function cancel(){
	document.getElementById('delete').style.display='none';
}
function cancelOrder_confirm(id){
	var url="/cancel_order/"+id;
	location.replace(url);
}