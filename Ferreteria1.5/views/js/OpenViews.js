$(document).ready(function () {
//=============================[  PRODUCT  ]=========================//	
	$(function viewCreateProduct() {
		$(document).on("click", "#viewProduct", function () {
			llamarVista("Product", "Product", "viewProduct");	
		});
	});
	// -------------------------------------------------------------//
    				/****SHOW MODAL Search PRODUCT****/
    $(document).on("click", "#Search", function () {
        $.ajax({
				url: "../../app/lib/ajax.php",
				method: "post",
				data: {
					modulo: "Product",
					controlador: "Product",
					funcion: "modalSearchProduct",
				}
        }).done((res) => {
            $("#modalSearchProduct .modal-body").html(res);
            $("#modalSearchProduct").modal({ backdrop: "static", keyboard: false });      
        });
    });
    
	
//=============================[ CUSTOMER ]=========================//	
	$(function showCustomer() {
		$(document).on("click", "#showCustomer", function () {
			llamarVista("Customer", "Customer", "viewCreateCustomer");
			
		});
	});
	// -------------------------------------------------------------//
	/****SHOW MODAL Search CLIENT**/
    $(document).on("click", "#SearchCustomer", function () {
        $.ajax({
            url: "../../app/lib/ajax.php",
            method: "POST",
            data: { modulo: "Customer",
					controlador: "Customer",
					funcion: "modalSearchCustomer",
				}

        }).done((res) => {
            $("#modalSearchCostumer .modal-body").html(res);
            $("#modalSearchCostumer").modal({ backdrop: "static", keyboard: false });
        });
    });
//=============================[ PROVIDER ]=========================//	
	$(function showProvider() {
		$(document).on("click", "#showProvider", function () {
			
			llamarVista("Provider", "Provider", "viewCreateProvider");
			
		});
	});
	// -------------------------------------------------------------//
	/****SHOW MODAL Search PROVIDER**/
    $(document).on("click", "#SearchProvider", function () {
        $.ajax({
            url: "../../app/lib/ajax.php",
            method: "POST",
            data: { modulo: "Provider",
					controlador: "Provider",
					funcion: "modalSearchProvider",
				}

        }).done((res) => {
            $("#modalSearchProvider .modal-body").html(res);
            $("#modalSearchProvider").modal({ backdrop: "static", keyboard: false });
        });
    });
//=============================[   SALE   ]=========================//	
	$(function showGenerateSale() {
		$(document).on("click", "#showGenerateSale", function () {
			llamarVista("Sale", "Sale", "viewCreateSale");
			
		});
	});

// //=============================[ PURCHASE ]=========================//	
// 	$(function showPurchase() {
// 		$(document).on("click", "#showPurchase", function () {
// 			llamarVista("Purchase", "Purchase", "viewCreatePurchase");
			
// 		});
// 	});

// //=============================[ INVOICE ]=========================//	
// 	$(function showInvoice() {
// 		$(document).on("click", "#showInvoice", function () {
// 			llamarVista("Invoice", "Invoice", "viewCreateInvoice");
			
// 		});
// 	});
// //=============================[ PROFILE ]=========================//	
// 	$(function showProfile() {
// 		$(document).on("click", "#showProfile", function () {
// 			llamarVista("Profile", "Profile", "viewCreateProfile");
			
// 		});
// 	});

// //=============================[ AUDIT ]=========================//	
// 	$(function showAudit() {
// 		$(document).on("click", "#showAudit", function () {
// 			llamarVista("Product", "Product", "viewCreateAudit");
			
// 		});
// 	});
});