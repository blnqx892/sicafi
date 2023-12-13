$(document).ready(function () {
  
  
    combo();
  
    function combo() {
      $.ajax({
        url: "Controlador/Usuarios/mostrarrol.php",
        type: "GET",
        success: function (response) {
          //console.log(JSON.parse(response));
          const item = JSON.parse(response);
          let template = '<option value="">Elegir Rol </option>';
          item.forEach((item) => {
            template += `
            <option value="${item.id}">${item.name}</option>
                    `;
          });
          $("#rolC").html(template);
        },
      });
    } 
    //fin de mostrar en el combo
  
   //**************************************guardar  */
    
  
   
    });