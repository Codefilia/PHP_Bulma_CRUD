<div class="container pb-6 pt-6">

    <p class="has-text-right pt-4 pb-4">
        <a href="#" class="button is-link is-rounded btn_back"><span class="icon-text">
          <span class="icon">
		  <i class="fa-solid fa-arrow-left-from-line"></i>
          </span>
          <span>Regresar atrás</span></button></a> 
    </p>

    <script type="text/javascript">
        let btn_back = document.querySelector(".btn_back")

        btn_back.addEventListener('click', function(e){

            e.preventDefault();
            window.history.back();

        });
    </script>