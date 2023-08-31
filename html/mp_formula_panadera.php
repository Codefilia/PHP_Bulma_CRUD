<body>
  <div class="container">
      <br><br><br>
    <h1 class="title">Formula Panadera</h1>
    <form action="./php/mp_calculate.php" method="post">
      <div class="field">
        <label class="label" for="flour">Harina</label>
        <input class="input" type="number" name="flour" id="flour">
      </div>
      <div class="field">
        <label class="label" for="water">Agua</label>
        <input class="input" type="number" name="water" id="water">
      </div>
      <div class="field">
        <label class="label" for="salt">Sal</label>
        <input class="input" type="number" name="salt" id="salt">
      </div>
      <div class="field">
        <label class="label" for="leaven">Levadura</label>
        <input class="input" type="number" name="leaven" id="leaven">
      </div>
      <p class="has-text-centered">
      <button class="button is-primary" type="submit">Calcular</button>
      </p>
    </form>
  </div>
</body>
</html>
