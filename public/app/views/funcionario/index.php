<?php
require_once "../../../assets/_includes/header.php";
?>
<link rel="stylesheet" href="../../../assets/_css/funcionario/main.css">
<link rel="stylesheet" href="../../../assets/_css/funcionario/table.css">
<?php
require_once "../../../assets/_includes/menu.php";
?>
<main> 
      
  <div class="card-search">
    <div class="bar-search">
      <span class="mdi mdi-magnify"></span>
      <input type="text" id="search-by-teacher" class="search-by-teacher">
    </div>
  </div>
    <section class="content">
       <div class="controlls">
        <button class="mdi mdi-plus"onclick="add()">Adicionar</button>
        <button class="mdi mdi-file-excel">Excel</button>
        <button class="mdi mdi-file-pdf">PDF</button>
       </div>

      <!-- Cards de Professores -->
      <div class="cards-container" id="professoresContainer">
        <table>
          <thead>
            <tr>
              <th>
                Funcionario
              </th>
            
            </tr>
          </thead>
          <tbody id="lista-funcionario">
           
          </tbody>
        </table>
      </div>
    </section>
       <div class="models-form" id="model-form">
        <div class="card-form">
            <form id="formulario">
                <div class="campo">
                    <label for="nome_funcionario">Nome</label>
                    <input type="text" name="nome_funcionario" id="" class="input-form">
                    
                </div>
                <div class="campo">
                    <label for="sobrenome_funcionario">Sobrenome</label>
                    <input type="text" name="sobrenome_funcionario" id="sobrenome_funcionario" class="input-form">

                </div>
                <div class="campo">
                    <label for="bilhete_funcionario">Bilhete</label>
                    <input type="text" name="bilhete_funcionario" id="bilhete_funcionario" class="input-form">

                </div>
                <div class="campo">
                    <label for="email_funcionario">E-mail</label>
                    <input type="email" name="email_funcionario" id="" class="input-form">

                </div>
                <div class="campo">
                    <label for="cargo">Cargo</label>
                    <input type="tel" name="cargo" id="" class="input-form">

                </div>
                <div class="campo">
                    <label for="telefone">Telefone</label>
                    <input type="tel" name="telefone" id="" class="input-form">

                </div>
                <div class="campo">
                    <label for="provincia_residencia">Residente na Provincia</label>
                    <input type="text" name="provincia_residencia" id="" class="input-form">

                </div>
                <div class="campo">
                    <label for="municipio_residencia">Residente no Municipio</label>
                    <input type="text" name="municipio_residencia" id="" class="input-form">

                </div>
                <div class="campo">
                    <label for="bairro_residencia">Residente no Bairro</label>
                    <input type="text" name="bairro_residencia" id="" class="input-form">

                </div>
                <div class="campo">
                    <label for="status_funcionario">Estado</label>
                    <select name="status_funcionario" id="">
                        <option value="Activo">Activo</option>
                        <option value="Demitido">Demitido</option>
                        <option value="Falecido">Falecido</option>
                        <option value="Aposendando">Aposendando</option>
                        <option value="Inativo">Inativo</option>
                    </select>

                </div>
                <div class="campo">
                    <label for="descricao">Observações</label>
                    <input type="text" name="descricao" id="" class="input-form">

                </div>
                <div class="campo">
                    <label for="id_departamento">Departamento</label>
                   <select name="id_departamento" id="">
                    <option value="1">Inrmatica</option>
                   </select>
                </div>
                <div class="campo">
                  <input type="file" name="img" id="img">
                  <div class="img">
                    <img src="" alt="foto-selecionada" id="img-preview">
                  </div>
                </div>
                
                  
                
                <div class="campo">
                  <input type="submit" value="Cadastrar">
                </div>
            </form>

        </div>
    </div>
 
</main>
<script src="../../../assets/_js/funcionario/funcionarios.js"></script>
<script src="../../../assets/_js/funcionario/requisicao.js"></script>
<?php
require_once "../../../assets/_includes/footer.php";
?>