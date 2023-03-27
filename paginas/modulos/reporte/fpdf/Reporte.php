<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: Generar Reporte pdf con  fpdf 
       Recursos: Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->

    <?php
    require('./fpdf.php');
    class PDF extends FPDF
    {
    protected $col = 0; // Columna actual
    protected $y0;      // Ordenada de comienzo de la columna
    // Cabecera de página
    function Header()
    {
      include '../../../conexion/conexion.php';//llamamos a la conexion BD
      $consulta_info = $conn->query("SELECT * FROM empresa");//traemos datos de la empresa desde BD
      $dato_info = $consulta_info->fetch_object();
      $this->Image('logo.png', 185, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode($dato_info->nombre_empresa), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color
      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE EMPLEADO"), 0, 1, 'C', 0);
      $this->Ln(7);
      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(10, 10, utf8_decode('ID'), 1, 0, 'C', 1);
      $this->Cell(70, 10, utf8_decode('EMAIL'), 1, 0, 'C', 1);
      $this->Cell(70, 10, utf8_decode('DEPARTAMENTO'), 1, 1, 'C', 1);
      $this->y0 = $this->GetY();      
    }
    // Pie de página
    function Footer()
    {
       $this->SetY(-15); // Posición: a 1,5 cm del final
       $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
       $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)
 
       $this->SetY(-15); // Posición: a 1,5 cm del final
       $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
       $hoy = date('d/m/Y');
       $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
    }
 }
    include '../../../conexion/conexion.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$datos_info = $conn->query(" select *from empresa");
//$dato_info = $conn_info->fetch_object();
    $pdf = new PDF();
    $pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
    $pdf->AliasNbPages(); //muestra la pagina / y total de paginas
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetDrawColor(163, 163, 163); //colorBorde
    $consulta_reporte_alquiler = $conn->query("SELECT empleado.id,empleado.`email`,empleado.`departamento` FROM empleado");
    while ($datos_reporte = $consulta_reporte_alquiler->fetch_object()) {  
   /* TABLA */
    $pdf->Cell(10, 10, utf8_decode($datos_reporte->id),1,0,'C',0);
    $pdf->Cell(70, 10,utf8_decode($datos_reporte->email),1,0,'C',0);
    $pdf->Cell(70, 10,utf8_decode($datos_reporte->departamento),1,1,'C',0);
    }
    $pdf->Output('Reportempleado.pdf','F');//nombreDescarga, Visor(I->visualizar - F->descargar)
    ?>