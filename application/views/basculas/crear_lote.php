<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Crear Lote de Basculas</h2>
                  <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                     </li>
                     <li><a class="close-link"><i class="fa fa-close"></i></a>
                     </li>
                  </ul>
                  <div class="clearfix"></div>
               </div>

                  <button style="display: ;" type='button' onclick="validacion()" class='btn btn-success btn-md pull-right creacion' id="btnEnviar"><i class='fa fa-send'></i> Crear Lote</button>
            </div>

         </div>

      </div>
      <div class="row">
         <div class="col-md-5 col-sm-5 col-xs-5">
            <div style="border: 0; margin-bottom: 0 px;" class="x_panel">
               <div class="x_title">
                  <h3 style="display: inline;">Cliente</h3>
                  <button type='button' onclick="modalAsignarCliente()" id='btnClientes' class='btn btn-primary btn-xs pull-right solicitud'><i class='fa fa-plus'></i> Seleccionar</button>
                  <div class="clearfix"></div>
               </div>
               <div id="divCliente" style="display: none;" class="x_content">
                  <div class="row">
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>Razón Social:</label>
                        <p id="lblRazonSocialCliente"></p>
                        <label>Dirección:</label>
                        <p id="lblDireccionCliente"></p>
                     </div>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>RFC:</label>
                        <p id="lblRFCCliente"></p>
                     </div>
                  </div>
                  <div id="contacto">
                  </div>
                  <div id="divContacto" style="display: none;" class="x_content">
                     <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <label>Nombre</label>
                           <p id="lblNombreContacto"></p>
                           <label>Telefono:</label>
                           <p id="lblTelefonoContacto"></p>
                           <label>Correo:</label>
                           <p id="lblCorreoContacto"></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div id="pnlDatos" style="display: none;" class="col-md-7 col-sm-7 col-xs-12">
            <div style="border: 0px;" class="x_panel">
               <div class="x_title">
                  <h3 style="display: inline;">Datos</h3>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <label style="display: block">Responsable</label>
                        <button id="btnRequisitor" type='button' onclick="buscarAutores()" data-id="<?= $this->session->id ?>" data-nombre="<?= $this->session->nombre ?>" class='btn btn-primary btn-xs edicion'><i class='fa fa-user'></i> <?= $this->session->nombre ?></button>
                     </div>
                  </div>
                  <div style="margin-top: 10px;" class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <label>Comentarios</label>
                        <textarea style="resize: none;" id="txtNotas" class="form-control" ></textarea>
                        <button id="btnRequisitor" type='button' onclick="GuardarComentarios()" class='btn btn-primary btn-xs edicion'><i class='fa fa-sign-in'></i> Agregar</button>
                        <br>
                        <label id="lblComentarios"></label>
                     </div>
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_title">
                           <h3 style="display: inline;">Fechas</h3>
                           <div class="clearfix"></div>
                        </div>
                        <div class="table-responsive">
                           <table id="tabla" class="table table-bordered" >
                              <thead>
                                 <tr class="headings">
                                    <th class="column-title text-center">Fecha Entrega</th>
                                    <th class="column-title text-center">Fecha Instalacion</th>
                                    <th class="column-title text-center">Fecha Capacitacion</th>
                                    <th class="column-title text-center">Fecha Soporte</th>
                                    <th class="column-title text-center">Fecha Recolecion</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <tbody>
                                 <tr class="even pointer">
                                    <td  class="text-center"><input
                                       id="fEntrega"
                                       type="datetime-local"
                                       name="fEntrega"/></td>
                                    <td  class="text-center"><input
                                       id="fInstalacion"
                                       type="datetime-local"
                                       name="fInstalacion"/></td>
                                    <td  class="text-center"><input
                                       id="fCapacitacion"
                                       type="datetime-local"
                                       name="fCapacitacion"/></td>
                                    <td  class="text-center"><input
                                       id="fSoporte"
                                       type="datetime-local"
                                       name="fSoporte"/></td>
                                    <td  class="text-center"><input
                                       id="fRecolecion"
                                       type="datetime-local"
                                       name="fRecolecion"/></td>
                                 </tr>
                              </tbody>
                              </tbody>
                           </table>
                        </div>
                        <button id="btnRequisitor" type='button' onclick="GuardarFechas()" class='btn btn-primary btn-xs edicion'><i class='fa fa-save'></i> Guardar Fechas</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="display: none ;" id="divEquipos">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                  <div class="x_title">
                     <h2>Equipos</h2>
                     <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                     </ul>
                     <div class="clearfix"></div>
                  </div>
                  <div class="table-responsive">
                     <table id="tabla" class="table table-bordered" >
                        <thead>
                           <tr class="headings">
                              <th class="column-title text-center">Basculas</th>
                              <th class="column-title text-center">Plataformas</th>
                              <th class="column-title text-center">Extensiones</th>
                              <th class="column-title text-center">Carritos</th>
                              <th class="column-title text-center">Rampas</th>
                              <th class="column-title text-center">Scanners</th>
                              <th class="column-title text-center">Impresoras</th>
                           </tr>
                        </thead>
                        <tbody>
                        <tbody>
                           <tr class="even pointer">
                              <td  class="text-center">
                                 <input id="basculas" type="number" name="basculas"/>
                                 <button id="basculas" type='button' onclick="escanearBascula()" class='btn btn-warning btn-xs'><i class='fa fa-barcode'></i> Escanear</button><br>
                                 <label id="lblBascula"></label>
                              </td>
                              <td  class="text-center">
                                 <input id="plataformas" type="number" name="plataformas"/>
                                 <button value="plataformas" id="plataformas" type='button' onclick="escanearPlataforma()" class='btn btn-warning btn-xs'><i class='fa fa-barcode'></i> Escanear</button>
                                 <br>
                                 <label id="lblPlataformas"></label>
                              </td>
                              <td  class="text-center">
                                 <input id="extensiones" type="number" name="extensiones"/>
                                 <button id="extensiones" type='button' onclick="escanearExtensiones()" class='btn btn-warning btn-xs'><i class='fa fa-barcode'></i> Escanear</button>
                                 <br>
                                 <label id="lblExtensiones"></label>
                              </td>
                              <td  class="text-center">
                                 <input id="carritos" type="number" name="carritos"/>
                                 <button id="carritos" type='button' onclick="escanearCarritos()" class='btn btn-warning btn-xs'><i class='fa fa-barcode'></i> Escanear</button>
                                 <br>
                                 <label id="lblCarritos"></label>
                              </td>
                              <td  class="text-center">
                                 <input id="rampas" type="number" name="rampas"/>
                                 <button id="rampas" type='button' onclick="escanearRampas()" class='btn btn-warning btn-xs'><i class='fa fa-barcode'></i> Escanear</button>
                                 <br>
                                 <label id="lblRampas"></label>
                              </td>
                              <td  class="text-center">
                                 <input id="scanners" type="number" name="scanners"/>
                                 <button id="scanners" type='button' onclick="escanearScanners()" class='btn btn-warning btn-xs'><i class='fa fa-barcode'></i> Escanear</button>
                                 <br>
                                 <label id="lblScanners"></label>
                              </td>
                              <td  class="text-center">
                                 <input id="impresoras" type="number" name="impresoras"/>
                                 <button id="impresoras" type='button' onclick="escanearImpresoras()" class='btn btn-warning btn-xs'><i class='fa fa-barcode'></i> Escanear</button>
                                 <br>
                                 <label id="lblImpresoras"></label>
                              </td>
                           </tr>
                        </tbody>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>


         </div>
      </div>
   </div>
</div>
<div id="mdlBasculas" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Basculas</h4>
         </div>
         <div class="modal-body">
            <div class="col-md-12 col-sm-12 col-xs-12" id="divBasculas">
               <p style="display: inline;">
                  No. Inventario:
                  <input type="radio" class="flat" name="rbBusqueda" id="rbFolio" value="inventario" checked />
                  <input id="txtBascula" name="txtBascula" style="display: inline;" type="text" >
                  <button onclick="agregarLoteTemp()" style="display: inline;" class="btn btn-success" type="button"><i class="fa fa-search"></i> Agregar</button>
            </div>
         </div>
         <div class="row" style="overflow-y: auto; ">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                  <div class="x_content">
                     <div class="table-responsive">
                        <table id="tblLote" class="table table-striped">
                           <thead>
                              <tr class="headings">
                                 <th class="column-title">ID</th>
                                 <th class="column-title">Modelo</th>
                                 <th class="column-title">Serie</th>
                                 <th class="column-title">Opciones</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
   </div>
</div>

<div id="mdlPlataformas" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Plataformas</h4>
         </div>
         <div class="modal-body">
            <div class="col-md-12 col-sm-12 col-xs-12" id="divPlataformas">
               <p style="display: inline;">
                  No. Inventario:
                  <input type="radio" class="flat" name="rbBusqueda" id="rbFolio" value="inventario" checked />
                  <input id="txtPlataforma" name="txtPlataforma" style="display: inline;" type="text" >
                  <button onclick="agregarLotePlataformaTemp()" style="display: inline;" class="btn btn-success" type="button"><i class="fa fa-search"></i> Agregar</button>
            </div>
         </div>
         <div class="row" style="overflow-y: auto; ">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                  <div class="x_content">
                     <div class="table-responsive">
                        <table id="tblPlataforma" class="table table-striped">
                           <thead>
                              <tr class="headings">
                                 <th class="column-title">ID</th>
                                 <th class="column-title">Modelo</th>
                                 <th class="column-title">Serie</th>
                                 <th class="column-title">Opciones</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
   </div>
</div>

<div id="mdlExtensiones" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Extensiones</h4>
         </div>
         <div class="modal-body">
            <div class="col-md-12 col-sm-12 col-xs-12" id="divExtensiones">
               <p style="display: inline;">
                  No. Inventario:
                  <input type="radio" class="flat" name="rbBusqueda" id="rbFolio" value="inventario" checked />
                  <input id="txtExtensiones" name="txtExtensiones" style="display: inline;" type="text" >
                  <button onclick="agregarLoteExtensionesTemp()" style="display: inline;" class="btn btn-success" type="button"><i class="fa fa-search"></i> Agregar</button>
            </div>
         </div>
         <div class="row" style="overflow-y: auto; ">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                  <div class="x_content">
                     <div class="table-responsive">
                        <table id="tblLoteExtensiones" class="table table-striped">
                           <thead>
                              <tr class="headings">
                                 <th class="column-title">ID</th>
                                 <th class="column-title">Modelo</th>
                                 <th class="column-title">Serie</th>
                                 <th class="column-title">Opciones</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
   </div>
</div>

<div id="mdlCarritos" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Carritos</h4>
         </div>
         <div class="modal-body">
            <div class="col-md-12 col-sm-12 col-xs-12" id="divCarritos">
               <p style="display: inline;">
                  No. Inventario:
                  <input type="radio" class="flat" name="rbBusqueda" id="rbFolio" value="inventario" checked />
                  <input id="txtCarritos" name="txtCarritos" style="display: inline;" type="text" >
                  <button onclick="agregarLoteCarritosTemp()" style="display: inline;" class="btn btn-success" type="button"><i class="fa fa-search"></i> Agregar</button>
            </div>
         </div>
         <div class="row" style="overflow-y: auto; ">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                  <div class="x_content">
                     <div class="table-responsive">
                        <table id="tblLoteCarritos" class="table table-striped">
                           <thead>
                              <tr class="headings">
                                 <th class="column-title">ID</th>
                                 <th class="column-title">Modelo</th>
                                 <th class="column-title">Serie</th>
                                 <th class="column-title">Opciones</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
   </div>
</div>

<div id="mdlRampas" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Rampas</h4>
         </div>
         <div class="modal-body">
            <div class="col-md-12 col-sm-12 col-xs-12" id="divRampas">
               <p style="display: inline;">
                  No. Inventario:
                  <input type="radio" class="flat" name="rbBusqueda" id="rbFolio" value="inventario" checked />
                  <input id="txtRampas" name="txtRampas" style="display: inline;" type="text" >
                  <button onclick="agregarLoteRampasTemp()" style="display: inline;" class="btn btn-success" type="button"><i class="fa fa-search"></i> Agregar</button>
            </div>
         </div>
         <div class="row" style="overflow-y: auto; ">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                  <div class="x_content">
                     <div class="table-responsive">
                        <table id="tblLoteRampas" class="table table-striped">
                           <thead>
                              <tr class="headings">
                                 <th class="column-title">ID</th>
                                 <th class="column-title">Modelo</th>
                                 <th class="column-title">Serie</th>
                                 <th class="column-title">Opciones</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
   </div>
</div>

<div id="mdlScanners" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Scanners</h4>
         </div>
         <div class="modal-body">
            <div class="col-md-12 col-sm-12 col-xs-12" id="divScanners">
               <p style="display: inline;">
                  No. Inventario:
                  <input type="radio" class="flat" name="rbBusqueda" id="rbFolio" value="inventario" checked />
                  <input id="txtScanners" name="txtScanners" style="display: inline;" type="text" >
                  <button onclick="agregarLoteScannersTemp()" style="display: inline;" class="btn btn-success" type="button"><i class="fa fa-search"></i> Agregar</button>
            </div>
         </div>
         <div class="row" style="overflow-y: auto; ">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                  <div class="x_content">
                     <div class="table-responsive">
                        <table id="tblLoteScanners" class="table table-striped">
                           <thead>
                              <tr class="headings">
                                 <th class="column-title">ID</th>
                                 <th class="column-title">ID Base</th>
                                 <th class="column-title">Modelo</th>
                                 <th class="column-title">Serie</th>
                                 <th class="column-title">Opciones</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
   </div>
</div>

<div id="mdlImpresoras" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Impresoras</h4>
         </div>
         <div class="modal-body">
            <div class="col-md-12 col-sm-12 col-xs-12" id="divImpresoras">
               <p style="display: inline;">
                  No. Inventario:
                  <input type="radio" class="flat" name="rbBusqueda" id="rbFolio" value="inventario" checked />
                  <input id="txtExtImpresoras" name="txtExtImpresoras" style="display: inline;" type="text" >
                  <button onclick="agregarLoteImpresorasTemp()" style="display: inline;" class="btn btn-success" type="button"><i class="fa fa-search"></i> Agregar</button>
            </div>
         </div>
         <div class="row" style="overflow-y: auto; ">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                  <div class="x_content">
                     <div class="table-responsive">
                        <table id="tblLoteImpresoras" class="table table-striped">
                           <thead>
                              <tr class="headings">
                                 <th class="column-title">ID</th>
                                 <th class="column-title">Modelo</th>
                                 <th class="column-title">Serie</th>
                                 <th class="column-title">Opciones</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
   </div>
</div>
<div id="mdlProveedores" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
         </div>
         <div class="modal-body">
            <form>
               <div style="display: none;" id="divBusqueda">
                  <label>Buscar: </label>
                  <div class="input-group">
                     <input id="txtBuscarCliente" type="text" class="form-control" placeholder="Buscar Cliente...">
                     <span class="input-group-btn">
                     <button onclick="buscarCliente()" class="btn btn-default" type="button">Buscar</button>
                     </span>
                  </div>
               </div>
               <br>
               <table id="tblBuscarProveedores" class="data table table-striped no-margin">
                  <tbody>
                  </tbody>
               </table>
            </form>
         </div>
      </div>
   </div>
</div>
<div id="mdlContactos" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
         </div>
         <div class="modal-body">
            <form>
               <br>
               <table id="tblContactos" class="data table table-striped no-margin">
                  <thead>
                     <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Seleccionar</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- MODAL REQUISITOR -->
<div id="mdlRequisitor" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Seleccionar Responsable</h4>
         </div>
         <div class="modal-body">
            <form>
               <table id="tblAutores" class="data table table-striped no-margin">
                  <thead>
                     <tr>
                        <th>Nombre</th>
                        <th>Puesto</th>
                        <th style="width: 20%">Opciones</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- D A T O S -->
<!-- footer content -->
<footer>
   <div class="pull-right">
      Equipo de Desarrollo | MAS Metrología
   </div>
   <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
<!-- jQuery -->
<script src=<?= base_url("template/vendors/jquery/dist/jquery.min.js"); ?>></script>
<!-- Bootstrap -->
<script src=<?= base_url("template/vendors/bootstrap/dist/js/bootstrap.min.js"); ?>></script>
<!-- PNotify -->
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.buttons.js"); ?>></script>
<script src=<?= base_url("template/vendors/pnotify/dist/pnotify.nonblock.js"); ?>></script>
<!-- iCheck -->
<script src=<?= base_url("template/vendors/iCheck/icheck.min.js"); ?>></script>
<!-- formatCurrency -->
<script src=<?= base_url("template/vendors/formatCurrency/jquery.formatCurrency-1.4.0.js"); ?>></script>
<!-- Custom Theme Scripts -->
<script src=<?= base_url("template/build/js/custom.js"); ?>></script>
<!-- JS FILE -->
<script src=<?= base_url("application/views/basculas/js/crear_lote.js"); ?>></script>
<script>
   $(document).ready(function(){
         load();
         eventos();
     });
   function eventos(){
   
         $( '#txtAccesorios' ).on( 'keypress', function( e ) {
             if( e.keyCode === 13 ) {
                 validarAccesorios();
             }
         });
         $( '#txtBusqueda' ).on( 'keypress', function( e ) {
             if( e.keyCode === 13 ) {
                 agregarLoteTemp();
             }
         });
         $( '#txtBascula' ).on( 'keypress', function( e ) {
             if( e.keyCode === 13 ) {
                 agregarLoteTemp();
             }
         });
     }
</script>
</body>
</html>