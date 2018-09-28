refreshDropdown();
// Call to Fill the Cart From Local Storage
//Now Check Every Few Moments
setInterval(function(){
	refreshDropdown();
},5000);

var title;
var pageTitle = document.title;
window.onfocus = function() {
    document.title = pageTitle;
	clearInterval(title);
};
window.onblur = function() {
	var x = 0;
	title = setInterval(function(){
		if(x == 0){
			document.title = "We Have Good Services.";
			x = 1;
		}else{
			document.title = "You Will Love Us";
			x = 0;
		}
	}, 2000);
};

var fixmeTop = $('body').offset().top;       // get initial position of the element

$(window).scroll(function() {                  // assign scroll event listener

	var currentScroll = $(window).scrollTop(); // get current position

	if (currentScroll >= 45) {           // apply position: fixed if you
		$('.fixed_container').addClass('fixed_container_fixed');
	} else {                                   // apply position: static
		$('.fixed_container').removeClass('fixed_container_fixed');
	}

});

var allItems = [];
$.ajax({
	url: 'getmenu',
	method: "GET",
	cache: false,
	error: function() {
		console.log("Could Not Fetch Or Connect TO Database");
    //alert('OPPS');
	},
	success: function(data) {
		allItems = data;
		displayMenu();
	}
});

// Query Result
// var allItems = [{'id':1,'name':'Veg. Mo:Mo','price':'60','description':'','special':'0'}, {'id':2,'name':'Chowmin','price':'40','description':'Plain Healthy Veg Chowmin','special':'0'}, {'id':3,'name':'Cheese Pizza','price':'120','description':'','special':'0'}, {'id':4,'name':'Veg Royal Burger','price':'180','description':'','special':'1'}, {'id':5,'name':'Pastries + Milk Shake','price':'180','description':'','special':'1'}, {'id':6,'name':'Cheek-Peas With Eggs','price':'100','description':'','special':'0'}, {'id':7,'name':'Banana Pancake','price':'70','description':'','special':'0'}, {'id':8,'name':'Egg Roll Mini','price':'40','description':'','special':'0'}];

///####///
//displayMenu(); // IMPORTANT : NOTE: REMOVE THIS CALL AFTER AJAX ADDED////############
///###///

// Cart Empty Initially
var inCart = [];

if(localStorage.getItem('cart') != null){
	if(localStorage.getItem('cart_date') !== null){
		if(new Date().getDate() > localStorage.getItem('cart_date')){
			localStorage.removeItem('cart_date');
			localStorage.removeItem('cart');
		}else{
			var cache_cart = JSON.parse(localStorage.getItem('cart'));
			var inCart = JSON.parse(localStorage.getItem('cart'));

			refreshOrders();
			refreshBill();
			refreshCartIcon();
			refreshDropdown();
			$('#orders').prepend('<b style="margin: 0; margin-top:5px; margin-bottom: -10px; padding:0;">Cached<b>');
			/* for(let i = 0 ; i < cache_cart.length ; i++){
				$('#orders').append('<i style="margin-left: 10px;">' + cache_cart[i]['name'] + ' - ' + cache_cart[i]['quantity'] + ' unit(s)</i><br/>');
			} */
			//$('#orders table td').css({'opacity':'0.5','color':'brown'});
			
			//clearCacheOrders();
		}
	}
}

var currentChange; //TO keep Track of Latest Change for Animating.
var deleteAnimate = false;

function displayMenu(){
	if(localStorage.getItem('cart') != null){
		$('.loading').html("<button class='big_button' style='background:salmon !important;' onclick='clearCache()'>Clear Cached Order</button>");
		return;
	}
	
	var hasSpecial = 0;
	var currentCategory = "";
	//Start Making Table
	var tableSpecialOffer = "<b>Special Offer</b>" +
						"<table>" +
						"<tr>" +
						"<th>Item</th>" +
						"<th>Price</th>" +
						"<th>Add</th>" +
						"<th>Del</th>" +
						"</tr>";

	var tableMenu = "<b>Menu Items</b>" +
						"<table>" +
						"<tr>" +
						"<th>Item</th>" +
						"<th>Price</th>" +
						"<th>Add</th>" +
						"<th>Del</th>" +
						"</tr>";
	//Fill Menu
	for(var i = 0 ; i < allItems.length ; i++){
		if(allItems[i]['special'] == 1){
			hasSpecial = 1;
			tableSpecialOffer = tableSpecialOffer + "<tr title='" + allItems[i]['description'] + "'>" +
						"<td>"+allItems[i]['name']+"</td>" +
						"<td>Rs. "+allItems[i]['price']+"</td>" +
						"<td class='btn' onclick='addNew(this," + allItems[i]['id'] + ',' + i +  ")'>" + '+' +"</td>" +
						"<td class='btn' onclick='removeNew(this," + allItems[i]['id'] + ',' + i +  ")'>"+ '-' +"</td>" +
						"</tr>";
		}else{
      if(currentCategory != allItems[i]['category']){
        currentCategory = allItems[i]['category'];
        tableMenu = tableMenu + "<tr>" +
  						"<td><u style='font-weight:bold; text-decoration:none;font-size:1.3em; letter-spacing: 5px;'>"+allItems[i]['category']+"</u></td>" +
  						"<td></td>" +
  						"<td></td>" +
  						"<td></td>" +
  						"</tr>";
      }
			tableMenu = tableMenu + "<tr title='" + allItems[i]['description'] + "'>" +
						"<td>"+allItems[i]['name']+"</td>" +
						"<td>Rs. "+allItems[i]['price']+"</td>" +
						"<td class='btn' onclick='addNew(this," + allItems[i]['id'] + ',' + i +  ")'>" + '+' +"</td>" +
						"<td class='btn' onclick='removeNew(this," + allItems[i]['id'] + ',' + i +  ")'>"+ '-' +"</td>" +
						"</tr>";
		}
	}

	tableSpecialOffer = tableSpecialOffer + "</table>";
	tableMenu = tableMenu + "</table>";
	//APPEND MENU
  $('.loading').hide();
	if(hasSpecial==1){
		$('#special_offer').append(tableSpecialOffer);
	}
	$('#special_offer').append(tableMenu);
}

function addNew(click_id, id, index){
	//alert(id);
	//alert(index);
	if(allItems[index].hasOwnProperty('quantity')){
		allItems[index].quantity = allItems[index].quantity + 1;
		currentChange = inCart.indexOf(allItems[index]); //Track current Change for Animation
	}else{
		allItems[index].quantity = 1;
		inCart.push(allItems[index]);
		currentChange = inCart.indexOf(allItems[index]); //Track current Change for Animation
	}

	deleteAnimate = false;

	refreshOrders();
	refreshBill();
	refreshCartIcon();
	refreshDropdown();
	addLocal();
	document.getElementsByClassName("dropdown_btn")[0].style.display = 'inline-block';
	document.getElementsByClassName("dropdown_btn")[1].style.display = 'inline-block';

	console.log(inCart);
}

function removeNew(click_id, id, index){
	//alert(id);
	//alert(index);
	if(allItems[index].hasOwnProperty('quantity')){
		if(allItems[index].quantity > 1){
			allItems[index].quantity = allItems[index].quantity - 1;
		}else{
			delete allItems[index].quantity;
			//alert (inCart.indexOf(allItems[index]));
			if(inCart.indexOf(allItems[index]) >= 0){
				inCart.splice(inCart.indexOf(allItems[index]),1);
				console.log("YES");
			}else{
				console.log("No");
				click_id.style.animation = 'nope 1s ease forwards';
				showError('First Add, Then Remove');
				return;
			}
		}
		currentChange = inCart.indexOf(allItems[index]);
	}else{
		//alert (inCart.indexOf(allItems[index]));
		if(inCart.indexOf(allItems[index]) >= 0){
			inCart.splice(inCart.indexOf(allItems[index]),1);
			console.log("YES");
		}else{
			console.log("No");
			click_id.style.animation = 'nope 1s ease forwards';
			showError('First Add, Then Remove');
			return;
		}
		currentChange = inCart.indexOf(allItems[index]);
	}

	deleteAnimate = true;

	refreshOrders();
	refreshBill();
	refreshCartIcon();
	refreshDropdown();
	addLocal();

	console.log(inCart);
}

function refreshOrders(){
	var ordersHTML = "<b>Orders</b>" +
						"<table>" +
						"<tr>" +
						"<th>Name</th>" +
						"<th>Quantity</th>" +
						"<th>Unit Price</th>" +
						"<th>Total Price</th>" +
						"</tr>";
	//Fill Orders
	for(var i = 0 ; i < inCart.length ; i++){
		if(currentChange == i){
			ordersHTML = ordersHTML + "<tr class='current_change' title='" + inCart[i]['description'] + "'>";
		}else{
			ordersHTML = ordersHTML + "<tr title='" + inCart[i]['description'] + "'>";
		}

		ordersHTML = ordersHTML +
						"<td>"+inCart[i]['name']+"</td>" +
						"<td>" +inCart[i]['quantity']+ "</td>" +
						"<td>Rs. "+inCart[i]['price']+"</td>" +
						"<td>Rs. "+(inCart[i]['price']*inCart[i]['quantity'])+"</td>" +
						"</tr>";
	}

	ordersHTML = ordersHTML + "</table>";

	if(inCart.length > 0){
		$('#order_btn').css({'display':'inline-block'});
	}else{
		$('#order_btn').css({'display':'none'});
	}
	//Order Button Shown Above//

	//APPEND Orders
	$('#orders').html('');
	$('#orders').append(ordersHTML);
}

function refreshBill(){
	//Total Quantity
	var total_quantity = 0;
	for(var i = 0 ; i < inCart.length ; i++){
		total_quantity = total_quantity + (inCart[i]['quantity']);
	}
	$('#bill_total_quantity').html('Total Quantity: ' + total_quantity);
	//Also in DropDown Inside//
	$('#dropdown_quantity').html('Quantity: ' + total_quantity);
	$('#mobile_dropdown_quantity').html('Quantity: ' + total_quantity);

	//Total Bill
	var total = 0;
	for(var i = 0 ; i < inCart.length ; i++){
		total = total + (inCart[i]['price'] * inCart[i]['quantity']);
	}
	$('#bill_total').html('Total: Rs. ' + total);

	//Tax
	var tax = Math.round(((total/100) * 13) * 100) / 100;
	$('#bill_tax').html('Tax: Rs. ' + tax);

	//Delivery Charge
	var delivery_charge = 0;
	$('#bill_delivery_charge').html('Delivery Charge: Rs. ' + delivery_charge);

	//Sub-Total
	var subtotal = Math.round((total + tax + delivery_charge) * 100) / 100;
	$('#bill_sub_total').html('Sub-Total: Rs. ' + subtotal);
	//Also Dropdown Total//
	$('#dropdown_total').html('Total: Rs. ' + subtotal);
	$('#mobile_dropdown_total').html('Total: Rs. ' + subtotal);

	if(subtotal >= 5000 && subtotal <= 5200){
		showSuccess('Rs.' + subtotal + '+++ worth purachase Hooray... Keep Loving Us.');
	}
}

function refreshCartIcon(){
  $('#cart_icon').html("In Cart: " + inCart.length);
	$('#total_cart').html("" + inCart.length);
	$('#total_cart_mobile').html("" + inCart.length);

	//Delete Animate Change CSS....Only works while keeping it here.
	//No Idea Why... :( SAD VERY SAD....
	if(deleteAnimate==true){
		$('.current_change').css({'animation':'delete_change 0.5s ease forwards'});
	}
}

function refreshDropdown(){
	//In Cart Local Storage Show in Dropdown//
	if(localStorage.getItem('cart') == null){
		return;
	}
	var inCartLocal = JSON.parse(localStorage.getItem('cart'));

	var dropdownHTML = "<table>" +
						"<tr>" +
						"<th>Name</th>" +
						"<th>Quantity</th>" +
						"<th>Unit</th>" +
						"<th>Total</th>" +
						"</tr>";
	//Fill Orders
	for(var i = 0 ; i < inCartLocal.length ; i++){
		dropdownHTML = dropdownHTML +
						"<tr><td>"+inCartLocal[i]['name']+"</td>" +
						"<td>" +inCartLocal[i]['quantity']+ "</td>" +
						"<td>Rs. "+inCartLocal[i]['price']+"</td>" +
						"<td>Rs. "+(inCartLocal[i]['price']*inCartLocal[i]['quantity'])+"</td>" +
						"</tr>";
	}

	dropdownHTML = dropdownHTML + "</table>";
	//APPEND TO DropDown Also
	$('#mobile_dropdown_table').html('');
	$('#dropdown_table').html('');

	$('#mobile_dropdown_table').append(dropdownHTML);
	$('#dropdown_table').append(dropdownHTML);

	//Now, Calculate from Local Storage Again//
	var total_quantity = 0;
	for(var i = 0 ; i < inCartLocal.length ; i++){
		total_quantity = total_quantity + (inCartLocal[i]['quantity']);
	}
	//Also in DropDown Inside//
	$('#dropdown_quantity').html('Quantity: ' + total_quantity);
	$('#mobile_dropdown_quantity').html('Quantity: ' + total_quantity);

	//Total Bill
	var total = 0;
	for(var i = 0 ; i < inCartLocal.length ; i++){
		total = total + (inCartLocal[i]['price'] * inCartLocal[i]['quantity']);
	}

	//Tax
	var tax = Math.round(((total/100) * 13) * 100) / 100;

	//Delivery Charge
	var delivery_charge = 0;

	//Sub-Total
	var subtotal = Math.round((total + tax + delivery_charge) * 100) / 100;
	//Also Dropdown Total//
	$('#dropdown_total').html('Total: Rs. ' + subtotal);
	$('#mobile_dropdown_total').html('Total: Rs. ' + subtotal);
	if(subtotal > 0){
		document.getElementsByClassName("dropdown_btn")[0].style.display = 'inline-block';
		document.getElementsByClassName("dropdown_btn")[1].style.display = 'inline-block';
	}
}

/* Other Extra JS Related to Cart*/

function showError(msg){
	$('#message_container').append('<div class="error_msg">' + msg + '</div>');
	var killer = setInterval(function(){
		$('#message_container').children().remove();
		clearInterval(killer);
	},10000);
}

function showSuccess(msg){
	$('#message_container').append('<div class="success_msg">' + msg + '</div>');
	var killer = setInterval(function(){
		$('#message_container').children().remove();
		clearInterval(killer);
	},10000);
}

function addLocal(){
	////////////////////#///#////#///////////////////////#/
	//BETA: Local Storage Cart Session Creation.
	localStorage.setItem('cart', JSON.stringify(inCart));
	localStorage.setItem('cart_date', new Date().getDate());
	/////////////////////#///#////#////////////////////#/
}

function clearCacheOrders(){
	$('.calculations').append("<button class='big_button' onclick='clearCache()'>Clear Cached Order</button>");
}

function clearCache(){
	localStorage.removeItem('cart_date');
	localStorage.removeItem('cart');
	location.reload();
}
