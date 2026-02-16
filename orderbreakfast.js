let fTot=0;

function createBill(){
	var index=0;
	var items = ["null", "null", "null","null"];
	var quantities = ["null", "null", "null","null"];
	var prices = ["null", "null", "null","null"];



	var e1 = document.getElementById("d11");
	var itemselected1 = e1.value;
	if(document.getElementById("q11").value!="0"){
		items[index]=itemselected1;
		quantities[index] = document.getElementById("q11").value;
		prices[index] = document.getElementById("p11").value;
		index++;
	}

	var e2 = document.getElementById("d12");
	var itemselected1 = e2.value;
	if(document.getElementById("q12").value!="0"){
		items[index]=itemselected1;
		quantities[index] = document.getElementById("q12").value;
		prices[index] = document.getElementById("p12").value;
		index++;
	}

	var e3 = document.getElementById("d13");
	var itemselected3 = e3.value;
	if(document.getElementById("q13").value!="0"){
		items[index]=itemselected1;
		quantities[index] = document.getElementById("q13").value;
		prices[index] = document.getElementById("p13").value;
		index++;
	}

	var e4 = document.getElementById("d14");
	var itemselected1 = e4.value;
	if(document.getElementById("q14").value!="0"){
		items[index]=itemselected1;
		quantities[index] = document.getElementById("q14").value;
		prices[index] = document.getElementById("p14").value;
		index++;
	}
    var e4 = document.getElementById("d15");
	var itemselected1 = e4.value;
	if(document.getElementById("q15").value!="0"){
		items[index]=itemselected1;
		quantities[index] = document.getElementById("q15").value;
		prices[index] = document.getElementById("p15").value;
		index++;
	}
    
    var e4 = document.getElementById("d16");
	var itemselected1 = e4.value;
	if(document.getElementById("q16").value!="0"){
		items[index]=itemselected1;
		quantities[index] = document.getElementById("q16").value;
		prices[index] = document.getElementById("p16").value;
		index++;
	}
    
	strt(1);
	
	let img = document.createElement("img");
	img.src = "icons/money.png";
	img.style.width = "500px";
	img.style.height = "642.78px";
	img.style.float = "left";
	img.style.marginTop="-250px";
	document.body.appendChild(img);
	
	for(var i=0;i<index;i++){
		document.write("<tr>");
		createtbl(items[i]);
		createtbl(prices[i]);
		createtbl(quantities[i]);
		var tot=parseInt(quantities[i])*parseInt(prices[i]);
		document.write("<td style=\"font-family: Papyrus; align-items:center;text-align:center;background-color:#86dd86;\"> <strong>"+tot+"$</strong></td>");
		fTot+=tot;
		document.write("</tr>");
	}
	document.write("<tr style=\"font-family: Algerian; background-color:white;\"><td colspan=\"3\" style=\"padding-left: 107px;color: #a71114;\"><strong>TOTAL</strong></td><td style=\"color: #a71114;text-align:center; background-color:#86dd86;\">"+fTot+"$</td><tr>");
		strt(2);	
	
	document.write("<button onclick=\"confirm()\";\" style=\"font-family: Papyrus; margin-top:25px;margin-left:45px; background-color: #7B68EE; width: 100px; color: white;\">Confirm</button>");
		strt(2);	
	
	
	}
	function createtbl(x){
		document.write("<td style=\"font-family: Papyrus; text-align:center; background-color:#9ae0ff\">"+x+"</td>");
	}

	function strt(n){
		if(n==1){
			document.writeln("<h1 style=\"text-align:right;font-family: Algerian; color: #4eff58;font-size: 75px; padding-right:110px;margin-top:100px;\">The Bill</h1>");
			document.writeln("<table width=\"50%\" style= \" float: right; margin-top:-25px; \">");
			document.writeln("<tr style=\"font-family: Algerian; color: #d1161a;background-color:white;\"><th>ITEMS</th><th>PRICE</th><th>QUANTITY</th><th>TOTAL</th></tr>");
		}
		else
			document.write("</table>");
	}

	function createTot(x,y){
		var tot=parseInt(x)*parseInt(y);
		document.write("<td>"+tot+"$</td>");
	}	

	function confirm(){
		if(fTot>0){
			window.location.href="order.html";
		}
		else{
			alert("No order is met.. Reload Page and order again.");
		}
	}