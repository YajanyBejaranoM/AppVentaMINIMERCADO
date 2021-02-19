<nav>
                <ul>
                   <li><a href=""><i class="fas fa-home"></i> Inicio</a></li>
                   <?php
                       if($_SESSION['rol'] == 1){
                       ?>
                   <li class="principal"><a href=""><i class="fas fa-users"></i> USUARIOS</a>
                      <ul>
                         <li><a href="registro_usuario.php"><i class="fas fa-user"></i> Nuevo usuario</a></li>
                         <li><a href="listar_usuario.php"><i class="fas fa-clipboard-list"></i> Lista de Usuario</a></li>
                      </ul>
                    </li>
                    
                    <li class="principal"><a href=""><i class="fas fa-users"> </i> CLIENTES</a>
                        <ul>
                          <li><a href="listar_clientes.php"><i class="fas fa-clipboard-list"></i> Lista de clientes</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="principal"><a href=""><i class="fas fa-shopping-cart"></i> PRODUCTOS</a>
                       <ul>
                       <?php
                       if($_SESSION['rol'] != 1){
                       ?>
                       <li><a href="registrar_producto.php"><i class="fas fa-shopping-cart"></i> Nuevo Producto</a></li>
                    <?php } ?>
                       <li><a href="listarproducto.php"><i class="fas fa-clipboard-list"></i> Lista de Productos</a></li>
                      </ul>

                    </li>
                     <li class="principal"><a href=""><i class="fas fa-clipboard-list"></i> FACTURA</a>
                    <ul>
                    <li><a href="facturafinal.php"><i class="fas fa-clipboard-list"></i> Nueva venta</a></li>
                    <li><a href=""><i class="fas fa-clipboard-list"></i> Lista de Facturas</a></li>
                    </ul>
                    </li>
                </ul>
 </nav>