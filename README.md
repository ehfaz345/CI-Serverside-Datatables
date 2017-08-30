# Codeigniter server side Datatables implementation

**This module has been built on an existing datatables solution on mbahcoding.com [Link](http://mbahcoding.com/tutorial/php/codeigniter/codeigniter-simple-server-side-datatable-example.html)**

**This solution has primarily been designed to be more modular and dynamic, following an MVC pattern to allow for multiple datatables generation, simply by passing SQL parameters - as shown in the examples provided. The purpose of this module is to act as a guide for future use of server side implementation of jQuery datatables**

## Steps
1. Place the file "Datatables_model.php" into the directory application > models
2. Load the model into the calling controller
3. Define function in controller to use the data sent from the view and pass necessary SQL parameters into the datatables model and finally prepare a response based on that, formatted and echoed using JSON. (See sample controller)
4. Configure the datatables plugin on the view page to use server side processing and set the AJAX url, data and response to interact with the function defined in the controller. (See sample view)
