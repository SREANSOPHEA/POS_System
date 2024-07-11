changeImage = (e) =>{
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = document.getElementById("imagePreview");
            img.src = e.target.result;
            img.style.display = "block";
        };
        reader.readAsDataURL(input.files[0]);
    }
};


$('.editBTN').click(function(){
    var id = $(this).parents('table tr').find('td').eq(0).text();
    var code = $(this).parents('table tr').find('td').eq(1).text();
    var name = $(this).parents('table tr').find('td').eq(2).text();
    var note = $(this).parents('table tr').find('td').eq(3).text();
    
    $('#text_id').val(id);
    $('#text_code').val(code);
    $('#text_name').val(name);
    $('#text_note').text(note);
})
$('.editCurrency').click(function(){
    var id = $(this).parents('table tr').find('td').eq(0).text();
    var name = $(this).parents('table tr').find('td').eq(1).text();
    
    $('#text_id').val(id);
    $('#text_name').val(name);
})

$('.deleteCategory').click(function(){
    var id = $(this).parents('table tr').find('td').eq(0).text();
    $('#deleteBTN').attr('href','/admin/delete-category/'+id);
})
$('.deleteProduct').click(function(){
    var id = $(this).parents('table tr').find('td').eq(0).text();
    $('#deleteBTN').attr('href','/admin/delete-product/'+id);
})
$('.deleteCustomer').click(function(){
    var id = $(this).parents('table tr').find('td').eq(0).text();
    $('#deleteBTN').attr('href','/admin/delete-customer/'+id);
})
$('.deleteSupplier').click(function(){
    var id = $(this).attr('data-value');
    $('#deleteBTN').attr('href','/admin/delete-supplier/'+id);
})
$('.deleteCurrency').click(function(){
    var id = $(this).parents('table tr').find('td').eq(0).text();
    $('#deleteBTN').attr('href','/admin/delete-currency/'+id);
})
$('.deleteUnit').click(function(){
    var id = $(this).parents('table tr').find('td').eq(0).text();
    $('#deleteBTN').attr('href','/admin/delete-unit/'+id);
})


const code = [];
const qty = [];
function getBarcode(barcode){
    var check = 0;
    for(i=0;i<code.length;i++){
        if(code[i] == barcode){
            check = 1;
            qty[i]++; 
            document.getElementById('text_qty'+barcode).innerHTML= "<input type='hidden' name='qty[]' value='"+qty[i]+"'>" + qty[i];
        }
    }
    // console.log(code);
    if(check == 0){
        code[code.length] = barcode;   
        qty[qty.length] = 1;   
        return barcode;
    }
    return 0;
}
function deleteArr(index){
    code.splice(index,1);
    qty.splice(index,1);
}

function speech(message){
    const text = new SpeechSynthesisUtterance(message);
    speechSynthesis.speak(text);
}



function itemProduct(id, name, price,qty,img) {
    return `
        <div class="row m-2">
            <div class="col-6 bg-dark">
                <img src="http://localhost:8000/images/${img}" class="w-100">
            </div>
            <div class="col-6">
                <h5>${name}</h5>
                <p>$${price}</p>
                <input type="hidden" name="id[]" value="${id}">
                <input type="hidden" name="name[]" value="${name}">
                <input type="hidden" name="price[]" value="${price}">
                <div class="input-group">
                    <button type="button" onclick="decrement('${id}')">-</button>
                    <input type="text" name="qty[]" id="quantity-${id}" class="form-control" value="${qty}" readonly>
                    <button type="button" onclick="increment('${id}')">+</button>
                </div>
            </div>    
        </div>
    `;
}

function decrement(id){
    for(i=0;i<ProductNames.length;i++){
        if(id == ProductID[i]){
            if(ProductQty[i] >1){
                ProductQty[i]--;
            }else{
                ProductID.splice(i,1);
                ProductNames.splice(i,1);
                ProductImages.splice(i,1);
                ProductPrice.splice(i,1);
                ProductQty.splice(i,1);
                ProductStock.splice(i,1);
                ProductStatus.splice(i,1);
            }
            document.getElementById('currentOrder').innerHTML = items();
        }
    }
}
function increment(id){
    for(i=0;i<ProductNames.length;i++){
        if(id == ProductID[i]){
            if(ProductStatus[i] == "sale" && ProductQty[i] < ProductStock[i]){
                ProductQty[i]++;
                document.getElementById('currentOrder').innerHTML = items();
            }
            if(ProductStatus[i] == "purchase"){
                ProductQty[i]++;
                document.getElementById('currentOrder').innerHTML = items();
            }
        }
    }
}

const ProductNames = [];
const ProductImages = [];
const ProductID = [];
const ProductQty = [];
const ProductPrice = [];
const ProductStock = [];
const ProductStatus = [];
function addPurchaseItem(name, id, image ,price,stock,status) {
    var index = ProductNames.length;
    for(i=0;i<ProductNames.length;i++){
        if(id == ProductID[i]){
            if(ProductStatus[i] == "sale" && ProductQty[i] < ProductStock[i]){
                ProductQty[i]++;
                document.getElementById('currentOrder').innerHTML = items();
            }
            if(ProductStatus[i] == "purchase"){
                ProductQty[i]++;
                document.getElementById('currentOrder').innerHTML = items();
            }
            return;
        }
    }

        ProductNames[index] = name;
        ProductID[index] = id;
        ProductImages[index] = image;
        ProductQty[index] = 1;
        ProductPrice[index] = price;
        ProductStock[index] = stock;
        ProductStatus[index] = status;
    document.getElementById('currentOrder').innerHTML = items();
}

function items(){
    let subtotal = 0;
    let discount = 0;
    let amount = 0;
    for(i=0;i<ProductNames.length;i++){
        let total = ProductPrice[i] * ProductQty[i];
        subtotal += total;
    }
    document.getElementById('totalProduct').innerHTML = ProductNames.length;
    if(subtotal<10) discount = 0;
    else if(subtotal <20) discount = 10;
    else if(subtotal <35) discount = 15;
    else if(subtotal <50) discount = 20;

    amount = subtotal - ((subtotal*discount)/100) + (subtotal*0.05);
    document.getElementsByName('subtotal')[0].value = subtotal;
    document.getElementsByName('discount')[0].value = discount;
    document.getElementsByName('amount')[0].value = amount;
    document.getElementById('subtotal').innerHTML = "<b>"+subtotal.toLocaleString()+"$</b?";
    document.getElementById('discount').innerHTML = "<b>"+discount+"%</b?";
    document.getElementById('amount').innerHTML = "<b>"+amount.toLocaleString()+"$</b?";
    var item = "";
        for(i=0;i<ProductNames.length;i++){
            item += itemProduct(ProductID[i],ProductNames[i],ProductPrice[i],ProductQty[i],ProductImages[i]);
        }
        return item;
}