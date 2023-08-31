<script>
    document.addEventListener('DOMContentLoaded', () => {

    /*== Obtener todos los elementos ==*/
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    if ($navbarBurgers.length > 0) {

    /*== Agregar evento por clik ==*/
    $navbarBurgers.forEach( el => {
        el.addEventListener('click', () => {

        const target = el.dataset.target;
        const $target = document.getElementById(target);

        /*== Toggle de Activacion ==*/
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

        });
    });
    }

    });
/*== Script ajax.js ==*/
</script>
<script src="./js/ajax.js" ></script>
